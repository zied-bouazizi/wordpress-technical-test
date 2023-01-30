<?php get_header(); ?>

<div class="container job-details">
	<div class="back">
		<a class="btn btn-back" href="<?php echo wp_get_referer(); ?>">Back</a>
	</div>

	<div class="job-title">
		<h3><?php the_title(); ?></h3>
	</div>
	<div class="row">
		<?php echo get_post_meta($post->ID, 'address', true) . " |"; ?>
		<?php echo get_post_meta($post->ID, 'working_hour_per_week', true) . " hours/week |"; ?>
		<?php echo get_post_meta($post->ID, 'recruiting_company', true); ?>
	</div>
	<div class="teaser">
		<?php the_excerpt(); ?>
	</div>
	<div class="general-information">
		<h4>General information:</h4>
		<p><?php the_content(); ?></p>
	</div>
</div>

<?php get_footer(); ?>