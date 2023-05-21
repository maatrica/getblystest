<?php get_header();?>
	<main>
    	<div class="py-5">
	  		<div class="container">
	  		    <div class="row">
	  		        
	  		    <div class="col-sm-8">
			        <?php
					while ( have_posts() ) :
						the_post();

						get_template_part( 'template-parts/content', get_post_type() );
						?>
						<?php
						$meta_value = get_post_meta( get_the_ID(), 'latitude', true );
						$meta_values = get_post_meta( get_the_ID(), 'longitude', true ); 
						if( !empty( $meta_value && $meta_values ) ) {
					?>

		
				<iframe 
  width="600" 
  height="450" 
  frameborder="0" 
  scrolling="no" 
  marginheight="0" 
  marginwidth="0" 
  src="https://maps.google.com/maps?q=<?php echo $meta_values;?>,<?php echo $meta_value;?>&hl=es&z=14&output=embed"
 >
 </iframe>
			<?php
				}
			
			?>
			<h3>Related Posts</h3>
			<?php


			$args = array(
			'orderby' => array( 'meta_value_num' => 'DESC' ),
			'meta_key' => 'latitude',
			'posts_per_page' => 5,
			'offset' => '0',
			'post__not_in' => array( $post->ID )
			);
			$query = new WP_Query( $args );

			 
			if ( $query->have_posts() ) {
			 
			    ?>
  
    
            <?php
 
                while ( $query->have_posts() ) {
                    $query->the_post();
                    ?>
					<a href="<?php the_permalink();?>"><?php the_title();?></a>
                    <?php
                }
            }
            ?>

			<?php
			
		endwhile; 
		?>
		</div>
		<div class="col-sm-4">
		    <?php get_sidebar();?>
		</div>
			</div>
			</div>
       </div>
	</main>
<?php get_footer();?>