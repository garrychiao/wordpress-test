<?php
$signature_options = signature_get_options('signature_wp');
?>
<footer class="mastfoot signature-berend" style="background: <?php echo esc_attr($signature_options['foot_bg_color']);?>">
  <div class="container">
    <div class="row">
      <article class="col-md-6 text-left">
        <a href="<?php echo esc_url(home_url( '/' )); ?>"><img alt="<?php echo esc_attr(get_bloginfo('name')); ?>" title="<?php echo esc_attr(get_bloginfo('name')); ?>" class="nav-logo img-responsive" src="<?php echo esc_url($signature_options['signature-footer-logo']['url']); ?>"/></a>
        <h6 class="font2 grey">
          <?php 
            echo wp_kses($signature_options['berend-footer-content'], array(
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
        </h6>
      </article>
      <article class="col-md-6 text-right">
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
        <p class="font1">
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