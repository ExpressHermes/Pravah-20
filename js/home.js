function displayNextImage() {
    x = (x === images.length - 1) ? 0 : x + 1;
    m = x + 1;
    document.getElementById("img").style.backgroundImage = images[x];
}

function displayPreviousImage() {
    x = (x <= 0) ? images.length - 1 : x - 1;
    document.getElementById("img").style.backgroundImage = images[x];
}

function startTimer() {
    setInterval(displayNextImage, 5000);
}


var images = [],
    x = -1;
for (i = 0; i <= 2; i++) {
    m = i + 1;
        images[i] = "url('images/homeBackground/img" + m + ".jpg')";
}