<?php
/**
 * The template for displaying all single jobs
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Limadia_Entity_Foundation_V1
 */

get_header();
?>

	<main id="primary" class="site-main">

		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', 'job-details' );

		endwhile; // End of the loop.
		?>

	</main><!-- #main -->

<?php
get_footer();
