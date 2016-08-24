<?php
/**
 * Template Name: WooCommerce
 *
 * @author Designova (designova.net)
 * @theme Signature
*/
get_header();



	?>
		<section id="shop-page" class="shop page inner-page signature-page-section second-page">
		
			<section class="container">

				<div class="row add-top-half add-bottom-half">
					<!-- shop-grid:starts -->
					<article class="col-md-12">
						<div ><?php woocommerce_content(); ?></div>
					</article>
				</div>
			</section>
			<div class="offer-price-txt hidden-md hidden-lg hidden-sm hidden-xs"><?php esc_html_e('Offer Price', 'signature'); ?></div>
			<div class="outofstock-txt hidden-md hidden-lg hidden-sm hidden-xs"><?php esc_html_e('No Stock', 'signature'); ?></div>
			<div class="featured-item-txt hidden-md hidden-lg hidden-sm hidden-xs"><?php esc_html_e('Featured Item', 'signature'); ?></div>
		</section>
	<?php





get_footer();
?>
