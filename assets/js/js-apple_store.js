
function toggleVideo() {
    var video = document.getElementById("heroVideo");
    if (video.paused) {
        video.play();
    } else {
        video.pause();
    }
}
