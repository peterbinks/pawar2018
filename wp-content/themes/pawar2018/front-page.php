<?php
/*
Template name: Front Page Template
 */
get_header(); ?>
  <div class="promo-banner">
    <h1 class="banner-headline">
      Join Ameya at the June 15th Virtual Town Hall.
      <a href="http://watchparty.pawar2018.com" target="_blank">RSVP Now</a>
    </h1>
  </div>
  <main>
    <section class="hero" style="background-image: url(<?php the_field('main_hero_image'); ?>);">
      <div class="row align-bottom">
        <div class="small-11 large-9 columns">
          <h1><?php the_field('hero_headline'); ?></h1>
        </div>
      </div>
      <div class="row align-middle">
        <div class="small-11 large-7 columns">
          <h2><?php the_field('hero_subheadline'); ?></h2>
        </div>
      </div>
      <div class="row align-middle">
        <div class="small-11 columns">
          <h3><?php the_field('hero_cta'); ?></h3>
          <a href="<?php the_field('hero_button_link'); ?>" class="button">
            <?php the_field('hero_button_text'); ?>
          </a>
        </div>
      </div>
    </section>
    <section class="row main-content align-center align-middle">
      <?php if (get_field('has_video')) : ?>
        <div class="small-11 large-6 columns">
          <div class="flex-video widescreen">
            <?php the_field('featured_video'); ?>
          </div>
        </div>
      <div class="small-11 large-6 columns">
      <?php else: ?>
      <div class="small-11 large-4 columns">
        <h1 class="main-callout"><?php the_field('main_callout'); ?></h1>
      </div>
      <div class="small-11 large-8 columns">
      <?php endif; ?>
        <?php echo (get_field('has_video')?'<h1 class="main-callout">'. get_field('main_callout').'</h1>':'');?>
        <p class="main-copy">
          <?php the_field('callout_copy'); ?>
        </p>
      </div>
    </section>
    <section class="action-content">
      <div class="pillar-wrapper">
        <h4 class="section-title"><?php the_field('pillar_headline'); ?></h4>
        <h1 class="main-callout">
          <?php the_field('pillar_subheadline'); ?>
        </h1>
        <div class="row small-up-1">
          <?php
            $args = array(
            'post_type' => 'pillars',
            'orderby' => 'meta_value',
            'order' => 'ASC') ?>
          <?php $loop = new WP_Query($args); ?>
          <?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
            <div class="column column-block pillar-content">
              <img src="<?php echo get_field('pillar_icon') ?>" class="issue-icon" alt="<?php echo get_field('pillar_alt') ?>">
              <div class="pillar-copy">
                <h4 class="pillar-header"><?php the_title();?></h4>
                  <?php the_content() ?>
              </div>
            </div>
          <?php endwhile; ?>
            <?php wp_reset_postdata(); ?>
        </div>
        <div class="pillar-button">
          <a href="<?php the_field('pillar_button_link'); ?>" class="button">
            <?php the_field('pillar_button_text'); ?>
          </a>
        </div>
      </div>
      <div class="event-wrapper">
        <div class="event-content">
          <h4 class="section-title">
            <?php the_field('event_headline'); ?>
          </h4>
          <h1 class="main-callout"><?php the_field('event_subheadline'); ?></h1>
          <div class="row small-collapse">
          <?php
          // eventbrite doesn't work locally :(
          if (class_exists(Eventbrite_Query)) : ?>
            <?php $events = new Eventbrite_Query(
              apply_filters('eventbrite_query_args', array(
                'limit' => 2
              )
            ));
            if ($events->have_posts()) :
              while ($events->have_posts()) :
                $events->the_post(); ?>
                  <div class="column small-11 large-8 event-copy">
                    <a href="<?php the_field('link'); ?>">
                      <p class="event-date">
                        <?php
                        echo date_format($date, 'l, F d \a\t h:i a');
                        ?>
                      </p>
                      <h5 class="event-title">
                        <?php the_title();?>
                      </h5>
                      <p class="event-locale">
                        <?= eventbrite_event_venue()->name; ?>
                      </p>
                      <span class="event-address">
                        <?php echo eventbrite_event_venue()->address->localized_multi_line_address_display[0]; ?>
                        <br/>
                        <?php echo eventbrite_event_venue()->address->localized_multi_line_address_display[1]; ?>
                      </span>
                    </a>
                  </div>
                </div>
              <?php endwhile;
              // Previous/next post navigation.
              eventbrite_paging_nav($events);

            else :
              // If no content, include the "No posts found" template.
              get_template_part('content', 'none');

            endif;

            // Return $post to its rightful owner.
            wp_reset_postdata();
          else :
              // maybe something more informative here?
              get_template_part('content', 'none');
          endif;

            ?>
          </div>
          <div class="column event-copy">
            <a href="<?php echo esc_url( home_url( '/events' )) ?>" class="button">
              See All Events
            </a>
          </div>
        </div>
        <div class="event-photo">
          <img src="<?php echo get_field('event_photo') ?>" class="event-photo" alt="<?php echo get_field('event_photo_alt') ?>">
        </div>
      </div>
    </section>
    <div class="row align-middle align-center">
      <div class="small-11 large-10 columns">
        <h1 class="main-quote">
          <?php the_field('main_quote'); ?>
        </h1>
        <p class="main-caption">
          <?php the_field('quote_caption'); ?>
        </p>
      </div>
    </div>
    <div class="row bottom-content small-collapse align-middle align-justify">
      <div class="small-12 large-6 columns">
        <img src="<?php echo get_field('bottom_first_photo') ?>" alt="<?php echo get_field('bottom_first_photo_alt') ?>">
      </div>
      <div class="small-12 large-6 columns">
        <img src="<?php echo get_field('bottom_second_photo') ?>" alt="<?php echo get_field('bottom_second_photo_alt') ?>">
      </div>
    </div>
  </div>
  </main>
<?php get_footer(); ?>
