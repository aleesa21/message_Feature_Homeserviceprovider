document.addEventListener("DOMContentLoaded", () => {
    const track = document.querySelector('.carousel-track');
    const items = document.querySelectorAll('.carousel-item');
    const dotsContainer = document.createElement('div');
    dotsContainer.classList.add('carousel-dots');
    document.querySelector('.carousel').appendChild(dotsContainer);

    items.forEach((_, index) => {
        const dot = document.createElement('span');
        if (index === 0) dot.classList.add('active');
        dotsContainer.appendChild(dot);
    });

    let currentIndex = 0;

    const updateCarousel = () => {
        const dots = document.querySelectorAll('.carousel-dots span');
        dots.forEach((dot, index) => {
            dot.classList.toggle('active', index === currentIndex);
        });
        track.style.transform = `translateX(-${currentIndex * 100}%)`;
    };

    const autoSlide = () => {
        currentIndex = (currentIndex + 1) % items.length;
        updateCarousel();
    };

    setInterval(autoSlide, 3000); // Slide every 3 seconds

    document.querySelectorAll('.carousel-dots span').forEach((dot, index) => {
        dot.addEventListener('click', () => {
            currentIndex = index;
            updateCarousel();
        });
    });
});
