document.addEventListener('DOMContentLoaded', function () {
    const video = document.querySelector('.video-large');
    const pauseButton = document.getElementById('pause-video-btn'); // Corrected line
    const bottomContent = document.getElementById('top-content-module');
    const watchVideoBtn = document.getElementById('watch-video-btn');

    if (!video || !pauseButton || !bottomContent || !watchVideoBtn) {
        console.error("One or more elements are missing!");
        return;
    } else {
        console.log("OK");
    }

    // Check if bottomContent exists before setting its width
    if (bottomContent) {
        bottomContent.style.width = '75%';
    }

    pauseButton.addEventListener('click', function () {
        if (video.paused) {
            video.play();
            pauseButton.querySelector('i').classList.replace('bi-play-fill', 'bi-pause-fill');
        } else {
            video.pause();
            pauseButton.querySelector('i').classList.replace('bi-pause-fill', 'bi-play-fill');
        }
    });

    window.addEventListener('scroll', function () {
        const scrollTop = window.scrollY;
        const maxScroll = 300; // Set the maximum scroll range
        const scrollPercent = Math.min(scrollTop / maxScroll, 1); // Cap the scroll percentage at 1

        // Adjust button size and opacity
        const maxScale = 1;
        const minScale = 0.5;
        const maxOpacity = 1;
        const minOpacity = 0;

        const scale = maxScale - scrollPercent * (maxScale - minScale);
        const opacity = maxOpacity - scrollPercent * (maxOpacity - minOpacity);

        if (watchVideoBtn) {
            watchVideoBtn.style.transform = `scale(${scale})`;
            watchVideoBtn.style.opacity = opacity;
        }

        // Adjust bottomContent width, border radius, and opacity
        if (bottomContent) {
            const initialWidth = 75; // Initial width in percentage
            const finalWidth = 100; // Final width in percentage
            const width = initialWidth + scrollPercent * (finalWidth - initialWidth);
            bottomContent.style.width = `${width}%`;

            const initialBorderRadius = 30; // Initial border radius in pixels
            const finalBorderRadius = 0; // Final border radius in pixels
            const borderRadius = initialBorderRadius - scrollPercent * initialBorderRadius;
            bottomContent.style.borderTopLeftRadius = `${borderRadius}px`;
            bottomContent.style.borderTopRightRadius = `${borderRadius}px`;

            const initialOpacity = 0.9; // Initial opacity
            const finalOpacity = 1; // Final opacity
            const bottomContentOpacity = initialOpacity + scrollPercent * (finalOpacity - initialOpacity);
            bottomContent.style.opacity = bottomContentOpacity;
        }
    });
});