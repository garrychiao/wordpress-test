<?php
$signature_options = signature_get_options('signature_wp');
?>

<footer class="mastfoot signature-hans" style="background: <?php echo esc_attr($signature_options['foot_bg_color']);?>">
  <div class="container-fluid">
    
    <div class="row add-top-quarter">
          <article class="credits col-md-12  text-center">
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

    <div class="row add-top-quarter">
      <ul class="foot-social col-md-12 text-center">
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
    </div>

  </div>
</footer>

