<?php get_header(); ?>

<section class="container-fluid custom_box">
  <div class="container">

    <div class="banner">
      <div class="banner_overlay">

        <div class="custom_menu">
          <div class="logo">
            <h4 class="logo">WordPress Technical Test</h4>
          </div>
          <div class="secondary-menu">
            <?php
            wp_nav_menu(array(
              'theme_location' => 'SecondaryMenu'
            ));
            ?>
          </div>
        </div>

        <header>
          <div class="header_text">
            <div class="first_subtitle">
              <h4>Job Listing</h4>
            </div>
            <div class="main_title">
              <h1>WordPress Technical Test</h1>
            </div>
            <div class="read_more">
              <a class="btn btn-default btn_csutom" href="#">Read More</a>
            </div>
          </div>
        </header>

      </div>
    </div>

  </div>
</section>

<div class="container container_filter">

  <div class="filters filter-button-group">
    <ul>
      <h4>
        <li class="active" data-filter="*">All</li>

        <?php
        $terms = get_terms('job_category');
        foreach ($terms as  $term) { ?>
          <li data-filter=".<?php echo $term->slug; ?>"><?php echo $term->name; ?></li>
        <?php  }

        ?>
      </h4>
    </ul>
  </div>

  <div class="content list">
    <?php
    $args = array(
      'post_type' => 'job',
      'posts_per_page' => 5
    );

    $query = new WP_Query($args);

    while ($query->have_posts()) {
      $job = $query->the_post();

      $termsArray = get_the_terms($post->ID, 'job_category');

      $termsSLug = "";
      foreach ($termsArray as $term) {
        $termsSLug .= $term->slug . ' ';
      }
    ?>

      <div class="single-content <?php echo  $termsSLug; ?> list-item">
        <div class="job-title">
          <h6><?php the_title(); ?></h6>
        </div>
        <div class="row">
          <?php echo get_post_meta($post->ID, 'address', true) . " |"; ?>
          <?php echo get_post_meta($post->ID, 'working_hour_per_week', true) . " hours/week |"; ?>
          <?php echo get_post_meta($post->ID, 'recruiting_company', true); ?>
        </div>
        <div class="teaser">
          <?php the_excerpt(); ?>
        </div>
        <div class="details">
          <a class="btn btn-default btn_details" href="#">Details</a>
        </div>
      </div>
    <?php  }

    wp_reset_postdata();
    ?>
  </div>

</div>

<?php get_footer(); ?>