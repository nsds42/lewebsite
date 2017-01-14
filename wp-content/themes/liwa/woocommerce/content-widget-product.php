<?php global $product; ?>		
<!-- Post #1 -->
<li>
	<div class="widget-thumb">
		<a href="<?php echo esc_url( get_permalink( $product->id ) ); ?>" title="<?php echo esc_attr( $product->get_title() ); ?>"><?php echo $product->get_image(); ?></a>
	</div>
	
	<div class="widget-text">
		<h4><a href="<?php echo esc_url( get_permalink( $product->id ) ); ?>" title="<?php echo esc_attr( $product->get_title() ); ?>"><?php echo $product->get_title(); ?></a></h4>
		<?php //if ( ! empty( $show_rating ) ) echo $product->get_rating_html(); ?>
		<?php echo $product->get_price_html(); ?>
	</div>
	<div class="clearfix"></div>
</li>