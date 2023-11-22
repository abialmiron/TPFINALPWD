$(document).ready(function () {
  var altura = $('.menu').offset().top;
  let lastScroll = 0;
  const menu = $(".menu");
  const parallax = $(".parallax");
  $(window).on('scroll', function () {
    const currentScroll = $(window).scrollTop();
    menu.removeClass('hidden');
    if (currentScroll > lastScroll && !menu.hasClass('swing-in-top-fwd') ) {
      menu.removeClass('swing-out-top-bck');
      menu.addClass('swing-in-top-fwd');
    } else if (currentScroll < lastScroll && !menu.hasClass('swing-out-top-bck') && !$('a').hasClass('dropdown-toggle show') && !$('.navbar-collapse').hasClass('show') ) {
      menu.addClass('swing-out-top-bck');
      menu.removeClass('swing-in-top-fwd');
    }
    lastScroll = currentScroll;
  });


  function mousemove(event) {
    if (event.clientY < 100) {
      menu.removeClass('hidden');
      menu.removeClass('swing-out-top-bck');
      menu.addClass('swing-in-top-fwd');
    } else if (event.clientY > 100 && lastScroll == 0 && !$('a').hasClass('dropdown-toggle show') && !$('.navbar-collapse').hasClass('show')) {
      menu.removeClass('swing-in-top-fwd');
      menu.addClass('swing-out-top-bck');
    }
  }
  
  window.addEventListener('mousemove', mousemove);
});
