<?php 
/*
 *  The template for displaying Category pages
 */
  $textdoimain = 'liwa';
global $theme_option;
get_header();?>
<section id="titlebar">
	<!-- Container -->
	<div class="container">
		<div class="eight columns" data-appear-top-offset="-100" data-animated="fadeInLeft">
			<h2><i class="icon-file-alt"></i> <?php printf( __( 'Category : %s', 'liwa' ), single_cat_title( '', false ) ); ?></h2>
		</div>
		<div class="eight columns" data-appear-top-offset="-100" data-animated="fadeInRight">
			<?php echo liwa_breadcrumbs(); ?>
		</div>
	</div>
	<!-- Container / End -->
</section>

<!-- Container -->
<div class="container">

	<!-- Portfolio Wrapper-->
	<div id="portfolio-wrapper" data-appear-top-offset="-100" data-animated="fadeInUp">
		<?php 
			while(have_posts()) : the_post();
			$params = array('width' => 420,'height' => 300);
			$thumbnail = bfi_thumb(wp_get_attachment_url(get_post_thumbnail_id()),$params);                               
		?>
		<!-- Portfolio Item -->
		<div class="one-third column portfolio-item media">
			<figure>
				<div class="mediaholder">
					<a href="<?php the_permalink(); ?>">
						<img alt="<?php the_title(); ?>" src="<?php echo $thumbnail; ?>" width="420" height="300" />
						<div class="hovercover">
							<div class="hovericon"><i class="hoverlink"></i></div>
						</div>
					</a>
				</div>

				<a href="<?php the_permalink(); ?>">
					<figcaption class="item-description">
						<h5><?php the_title(); ?></h5>
						<span><?php printf( __( '%s', 'liwa' ), single_cat_title( '', false ) ); ?></span>
					</figcaption>
				</a>

			</figure>
		</div>
		<?php endwhile; ?>
	</div>
	<!-- Portfolio Wrapper / End -->
	<!-- Pagination -->
	 <div class="pagination">
		<?php liwa_pagination();?>          
    </div> <!-- /pagination -->
</div>
<!-- Container / End -->

<?php get_footer();?>