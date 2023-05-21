 <?php
/**
 * Template part for displaying posts
*/

?>
<?php 
if(is_singular()):?>
	<h1><?php the_title();?></h1>
    <p><?php the_content();?></p>   
<?php else : ?>


          <div class="col">
            <div class="card shadow-sm">
            	<?php the_post_thumbnail(); ?>
              <img class="card-img-top" src="images/placeholder-250x250.png" alt="" />
              <div class="card-body border-top">
                <h2><?php the_title();?></h2>
                <p><?php the_excerpt();?></p>
                <div class="d-flex justify-content-between align-items-center">
                  <div class="btn-group">
                    <a href="<?php the_permalink();?>" class="btn btn-sm btn-outline-secondary">View</a>
                  </div>
                </div>
              </div>
            </div>
          </div>

   

<?php endif;?>

	
