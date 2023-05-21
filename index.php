<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 */

get_header();
?>
	<main>
	   <div class="py-5">
	  		<div class="container">
	  		<?php if ( is_home() &&  is_front_page() ) :?>
				<div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
			<?php endif;?>
		<?php
		if ( have_posts() ) :

			/* Start the Loop */
			while ( have_posts() ) :
				the_post();

				/*
				 * Include the Post-Type-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content', get_post_type() );

			endwhile;
			?>
			<?php if ( is_home() &&  is_front_page() ) :?>
				</div>
			<?php endif;?>
			<?php
		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?> 	</div>
		</div>
	</main>

<?php
get_footer();

