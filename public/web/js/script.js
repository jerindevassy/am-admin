const navHamburger = document.querySelector('.nav-hamburger');
const navMobileMenu = document.querySelector('.nav-mobile-menu');
const navCloseButton = document.querySelector('.nav-close-button');

navHamburger.addEventListener('click', () => {
    navHamburger.classList.toggle('active');
    navMobileMenu.classList.toggle('active');
});

navCloseButton.addEventListener('click', () => {
    navHamburger.classList.remove('active');
    navMobileMenu.classList.remove('active');
});

     /* Product  Carousel Start */
document.addEventListener('DOMContentLoaded', function() {
    const carousel = document.querySelector('.carousel');
    const wrapper = document.querySelector('.carousel-wrapper');
    const prevBtn = document.querySelector('.prev');
    const nextBtn = document.querySelector('.next');
    
    // Clone items for infinite loop
    const items = document.querySelectorAll('.carousel-item');
    const itemWidth = items[0].offsetWidth + parseInt(getComputedStyle(items[0]).marginRight);
    
    // Clone items at the beginning and end
    items.forEach(item => {
        carousel.appendChild(item.cloneNode(true));
        carousel.insertBefore(item.cloneNode(true), carousel.firstChild);
    });

    let currentIndex = items.length; // Start from first real item
    updateCarousel(false);

    function updateCarousel(animate = true) {
        const translation = -currentIndex * itemWidth;
        carousel.style.transition = animate ? 'transform 0.5s ease' : 'none';
        carousel.style.transform = `translateX(${translation}px)`;
        
        // Update active states
        const allItems = document.querySelectorAll('.carousel-item');
        allItems.forEach((item, index) => {
            item.classList.toggle('active', index === currentIndex);
        });
    }

    function handleTransitionEnd() {
        const allItems = document.querySelectorAll('.carousel-item');
        if (currentIndex >= allItems.length - items.length) {
            currentIndex = items.length;
            updateCarousel(false);
        } else if (currentIndex <= items.length - 1) {
            currentIndex = allItems.length - items.length - 1;
            updateCarousel(false);
        }
    }

    carousel.addEventListener('transitionend', handleTransitionEnd);

    prevBtn.addEventListener('click', () => {
        currentIndex--;
        updateCarousel();
    });

    nextBtn.addEventListener('click', () => {
        currentIndex++;
        updateCarousel();
    });

    // Touch events for mobile swipe
    let touchStartX = 0;
    let touchEndX = 0;

    carousel.addEventListener('touchstart', e => {
        touchStartX = e.changedTouches[0].screenX;
    }, { passive: true });

    carousel.addEventListener('touchend', e => {
        touchEndX = e.changedTouches[0].screenX;
        handleSwipe();
    }, { passive: true });

    function handleSwipe() {
        const swipeThreshold = 50;
        const diff = touchStartX - touchEndX;

        if (Math.abs(diff) > swipeThreshold) {
            if (diff > 0) {
                currentIndex++;
            } else {
                currentIndex--;
            }
            updateCarousel();
        }
    }

    // Handle window resize
    let resizeTimer;
    window.addEventListener('resize', () => {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(() => {
            const newItemWidth = items[0].offsetWidth + parseInt(getComputedStyle(items[0]).marginRight);
            updateCarousel(false);
        }, 250);
    });
});
     /* Product  Carousel End */
