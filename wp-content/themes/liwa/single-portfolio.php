<?php
/**
 * The Template for displaying all single posts
 */
 $textdoimain = 'liwa';
global $theme_option; 
get_header(); ?>
<section id="titlebar">
	<!-- Container -->
	<div class="container">
		<div class="eight columns" data-appear-top-offset="-100" data-animated="fadeInLeft">
			<h2><i class="icon-file-alt"></i> <?php the_title(); ?></h2>
		</div>
		<div class="eight columns" data-appear-top-offset="-100" data-animated="fadeInRight">
			<?php echo liwa_breadcrumbs(); ?>
		</div>
	</div>
	<!-- Container / End -->
</section>

<?php 
	while(have_posts()) :the_post(); 
	$project_layout = get_post_meta(get_the_ID(),'_cmb_project_layout', true);
	$information = get_post_meta(get_the_ID(),'_cmb_information', true);
?>

<?php if($project_layout != 'wide'){ ?>

<!-- Container -->
<div class="container">

	<!-- Slider -->
	<div class="eleven alt columns">

				<?php $format = get_post_format();?>
				<?php if($format == 'gallery'){?>
				<?php $gallery = get_post_gallery( get_the_ID(), false );
					 if(isset($gallery['ids'])){
					?>
				<!-- FlexSlider  -->
				<section class="flexslider post-img" data-appear-top-offset="-100" data-animated="fadeInLeft">
					<div class="media">	
						<ul class="slides">
							<?php
								$gallery_ids = $gallery['ids'];
								$img_ids = explode(",",$gallery_ids);               
								foreach( $img_ids AS $img_id ){
								$image_src = wp_get_attachment_image_src($img_id,'');
								$params = array( 'width' => 775, 'height' => 430 );
								$image = bfi_thumb( $image_src[0], $params );
							  ?>
							<li>
								<a class="mfp-gallery" title="<?php the_title(); ?>" href="<?php echo $image_src[0]; ?>">
									<img src="<?php echo $image;?>" alt="" width="775" height="430" />
								</a>
							</li>
							<?php }?>
						</ul>
					</div>
				</section>	
				<?php }?>
				<!--End project details slider-->
				<?php }elseif($format == 'video'){?>
					<?php if(get_post_meta(get_the_ID(),'_cmb_portfolio_video', true)!=''){?>
						<!--Project details video-->	
						<div class="videoHolder" >
							<iframe width="775" height="430" src="<?php echo get_post_meta(get_the_ID(),'_cmb_portfolio_video', true);  ?>" allowfullscreen></iframe>
						</div>
						<!--End project details video-->	
				   <?php }?>
				<?php }elseif($format == 'audio'){?>
				<!--Post media-->
				<div class="postMedia large">
					<iframe width="100%" height="220" scrolling="no" frameborder="no" src="<?php echo get_post_meta(get_the_ID(), "_cmb_portfolio_audio", true);?>&amp;color=ff5500&amp;auto_play=false&amp;hide_related=false&amp;show_artwork=true"></iframe>
				</div>
				<!--End post media-->	    
			   <?php }else{ ?>
				<?php if ( has_post_thumbnail() ) { ?>
				<?php
					$params = array( 'width' => 775, 'height' => 430 );
					$image = bfi_thumb( wp_get_attachment_url( get_post_thumbnail_id()), $params );
				?>
				<!--Post media-->
				<div class="postMedia large">
					<img width="775" height="430" class="thumb-single" src="<?php echo $image;?>" />
				</div>
				<?php } }?>	

	</div>
	<!-- Slider / End -->
	

	<!-- Sidebar -->
	<div class="five columns">
		
		<!-- Job Description -->
		<div class="widget" style="margin: 5px 0 0 0;" data-appear-top-offset="-100" data-animated="fadeInRight">
			<h3 class="headline"><?php echo $theme_option['portfolio_project_description'];?></h3><span class="line"></span><div class="clearfix"></div>
			<?php the_content();?>
		</div>

		<!-- Job Description -->
		<div class="widget" style="margin: 25px 0 0 0;" data-appear-top-offset="-100" data-animated="fadeInUp">
			<h3 class="headline" ><?php echo $theme_option['portfolio_project_details'];?></h3><span class="line"></span><div class="clearfix"></div>
			
			<?php echo htmlspecialchars_decode($information); ?>
			
			<div class="clearfix"></div>
			<?php $link_projects = get_post_meta(get_the_ID(),'_cmb_portfolio_project', true); if($link_projects != ''){ ?>
			<a class="button color launch" href="<?php echo $link_projects; ?>"><?php echo $theme_option['portfolio_launch_project'];?></a>
		<?php }else{echo '';} ?>
		</div>

	</div>
	<!-- Sidebar / End-->
	
</div>
<!-- Container / End -->

<?php }else{ ?>


<!-- Container -->
<div class="container">

	<!-- Slider -->
	<div class="sixteen columns">

				<?php $format = get_post_format();?>
				<?php if($format == 'gallery'){?>
				<?php $gallery = get_post_gallery( get_the_ID(), false );
					 if(isset($gallery['ids'])){
					?>
				<!-- FlexSlider  -->
				<section class="flexslider post-img" data-appear-top-offset="-100" data-animated="fadeInLeft">
					<div class="media">	
						<ul class="slides">
							<?php
								$gallery_ids = $gallery['ids'];
								$img_ids = explode(",",$gallery_ids);               
								foreach( $img_ids AS $img_id ){
								$image_src = wp_get_attachment_image_src($img_id,'');
								$params = array( 'width' => 1180, 'height' => 450 );
								$image = bfi_thumb( $image_src[0], $params );
							  ?>
							<li>
								<a class="mfp-gallery" title="<?php the_title(); ?>" href="<?php echo $image_src[0]; ?>">
									<img src="<?php echo $image;?>" alt="" width="1180" height="450" />
								</a>
							</li>
							<?php }?>
						</ul>
					</div>
				</section>	
				<?php }?>
				<!--End project details slider-->
				<?php }elseif($format == 'video'){?>
					<?php if(get_post_meta(get_the_ID(),'_cmb_portfolio_video', true)!=''){?>
						<!--Project details video-->	
						<div class="videoHolder" >
							<iframe width="1180" height="450" src="<?php echo get_post_meta(get_the_ID(),'_cmb_portfolio_video', true);  ?>" allowfullscreen></iframe>
						</div>
						<!--End project details video-->	
				   <?php }?>
				<?php }elseif($format == 'audio'){?>
				<!--Post media-->
				<div class="postMedia large">
					<iframe width="100%" height="220" scrolling="no" frameborder="no" src="<?php echo get_post_meta(get_the_ID(), "_cmb_portfolio_audio", true);?>&amp;color=ff5500&amp;auto_play=false&amp;hide_related=false&amp;show_artwork=true"></iframe>
				</div>
				<!--End post media-->	    
			   <?php }else{
				$params = array( 'width' => 1180, 'height' => 450 );
				$image = bfi_thumb( wp_get_attachment_url( get_post_thumbnail_id()), $params );?>
				<!--Post media-->
				<div class="postMedia large">
					<img width="1180" height="450" class="thumb-single" src="<?php echo $image;?>" />
				</div>
				<?php }?>	
			

	</div>
	<!-- Slider / End -->
	
</div>
<!-- Container / End -->


<!-- Container -->
<div class="container">

	<!-- Job Description -->
	<div class="twelve columns" data-appear-top-offset="-100" data-animated="fadeInLeft">
		<h3 class="headline"><?php echo $theme_option['portfolio_project_description'];?></h3><span class="line"></span><div class="clearfix"></div>
		<?php the_content();?>
	</div>


	<!-- Job Description -->
	<div class="four columns" data-appear-top-offset="-100" data-animated="fadeInRight">

		<h3 class="headline" ><?php echo $theme_option['portfolio_project_details'];?></h3><span class="line"></span><div class="clearfix"></div>
				
		<?php echo htmlspecialchars_decode($information); ?>
		
		<div class="clearfix"></div>
		
		<?php $link_projects = get_post_meta(get_the_ID(),'_cmb_portfolio_project', true); if($link_projects != ''){ ?>
			<a class="button color launch" href="<?php echo $link_projects; ?>"><?php echo $theme_option['portfolio_launch_project'];?></a>
		<?php }else{echo '';} ?>	
		
	</div>
	<!-- Sidebar / End-->
	
</div>
<!-- Container / End -->

<?php } ?>
<?php endwhile;?>




