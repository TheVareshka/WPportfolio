//Инициализация и настройка swiper js
let swiperMini = new Swiper(".header__swiper-slider-mini", {
  loop: true,
  spaceBetween: 15,
  slidesPerGroup: 3,
  slidesPerView: 2,
  freeMode: true,
  watchSlidesProgress: true,
  breakpoints: {

    768: {
      slidesPerView: 2,
      slidesPerGroup: 2,
      
    },
    440: {
      slidesPerView: 2,
      slidesPerGroup: 1,
      spaceBetween: 8,
    },
    320: {
      slidesPerView: 2,
      slidesPerGroup: 1,
    },
  }
});

let swiper = new Swiper(".header__swiper-slider", {
  loop: true,
  spaceBetween: 15,
  slidesPerView: 1,
  navigation: {
    nextEl: ".header__swiper-button-next",
    prevEl: ".header__swiper-button-prev",
  },
  thumbs: {
    swiper: swiperMini,
  },
});

let awardsSlider = new Swiper(".info__swiper-wrapper", {
  direction: 'horizontal',
  slidesPerView: 'auto',
  navigation: {
    nextEl: '.info__swiper-button-next',
    prevEl: '.info__swiper-button-prev',
  },
});