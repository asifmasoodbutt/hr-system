(function ($) {
  "use strict"; // Start of use strict

  // Toggle the side navigation
  $("#sidebarToggle, #sidebarToggleTop").on('click', function (e) {
    $("body").toggleClass("sidebar-toggled");
    $(".sidebar").toggleClass("toggled");
    if ($(".sidebar").hasClass("toggled")) {
      $('.sidebar .collapse').collapse('hide');
    };
  });

  // Close any open menu accordions when window is resized below 768px
  $(window).resize(function () {
    if ($(window).width() < 768) {
      $('.sidebar .collapse').collapse('hide');
    };

    // Toggle the side navigation when window is resized below 480px
    if ($(window).width() < 480 && !$(".sidebar").hasClass("toggled")) {
      $("body").addClass("sidebar-toggled");
      $(".sidebar").addClass("toggled");
      $('.sidebar .collapse').collapse('hide');
    };
  });

  // Prevent the content wrapper from scrolling when the fixed side navigation hovered over
  $('body.fixed-nav .sidebar').on('mousewheel DOMMouseScroll wheel', function (e) {
    if ($(window).width() > 768) {
      var e0 = e.originalEvent,
        delta = e0.wheelDelta || -e0.detail;
      this.scrollTop += (delta < 0 ? 1 : -1) * 30;
      e.preventDefault();
    }
  });

  // Scroll to top button appear
  $(document).on('scroll', function () {
    var scrollDistance = $(this).scrollTop();
    if (scrollDistance > 100) {
      $('.scroll-to-top').fadeIn();
    } else {
      $('.scroll-to-top').fadeOut();
    }
  });

  // Smooth scrolling using jQuery easing
  $(document).on('click', 'a.scroll-to-top', function (e) {
    var $anchor = $(this);
    $('html, body').stop().animate({
      scrollTop: ($($anchor.attr('href')).offset().top)
    }, 1000, 'easeInOutExpo');
    e.preventDefault();
  });

  $(document).ready(function () {
    // Add active class to first item initially
    $(".nav-item:first").addClass("active");

    // Check if there is an active link in local storage
    var activeLink = localStorage.getItem('activeLink');
    if (activeLink) {
      // Remove active class from all items
      $(".nav-item").removeClass("active");
      // Add active class to stored link
      $('a[href="' + activeLink + '"]').closest('.nav-item').addClass('active');
    }

    // Add event listener to items
    $(".nav-item").click(function (event) {
      // Prevent default link behavior
      event.preventDefault();

      // Remove active class from all items
      $(".nav-item").removeClass("active");
      // Add active class to clicked item
      $(this).addClass("active");

      // Get the URL of the clicked link
      var url = $(this).find('a').attr("href");

      // Store the active link in local storage
      localStorage.setItem('activeLink', url);

      // Redirect to the appropriate page
      window.location.href = url;
    });
  });

})(jQuery); // End of use strict