<!-- Container -->
<div class="container" style="margin-top: 5px;">
<!-- Headline -->
<div class="fiveteen columns" data-appear-top-offset="-100" data-animated="fadeInUp">
    <div class="container">
		<h3 class="headline"><?php echo htmlspecialchars_decode($theme_option['portfolio_title_related']); ?></h3>
		<span class="line" style="margin-bottom:35px;"></span>
	  </div>
			<ul class="grid cs-style">
			<?php											 
						// get the custom post type's taxonomy terms
						 
						$custom_taxterms = wp_get_object_terms( $post->ID, 'categories', array('fields' => 'ids') );
						// arguments
						$args = array(
						'post_type' => 'portfolio',
						'post_status' => 'publish',
						'posts_per_page' => 3, // you may edit this number
						'orderby' => 'rand',
						'tax_query' => array(
							array(
								'taxonomy' => 'categories',
								'field' => 'id',
								'terms' => $custom_taxterms
							)
						),
						'post__not_in' => array ($post->ID),
						);
						$related_items = new WP_Query( $args );
						// loop over query
						$i = 0;
						if ($related_items->have_posts()) :											
						while ( $related_items->have_posts() ) : $related_items->the_post(); $i++;
						$cates = get_the_terms(get_the_ID(),'categories');
						$cate_name =' ';
						$cate_slug = '';
						foreach((array)$cates as $cate){
							if(count($cates)>0){
								$cate_name .= $cate->name.' ' ;
								$cate_slug .= $cate->slug .' ';     
							} 
						} 
							$params = array('width' => 420,'height' => 300);
                            $image = bfi_thumb(wp_get_attachment_url(get_post_thumbnail_id()),$params); 
						?>	
				<li>
					<figure>
						<img src="<?php echo $image; ?>" alt="img0<?php echo $i;?>" >
						<figcaption>
							<h3><?php the_title(); ?></h3>
							<span><?php echo $cate_name; ?></span>
							<a href="<?php the_permalink(); ?>"><?php global $theme_option; echo $theme_option['portfolio_read']; ?></a>
						</figcaption>
					</figure>
				</li>
				<?php
						endwhile;											
					endif;
				// Reset Post Data
				wp_reset_postdata(); ?>	
			</ul>
			<div class="clearfix"></div>
       </div>
   </div>

<?php get_footer();?>