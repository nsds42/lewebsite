<?php
/**
 * The template for displaying 404 pages (Not Found)
 */
global $theme_option; 
get_header(); ?>
<section id="titlebar">
	<!-- Container -->
	<div class="container">
	
		<div class="eight columns" data-appear-top-offset="-100" data-animated="fadeInLeft">
			<h2><i class="icon-exclamation-sign"></i> Page Not Found</h2>
		</div>
		
		<div class="eight columns" data-appear-top-offset="-100" data-animated="fadeInRight">
			<nav id="breadcrumbs">
				<ul>
					
				</ul>
			</nav>
		</div>

	</div>
	<!-- Container / End -->
</section>

<div class="container">
	<div class="sixteen columns">
		<section id="not-found">
			<h2 data-appear-top-offset="-100" data-animated="fadeInLeft"><?php echo $theme_option['404_title']; ?> <i class="icon-question-sign"></i></h2>
			<p data-appear-top-offset="-100" data-animated="fadeInRight"><?php echo $theme_option['404_content']; ?></p>
			<div class="btn" style="text-align: center;"><a class="button dark" href="<?php echo home_url(); ?>">BACK TO HOME</a></div>
		</section>
	</div>
</div>

<?php
get_footer();
