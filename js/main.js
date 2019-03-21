var intervalId = 0;
var $scrollButton = document.querySelector('.scroll');

function scrollStep() {
  if (window.pageYOffset === 0) {
    clearInterval(intervalId);
  }
  window.scroll(0, window.pageYOffset - 50);
}

function scrollToTop() {
  intervalId = setInterval(scrollStep, 15.00);
}
$scrollButton.addEventListener('click', scrollToTop);

$(document).ready(function () {

  /*! Fades in page on load */
  $('body').css('display', 'none');
  $('body').fadeIn(1000);

});

$('#sm-box').delay(3000).fadeOut();

$('.confirm-ms-link').on('click', function () {
  if (confirm('Are you sure?')) {
    return true;
  }
  return false;
});

$('#myModal').on('shown.bs.modal', function () {
  $('#myInput').trigger('focus')
})