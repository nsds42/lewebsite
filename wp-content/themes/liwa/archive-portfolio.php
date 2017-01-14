<?php 
/*
 *  The template for displaying Archive pages
 */
  $textdoimain = 'liwa';
 global $theme_option;
get_header();?>

<!-- Titlebar
================================================== -->
<section id="titlebar">
	<!-- Container -->
	<div class="container">
		<div class="eight columns" data-appear-top-offset="-100" data-animated="fadeInLeft">
			<h2><i class="icon-file-alt"></i> <?php
				if ( is_day() ) :
					printf( __( 'Daily Archives Portfolio: %s', 'liwa' ), get_the_date() );

				elseif ( is_month() ) :
					printf( __( 'Monthly Archives Portfolio: %s', 'liwa' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'liwa' ) ) );

				elseif ( is_year() ) :
					printf( __( 'Yearly Archives Portfolio: %s', 'liwa' ), get_the_date( _x( 'Y', 'yearly archives date format', 'liwa' ) ) );

				else :
					_e( 'Archives Portfolio', 'liwa' );

				endif;
			?></h2>
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
			$item_classes = ', ';
			$item_slug =' ';
			$item_cats = get_the_terms(get_the_ID(), 'categories');
			foreach((array)$item_cats as $item_cat){
				if(count($item_cat)>0){
					$item_classes = $item_cat->name ;
					$item_slug .= $item_cat->slug . ' ';
				}
			}
			$params = array('width' => 420,'height' => 300);
			$thumbnail = bfi_thumb(wp_get_attachment_url(get_post_thumbnail_id()),$params);                               
		?>
		<!-- Portfolio Item -->
		<div class="one-third column portfolio-item media <?php echo $item_slug; ?>">
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
						<span><?php echo $item_classes; ?></span>
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