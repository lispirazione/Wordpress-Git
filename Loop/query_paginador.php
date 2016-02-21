<?php
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$args = array(
  'posts_per_page' => 4,
  'post_type' => 'post',
  'paged' => $paged
);
// The Query
query_posts($args); 	

// The Loop
if (have_posts()) : while (have_posts()) : the_post(); ?>


<article>
	<?php echo get_the_post_thumbnail( $post_id, array(135,112), $attr ); ?>

    <h4><a title="<?php the_title_attribute(); ?>"  href="<?php the_permalink(); ?> " >
	<?php  the_title(); ?>
	</a></h4>
<?php the_excerpt(); ?>
</article>
	
	
<?php endwhile; ?>
<!-- pagination -->
<?php if(function_exists('wp_paginate')) {
    wp_paginate();
} ?>


<?php else : ?>
<!-- No posts found -->
<?php endif; ?>
<?php
wp_reset_query();
?>