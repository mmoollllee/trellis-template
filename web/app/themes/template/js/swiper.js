
var swipers = [];
$(document).ready(function() {
   var selector = '';

   selector = '.video.swiper-container';
   if ($(selector).length) {
      $(selector).each(function(e) {
         $(this).append('<button class="swiper-button-next"></button><button class="swiper-button-prev"></button>');
      });
      var loop = $(selector).find('.swiper-slide').length > 1;
      swipers['video'] = new Swiper(selector, {
         navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
         },
         loop,
         grabCursor: true,
         watchOverflow: true,
         init: false,
      })

      if (loop) {
         var timeout;
         swipers['video'].on('init slideChange', function(swiper) { 
            var prev = swiper.previousIndex;
            var current = swiper.activeIndex;
            console.log(timeout);
            if (timeout) {
               console.log('cleared timeout');
               clearTimeout(timeout);
            }
            if (swiper.slides[prev].classList.contains('is-video')) {
               console.log('pause previous');
               var video = swiper.slides[prev].getElementsByTagName("video")[0];
               video.pause();
               video.removeEventListener("ended", function() { return });
            }
            if (swiper.slides[current].classList.contains('is-video')) {
               console.log('play');
               var video = swiper.slides[current].getElementsByTagName("video")[0];
               video.play();
               video.addEventListener("ended", function() {
                  console.log('ended');
                  swiper.slideNext();
               });
            } else {
               timeout = setTimeout(function() {
                  console.log('timed out');
                  swiper.slideNext();
               }, 5000)
            }
         });
      }
      swipers['video'].init();
   }

   selector = '.header-grid .images.no-video.swiper-container';
   if ($(selector).length) {
      $(selector).each(function(e) {
         $(this).append('<button class="swiper-button-next"></button><button class="swiper-button-prev"></button>');
      });
      swipers['header-grid'] = new Swiper(selector, {
         navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
         },
         grabCursor: true,
         watchOverflow: true,
      })
   }

   selector = '.header-grid .images.with-video.swiper-container';
   if ($(selector).length) {
      $(selector).each(function(e) {
         $(this).prepend('<button class="swiper-button-next"></button><button class="swiper-button-prev"></button><div class="swiper-scrollbar"></div>');
      });
      swipers['header-grid'] = new Swiper(selector, {
         navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
         },
         scrollbar: {
            el: '.swiper-scrollbar',
            draggable: true
         },
         grabCursor: true,
         watchOverflow: true,
         slidesPerView: 'auto',
         watchOverflow: true,
         observer: true
      })
   }

   selector = '.gallery.swiper-container';
   if ($(selector).length) {
      $(selector).each(function(e) {
         $(this).append('<button class="swiper-button-next"></button><button class="swiper-button-prev"></button><div class="swiper-scrollbar"></div>');
      });
      swipers['gallery'] = new Swiper(selector, {
         navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
         },
         scrollbar: {
            el: '.swiper-scrollbar',
            draggable: true
         },
         slidesPerView: 'auto',
         grabCursor: true,
         watchOverflow: true,
         observer: true
      })
   }

   selector = '.category .swiper-container';
   if ($(selector).length) {
      $(selector).each(function(e) {
         $(this).prepend('<button class="swiper-button-next"></button><button class="swiper-button-prev"></button><div class="swiper-scrollbar"></div>');
      });
      swipers['category'] = new Swiper(selector, {
         navigation: {
         nextEl: '.swiper-button-next',
         prevEl: '.swiper-button-prev',
         },
         scrollbar: {
            el: '.swiper-scrollbar',
            draggable: true
         },
         slidesPerView: 'auto',
         grabCursor: true,
         watchOverflow: true,
         observer: true,
         centerInsufficientSlides: true
      })
   }

   $(window).load(function() {
      setTimeout(function() {
         if (swipers['gallery'] && swipers['gallery'].$el) {
            console.log('updated');
            swipers['gallery'].update();
         }
      }, 200)
   })
})

function nextWhenFinished(current, swiper) {
   var slides = [...swiper.slides];
   var next = current + 1;
   if (slides.length == next) {
      next = 0;
   }
   if (slides[current].classList.contains('is-video')) {
      var video = slides[current].getElementsByTagName("video")[0];
      video.play();
      video.addEventListener("ended", function() {
         console.log('ended');
         swiper.slideTo(next);
         nextWhenFinished(next, swiper)
     });
   } else {
      setTimeout(function() {
         swiper.slideTo(next);
      }, 5000)
   }
}
