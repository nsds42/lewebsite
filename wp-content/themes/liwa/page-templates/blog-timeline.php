<?php
/**
 * Template Name: Blog Timeline
 */
  $textdoimain = 'liwa';
 global $theme_option;
get_header(); ?>

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

<div id="tline-content">
		
		<?php
            $counter = 0;
            $ref_month = '';
            $monthly = new WP_Query(array(
                'posts_per_page' => -1
            ));
            if( $monthly->have_posts() ) : while( $monthly->have_posts() ) : $monthly->the_post();		
			$format = get_post_format();
			$icon = '';
			$icon_color ='';
			$id = get_the_ID();
			switch($format){
				case 'gallery':
				$icon = 'icon-picture';
				$icon_color ='tline-cat1';
				break;
				case 'video':
				$icon = 'icon-facetime-video';
				$icon_color ='tline-cat2';
				break;
				case 'audio':
				$icon ='icon-music';
				$icon_color ='tline-cat3';
				break;
				case 'quote':
				$icon ='icon-quote-left';
				$icon_color ='tline-cat4';
				break;
				case 'image':
				$icon ='icon-picture';
				$icon_color ='tline-cat1';
				break;
				case 'link':
				$icon ='icon-link';
				$icon_color ='tline-cat2';
				break;
				default:
				$icon ='icon-pencil';
				$icon_color ='tline-cat4';
			}
		?>
		<?php 
            if( get_the_date('mY') != $ref_month ) {
                if( $ref_month );
        ?>

        <div class="tline-topdate" data-appear-top-offset="-100" data-animated="fadeInUp"><?php echo get_the_date('M'); ?><br> <?php echo get_the_date('Y'); ?></div>
		<?php
            $ref_month = get_the_date('mY');
            $counter = 0;
            }
		?> 	
		<?php if ($counter++ < 5) { ?>
		<?php if($counter%2==0){ ?>
			<article class="tline-box" data-appear-top-offset="-100" data-animated="fadeInRight"> <span class="tline-row-l"></span> 
		<?php }else{ ?>
			<article class="tline-box rgtline" data-appear-top-offset="-100" data-animated="fadeInLeft"> <span class="tline-row-r"></span>
		<?php } ?>
			<span class="<?php echo $icon_color; ?>"><i class="<?php echo $icon; ?>"></i></span>
			<?php   
				$params = array('width' => 420,'height' => 300);
				$thumbnail = bfi_thumb(wp_get_attachment_url(get_post_thumbnail_id()),$params); 
			?>
			<img src="<?php echo $thumbnail; ?>" alt="<?php the_title(); ?>" width="420" height="300" /><br />
			  <div class="tline-ecxt">
				<header class="tline-meta">
					<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
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
			  </div>
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
			
			<?php } else { ?>

            <?php } ?>
        </article>
	<?php endwhile; endif; ?>
	<?php wp_reset_query(); ?>
</div>

</div>
<!-- Container / End -->				
<?php
get_footer();
