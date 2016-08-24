<?php
$signature_options = signature_get_options('signature_wp');
?>

<footer class="mastfoot signature-igor" style="background: <?php echo esc_attr($signature_options['foot_bg_color']);?>">
  <div class="container">
      <div class="row">
          <article class="col-md-12 text-center">
              <ul class="social-nav font3 white orwin-social-icons">
                <?php
                  if(isset($signature_options['signature-social-media-icons']) && !empty($signature_options['signature-social-media-icons']))
                  {
                    $social_icons = $signature_options['signature-social-media-icons'];

                    foreach ($social_icons as $social_icon) {
                      $title = $social_icon['title'];
                      $icon_url = $social_icon['url'];

                      echo '<li><a href="'.esc_url($icon_url).'" class="white" target="_blank">'.esc_html($title).'</a></li>';
                    }
                  }
                ?>
              </ul>
          </article>
      </div>
      <div class="row">
          <article class="col-md-12 text-center">
              <p class="copyright font2 white">
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




