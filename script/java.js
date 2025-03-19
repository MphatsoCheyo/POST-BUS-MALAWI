/*back to top*/

// Back to top functionality
window.onscroll = function() {
    const backToTop = document.getElementById('backToTop');
    if (document.body.scrollTop > 200 || document.documentElement.scrollTop > 200) {
        backToTop.classList.add('visible');
    } else {
        backToTop.classList.remove('visible');
    }
};

// Scroll to top
function scrollToTop() {
    window.scrollTo({
        top: 0,
        behavior: 'smooth'
    });
}