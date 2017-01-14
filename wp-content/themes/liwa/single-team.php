<?php
/**
 * The Template for displaying all single posts
 */
 $textdoimain = 'liwa';
global $theme_option; 
get_header(); ?>

<?php 
	while(have_posts()) :the_post(); 
	$twitter = get_post_meta(get_the_ID(),'_cmb_twitter', true);
	$facebook = get_post_meta(get_the_ID(),'_cmb_facebook', true);
	$linkedin = get_post_meta(get_the_ID(),'_cmb_linkedin', true);
	$googleplus = get_post_meta(get_the_ID(),'_cmb_googleplus', true);
	$dribbble = get_post_meta(get_the_ID(),'_cmb_dribbble', true);
	$forrst = get_post_meta(get_the_ID(),'_cmb_forrst', true);
	$instagram	= get_post_meta(get_the_ID(),'_cmb_instagram', true);
	$tumblr	 = get_post_meta(get_the_ID(),'_cmb_tumblr', true);
	$github = get_post_meta(get_the_ID(),'_cmb_github', true);
	$pinterest = get_post_meta(get_the_ID(),'_cmb_pinterest', true);
	$team_job = get_post_meta(get_the_ID(),'_cmb_team_job', true);
	$teamskills = get_post_meta(get_the_ID(),'_cmb_teamskills', true);
	$bgimage_thumbnail = get_post_meta(get_the_ID(),'_cmb_image_thumbnail', true);
	$params = array( 'width' => 450, 'height' => 450 );
	$image = bfi_thumb( wp_get_attachment_url( get_post_thumbnail_id()), $params );
	$bgparams = array( 'width' => 1920, 'height' => 470 );
	$bgimage = bfi_thumb( $bgimage_thumbnail, $bgparams );
?>

<div class="fullwidthbanner-container">
	<div class="fullwidthbanner">
		<ul>
        	<!-- Slide 1 -->
			<li data-fstransition="fade" data-transition="fade" data-slotamount="10" data-masterspeed="300">
				<?php if($bgimage_thumbnail !=''){?>
					<img src="<?php echo $bgimage; ?>" alt="<?php the_title(); ?>">
				<?php }else{?>	
					<img src="<?php echo get_template_directory_uri(); ?>/images/about-me.jpg" alt="">
				<?php }?>	
				<div class="caption dark sfb" data-x="0" data-y="170" data-speed="400" data-start="800"  data-easing="easeOutExpo"><h2><?php the_title(); ?></h2></div>
				<div class="caption dark sfb" data-x="1" data-y="215" data-speed="400" data-start="1000" data-easing="easeOutExpo"><h3><?php echo $team_job; ?></h3></div>
				<div class="caption dark sfb" data-x="1" data-y="255" data-speed="400" data-start="1200" data-easing="easeOutExpo"><?php the_excerpt(); ?></div>
				<div class="caption sfb" data-x="630" data-y="31" data-speed="600" data-start="1200" data-easing="easeOutExpo"><img src="<?php echo $image; ?>" alt="<?php the_title(); ?>"></div>
			</li>
		</ul>
	</div>
</div>

<div class="container" style=" margin-top:50px; margin-bottom: 10px;">

	<!-- Who We Are? -->
	<div class="two-thirds column" data-appear-top-offset="-100" data-animated="fadeInLeft">
		<h3 class="headline"><span class="text_headline">About</span> Me</h3><span class="line" style="margin-bottom:30px;"></span><div class="clearfix"></div>
		<?php the_content(); ?>
	</div>


    <!-- Social Links -->
	<div class="one-third column" data-appear-top-offset="-100" data-animated="fadeInRight" style="margin-bottom:25px;">
		<h3 class="headline"><span class="text_headline">Find</span> Me</h3><span class="line" style="margin-bottom:35px;"></span><div class="clearfix"></div>
		
		<ul class="social-icons">
			<?php if($twitter !=''){?>
				<li><a href="<?php echo $twitter;?>" class="twitter"><i class="icon-twitter"></i></a></li>
			<?php }?>
			<?php if($facebook !=''){?>	
				<li><a href="<?php echo $facebook;?>" class="facebook"><i class="icon-facebook"></i></a></li>
			<?php }?>
			<?php if($linkedin !=''){?>	
				<li><a href="<?php echo $linkedin;?>" class="linkedin"><i class="icon-linkedin"></i></a></li>
			<?php }?>
			<?php if($googleplus !=''){?>	
				<li><a href="<?php echo $googleplus;?>" class="gplus"><i class="icon-gplus"></i></a></li>
			<?php }?>
			<?php if($dribbble !=''){?>	
				<li><a href="<?php echo $dribbble;?>" class="dribbble"><i class="icon-dribbble"></i></a></li>
			<?php }?>	
			<?php if($forrst !=''){?>
				<li><a href="<?php echo $forrst;?>" class="forrst"><i class="icon-forrst"></i></a></li>
			<?php }?>	
			<?php if($instagram !=''){?>
				<li><a href="<?php echo $instagram;?>" class="instagram"><i class="icon-instagram"></i></a></li>
			<?php }?>
			<?php if($tumblr !=''){?>	
				<li><a href="<?php echo $tumblr;?>" class="tumblr"><i class="icon-tumblr"></i></a></li>
			<?php }?>	
			<?php if($github !=''){?>
				<li><a href="<?php echo $github;?>" class="github"><i class="icon-github"></i></a></li>
			<?php }?>	
			<?php if($pinterest !=''){?>
				<li><a href="<?php echo $pinterest;?>" class="pinterest"><i class="icon-pinterest"></i></a></li>
			<?php }?>	           
		</ul>
	</div>

	<!-- Our Skills -->
	<div class="one-third column" data-appear-top-offset="-100" data-animated="fadeInRight">
		<h3 class="headline"><span class="text_headline">My</span> Skills</h3><span class="line" style="margin-bottom:35px;"></span><div class="clearfix"></div>
		<div id="skillzz">
			<?php echo htmlspecialchars_decode($teamskills); ?>
		</div>
	</div>
