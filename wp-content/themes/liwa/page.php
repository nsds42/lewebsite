<?php
/**
 * The template for displaying all pages
 */
get_header(); ?>
<section id="titlebar">
	<!-- Container -->
	<div class="container">
		<div class="eight columns" data-appear-top-offset="-100" data-animated="fadeInLeft">
			<?php while (have_posts()): the_post(); ?> 
				<?php $icon_class = get_post_meta(get_the_ID(),'_cmb_icon_class', true);?>
				<h2><i class="<?php if($icon_class !=''){ echo $icon_class;}else{echo 'icon-ticket';}?>"></i> <?php the_title(); ?></h2>
			<?php endwhile; ?>
		</div>
		<div class="eight columns" data-appear-top-offset="-100" data-animated="fadeInRight">
			<?php echo liwa_breadcrumbs(); ?>
		</div>
	</div>
	<!-- Container / End -->
</section>

<!-- Container -->
<div class="container">
	<div class="twelve alt columns">
		<?php while (have_posts()): the_post(); ?> 	
			<!-- Post -->
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> >
			
				<?php the_content(); ?>	
							
				<?php wp_link_pages(); ?>
			</article>
		<?php endwhile; ?>	
	</div>
	<!-- Container / End -->
	
	<!-- Sidebar
	================================================== -->
	<div class="four columns">
		<?php get_sidebar(); ?>
	</div>
</div>
<!-- Container / End -->
<?php
get_footer();
