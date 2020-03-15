var fab = document.getElementById("fab");
var fab_time = document.getElementById("fab_time");
var fab_done = document.getElementById("fab_done");
var fab_icon = document.getElementById("fab_icon");
var duration = 60 * 60;
var timer = duration, minutes, seconds;
setInterval(function () {
    minutes = parseInt(timer / 60, 10);
    seconds = parseInt(timer % 60, 10);

    minutes = minutes < 10 ? "0" + minutes : minutes;
    seconds = seconds < 10 ? "0" + seconds : seconds;

    fab_time.textContent = minutes + ":" + seconds;

    if (--timer < 0) {
        timer = duration;
    }
}, 1000);

fab.addEventListener("mouseenter", function () {
    fab_done.classList.remove('d-none');
    fab_done.classList.add('d-inline');
    fab_time.classList.remove('d-inline');
    fab_time.classList.add('d-none');

    fab_icon.classList.remove('fa-clock-o');
    fab_icon.classList.add('fa-paper-plane-o');
});
fab.addEventListener("mouseleave", function () {
    fab_time.classList.remove('d-none');
    fab_time.classList.add('d-inline');
    fab_done.classList.remove('d-inline');
    fab_done.classList.add('d-none');

    fab_icon.classList.remove('fa-paper-plane-o');
    fab_icon.classList.add('fa-clock-o');
});
