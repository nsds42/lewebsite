<?php 
/*
/**Template Name: Portfolio 4 Columns
*/
global $theme_option;
get_header();
?>

<section id="titlebar">
	<!-- Container -->
	<div class="container">
		<div class="eight columns" data-appear-top-offset="-100" data-animated="fadeInLeft">
			<?php while (have_posts()): the_post(); ?> 
				<?php $icon_class = get_post_meta(get_the_ID(),'_cmb_icon_class', true);?>
				<h2><i class="<?php if($icon_class !=''){ echo $icon_class;}else{echo 'icon-file-alt';}?>"></i> <?php the_title(); ?></h2>
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
	<div class="sixteen columns" data-appear-top-offset="-100" data-animated="fadeInUp">

		<!-- Filters -->
		<div class="showing">Categories</div>
		<span class="line showing"></span>
		<div id="filters" class="filters-dropdown headline"><span></span>
			<ul class="option-set" data-option-key="filter">
            	<li><a href="#filter" class="selected" data-option-value="*">All</a></li>
			<?php 
				$skill = get_terms('categories');
				if($skill && ! is_wp_error($skill)):
				foreach((array)$skill as $skills){
					$term_link=get_term_link( $skills, 'categories' );
					$name=$skills->name;
					$slug=$skills->slug;
			?>	
				<li><a href="#filter" data-option-value=".<?php echo $slug; ?>"><?php echo $name; ?></a></li>
			<?php } endif; ?>	
			</ul>
		</div>
		<span class="line filters"></span><div class="clearfix"></div>
	</div>
</div>
<!-- Container / End -->

<!-- Container -->
<div class="container">

	<!-- Portfolio Wrapper-->
	<div id="portfolio-wrapper" data-appear-top-offset="-100" data-animated="fadeInUp">
	<?php 
		$args = array(
			'paged' => $paged,
			'post_type' => 'portfolio',
		);
		$wp_query=new WP_Query($args);
		while($wp_query->have_posts()) : $wp_query->the_post();
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
		<div class="four columns portfolio-item media <?php echo $item_slug; ?>">
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

<?php get_footer(); ?>