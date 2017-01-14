<?php
/**
 * The Template for displaying all single posts
 */
 $textdoimain = 'liwa';
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
		<article class="post" style="margin: 0; border: 0;">
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
					<h2><?php the_title(); ?></h2>
					<ul>
						<li>By <?php the_author_posts_link(); ?> - <?php the_time('M j, Y');?></li>
						<li><?php the_category(', '); ?></li>
						<li><?php comments_popup_link(__(' 0 comment', $textdoimain), __(' 1 comment', $textdoimain), ' % comments'.__('', $textdoimain)); ?></li>
					</ul>
				</header>

				<?php the_content(); ?>	
				
				<?php wp_link_pages(); ?>
				
				<div class="tagsSingle clearfix">
					<h4><i class="icon-tag-1"></i>Tags :</h4>
					<?php
					if(get_the_tag_list()) {
						echo get_the_tag_list('<ul class="tagsListSingle"><li>','</li><li>','</li></ul>');
					} ?>
				</div>	
				
			</section>
			<div class="clearfix"></div>
		</article>
		<?php endwhile; ?>	
		
		<?php comments_template();?>
		
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
?>						
