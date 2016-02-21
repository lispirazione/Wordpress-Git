<?php $recent = new WP_Query("page_id=ID"); 
while($recent->have_posts()) : $recent->the_post();?>
       <h3><?php the_title(); ?></h3>
       <?php the_content(); ?>
<?php endwhile; ?>