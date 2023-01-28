/**
 * https://gomakethings.com/how-to-update-localstorage-with-vanilla-javascript/
 * Add an item to a localStorage() array
 * @param {String} name  The localStorage() key
 * @param {String} value The localStorage() value
 */
var addToLocalStorageArray = function (name, value) {
  // Get the existing data
  var existing = localStorage.getItem(name);

  // If no existing data, create an array
  // Otherwise, convert the localStorage string to an array
  existing = existing ? existing.split(',') : [];

  // Add new data to localStorage Array
  existing.push(value);

  // Save back to localStorage
  localStorage.setItem(name, existing.toString());
};

/**
 * Add an item to a localStorage() object
 * @param {String} name  The localStorage() key
 * @param {String} key   The localStorage() value object key
 * @param {String} value The localStorage() value object value
 */
var addToLocalStorageObject = function (name, key, value) {
  // Get the existing data
  var existing = localStorage.getItem(name);

  // If no existing data, create an array
  // Otherwise, convert the localStorage string to an array
  existing = existing ? JSON.parse(existing) : {};

  // Add new data to localStorage Array
  existing[key] = value;

  // Save back to localStorage
  localStorage.setItem(name, JSON.stringify(existing));
};

const swiper = new Swiper('.cat-tinder-swiper', {
  loop: true,
  slidesPerView: 1,
  centeredSlides: true,
  effect: 'coverflow',
  speed: 500,
  // hashNavigation: {
  //   watchState: true,
  // },
  navigation: {
    nextEl: '.cat-tinder-next',
    prevEl: '.cat-tinder-prev',
  },
});

