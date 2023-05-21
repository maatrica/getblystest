<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package bootstrap_example
 */

?>


	<div id="post-<?php the_ID(); ?>" class="py-5 <?php post_class(); ?>">
      <div class="container">
        <div class="row">
        	<h1><?php the_title();?></h1>
		<?php
		the_content();

		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'bootstrap-example' ),
				'after'  => '</div>',
			)
		);
		?>
	

		<?php if ( get_edit_post_link() ) : ?>
		
			<?php
			edit_post_link(
				sprintf(
					wp_kses(
						/* translators: %s: Name of current post. Only visible to screen readers */
						__( 'Edit <span class="screen-reader-text">%s</span>', 'bootstrap-example' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					wp_kses_post( get_the_title() )
				),
				'<span class="edit-link">',
				'</span>'
			);
			?>
		<?php endif;?>
		 </div>
      </div>
    </div>