</div>
<?php endwhile;?>

<div class="container" style="margin-top:30px;">
	<!-- ShowBiz Carousel -->
	<div id="team" class="showbiz-container sixteen columns">
	
	<!-- Headline -->
	<h3 class="headline"><span class="text_headline">Related</span> Team</h3>
	<span class="line" style="margin-bottom:0;"></span>
		
	<!-- Navigation -->
	<div class="showbiz-navigation">
		<div id="showbiz_left_4" class="sb-navigation-left"><i class="icon-angle-left"></i></div>
		<div id="showbiz_right_4" class="sb-navigation-right"><i class="icon-angle-right"></i></div>
	</div>
	<div class="clearfix"></div>

	<!-- Entries -->
	<div class="showbiz" data-left="#showbiz_left_4" data-right="#showbiz_right_4">
		<div class="overflowholder">
			<ul data-appear-top-offset="-100" data-animated="fadeInUp">
			<?php											 
						// get the custom post type's taxonomy terms
						 
						$custom_taxterms = wp_get_object_terms( $post->ID, 'categories1', array('fields' => 'ids') );
						// arguments
						$args = array(
						'post_type' => 'team',
						'post_status' => 'publish',
						'posts_per_page' => 99, // you may edit this number
						'orderby' => 'rand',
						'tax_query' => array(
							array(
								'taxonomy' => 'categories1',
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
						$cates = get_the_terms(get_the_ID(),'categories1');
						$cate_name =' ';
						$cate_slug = '';
						foreach((array)$cates as $cate){
							if(count($cates)>0){
								$cate_name .= $cate->name.' ' ;
								$cate_slug .= $cate->slug .' ';     
							} 
						} 
						$twitter = get_post_meta(get_the_ID(),'_cmb_twitter', true);
						$facebook = get_post_meta(get_the_ID(),'_cmb_facebook', true);
						$linkedin = get_post_meta(get_the_ID(),'_cmb_linkedin', true);
						$googleplus = get_post_meta(get_the_ID(),'_cmb_googleplus', true);
						$dribbble = get_post_meta(get_the_ID(),'_cmb_dribbble', true);
						$forrst = get_post_meta(get_the_ID(),'_cmb_forrst', true);
						$instagram	= get_post_meta(get_the_ID(),'_cmb_instagram', true);
						$tumblr	 = get_post_meta(get_the_ID(),'_cmb_tumblr', true);
						$github = get_post_meta(get_the_ID(),'_cmb_github', true);
						$pinterest = get_post_meta(get_the_ID(),'_cmb_pinterest', true);
						$team_job = get_post_meta(get_the_ID(),'_cmb_team_job', true);
						$params = array('width' => 488, 'height' => 365);
						$image = bfi_thumb(wp_get_attachment_url(get_post_thumbnail_id()),$params); 
						?>
				<li>
					<img class="mediaholder team-img" src="<?php echo $image; ?>" alt="<?php the_title(); ?>"/>	
					<ol class="social-icons">
						<?php if($twitter !=''){?>
							<li><a href="<?php echo $twitter;?>" class="twitter"><i class="icon-twitter"></i></a></li>
						<?php }?>
						<?php if($facebook !=''){?>	
							<li><a href="<?php echo $facebook;?>" class="facebook"><i class="icon-facebook"></i></a></li>
						<?php }?>
						<?php if($linkedin !=''){?>	
							<li><a href="<?php echo $linkedin;?>" class="linkedin"><i class="icon-linkedin"></i></a></li>
						<?php }?>
						<?php if($googleplus !=''){?>	
							<li><a href="<?php echo $googleplus;?>" class="gplus"><i class="icon-gplus"></i></a></li>
						<?php }?>
						<?php if($dribbble !=''){?>	
							<li><a href="<?php echo $dribbble;?>" class="dribbble"><i class="icon-dribbble"></i></a></li>
						<?php }?>	
						<?php if($forrst !=''){?>
							<li><a href="<?php echo $forrst;?>" class="forrst"><i class="icon-forrst"></i></a></li>
						<?php }?>	
						<?php if($instagram !=''){?>
							<li><a href="<?php echo $instagram;?>" class="instagram"><i class="icon-instagram"></i></a></li>
						<?php }?>
						<?php if($tumblr !=''){?>	
							<li><a href="<?php echo $tumblr;?>" class="tumblr"><i class="icon-tumblr"></i></a></li>
						<?php }?>	
						<?php if($github !=''){?>
							<li><a href="<?php echo $github;?>" class="github"><i class="icon-github"></i></a></li>
						<?php }?>	
						<?php if($pinterest !=''){?>
							<li><a href="<?php echo $pinterest;?>" class="pinterest"><i class="icon-pinterest"></i></a></li>
						<?php }?>	
					</ol>  
					
					<div class="team-name"><a href="<?php the_permalink(); ?>"><h5><?php the_title();?></h5></a> <span><?php echo $team_job; ?></span></div>
					<div class="team-about"><p><?php the_excerpt(); ?></p></div>
					<div class="clearfix"></div>
				</li>
				<?php
						endwhile;											
					endif;
				// Reset Post Data
				wp_reset_postdata(); ?>	
			</ul>
			<div class="clearfix"></div>
		</div>
		<div class="clearfix"></div>
	</div>
	</div>
</div>   

<?php get_footer();?>