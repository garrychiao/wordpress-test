<?php
$signature_options = signature_get_options('signature_wp');
?>

<footer class="mastfoot signature-gozzo" style="background: <?php echo esc_attr($signature_options['foot_bg_color']);?>">
    
  <div class="container">
      <div class="row">
          <article class="col-md-4 text-left">
              <ul class="social-icons signature-gozzo">
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
          <article class="col-md-8 text-right credits">
              <p class="font2 dark">
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

