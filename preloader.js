$(document).ready(function() {
//Preloader
$(window).load(function() {
preloaderFadeOutTime = 500;
function hidePreloader() {
var preloader = $('.preloader-wrapper');
preloader.fadeOut(preloaderFadeOutTime);
}
hidePreloader();
});
});
