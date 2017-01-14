<?php
/**
 * The template for displaying the footer
 */
 global $theme_option; 
?>

</div>
<!-- Content Wrapper / End -->			
				
<!-- Footer
================================================== -->
<div id="footer">
	<!-- Container -->
	<div class="container">
		<?php get_sidebar('footer'); ?>
	</div>
	<!-- Container / End -->
</div>
<!-- Footer / End -->

<!-- Footer Bottom / Start -->
<div id="footer-bottom">
	<!-- Container -->
	<div class="container">
		<div class="eight columns">
			<?php if($theme_option['footer_text']!=''){ ?>
				<?php echo $theme_option['footer_text']; ?>
			<?php } ?>
		</div>
		<div class="eight columns">
			<ul class="social-icons-footer">
				<?php if($theme_option['facebook']!=''){ ?>
				<li><a class="tooltip top" title="Facebook" href="<?php echo $theme_option['facebook']; ?>"><i class="icon-facebook"></i></a></li>
				<?php } ?>
				<?php if($theme_option['google']!=''){ ?>
				<li><a class="tooltip top" title="Google Plus" href="<?php echo $theme_option['google']; ?>"><i class="icon-gplus"></i></i></a></li>
				<?php } ?>
				<?php if($theme_option['twitter']!=''){ ?>
				<li><a class="tooltip top" title="Twitter" href="<?php echo $theme_option['twitter']; ?>"><i class="icon-twitter"></i></a></li>
				<?php } ?>						
				<?php if($theme_option['linkedin']!=''){ ?>
				<li><a class="tooltip top" title="LinkedIn" href="<?php echo $theme_option['linkedin']; ?>"><i class="icon-linkedin"></i></a></li>
				<?php } ?>
				<?php if($theme_option['dribbble']!=''){ ?>
				<li><a class="tooltip top" title="Dribbble" href="<?php echo $theme_option['dribbble']; ?>"><i class="icon-dribbble"></i></a></li>
				<?php } ?>
				<?php if($theme_option['pinterest']!=''){ ?>
				<li><a class="tooltip top" title="Pinterest" href="<?php echo $theme_option['pinterest']; ?>"><i class="icon-pinterest"></i></a></li>
				<?php } ?>
				<?php if($theme_option['instagram']!=''){ ?>
				<li><a class="tooltip top" title="Instagram" href="<?php echo $theme_option['instagram']; ?>"><i class="icon-instagram"></i></a></li>
				<?php } ?>
				<?php if($theme_option['vimeo']!=''){ ?>
				<li><a class="tooltip top" title="Vimeo" href="<?php echo $theme_option['vimeo']; ?>"><i class="icon-vimeo"></i></a></li>
				<?php } ?>	
			</ul>
		</div>
	</div>
	<!-- Container / End -->
</div>
<!-- Footer Bottom / Start -->

<?php wp_footer(); ?>
</body>
</html>