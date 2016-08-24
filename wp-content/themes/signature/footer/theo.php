<?php
$signature_options = signature_get_options('signature_wp');
?>


<footer class="mastfoot signature-theo" style="background: <?php echo esc_attr($signature_options['foot_bg_color']);?>">
  <div class="container">
      <div class="row">
          <article class="col-md-12 text-center">
            <a href="<?php echo esc_url(home_url( '/' )); ?>"><img alt="<?php echo esc_attr(get_bloginfo('name')); ?>" title="<?php echo esc_attr(get_bloginfo('name')); ?>" class="foot-logo img-responsive" src="<?php echo esc_url($signature_options['signature-footer-logo']['url']); ?>"/></a>
          </article>
      </div>
      <div class="row">
          <article class="col-md-12 text-center">
              <p class="copyright font3 light-grey">
                <?php 
                  echo wp_kses($signature_options['signature-footer-copy'], array(
                              'a' => array(
                                  'href' => array(),
                                  'title' => array(),
                                  'target' => array()
                              ),
                              'br' => array(),
                              'img' => array(
                                  'src' => array(),
                                  'title' => array()
                                ),

                              ));
                ?>
              </p>
          </article>
      </div>
  </div>
</footer>

