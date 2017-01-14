<?php
/*
 * Template Name: Contact
 * Description: A Page Template with a Page Builder design.
 */
get_header(); ?>
	<?php if (have_posts()){ ?>
		<?php while (have_posts()) : the_post()?>
			<?php $breadcrumb_page = get_post_meta(get_the_ID(),'_cmb_breadcrumb_page', true);?>
			<?php if($breadcrumb_page == 'show'){ ?>
				<section id="titlebar">
					<!-- Container -->
					<div class="container">
						<div class="eight columns" data-appear-top-offset="-100" data-animated="fadeInLeft">
							<?php $icon_class = get_post_meta(get_the_ID(),'_cmb_icon_class', true);?>
							<h2><i class="<?php if($icon_class !=''){ echo $icon_class;}else{echo 'icon-ticket';}?>"></i> <?php the_title(); ?></h2>						
						</div>
						<div class="eight columns" data-appear-top-offset="-100" data-animated="fadeInRight">
							<?php echo liwa_breadcrumbs(); ?>
						</div>
					</div>
					<!-- Container / End -->
				</section>
			<?php }else{} ?>
			
			<?php the_content(); ?>
			
		<?php endwhile; ?>
	
	<?php }else {
		echo 'Page Canvas For Page Builder'; 
	}?>

<?php get_footer(); ?>