 	<div class="container">
 		<?php dynamic_sidebar('bootstrap_example_footer_sidebar'); ?>
	    <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
	      <p class="col-md-4 mb-0 text-muted">
	    <?php
				printf( esc_html__( ' %1$s ', 'bootstrap-example' ), '&copy; '. date('Y').' Company, Inc' );
		?>
			</p>
		    <a href="<?php echo esc_url( home_url( '/' ) ); ?>"
		        class="col-md-4 d-flex align-items-center justify-content-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
		        <svg class="bi me-2" width="40" height="32">
		          <use xlink:href="#bootstrap" />
		        </svg>
		    </a>

	      <?php custom_menu(); ?> 
	    </footer>
	</div>
 	<?php wp_footer(); ?>

</body>
</html>