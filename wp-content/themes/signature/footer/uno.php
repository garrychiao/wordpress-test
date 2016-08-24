<?php
$signature_options = signature_get_options('signature_wp');
?>


<footer class="mastfoot signature-uno" style="background: <?php echo esc_attr($signature_options['foot_bg_color']);?>">
    
  <div class="container">
      <div class="row">
          <article class="col-md-12 text-center">
              <ul class="social-icons signature-uno">
                <?php
                  if(isset($signature_options['signature-social-media-icons']) && !empty($signature_options['signature-social-media-icons']))
                  {
                    $social_icons = $signature_options['signature-social-media-icons'];

                    foreach ($social_icons as $social_icon) {
                      $title = $social_icon['title'];
                      $icon_url = $social_icon['url'];
                      $icon = $social_icon['image'];

                      echo '<li><a href="'.esc_url($icon_url).'"><img data-no-retina alt="'.esc_attr($title).'" title="'.esc_attr($title).'" src="'.esc_url($icon).'"/></a></li>';
                    }
                  }
                ?>
              </ul>
          </article>
      </div>
      <div class="row">
          <article class="col-md-6 col-md-offset-3 text-center foot-caps">
              <p class="font4 white" style="border-color: <?php echo esc_attr($signature_options['uno-footer-border-color']);?>">
                <?php 
                  echo wp_kses($signature_options['uno-footer-text'], array(
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
      <div class="row">
          <article class="col-md-12 text-center credits">
              <p class="font3thin white">
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