jQuery(function ($) {
  // $('.cat-card').on('click', function (event) {
  //   event.preventDefault();
  //   console.log('click:', $(this).data('id'));
  //   $('#cat-modal').addClass('show');
  //   $.ajax({
  //     type: 'POST',
  //     url: '/wp-admin/admin-ajax.php',
  //     dataType: 'json',
  //     data: {
  //       action: 'load_cat',
  //       cat_id: $(this).data('id'),
  //     },
  //     //success: function (res) {
  //     //console.log(res);
  //     // $('.news-grid').html(res);
  //     // $('.filter-news-loader .spinner-border')
  //     //   .removeClass('opacity-100')
  //     //   .addClass('opacity-0');
  //     //},
  //   })
  //     .done(function (res) {
  //       //console.log(JSON.stringify(res));
  //       //console.log(res.id);
  //       let image = res.images[0]['sizes']['medium_large'];
  //       let name = res.name;
  //       let age = res.age;
  //       let gender = res.gender;
  //       let id = res.id;
  //       let microchip = res.microchip;
  //       let description = res.description;
  //       if (image) {
  //         $('.loader-image').hide();
  //         $('.cat-modal-image').show();
  //         $('.cat-image').attr('src', image);
  //       }
  //       $('.loader-content').hide();
  //       $('.loader-button').hide();
  //       $('.cat-modal-content').show();
  //       $('.btn-love').show();

  //       $('.cat-name').html(name).show();
  //       if (description) {
  //         $('.cat-description').html(description).show();
  //       }
  //       if (age) {
  //         $('.cat-info-table tbody').append(
  //           '<tr><th>Age</th><td>' + age['label'] + '</td></tr>'
  //         );
  //       }
  //       if (gender) {
  //         $('.cat-info-table tbody').append(
  //           '<tr><th>Gender</th><td>' + gender + '</td></tr>'
  //         );
  //       }
  //       if (id) {
  //         $('.cat-info-table tbody').append(
  //           '<tr><th>ID No</th><td>' + id + '</td></tr>'
  //         );
  //       }
  //       if (microchip) {
  //         $('.cat-info-table tbody').append(
  //           '<tr><th>Microchip No</th><td>' + microchip + '</td></tr>'
  //         );
  //       }
  //     })
  //     .fail(function () {
  //       console.log('error');
  //     })
  //     .always(function () {
  //       console.log('complete');
  //     });
  // });

  $('.cat-modal-close').on('click', function (event) {
    event.preventDefault();
    $('#cat-modal').removeClass('show');
    reset_cat_modal();
  });

  function reset_cat_modal() {
    $('.loader-image').show();
    $('.cat-modal-image').hide();
    $('.cat-image').attr('src', '');
    $('.loader-content').show();
    $('.loader-button').show();
    $('.cat-modal-content').hide();
    $('.btn-love').hide();
    $('.cat-name').html('').hide();
    $('.cat-description').html('').hide();
    $('.cat-info-table tbody').html('');
  }

  $('.cat-tinder-card').on('click', function (event) {
    event.preventDefault();
    swiper.slideTo($(this).data('index'), 0);
    $('body, html').addClass('overflow-hidden');
    $('.cat-tinder-modal').addClass('show');
  });
  $('.cat-tinder-modal-trigger-close').on('click', function (event) {
    event.preventDefault();
    $('.cat-tinder-modal').removeClass('show');
  });
  $('.cat-tinder-modal-btn-close').on('click', function (event) {
    event.preventDefault();
    $('.cat-tinder-modal').removeClass('show');
    $('body, html').removeClass('overflow-hidden');
  });
  $('.cat-tinder-btn-love, .cat-tinder-grid-btn-love').on(
    'click',
    function (event) {
      event.preventDefault();
      if (!$(this).hasClass('selected')) {
        //$(this).toggleClass('selected');
        $('[data-id="' + $(this).data('id') + '"]').toggleClass('selected');
        $('[data-id="' + $(this).data('id') + '"]')
          .children('.btn-love-label')
          .text('Wishlisted');
        let cat_post_id = $(this).data('id');
        let cat_name = $(this).data('name');
        let cat_id = $(this).data('catid');
        let cat_microchip = $(this).data('microchip');
        let json = {
          name: cat_name,
          post_id: cat_post_id,
          cat_id: cat_id,
          microchip: cat_microchip,
        };
        addToLocalStorageObject('cats_object', cat_post_id, json);
      } else {
        //$(this).toggleClass('selected');
        $('[data-id="' + $(this).data('id') + '"]').toggleClass('selected');
        $('[data-id="' + $(this).data('id') + '"]')
          .children('.btn-love-label')
          .text('Wishlist Me');
        let cats = JSON.parse(localStorage.getItem('cats_object'));
        let cat_post_id = $(this).data('id');
        delete cats[cat_post_id];
        localStorage.setItem('cats_object', JSON.stringify(cats));
      }

      let cats = JSON.parse(localStorage.getItem('cats_object'));
      if (Object.keys(cats).length > 0) {
        $('body').addClass('has-cta-bar');
        $('#wishlist-count').text(
          Object.keys(cats).length > 1
            ? Object.keys(cats).length + ' cats'
            : '1 cat'
        );
        let cat_names = '';
        $.each(cats, function (key, value) {
          cat_names +=
            value['name'] + ' (ID: ' + value['cat_id'] + ')' + '\r\n';
        });
        $('#field_wishlist_cat_names').val(cat_names);
      } else {
        $('body').removeClass('has-cta-bar');
        $('#wishlist-count').text('0 cat');
      }
    }
  );

  $('.btn-email-wishlist').on('click', function (event) {
    event.preventDefault();
    $('body, html').addClass('overflow-hidden');
    $('.cat-tinder-modal').removeClass('show');
    $('.cat-tinder-email-wishlist').addClass('show');
  });
  $('.cat-tinder-email-wishlist-btn-close').on('click', function (event) {
    event.preventDefault();
    location.reload();
    $('.cat-tinder-email-wishlist').removeClass('show');
    $('body, html').removeClass('overflow-hidden');
  });

  let cats = JSON.parse(localStorage.getItem('cats_object'));
  $.each(cats, function (key, value) {
    //console.log(key + ': ' + value['name']);
    $('[data-id="' + key + '"]').addClass('selected');
    $('[data-id="' + key + '"]')
      .children('.btn-love-label')
      .text('Wishlisted');
  });

  if (Object.keys(cats).length > 0) {
    $('body').addClass('has-cta-bar');
    $('#wishlist-count').text(
      Object.keys(cats).length > 1
        ? Object.keys(cats).length + ' cats'
        : '1 cat'
    );
  } else {
    $('body').removeClass('has-cta-bar');
    $('#wishlist-count').text('0 cat');
  }

  // Formidable Forms
  if (Object.keys(cats).length > 0) {
    let cat_names = '';
    $.each(cats, function (key, value) {
      //console.log(key + ': ' + value['name']);
      cat_names += value['name'] + ' (ID: ' + value['cat_id'] + ')' + '\r\n';
    });
    $('#field_cats_names').val(cat_names);
    $('#field_wishlist_cat_names').val(cat_names);
  }

  //element = $('a[data-item-id="stand-out"]');
});
