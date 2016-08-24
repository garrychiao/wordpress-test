<?php
$signature_options = signature_get_options('signature_wp');
?>

<footer class="mastfoot signature-igor" style="background: <?php echo esc_attr($signature_options['foot_bg_color']);?>">
  <div class="container">
      <div class="row">
          <article class="col-md-12 text-center">
            <a href="<?php echo esc_url(home_url( '/' )); ?>"><img alt="<?php echo esc_attr(get_bloginfo('name')); ?>" title="<?php echo esc_attr(get_bloginfo('name')); ?>" class="foot-logo img-responsive" src="<?php echo esc_url($signature_options['signature-footer-logo']['url']); ?>"/></a>
          </article>
      </div>
      <div class="row">
          <article class="col-md-12 text-center">
              <ul class="social-nav font4 black">
                <?php
                  if(isset($signature_options['signature-social-media-icons']) && !empty($signature_options['signature-social-media-icons']))
                  {
                    $social_icons = $signature_options['signature-social-media-icons'];

                    foreach ($social_icons as $social_icon) {
                      $title = $social_icon['title'];
                      $icon_url = $social_icon['url'];

                      echo '<li><a href="'.esc_url($icon_url).'">'.esc_html($title).'</a></li>';
                    }
                  }
                ?>
              </ul>
          </article>
      </div>
      <div class="row">
          <article class="col-md-12 text-center">
              <p class="copyright font1 grey">
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




