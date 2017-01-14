<?php
/**
 * The template for displaying Author archive pages
 */
  $textdoimain = 'liwa';
 global $theme_option;
get_header(); ?>
<section id="titlebar">
	<!-- Container -->
	<div class="container">
		<div class="eight columns" data-appear-top-offset="-100" data-animated="fadeInLeft">
			<h2><i class="icon-user"></i> <?php
					/*
					 * Queue the first post, that way we know what author
					 * we're dealing with (if that is the case).
					 *
					 * We reset this later so we can run the loop properly
					 * with a call to rewind_posts().
					 */
					the_post();

					printf( __( 'All posts by %s', 'liwa' ), get_the_author() );
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

<div class="twelve alt columns">
	<?php 
		while (have_posts()): the_post(); 
		$format = get_post_format();
		$icon = '';
		$id = get_the_ID();
		switch($format){
			case 'gallery':
			$icon = 'icon-picture';
			break;
			case 'video':
			$icon = 'icon-facetime-video';
			break;
			case 'audio':
			$icon ='icon-music';
			break;
			case 'quote':
			$icon ='icon-quote-left';
			break;
			case 'image':
			$icon ='icon-picture';
			break;
			case 'link':
			$icon ='icon-link';
			break;
			default:
			$icon ='icon-pencil';
		}
	?> 	
	<!-- Post -->
	<article class="post">
		<?php $format = get_post_format();?>
		<?php if($format == 'gallery'){?>
		<?php $gallery = get_post_gallery( get_the_ID(), false );
			if(isset($gallery['ids'])){ ?>
		<!-- FlexSlider  -->
		<section class="flexslider post-img">
			<div class="media">
				<ul class="slides mediaholder">
				<?php
					$gallery_ids = $gallery['ids'];
					$img_ids = explode(",",$gallery_ids);
					foreach( $img_ids AS $img_id ){
					$image_src = wp_get_attachment_image_src($img_id,'');
				?>
					<li>	
						<?php $params = array( 'width' => 860, 'height' => 320 );
							  $image = bfi_thumb( $image_src[0], $params ); ?>
						<img src="<?php echo $image; ?>" alt="<?php the_title(); ?>" width="860" height="320"/>							
					</li>
					<?php }?>
				</ul>
			</div>
		</section>
		<?php }?>
		<?php }elseif($format == 'video'){?>
			<?php $link_video = get_post_meta(get_the_ID(),'_cmb_link_video', true);?>
			<?php if($link_video !=''){?>
				<div class="media_element">
					<iframe height="320" src="<?php echo $link_video;?>" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen ></iframe>
				 </div>
			<?php }?>
			<!--End post media-->	
		<?php }elseif($format == 'audio'){?>
			<?php $link_audio = get_post_meta(get_the_ID(),'_cmb_link_audio', true);?>
			<?php if($link_audio !=''){?>
				<div class="media_element">
					<iframe width="100%" height="166" scrolling="no" frameborder="no" src="<?php echo get_post_meta(get_the_ID(), "_cmb_link_audio", true);?>&amp;color=ff5500&amp;auto_play=false&amp;hide_related=false&amp;show_artwork=true"></iframe>
				 </div>
			<?php }?>
		<?php }elseif($format == 'image'){ ?>
			<?php if ( has_post_thumbnail() ) { ?>
					<figure class="post-img media">
						<div class="mediaholder">
							<a href="<?php the_permalink(); ?>">
								<?php   
									$params = array('width' => 860,'height' => 320);
									$thumbnail = bfi_thumb(wp_get_attachment_url(get_post_thumbnail_id()),$params); 
								?>
								<img src="<?php echo $thumbnail; ?>" alt="<?php the_title(); ?>" width="860" height="320" />
								
								<div class="hovercover">
									<div class="hovericon"><i class="hoverlink"></i></div>
								</div>
							</a>
						</div>
					</figure>
				<?php }?>
		<?php }else{ ?>
			<?php if ( has_post_thumbnail() ) { ?>
				<figure class="post-img media">
					<div class="mediaholder">
						<a href="<?php the_permalink(); ?>">
							<?php   
								$params = array('width' => 860,'height' => 320);
								$thumbnail = bfi_thumb(wp_get_attachment_url(get_post_thumbnail_id()),$params); 
							?>
							<img src="<?php echo $thumbnail; ?>" alt="<?php the_title(); ?>" width="860" height="320" />
							
							<div class="hovercover">
								<div class="hovericon"><i class="hoverlink"></i></div>
							</div>
						</a>
					</div>
				</figure>
				<?php }?>
		<?php }?>
		
		<div class="post-format">
			<div class="blog-cat1 cat-circle"><i class="<?php echo $icon; ?>"></i><span></span></div>
		</div>

		<section class="post-content">

			<header class="meta">
				<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
				<ul>
					<li>By <?php the_author_posts_link(); ?> - <?php the_time('M j, Y');?></li>
					<li><?php 
							// Show all category for post
							$i = 1; foreach((get_the_category()) as $category) { 
							if ($i == 1){echo ''; }else {echo ' , ';}
								echo '<a href="'.get_category_link($category->cat_ID).'">'.$category->category_nicename . ' '.'</a>'; 
								
								$i++;
							} ?></li>
					<li><?php comments_popup_link(__(' 0 comment', $textdoimain), __(' 1 comment', $textdoimain), ' % comments'.__('', $textdoimain)); ?></li>
				</ul>
			</header>
			<?php if($format == 'quote' ){ ?>
				<div class="quote-post">
					<?php echo the_content(); ?>
				</div>
			<?php }elseif($format == 'link'){ ?>	
				<div class="link-post">
					<?php echo the_content(); ?>
				</div>	
			<?php }else{ ?>
			<p><?php echo liwa_excerpt(); ?></p>
			<?php } ?>
			<a class="button color" href="<?php the_permalink(); ?>"><i class="icon-align-left"></i> <?php global $theme_option; echo $theme_option['read_more']; ?></a>

		</section>
		<div class="clearfix"></div>

	</article>
<?php endwhile;?> 

	<!-- Pagination -->
	 <div class="pagination">
		<?php liwa_pagination();?>          
    </div> <!-- /pagination -->

</div>

<div class="four columns">
	<?php get_sidebar(); ?>
</div>

</div>
<!-- Container / End -->				
<?php
get_footer();

