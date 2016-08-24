<?php
$signature_options = signature_get_options('signature_wp');
?>

    </div>

    <?php
    $footer_style = signature_get_footer_style();

      if ($footer_style == 'Adler') {
        get_template_part('footer/adler');
        echo "</section>";                      //Mastwrap ends here
      }
      elseif ($footer_style == 'Berend') {
        get_template_part('footer/berend');
        echo "</section>";                      //Mastwrap ends here
      }
      elseif ($footer_style == 'Claus') {
        echo "</section>";                      //Mastwrap ends here
        get_template_part('footer/claus');
      }
      elseif ($footer_style == 'Dierk') {
        get_template_part('footer/dierk');
        echo "</section>";                      //Mastwrap ends here
      }
      elseif ($footer_style == 'Ebert') {
        get_template_part('footer/ebert');
        echo "</section>";                      //Mastwrap ends here
      }
      elseif ($footer_style == 'Franz') {
        get_template_part('footer/franz');
        echo "</section>";                      //Mastwrap ends here
      }
      elseif ($footer_style == 'Gozzo') {
        get_template_part('footer/gozzo');
        echo "</section>";                      //Mastwrap ends here
      }
      elseif ($footer_style == 'Hans') {
        get_template_part('footer/hans');
        echo "</section>";                      //Mastwrap ends here
      }
      elseif ($footer_style == 'Igor') {
        get_template_part('footer/igor');
        echo "</section>";                      //Mastwrap ends here
      }
      elseif ($footer_style == 'Johan') {
        get_template_part('footer/johan');
        echo "</section>";                      //Mastwrap ends here
      }
      elseif ($footer_style == 'Karl') {
        get_template_part('footer/karl');
        echo "</section>";                      //Mastwrap ends here
      }
      elseif ($footer_style == 'Leon') {
        get_template_part('footer/leon');
        echo "</section>";                      //Mastwrap ends here
      }
      elseif ($footer_style == 'Orwin') {
        get_template_part('footer/orwin');
        echo "</section>";                      //Mastwrap ends here
      }
      elseif ($footer_style == 'Quartz') {
        get_template_part('footer/quartz');
        echo "</section>";                      //Mastwrap ends here
      }
      elseif ($footer_style == 'Rein') {
        get_template_part('footer/rein');
        echo "</section>";                      //Mastwrap ends here
      }
      elseif ($footer_style == 'Stefan') {
        get_template_part('footer/stefan');
        echo "</section>";                      //Mastwrap ends here
      }
      elseif ($footer_style == 'Theo') {
        get_template_part('footer/theo');
        echo "</section>";                      //Mastwrap ends here
      }
      elseif ($footer_style == 'Uno') {
        get_template_part('footer/uno');
        echo "</section>";                      //Mastwrap ends here
      }
      elseif ($footer_style == 'Velten') {
        get_template_part('footer/velten');
        echo "</section>";                      //Mastwrap ends here
      }
      elseif ($footer_style == 'Wilmar') {
        get_template_part('footer/wilmar');
        echo "</section>";                      //Mastwrap ends here
      }
      elseif ($footer_style == 'Xaver') {
        get_template_part('footer/xaver');
        echo "</section>";                      //Mastwrap ends here
      }
      elseif ($footer_style == 'York') {
        get_template_part('footer/york');
        echo "</section>";                      //Mastwrap ends here
      }
      elseif ($footer_style == 'Zircon') {
        get_template_part('footer/zircon');
        echo "</section>";                      //Mastwrap ends here
      }
      if ($footer_style == 'Amor') {
        echo "</section>"; //Mastwrap ends here
        get_template_part('footer/amor');
                             
      }
    ?>
    




  

<?php

    wp_footer();
?>
</body>
</html>