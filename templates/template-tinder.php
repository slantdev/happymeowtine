<?php

/**
 * Template Name: [Campaign] TinderForCats
 * Template Post Type: page
 *
 */
get_header();
nectar_page_header($post->ID);
$nectar_fp_options = nectar_get_full_page_options();

?>

<div class="container-wrap">
  <div class="<?php if ($nectar_fp_options['page_full_screen_rows'] !== 'on') {
                echo 'container';
              } ?> main-content" role="main">
    <div class="row">
      <?php

      nectar_hook_before_content();

      if (have_posts()) :
        while (have_posts()) :

          the_post();
          the_content();

        endwhile;
      endif;

      nectar_hook_after_content();

      ?>
    </div>
  </div>

  <div class="cat-tinder-grid-container">
    <div class="container mx-auto px-4 xl:px-6">
      <?php
      $args = array(
        'post_type' => 'cats_tinder',
        'posts_per_page' => -1,
        'orderby' => 'date',
        'order' => 'DESC',
        'post_status' => 'publish',
      );
      $the_query = new WP_Query($args);
      $index = 0;
      if ($the_query->have_posts()) {
        echo '<div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3 2xl:grid-cols-4 md:gap-6 lg:gap-4 xl:gap-6">';
        while ($the_query->have_posts()) {
          $the_query->the_post();
          $post_id = get_the_ID();
          $id = get_field('cat_tinder_id');
          $cat_gallery = get_field('cat_tinder_images');
          $name = get_the_title();
          $age = get_field('cat_tinder_age');
          $gender = get_field('cat_tinder_gender');
          $microchip = get_field('cat_tinder_microchip');
          $poster_image = $cat_gallery[0]['sizes']['medium_large'];
          $index++;
      ?>
          <div class="relative block rounded-xl md:rounded-3xl overflow-hidden shadow-md hover:shadow-xl transition-all duration-300 lg:hover:scale-105">
            <a href="#<?php echo $id ?>" data-index="<?php echo $index ?>" data-id="<?php echo $id ?>" class="cat-tinder-card block relative">
              <div class="aspect-w-1 aspect-h-1">
                <img src="<?php echo $poster_image ?>" class="w-full h-full object-cover">
              </div>
              <div class="absolute w-full h-full inset-0 bg-gradient-to-t from-black via-transparent to-transparent"></div>
              <div class="px-6 py-6 absolute w-full bottom-0 left-0 right-0 text-white">
                <h4 class="text-3xl font-semibold text-white mb-0 -ml-0.5"><?php echo $name ?></h4>
                <div class="text-sm"><?php echo $gender ?><?php echo ($age) ? ', ' . $age['label'] . ' Old' : ''; ?></div>
              </div>
            </a>
            <div class="absolute top-4 right-4">
              <button type="button" data-id="<?php echo $post_id ?>" data-name="<?php echo $name ?>" data-catid="<?php echo $id ?>" data-microchip="<?php echo $microchip ?>" class="cat-tinder-grid-btn-love">
                <svg class="w-7 h-auto -mb-1" width="20" height="18" viewBox="0 0 20 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path class="path-heart" d="M10 18L8.55 16.7052C3.4 12.1243 0 9.09319 0 5.3951C0 2.36403 2.42 0 5.5 0C7.24 0 8.91 0.79455 10 2.04033C11.09 0.79455 12.76 0 14.5 0C17.58 0 20 2.36403 20 5.3951C20 9.09319 16.6 12.1243 11.45 16.7052L10 18Z" fill="currentColor" />
                  <path class="path-paw" d="M6.12826 5.46902C6.56552 5.46902 7.34994 5.61527 7.34994 6.78602C7.34994 7.95677 6.57347 8.40706 6.12826 8.40706C5.68305 8.40706 5 7.94741 5 6.78602C5 5.62392 5.75063 5.46902 6.12826 5.46902ZM9.75156 5.317C9.75156 4.14625 8.96714 4 8.52988 4C8.15224 4 7.40162 4.1549 7.40162 5.317C7.40162 6.47839 8.08467 6.93804 8.52988 6.93804C8.97509 6.93804 9.75156 6.48775 9.75156 5.317ZM11.4284 4C11.8656 4 12.6501 4.14625 12.6501 5.317C12.6501 6.48775 11.8736 6.93804 11.4284 6.93804C10.9832 6.93804 10.3001 6.47839 10.3001 5.317C10.3001 4.1549 11.0507 4 11.4284 4ZM15 6.78602C15 5.61527 14.2156 5.46902 13.7783 5.46902C13.4007 5.46902 12.6501 5.62392 12.6501 6.78602C12.6501 7.94741 13.3331 8.40706 13.7783 8.40706C14.2235 8.40706 15 7.95677 15 6.78602ZM10 7.2817C12.0498 7.2817 13.302 9.10447 13.302 11.2104C13.302 12.9438 11.4602 13 10 13H9.9947C8.68027 13 6.71856 13 6.71856 11.2104C6.71856 9.0598 7.95084 7.2817 10 7.2817Z" fill="currentColor" />
                </svg>
              </button>
            </div>
          </div>
      <?php
        }
        echo '</div>';
      }
      wp_reset_postdata();
      ?>
    </div>
  </div>

  <div class="cat-tinder-modal">
    <button type="button" class="cat-tinder-modal-btn-close md:hidden fixed top-3 right-3 z-10 font-mono rounded-full w-10 h-10 flex items-center justify-center text-white text-2xl leading-none bg-black cursor-pointer">&times;</button>
    <div class="cat-tinder-swiper swiper">
      <div class="swiper-wrapper">
        <?php
        $args = array(
          'post_type' => 'cats_tinder',
          'posts_per_page' => -1,
          'orderby' => 'date',
          'order' => 'DESC',
          'post_status' => 'publish',
        );
        $the_query = new WP_Query($args);
        if ($the_query->have_posts()) {
          $index = 0;
          while ($the_query->have_posts()) {
            $the_query->the_post();
            $post_id = get_the_ID();
            $cat_gallery = get_field('cat_tinder_images');
            $poster_image = $cat_gallery[0]['sizes']['medium_large'];
            $name = get_the_title();
            $id = get_field('cat_tinder_id');
            $microchip = get_field('cat_tinder_microchip');
            $age = get_field('cat_tinder_age');
            $gender = get_field('cat_tinder_gender');
            $description = get_field('cat_tinder_description');
            $index++;
        ?>
            <div data-hash="<?php echo $id ?>" class="swiper-slide">
              <div class="w-full mx-auto bg-white overflow-y-auto relative h-screen lg:h-auto lg:min-h-[480px] lg:max-w-6xl lg:overflow-hidden lg:rounded-2xl">
                <div class="flex flex-col lg:flex-row w-full h-full">
                  <div class="lg:w-1/2">
                    <div class="cat-modal-image h-full w-full lg:rounded-l-2xl overflow-hidden bg-black">
                      <div id="swiper-image-<?php echo $index ?>" class="swiper">
                        <div class="swiper-wrapper items-center">
                          <?php foreach ($cat_gallery as $cat) { ?>
                            <div class="swiper-slide grow">
                              <div class="aspect-w-1 aspect-h-1 w-full h-full lg:aspect-none lg:w-full lg:h-full relative">
                                <img src="<?php echo $cat['url'] ?>" class="w-full h-full object-cover">
                              </div>
                            </div>
                          <?php } ?>
                        </div>
                        <div class="swiper-pagination"></div>
                      </div>
                      <script>
                        const swiper_image_<?php echo $index ?> = new Swiper('#swiper-image-<?php echo $index ?>', {
                          loop: false,
                          watchOverflow: true,
                          slidesPerView: 1,
                          centeredSlides: true,
                          pagination: {
                            el: '#swiper-image-<?php echo $index ?> .swiper-pagination',
                            clickable: true,
                            type: "progressbar",
                          },
                        });
                      </script>
                      <!-- <img src="<?php echo $poster_image ?>" class="cat-image !w-full !h-full object-cover" /> -->
                    </div>
                  </div>
                  <div class="slide-content lg:w-1/2 flex flex-col">
                    <div class="pt-6 px-4 pb-4 xl:p-8 relative">
                      <div class="absolute -top-7 right-4 lg:hidden z-10">
                        <button type="button" data-id="<?php echo $post_id ?>" data-name="<?php echo $name ?>" data-catid="<?php echo $id ?>" data-microchip="<?php echo $microchip ?>" class="cat-tinder-grid-btn-love !h-14 !w-14 !shadow-md">
                          <svg class="w-7 h-auto -mb-1" width="20" height="18" viewBox="0 0 20 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path class="path-heart" d="M10 18L8.55 16.7052C3.4 12.1243 0 9.09319 0 5.3951C0 2.36403 2.42 0 5.5 0C7.24 0 8.91 0.79455 10 2.04033C11.09 0.79455 12.76 0 14.5 0C17.58 0 20 2.36403 20 5.3951C20 9.09319 16.6 12.1243 11.45 16.7052L10 18Z" fill="currentColor" />
                            <path class="path-paw" d="M6.12826 5.46902C6.56552 5.46902 7.34994 5.61527 7.34994 6.78602C7.34994 7.95677 6.57347 8.40706 6.12826 8.40706C5.68305 8.40706 5 7.94741 5 6.78602C5 5.62392 5.75063 5.46902 6.12826 5.46902ZM9.75156 5.317C9.75156 4.14625 8.96714 4 8.52988 4C8.15224 4 7.40162 4.1549 7.40162 5.317C7.40162 6.47839 8.08467 6.93804 8.52988 6.93804C8.97509 6.93804 9.75156 6.48775 9.75156 5.317ZM11.4284 4C11.8656 4 12.6501 4.14625 12.6501 5.317C12.6501 6.48775 11.8736 6.93804 11.4284 6.93804C10.9832 6.93804 10.3001 6.47839 10.3001 5.317C10.3001 4.1549 11.0507 4 11.4284 4ZM15 6.78602C15 5.61527 14.2156 5.46902 13.7783 5.46902C13.4007 5.46902 12.6501 5.62392 12.6501 6.78602C12.6501 7.94741 13.3331 8.40706 13.7783 8.40706C14.2235 8.40706 15 7.95677 15 6.78602ZM10 7.2817C12.0498 7.2817 13.302 9.10447 13.302 11.2104C13.302 12.9438 11.4602 13 10 13H9.9947C8.68027 13 6.71856 13 6.71856 11.2104C6.71856 9.0598 7.95084 7.2817 10 7.2817Z" fill="currentColor" />
                          </svg>
                        </button>
                      </div>
                      <div class="cat-modal-content">
                        <div class="lg:pt-6">
                          <h4 class="cat-name text-4xl font-semibold mb-2"><?php echo $name ?></h4>
                          <div class="mb-2 text-base text-slate-500">
                            <?php echo $gender ?><?php echo ($age) ? ', ' . $age['label'] . ' Old' : ''; ?>
                          </div>
                          <div class="flex flex-col lg:flex-row gap-x-3 gap-y-2 text-sm">
                            <div>
                              <div class="px-5 py-1.5 text-slate-500 font-medium bg-slate-200 rounded-full whitespace-nowrap inline-block grow-0">ID: <?php echo $id ?></div>
                            </div>
                            <div>
                              <div class="px-5 py-1.5 text-slate-500 font-medium bg-slate-200 rounded-full whitespace-nowrap inline-block grow-0">Microchip: <?php echo $microchip ?></div>
                            </div>
                          </div>
                        </div>
                        <?php if ($description) { ?>
                          <div class="cat-description prose pt-6">
                            <?php echo $description ?>
                          </div>
                        <?php } ?>
                      </div>
                    </div>
                    <div class="px-4 lg:px-8 py-6 bg-slate-100 mt-auto">
                      <button type="button" data-id="<?php echo $post_id ?>" data-name="<?php echo $name ?>" data-catid="<?php echo $id ?>" data-microchip="<?php echo $microchip ?>" class="cat-tinder-btn-love">
                        <svg class="w-6 h-auto" width="20" height="18" viewBox="0 0 20 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <path class="path-heart" d="M10 18L8.55 16.7052C3.4 12.1243 0 9.09319 0 5.3951C0 2.36403 2.42 0 5.5 0C7.24 0 8.91 0.79455 10 2.04033C11.09 0.79455 12.76 0 14.5 0C17.58 0 20 2.36403 20 5.3951C20 9.09319 16.6 12.1243 11.45 16.7052L10 18Z" fill="currentColor" />
                          <path class="path-paw" d="M6.12826 5.46902C6.56552 5.46902 7.34994 5.61527 7.34994 6.78602C7.34994 7.95677 6.57347 8.40706 6.12826 8.40706C5.68305 8.40706 5 7.94741 5 6.78602C5 5.62392 5.75063 5.46902 6.12826 5.46902ZM9.75156 5.317C9.75156 4.14625 8.96714 4 8.52988 4C8.15224 4 7.40162 4.1549 7.40162 5.317C7.40162 6.47839 8.08467 6.93804 8.52988 6.93804C8.97509 6.93804 9.75156 6.48775 9.75156 5.317ZM11.4284 4C11.8656 4 12.6501 4.14625 12.6501 5.317C12.6501 6.48775 11.8736 6.93804 11.4284 6.93804C10.9832 6.93804 10.3001 6.47839 10.3001 5.317C10.3001 4.1549 11.0507 4 11.4284 4ZM15 6.78602C15 5.61527 14.2156 5.46902 13.7783 5.46902C13.4007 5.46902 12.6501 5.62392 12.6501 6.78602C12.6501 7.94741 13.3331 8.40706 13.7783 8.40706C14.2235 8.40706 15 7.95677 15 6.78602ZM10 7.2817C12.0498 7.2817 13.302 9.10447 13.302 11.2104C13.302 12.9438 11.4602 13 10 13H9.9947C8.68027 13 6.71856 13 6.71856 11.2104C6.71856 9.0598 7.95084 7.2817 10 7.2817Z" fill="currentColor" />
                        </svg>
                        <span class="btn-love-label inline-block font-semibold text-base !uppercase">Wishlist Me</span>
                      </button>
                    </div>
                  </div>
                </div>
                <button type="button" class="cat-tinder-modal-btn-close hidden md:flex absolute top-3 right-3 z-10 font-mono rounded-full w-10 h-10 items-center justify-center text-white text-2xl leading-none bg-black cursor-pointer">&times;</button>
              </div>
            </div>
        <?php
          }
        }
        wp_reset_postdata();
        ?>
      </div>
      <div class="absolute w-full h-8 top-1/2 left-0 right-0">
        <div class="w-full h-8 max-w-6xl mx-auto relative">
          <div class="cat-tinder-prev absolute z-30 p-4 -left-20 -translate-y-1/2 flex items-center justify-center text-black bg-white rounded-full shadow-md opacity-80 hover:opacity-100 transition duration-200">
            <svg class="h-5 w-5 rotate-180" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M8.87495 2.9L17.3 11.3C17.4 11.4 17.4706 11.5083 17.512 11.625C17.554 11.7417 17.575 11.8667 17.575 12C17.575 12.1333 17.554 12.2583 17.512 12.375C17.4706 12.4917 17.4 12.6 17.3 12.7L8.87495 21.125C8.64162 21.3583 8.34995 21.475 7.99995 21.475C7.64995 21.475 7.34995 21.35 7.09995 21.1C6.84995 20.85 6.72495 20.5583 6.72495 20.225C6.72495 19.8917 6.84995 19.6 7.09995 19.35L14.45 12L7.09995 4.65C6.86662 4.41667 6.74995 4.12934 6.74995 3.788C6.74995 3.44601 6.87495 3.15 7.12495 2.9C7.37495 2.65 7.66662 2.525 7.99995 2.525C8.33329 2.525 8.62495 2.65 8.87495 2.9Z" fill="currentColor" />
            </svg>
          </div>
          <div class="cat-tinder-next absolute z-30 p-4 -right-20 -translate-y-1/2 flex items-center justify-center text-black bg-white rounded-full shadow-md opacity-80 hover:opacity-100 transition duration-200">
            <svg class="h-5 w-5" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M8.87495 2.9L17.3 11.3C17.4 11.4 17.4706 11.5083 17.512 11.625C17.554 11.7417 17.575 11.8667 17.575 12C17.575 12.1333 17.554 12.2583 17.512 12.375C17.4706 12.4917 17.4 12.6 17.3 12.7L8.87495 21.125C8.64162 21.3583 8.34995 21.475 7.99995 21.475C7.64995 21.475 7.34995 21.35 7.09995 21.1C6.84995 20.85 6.72495 20.5583 6.72495 20.225C6.72495 19.8917 6.84995 19.6 7.09995 19.35L14.45 12L7.09995 4.65C6.86662 4.41667 6.74995 4.12934 6.74995 3.788C6.74995 3.44601 6.87495 3.15 7.12495 2.9C7.37495 2.65 7.66662 2.525 7.99995 2.525C8.33329 2.525 8.62495 2.65 8.87495 2.9Z" fill="currentColor" />
            </svg>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="cat-tinder-cta-bar">
    <div class="container mx-auto px-3 md:px-6">
      <div class="py-4 flex gap-x-2 items-center justify-between md:flex-row md:items-center md:justify-between md:py-6">
        <div class="flex flex-col">
          <div class="text-left md:text-left text-base md:text-xl whitespace-nowrap">
            <span id="wishlist-count" class="font-bold">0 cat</span> <span class="text-slate-500 text-xs md:text-base">in My Wishlist</span>
          </div>
          <button type="button" class="btn-email-wishlist inline-block md:hidden text-sm text-left text-brand-orange underline hover:text-brand-orange hover:underline transition">Email My Wishlist</button>
        </div>
        <div class="flex-none flex flex-col md:flex-row gap-x-1">
          <button type="button" class="hidden md:inline-block order-2 md:order-1 btn-email-wishlist text-sm md:text-base py-0 mt-2 mx:py-3 px-4 md:px-6 rounded-full text-slate-600 hover:text-brand-orange hover:underline transition">Email My Wishlist</button>
          <a href="/adoption-application-form/" class="whitespace-nowrap h-12 inline-flex items-center justify-center order-1 md:order-2 text-sm md:text-lg text-center py-3 px-4 md:px-6 rounded-full bg-brand-orange hover:brightness-110 text-white shadow-md hover:shadow-lg hover:!text-white transition">Book Meet and Greet</a>
        </div>
      </div>
    </div>
  </div>

  <div class="cat-tinder-email-wishlist">
    <?php
    $email_my_wishlist = get_field('email_my_wishlist');

    if ($email_my_wishlist) {
      echo '<div class="h-full">';
      echo '<div class="flex justify-center items-center h-full">';
      echo '<div class="w-full max-w-2xl mx-auto relative pt-10 px-6 pb-2 bg-white rounded-3xl">';
      if ($email_my_wishlist['title']) {
        echo '<h3 class="text-3xl mb-4">' . $email_my_wishlist['title'] . '</h3>';
      }
      if ($email_my_wishlist['description']) {
        echo '<div class="prose mb-4">';
        echo $email_my_wishlist['description'];
        echo '</div>';
      }
      if ($email_my_wishlist['form_shortcode']) {
        echo do_shortcode($email_my_wishlist['form_shortcode']);
      }
      echo '<button type="button" class="cat-tinder-email-wishlist-btn-close absolute top-3 right-3 z-10 font-mono rounded-full w-10 h-10 flex items-center justify-center text-white text-2xl leading-none bg-black cursor-pointer">&times;</button>';
      echo '<div>';
      echo '<div>';
      echo '</div>';
    }
    ?>
  </div>

</div><!--/container-wrap-->

<?php

nectar_hook_before_outer_wrap_close();

get_template_part('includes/partials/footer/off-canvas-navigation');

?>

</div> <!--/ajax-content-wrap-->

<?php
if (
  !empty($nectar_options['boxed_layout']) &&
  $nectar_options['boxed_layout'] === '1' &&
  $header_format !== 'left-header'
) {
  echo '</div><!--/boxed closing div-->';
}

get_template_part('includes/partials/footer/back-to-top');

get_template_part('includes/partials/footer/body-border');


nectar_hook_after_wp_footer();
nectar_hook_before_body_close();

wp_footer();
?>
</body>

</html>