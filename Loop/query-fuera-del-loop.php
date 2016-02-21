<?php

$query = new WP_Query(array( 'post_type' => 'post', 'posts_per_page' => '2' ));
// The Loop
if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post();  ?>


<div class="contnotblack">
    <span class="titpst01"><?php  the_title(); ?></span>
	<span class="linknotas"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"></a></span>
</div>
	
	
<?php endwhile; ?>
<!-- pagination -->

<?php endif; ?>
