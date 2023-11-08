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
      // parallax.style.scale += 0.1;
    } else if (currentScroll < lastScroll && !menu.hasClass('swing-out-top-bck') ) {
      menu.addClass('swing-out-top-bck');
      menu.removeClass('swing-in-top-fwd');
      // parallax.style.scale -= 0.1;
    }
    lastScroll = currentScroll;
  });

});
