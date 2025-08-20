  
  (function() {
    const imagenes1 = [
    'marca6.png', 'marca11.png', 'marca8.png', 'marca4.png', 'marca5.png',
    'marca1.png', 'marca2.png', 'marca7.png', 'marca3.png', 'marca9.png',
    'marca10.png', 'marca12.png', 'marca13.png', 'marca14.png'
  ];

  const imagenes2 = [
    'marca15.png', 'marca16.png', 'marca17.png', 'marca18.png', 'marca19.png',
    'marca20.png', 'marca21.png', 'marca22.png', 'marca23.png', 'marca24.png',
    'marca26.png','marca27.png','marca28.png'
  ];

  function cargarImagenes(imagenes, wrapperId) {
    const wrapper = document.getElementById(wrapperId);
    for (let i = 0; i < 2; i++) { // duplicamos para que el loop se vea más fluido
      imagenes.forEach(src => {
        const slide = document.createElement('div');
        slide.classList.add('swiper-slide');
        slide.innerHTML = `<img src="../build/img/${src}" alt="${src}" class="marca-img" />`;
        wrapper.appendChild(slide);
      });
    }
  }

  cargarImagenes(imagenes1, 'swiper1-wrapper');
  cargarImagenes(imagenes2, 'swiper2-wrapper');

  // Ruleta 1 - izquierda
  new Swiper('.swiper1', {
    slidesPerView: '11',
    spaceBetween: 40,
    loop: true,
    speed: 3000,
    autoplay: {
      delay: 0,
      disableOnInteraction: false,
    },
    allowTouchMove: false,
    loopedSlides: 20,
    breakpoints: {
      320: {
        slidesPerView: '3',
        spaceBetween: 10,
      },
      480: {
        slidesPerView: '5',
        spaceBetween: 20,
      },
      640: {
        slidesPerView: '7',
        spaceBetween: 20,
      },
      768: {
        slidesPerView: '9',
        spaceBetween: 30,
      },
      1024: {
        slidesPerView: '11',
        spaceBetween: 40,
      },
    }
  });

  // Ruleta 2 - derecha
  new Swiper('.swiper2', {
    slidesPerView: '11',
    spaceBetween: 40,
    loop: true,
    speed: 3000,
    autoplay: {
      delay: 0,
      reverseDirection: true,
      disableOnInteraction: false,
    },
    allowTouchMove: false,
    loopedSlides: 20,
    breakpoints: {
      320: {
        slidesPerView: '3',
        spaceBetween: 10,
      },
      480: {
        slidesPerView: '5',
        spaceBetween: 20,
      },
      640: {
        slidesPerView: '7',
        spaceBetween: 20,
      },
      768: {
        slidesPerView: '9',
        spaceBetween: 30,
      },
      1024: {
        slidesPerView: '11',
        spaceBetween: 40,
      },
    }
  });
  })();
