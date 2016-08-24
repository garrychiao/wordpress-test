


<section class="pop-search signature-zircon fullheight text-left">
	<div class="valign">
		<form role="search" method="get" id="searchform" class="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	    	<div><input type="text" class="pop-search-field font3light" placeholder="<?php _e('Your keywords here', 'signature'); ?>" value="<?php echo get_search_query(); ?>" name="s" id="s" /></div>
	    	<div><input type="submit" class="btn btn-signature btn-signature-zircon btn-signature-color" id="submit" value="<?php _e('Search Now', 'signature'); ?>" /></div>
		</form>
	</div>
</section>

  <section class="shop-sub-header signature-zircon dark-bg">
        <div class="row">
          <article class="col-md-6 col-xs-6">
            <div class="shop-sub-close white text-right">
              <a href="#"><span class="ion-android-arrow-up white"></span></a>
            </div>
            <div class="shop-sub-search white text-right">
              <a href="#"><span class="ion-search white"></span></a>
            </div>
          </article>
          <article class="col-md-6 col-xs-6 text-right shop-cart">
          	<div class="shop-cart-dropdown-trigger">
	            <div class="shop-cart-count white color-bg text-center">
	            	<div class="signature-woocommerce-widget-area">
					  	<?php
					  		if(is_active_sidebar('signature_shop_sidebar')) {
					            dynamic_sidebar('signature_shop_sidebar');
					        }
					  	?>
					</div>
	            </div>
	            <div class="shop-cart-icon white">
	              <span class="ion-bag white"></span>
	            </div>
            </div>
          </article>
        </div>
  </section>