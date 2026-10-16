/**
 * Big Altay Design System (BADS)
 * News Interactions: Likes, Shares, Views tracking
 */
document.addEventListener('DOMContentLoaded', () => {
    const STORAGE_KEY_LIKES = 'bads_news_likes';

    const getStoredLikes = () => {
        try {
            return JSON.parse(localStorage.getItem(STORAGE_KEY_LIKES)) || [];
        } catch (e) {
            return [];
        }
    };

    const setStoredLikes = (likes) => {
        try {
            localStorage.setItem(STORAGE_KEY_LIKES, JSON.stringify(likes));
        } catch (e) {
            // LocalStorage quota or privacy mode fallback
        }
    };

    const isPostLiked = (postId) => {
        const likes = getStoredLikes();
        return likes.includes(Number(postId)) || likes.includes(String(postId));
    };

    // Initialize UI active state for previously liked posts
    const updateLikesUI = () => {
        const likedPosts = getStoredLikes();
        document.querySelectorAll('.bads-reactions__btn--like, .bads-card__metric-btn--like').forEach((btn) => {
            const postId = btn.dataset.postId;
            if (!postId) return;
            if (likedPosts.includes(Number(postId)) || likedPosts.includes(String(postId))) {
                btn.classList.add('is-active');
                btn.setAttribute('aria-pressed', 'true');
            } else {
                btn.classList.remove('is-active');
                btn.setAttribute('aria-pressed', 'false');
            }
        });
    };

    updateLikesUI();

    // Event Delegation: Like Button Click
    document.addEventListener('click', async (e) => {
        const likeBtn = e.target.closest('.bads-reactions__btn--like, .bads-card__metric-btn--like');
        if (!likeBtn) return;

        e.preventDefault();
        e.stopPropagation();

        const postId = likeBtn.dataset.postId;
        if (!postId || likeBtn.dataset.loading === 'true') return;

        likeBtn.dataset.loading = 'true';

        const currentlyLiked = isPostLiked(postId);
        const action = currentlyLiked ? 'unlike' : 'like';

        // Find all like buttons on the page for this post ID (e.g. top and bottom panels in single-news)
        const allMatchingBtns = document.querySelectorAll(
            `.bads-reactions__btn--like[data-post-id="${postId}"], .bads-card__metric-btn--like[data-post-id="${postId}"]`
        );

        // Optimistic UI update across all instances
        const countSpan = likeBtn.querySelector('.bads-reactions__count, .bads-card__metric-count');
        const currentCount = parseInt(countSpan ? countSpan.textContent.trim() : '0', 10) || 0;
        const optimisticCount = Math.max(0, currentlyLiked ? currentCount - 1 : currentCount + 1);

        allMatchingBtns.forEach((btn) => {
            if (currentlyLiked) {
                btn.classList.remove('is-active');
                btn.setAttribute('aria-pressed', 'false');
            } else {
                btn.classList.add('is-active');
                btn.setAttribute('aria-pressed', 'true');
            }
            const span = btn.querySelector('.bads-reactions__count, .bads-card__metric-count');
            if (span) {
                span.textContent = optimisticCount;
            }
        });

        // Local storage update
        let likedPosts = getStoredLikes();
        if (currentlyLiked) {
            likedPosts = likedPosts.filter((id) => id != postId);
        } else {
            likedPosts.push(Number(postId));
        }
        setStoredLikes(likedPosts);

        // AJAX Request
        try {
            const ajaxUrl = (window.badsNewsInteractions && window.badsNewsInteractions.ajaxUrl) || '/wp-admin/admin-ajax.php';
            const nonce = (window.badsNewsInteractions && window.badsNewsInteractions.nonce) || '';

            const formData = new FormData();
            formData.append('action', 'bads_toggle_like');
            formData.append('post_id', postId);
            formData.append('toggle_action', action);
            formData.append('nonce', nonce);

            const res = await fetch(ajaxUrl, {
                method: 'POST',
                body: formData,
            });

            const data = await res.json();
            if (data && data.success && typeof data.data.count !== 'undefined') {
                allMatchingBtns.forEach((btn) => {
                    const span = btn.querySelector('.bads-reactions__count, .bads-card__metric-count');
                    if (span) {
                        span.textContent = data.data.count;
                    }
                });
            }
        } catch (err) {
            console.error('Error toggling like:', err);
        } finally {
            allMatchingBtns.forEach((btn) => {
                btn.dataset.loading = 'false';
            });
        }
    });

    // Event Delegation: Share Button Click
    document.addEventListener('click', async (e) => {
        const shareBtn = e.target.closest('.bads-reactions__btn--share, .bads-card__metric-btn--share');
        if (!shareBtn) return;

        e.preventDefault();
        e.stopPropagation();

        const shareUrl = shareBtn.dataset.url || window.location.href;
        const shareTitle = shareBtn.dataset.title || document.title;

        if (navigator.share) {
            try {
                await navigator.share({
                    title: shareTitle,
                    url: shareUrl,
                });
                return;
            } catch (err) {
                // User cancelled or share aborted - fallback to clipboard below if needed
                if (err.name === 'AbortError') return;
            }
        }

        // Desktop clipboard fallback
        if (navigator.clipboard && navigator.clipboard.writeText) {
            try {
                await navigator.clipboard.writeText(shareUrl);
                showShareFeedback(shareBtn, 'Ссылка скопирована!');
            } catch (err) {
                fallbackCopyText(shareUrl, shareBtn);
            }
        } else {
            fallbackCopyText(shareUrl, shareBtn);
        }
    });

    function showShareFeedback(button, message) {
        let feedback = button.querySelector('.bads-card__metric-tooltip');
        if (!feedback) {
            feedback = document.createElement('span');
            feedback.className = 'bads-card__metric-tooltip';
            button.appendChild(feedback);
        }
        feedback.textContent = message;
        feedback.classList.add('is-visible');

        setTimeout(() => {
            feedback.classList.remove('is-visible');
        }, 2200);
    }

    function fallbackCopyText(text, button) {
        const tempInput = document.createElement('textarea');
        tempInput.value = text;
        tempInput.style.position = 'fixed';
        tempInput.style.left = '-9999px';
        document.body.appendChild(tempInput);
        tempInput.select();
        try {
            document.execCommand('copy');
            showShareFeedback(button, 'Ссылка скопирована!');
        } catch (err) {
            showShareFeedback(button, 'Не удалось скопировать');
        }
        document.body.removeChild(tempInput);
    }

    // Observer for dynamically added news cards (e.g. "Load More")
    const observer = new MutationObserver(() => {
        updateLikesUI();
    });

    const newsGrid = document.getElementById('news-grid');
    if (newsGrid) {
        observer.observe(newsGrid, { childList: true, subtree: true });
    }
});
