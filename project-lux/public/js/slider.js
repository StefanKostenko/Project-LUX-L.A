$('.box-container').slick({
    slidesToShow: 3,
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 2000,
    dots: true,
    arrows: false,
    customPaging: function (slider, i) {
      return '<button class="my-custom-dots"></button>';
    }
  });