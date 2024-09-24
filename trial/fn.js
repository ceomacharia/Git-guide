window.addEventListener('scroll', function() {
    const header = document.querySelector('header');
    const banner = document.querySelector('.banner');
    const headerContainer = document.querySelector('.header-container');
    const bannerHeight = banner.offsetHeight;

    if (window.scrollY > bannerHeight) {
        header.classList.add('sticky-header');
        banner.style.display = 'none';
    } else {
        header.classList.remove('sticky-header');
        banner.style.display = 'block';
    }
});
