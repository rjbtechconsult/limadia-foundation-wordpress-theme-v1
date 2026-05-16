<?php
/**
 * The template for displaying all pages
 * Template Name: Careers
 * This is the template that displays the careers page.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Limadia_Entity_Foundation_V1
 */

get_header();
?>

	<main id="primary" class="site-main">

		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', 'careers' );

		endwhile; // End of the loop.
		?>

	</main><!-- #main -->

<?php
get_footer();
