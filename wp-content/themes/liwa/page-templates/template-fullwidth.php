<?php 
/*
*Template Name: Shop Full Width
*
*/
?>
<?php get_header(); ?>
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

<!-- Container / Start -->
<div class="container">
	<?php while (have_posts()): the_post(); ?> 	
		<?php $page_sub_title = get_post_meta(get_the_ID(),'_cmb_page_sub_title', true);?>
		<?php if($page_sub_title !=''){?>
			<div class="sixteen columns">
				<h3 class="headline"><?php echo htmlspecialchars_decode($page_sub_title); ?></h3><span class="line" style="margin-bottom:45px;"></span><div class="clearfix"></div>
			</div>
		<?php }?>
		<div class="clearfix"></div>
		<div class="shop-wrapper">
			<!-- Post -->
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> >
			
				<?php the_content(); ?>	
							
				<?php wp_link_pages(); ?>
			</article>
		</div>
	<?php endwhile; ?>	
</div><!-- end shop-wrapper -->
<?php get_footer(); ?>