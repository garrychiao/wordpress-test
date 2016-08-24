<?php
$signature_options = signature_get_options('signature_wp');
?>
<footer class="mastfoot signature-rein" style="background: <?php echo esc_attr($signature_options['foot_bg_color']);?>">
  <div class="container">
    <div class="row">
      <article class="col-md-6 text-left">
        <ul class="social">
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
        <p>
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
      <article class="col-md-6 text-right">
        <a href="<?php echo esc_url(home_url( '/' )); ?>"><img alt="<?php echo esc_attr(get_bloginfo('name')); ?>" title="<?php echo esc_attr(get_bloginfo('name')); ?>" class="foot-logo img-responsive" src="<?php echo esc_url($signature_options['signature-footer-logo']['url']); ?>"/></a>
      </article>
    </div>
  </div>

</footer>
