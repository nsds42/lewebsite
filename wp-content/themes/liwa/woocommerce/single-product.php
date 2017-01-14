<?php
/**
 * The Template for displaying all single products.
 *
 * Override this template by copying it to yourtheme/woocommerce/single-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

get_header( 'shop' ); ?>

	<?php
		/**
		 * woocommerce_before_main_content hook
		 *
		 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
		 * @hooked woocommerce_breadcrumb - 20
		 */
		do_action( 'woocommerce_before_main_content' );
	?>
	<section id="titlebar">
		<!-- Container -->
		<div class="container">
		
			<div class="eight columns" data-appear-top-offset="-100" data-animated="fadeInLeft">
				<h2><i class="icon-ticket"></i> <?php the_title(); ?></h2>
			</div>
			
			<div class="eight columns" data-appear-top-offset="-100" data-animated="fadeInRight">
				<nav id="breadcrumbs">
					<ul>
						<li>You are here:</li>
						<?php echo woocommerce_breadcrumb(); ?>	
					</ul>
				</nav>
			</div>

		</div>
		<!-- Container / End -->
	</section>
	<div class="container">
		<div class="twelve alt columns">
			<?php while ( have_posts() ) : the_post(); ?>

				<?php wc_get_template_part( 'content', 'single-product' ); ?>

			<?php endwhile; // end of the loop. ?>
		</div>
		<?php
			/**
			 * woocommerce_after_main_content hook
			 *
			 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
			 */
			do_action( 'woocommerce_after_main_content' );
		?>
		<div class="four columns">
			<?php
				/**
				 * woocommerce_sidebar hook
				 *
				 * @hooked woocommerce_get_sidebar - 10
				 */
				do_action( 'woocommerce_sidebar' );
			?>
		</div>
	</div>
<?php get_footer( 'shop' ); ?>