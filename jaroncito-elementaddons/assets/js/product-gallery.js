document.addEventListener('DOMContentLoaded', function() {
    // Ensure Swiper is loaded
    if (typeof Swiper === 'undefined') {
        console.error('Swiper library is not loaded.');
        return;
    }
    console.log('Swiper version:', Swiper.version);

    var swiperContainer = document.querySelector('.jaroncito-gallery-carousel');
    if (!swiperContainer) return;

    // Get configuration from data attributes
    var imagesPerView = parseInt(swiperContainer.dataset.imagesPerView, 10) || 3;
    var slidesToScroll = parseInt(swiperContainer.dataset.slidesToScroll, 10) || 1;

    // Initialize Swiper
    var gallerySwiper = new Swiper('.jaroncito-gallery-carousel.swiper-container', {
        loop: false,
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        slidesPerView: imagesPerView,
        slidesPerGroup: slidesToScroll,
        spaceBetween: 10,
        breakpoints: {
            768: {
                slidesPerView: imagesPerView,
            }
        }
    });

    // Update the main image when clicking on a gallery image
    document.querySelectorAll('.jaroncito-gallery-item img').forEach(function (thumbnail) {
        thumbnail.addEventListener('click', function () {
            var mainImage = document.querySelector('.jaroncito-main-product-image');
            if (mainImage) {
                mainImage.src = this.src;
            }
        });
    });

        // Lightbox functionality
    const mainImage = document.querySelector('.jaroncito-main-product-image');
    if (mainImage && mainImage.dataset.lightbox === 'yes') {
        mainImage.addEventListener('click', function() {
            const lightbox = document.createElement('div');
            lightbox.className = 'jaroncito-lightbox';
            lightbox.innerHTML = `
                <div class="lightbox-content">
                    <img src="${this.src}" alt="${this.alt}">
                    <button class="lightbox-prev">&lt;</button>
                    <button class="lightbox-next">&gt;</button>
                    <button class="lightbox-close">&times;</button>
                </div>
            `;
            document.body.appendChild(lightbox);
            
            // Handle navigation
            const images = Array.from(document.querySelectorAll('.jaroncito-gallery-thumbnail'));
            let currentIndex = parseInt(this.dataset.index);
            
            lightbox.querySelector('.lightbox-next').addEventListener('click', () => {
                currentIndex = (currentIndex + 1) % images.length;
                lightbox.querySelector('img').src = images[currentIndex].src;
            });
            
            lightbox.querySelector('.lightbox-prev').addEventListener('click', () => {
                currentIndex = (currentIndex - 1 + images.length) % images.length;
                lightbox.querySelector('img').src = images[currentIndex].src;
            });
            
            lightbox.querySelector('.lightbox-close').addEventListener('click', () => {
                lightbox.remove();
            });
        });
    }
});

