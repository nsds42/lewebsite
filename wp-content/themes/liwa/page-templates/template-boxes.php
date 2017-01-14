<?php
/*
 * Template Name: Template Boxes
 * Description: A Page Template Full Width - No Sidebar.
 */
$textdoimain = 'liwa';

get_header(); ?>
<?php if (have_posts()){ ?>
	
		<?php while (have_posts()) : the_post()?>
			<?php the_content(); ?>
		<?php endwhile; ?>
	
	<?php }else {
		echo 'Page Canvas For Page Builder'; 
	}?>
<?php
get_footer();
