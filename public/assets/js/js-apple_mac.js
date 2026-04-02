$(document).ready(function () {
    // Điều khiển Video
    const pauseButton = document.querySelector('.pause-button');
    const video = document.querySelector('.video-container video');

    if (video) {
        if (video.readyState >= 2) {
            video.play();
        } else {
            video.addEventListener('loadeddata', () => {
                video.play();
            });
        }

        if (pauseButton) {
            pauseButton.addEventListener('click', function () {
                if (video.paused) {
                    video.play();
                    this.innerHTML = '<i class="fa fa-pause" aria-hidden="true"></i>';
                    this.setAttribute('aria-label', 'Pause video');
                } else {
                    video.pause();
                    this.innerHTML = '<i class="fa fa-play" aria-hidden="true"></i>';
                    this.setAttribute('aria-label', 'Play video');
                }
            });
        }
    }

    // Khởi tạo Carousel hình ảnh
    $('.image-carousel').slick({
        infinite: false,
        slidesToShow: 4,
        slidesToScroll: 1,
        arrows: true,
        dots: false,
        responsive: [
            {
                breakpoint: 992,
                settings: {
                    slidesToShow: 3
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 2
                }
            },
            {
                breakpoint: 576,
                settings: {
                    slidesToShow: 1
                }
            }
        ]
    });

    // Khởi tạo Carousel icon
    $('.image-carousel-icon').slick({
        infinite: false,
        slidesToShow: 4,
        slidesToScroll: 1,
        arrows: true,
        dots: false,
        responsive: [
            {
                breakpoint: 992,
                settings: {
                    slidesToShow: 3
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 2
                }
            },
            {
                breakpoint: 576,
                settings: {
                    slidesToShow: 1
                }
            }
        ]
    });
});
