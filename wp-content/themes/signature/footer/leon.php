<?php
$signature_options = signature_get_options('signature_wp');
?>

<footer class="mastfoot signature-leon" style="background: <?php echo esc_attr($signature_options['foot_bg_color']);?>">
  <div class="container-fluid">
    
    <div class="row">
          <ul class="foot-social col-md-12 text-center font3bold">
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
    </div>

    <div class="row">
          <article class="credits col-md-6 col-md-offset-3  text-center">
              <p class="font3 dark">
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




