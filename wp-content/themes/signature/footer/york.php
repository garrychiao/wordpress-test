<?php
$signature_options = signature_get_options('signature_wp');
?>

<footer class="mastfoot signature-york white-bg">
  <div class="container-fluid">
    

    <div class="row">
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







