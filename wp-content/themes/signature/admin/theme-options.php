<?php
    /**
     * ReduxFramework Sample Config File
     * For full documentation, please visit: http://docs.reduxframework.com/
     */

    if ( ! class_exists( 'Redux_Framework_sample_config' ) ) {

        class Redux_Framework_sample_config {

            public $args = array();
            public $sections = array();
            public $theme;
            public $ReduxFramework;

            public function __construct() {

                if ( ! class_exists( 'ReduxFramework' ) ) {
                    return;
                }

                // This is needed. Bah WordPress bugs.  ;)
                if ( true == Redux_Helpers::isTheme( __FILE__ ) ) {
                    $this->initSettings();
                } else {
                    add_action( 'plugins_loaded', array( $this, 'initSettings' ), 10 );
                }

            }

            public function initSettings() {

                // Just for demo purposes. Not needed per say.
                $this->theme = wp_get_theme();

                // Set the default arguments
                $this->setArguments();

                // Set a few help tabs so you can see how it's done
                $this->setHelpTabs();

                // Create the sections and fields
                $this->setSections();

                if ( ! isset( $this->args['opt_name'] ) ) { // No errors please
                    return;
                }

                // If Redux is running as a plugin, this will remove the demo notice and links
                //add_action( 'redux/loaded', array( $this, 'remove_demo' ) );

                // Function to test the compiler hook and demo CSS output.
                // Above 10 is a priority, but 2 in necessary to include the dynamically generated CSS to be sent to the function.
                //add_filter('redux/options/'.$this->args['opt_name'].'/compiler', array( $this, 'compiler_action' ), 10, 3);

                // Change the arguments after they've been declared, but before the panel is created
                //add_filter('redux/options/'.$this->args['opt_name'].'/args', array( $this, 'change_arguments' ) );

                // Change the default value of a field after it's been set, but before it's been useds
                //add_filter('redux/options/'.$this->args['opt_name'].'/defaults', array( $this,'change_defaults' ) );

                // Dynamically add a section. Can be also used to modify sections/fields
                //add_filter('redux/options/' . $this->args['opt_name'] . '/sections', array($this, 'dynamic_section'));

                $this->ReduxFramework = new ReduxFramework( $this->sections, $this->args );
            }

            /**
             * This is a test function that will let you see when the compiler hook occurs.
             * It only runs if a field    set with compiler=>true is changed.
             * */
            function compiler_action( $options, $css, $changed_values ) {
                echo '<h1>'.esc_html__('The compiler hook has run!', 'signature').'</h1>';
                echo "<pre>";
                print_r( $changed_values ); // Values that have changed since the last save
                echo "</pre>";
                //print_r($options); //Option values
                //print_r($css); // Compiler selector CSS values  compiler => array( CSS SELECTORS )

                /*
              // Demo of how to use the dynamic CSS and write your own static CSS file
              $filename = get_template_directory().'/admin/style' . '.css';
              global $wp_filesystem;
              if( empty( $wp_filesystem ) ) {
                require_once( ABSPATH .'/wp-admin/includes/file.php' );
              WP_Filesystem();
              }

              if( $wp_filesystem ) {
                $wp_filesystem->put_contents(
                    $filename,
                    $css,
                    FS_CHMOD_FILE // predefined mode settings for WP files
                );
              }
             */
            }

            /**
             * Custom function for filtering the sections array. Good for child themes to override or add to the sections.
             * Simply include this function in the child themes functions.php file.
             * NOTE: the defined constants for URLs, and directories will NOT be available at this point in a child theme,
             * so you must use get_template_directory_uri() if you want to use any of the built in icons
             * */
            function dynamic_section( $sections ) {
                //$sections = array();
                $sections[] = array(
                    'title'  => esc_html__( 'Section via hook', 'signature' ),
                    'desc'   => esc_html__( '<p class="description">This is a section created by adding a filter to the sections array. Can be used by child themes to add/remove sections from the options.</p>', 'signature' ),
                    'icon'   => 'el-icon-paper-clip',
                    // Leave this as a blank section, no options just some intro text set above.
                    'fields' => array()
                );

                return $sections;
            }

            /**
             * Filter hook for filtering the args. Good for child themes to override or add to the args array. Can also be used in other functions.
             * */
            function change_arguments( $args ) {
                //$args['dev_mode'] = true;

                return $args;
            }

            /**
             * Filter hook for filtering the default value of any given field. Very useful in development mode.
             * */
            function change_defaults( $defaults ) {
                $defaults['str_replace'] = 'Testing filter hook!';

                return $defaults;
            }

            // Remove the demo link and the notice of integrated demo from the redux-framework plugin
            function remove_demo() {

                // Used to hide the demo mode link from the plugin page. Only used when Redux is a plugin.
                if ( class_exists( 'ReduxFrameworkPlugin' ) ) {
                    remove_filter( 'plugin_row_meta', array(
                        ReduxFrameworkPlugin::instance(),
                        'plugin_metalinks'
                    ), null, 2 );

                    // Used to hide the activation notice informing users of the demo panel. Only used when Redux is a plugin.
                    remove_action( 'admin_notices', array( ReduxFrameworkPlugin::instance(), 'admin_notices' ) );
                }
            }

            
            public function setSections() {

                /**
                 * Used within different fields. Simply examples. Search for ACTUAL DECLARATION for field examples
                 * */
                // Background Patterns Reader
                $sample_patterns_path = ReduxFramework::$_dir . '../sample/patterns/';
                $sample_patterns_url  = ReduxFramework::$_url . '../sample/patterns/';
                $sample_patterns      = array();

                if ( is_dir( $sample_patterns_path ) ) :

                    if ( $sample_patterns_dir = opendir( $sample_patterns_path ) ) :
                        $sample_patterns = array();

                        while ( ( $sample_patterns_file = readdir( $sample_patterns_dir ) ) !== false ) {

                            if ( stristr( $sample_patterns_file, '.png' ) !== false || stristr( $sample_patterns_file, '.jpg' ) !== false ) {
                                $name              = explode( '.', $sample_patterns_file );
                                $name              = str_replace( '.' . end( $name ), '', $sample_patterns_file );
                                $sample_patterns[] = array(
                                    'alt' => $name,
                                    'img' => $sample_patterns_url . $sample_patterns_file
                                );
                            }
                        }
                    endif;
                endif;



                $footer_styles_path = get_template_directory() .'/admin/preview/footer/';
                $footer_styles_url  = get_template_directory_uri().'/admin/preview/footer/';
                $footer_styles      = array();

                if ( is_dir( $footer_styles_path ) ) :

                    if ( $footer_styles_dir = opendir( $footer_styles_path ) ) :
                        $footer_styles = array();

                        while ( ( $footer_styles_file = readdir( $footer_styles_dir ) ) !== false ) {

                            if ( stristr( $footer_styles_file, '.png' ) !== false || stristr( $footer_styles_file, '.jpg' ) !== false ) {
                                $footer_name              = explode( '.', $footer_styles_file );
                                $footer_name              = str_replace( '.' . end( $footer_name ), '', $footer_styles_file );
                                $footer_styles[] = array(
                                    'alt' => $footer_name,
                                    'img' => $footer_styles_url . $footer_styles_file
                                );
                            }
                        }
                    endif;
                endif;



                $navigation_styles_path = get_template_directory() .'/admin/preview/navigation/';
                $navigation_styles_url  = get_template_directory_uri().'/admin/preview/navigation/';
                $navigation_styles      = array();

                if ( is_dir( $navigation_styles_path ) ) :

                    if ( $navigation_styles_dir = opendir( $navigation_styles_path ) ) :
                        $navigation_styles = array();

                        while ( ( $navigation_styles_file = readdir( $navigation_styles_dir ) ) !== false ) {

                            if ( stristr( $navigation_styles_file, '.png' ) !== false || stristr( $navigation_styles_file, '.jpg' ) !== false ) {
                                $navigation_name              = explode( '.', $navigation_styles_file );
                                $navigation_name              = str_replace( '.' . end( $navigation_name ), '', $navigation_styles_file );
                                $navigation_styles[] = array(
                                    'alt' => $navigation_name,
                                    'img' => $navigation_styles_url . $navigation_styles_file
                                );
                            }
                        }
                    endif;
                endif;

                

                
                ob_start();

                $ct          = wp_get_theme();
                $this->theme = $ct;
                $item_name   = $this->theme->get( 'Name' );
                $tags        = $this->theme->Tags;
                $screenshot  = $this->theme->get_screenshot();
                $class       = $screenshot ? 'has-screenshot' : '';

                $customize_title = sprintf( esc_html__( 'Customize &#8220;%s&#8221;', 'signature' ), $this->theme->display( 'Name' ) );

                ?>
                <div id="current-theme" class="<?php echo esc_attr( $class ); ?>">
                    <?php if ( $screenshot ) : ?>
                        <?php if ( current_user_can( 'edit_theme_options' ) ) : ?>
                            <a href="<?php echo wp_customize_url(); ?>" class="load-customize hide-if-no-customize"
                               title="<?php echo esc_attr( $customize_title ); ?>">
                                <img src="<?php echo esc_url( $screenshot ); ?>"
                                     alt="<?php esc_attr_e( 'Current theme preview', 'signature' ); ?>"/>
                            </a>
                        <?php endif; ?>
                        <img class="hide-if-customize" src="<?php echo esc_url( $screenshot ); ?>"
                             alt="<?php esc_attr_e( 'Current theme preview', 'signature' ); ?>"/>
                    <?php endif; ?>

                    <h4><?php echo esc_html($this->theme->display( 'Name' )); ?></h4>

                    <div>
                        <ul class="theme-info">
                            <li><?php printf( esc_html__( 'By %s', 'signature' ), $this->theme->display( 'Author' ) ); ?></li>
                            <li><?php printf( esc_html__( 'Version %s', 'signature' ), $this->theme->display( 'Version' ) ); ?></li>
                            <li><?php echo '<strong>' . esc_html__( 'Tags', 'signature' ) . ':</strong> '; ?><?php printf( $this->theme->display( 'Tags' ) ); ?></li>
                        </ul>
                        <p class="theme-description"><?php echo esc_html($this->theme->display( 'Description' )); ?></p>
                        <?php
                            if ( $this->theme->parent() ) {
                                printf( ' <p class="howto">' . esc_html__( 'This <a href="%1$s">child theme</a> requires its parent theme, %2$s.', 'signature' ) . '</p>', esc_html__( 'http://codex.wordpress.org/Child_Themes', 'signature' ), $this->theme->parent()->display( 'Name' ) );
                            }
                        ?>

                    </div>
                </div>

                <?php
                $item_info = ob_get_contents();

                ob_end_clean();

                $sampleHTML = '';
                if ( file_exists( get_template_directory().'/admin/info-html.html' ) ) {
                    Redux_Functions::initWpFilesystem();

                    global $wp_filesystem;

                    $sampleHTML = $wp_filesystem->get_contents( get_template_directory().'/admin/info-html.html' );
                }


                
                // ACTUAL DECLARATION OF SECTIONS
                $this->sections[] = array(
                    'icon'   => 'ion ion-settings',
                    'title'  => esc_html__( 'General Settings', 'signature' ),
                    'fields' => array(
                        array(
                            'id'       => 'highlight_color',
                            'type'     => 'color',
                            'output'   => array( '.site-title' ),
                            'title'    => esc_html__( 'Highlight Color', 'signature' ),
                            'subtitle' => esc_html__( 'Pick a highlight color for the theme (default: #EC1A49).', 'signature' ),
                            'default'  => '#EC1A49',
                            'validate' => 'color',
                            'transparent' => false
                        ),
                        array(
                            'id'       => 'contrast_color',
                            'type'     => 'color',
                            'output'   => array( '.site-title' ),
                            'title'    => esc_html__( 'Contrast for Highlight Color', 'signature' ),
                            'subtitle' => esc_html__( 'Pick a highlight color for the theme (default: #FFFFFF).', 'signature' ),
                            'default'  => '#FFFFFF',
                            'validate' => 'color',
                            'transparent' => false
                        ),
                        array(
                            'id'       => 'load-animation',
                            'type'     => 'media',
                            'title'    => esc_html__( 'Loading Image', 'signature' ),
                            'subtitle'     => esc_html__( 'Upload or Select the image. ', 'signature' ),
                            
                        ),
                        array(
                            'id'       => 'load-animation2x',
                            'type'     => 'media',
                            'title'    => esc_html__( 'Loading Image (Retina)', 'signature' ),
                            'subtitle' => esc_html__( 'Upload your loading image for retina display. It should have the same name and doubled the sized than the regular. The name also need to contain the chars @2x at the end. Eg: \'mylogo.png\' becomes \'mylogo@2x.png\'.', 'signature' ),
                        ),
                        array(
                            'id'       => 'disable-sidebar',
                            'type'     => 'checkbox',
                            'title'    => esc_html__('Disable sidebar on blog.', 'redux-framework-demo'), 
                            'subtitle' => esc_html__('Check if you want to disable the sidebar on blog.', 'redux-framework-demo'),
                            'desc'     => esc_html__('', 'redux-framework-demo'),
                            'default'  => '0'// 1 = on | 0 = off
                        ),


                    )
                );
                

                $this->sections[] = array(
                    'icon'   => 'el-icon-plane',
                    'title'  => esc_html__( 'Navigation Settings', 'signature' ),
                    'fields' => array(
                        array(
                            'id'       => 'navigation_opt',
                            'type'     => 'switch', 
                            'title'    => esc_html__( 'Choose The Navigation', 'signature' ),
                            'subtitle' => esc_html__( 'Choose "Signature Navigation", if you are using one page layout. Also create a menu and assign it to the location.  Appearence >> Menus', 'signature' ),
                            'on'       => 'Signature Navigation',
                            'off'      => 'Default WP Navigation',
                            'default'  => true,
                        ),
                        array(
                            'id'       => 'mob-nav-logo',
                            'type'     => 'media',
                            'title'    => esc_html__( 'Mobile Navigation Logo', 'signature' ),
                            'subtitle'     => esc_html__( 'Upload or Select the logo. ', 'signature' ),
                            
                        ),
                        array(
                            'id'       => 'mob-nav-logo2x',
                            'type'     => 'media',
                            'title'    => esc_html__( 'Mobile Navigation Logo (Retina)', 'signature' ),
                            'subtitle' => esc_html__( 'Upload your logo for retina display. It should have the same name and doubled the sized than the regular. The name also need to contain the chars @2x at the end. Eg: \'mylogo.png\' becomes \'mylogo@2x.png\'.', 'signature' ),
                        ),
                        array(
                            'id'       => 'navigation-style',
                            'type'     => 'select_image',
                            'title'    => esc_html__( 'Select Desktop Navigation Style', 'signature' ),
                            'subtitle' => esc_html__( 'A preview of the selected navigation style will appear underneath the select box.', 'signature' ),
                            'options'  => $navigation_styles,
                            'default'  => 'Adler.png',
                        ),
                        array(
                            'id'       => 'adler-nav-bg-color',
                            'type'     => 'color',
                            'title'    => esc_html__( 'background Color', 'signature' ),
                            'subtitle' => esc_html__( 'Pick a background color for navigation panel.(default: #f0f4f4).', 'signature' ),
                            'default'  => '#f0f4f4',
                            'validate' => 'color',
                            'transparent' => false,
                            'required' => array('navigation-style','equals',get_template_directory_uri().'/admin/preview/navigation/Adler.png')
                        ),
                        array(
                            'id'       => 'adler-nav-logo',
                            'type'     => 'media',
                            'title'    => esc_html__( 'Navigation Logo', 'signature' ),
                            'subtitle'     => esc_html__( 'Upload or Select the image. ', 'signature' ),
                            'required' => array('navigation-style','equals',get_template_directory_uri().'/admin/preview/navigation/Adler.png')
                        ),
                        array(
                            'id'       => 'adler-nav-logo2x',
                            'type'     => 'media',
                            'title'    => esc_html__( 'Navigation Logo (Retina)', 'signature' ),
                            'subtitle' => esc_html__( 'Upload your logo image for retina display. It should have the same name and doubled the sized than the regular. The name also need to contain the chars @2x at the end. Eg: \'mylogo.png\' becomes \'mylogo@2x.png\'.', 'signature' ),
                            'required' => array('navigation-style','equals',get_template_directory_uri().'/admin/preview/navigation/Adler.png')
                        ),
                        array(
                            'id'       => 'berend-nav-bg-color',
                            'type'     => 'color',
                            'title'    => esc_html__( 'Background Color For Right Panel', 'signature' ),
                            'subtitle' => esc_html__( 'Pick a background color for the right panel of the navigation.(default: #FFFFFF).', 'signature' ),
                            'default'  => '#FFFFFF',
                            'validate' => 'color',
                            'transparent' => false,
                            'required' => array('navigation-style','equals',get_template_directory_uri().'/admin/preview/navigation/Berend.png')
                        ),
                        array(
                            'id'       => 'berend-nav-bg-image',
                            'type'     => 'media',
                            'title'    => esc_html__( 'Navigation Left Panel background Image', 'signature' ),
                            'subtitle'     => esc_html__( 'Upload or Select the image. ', 'signature' ),
                            'required' => array('navigation-style','equals',get_template_directory_uri().'/admin/preview/navigation/Berend.png')
                        ),
                        array(
                            'id'       => 'berend-nav-bar-logo',
                            'type'     => 'media',
                            'title'    => esc_html__( 'Navigation Bar Logo', 'signature' ),
                            'subtitle'     => esc_html__( 'Upload or Select the image. ', 'signature' ),
                            'required' => array('navigation-style','equals',get_template_directory_uri().'/admin/preview/navigation/Berend.png')
                        ),
                        array(
                            'id'       => 'berend-nav-bar-logo2x',
                            'type'     => 'media',
                            'title'    => esc_html__( 'Navigation Bar Logo (Retina)', 'signature' ),
                            'subtitle' => esc_html__( 'Upload your logo image for retina display. It should have the same name and doubled the sized than the regular. The name also need to contain the chars @2x at the end. Eg: \'mylogo.png\' becomes \'mylogo@2x.png\'.', 'signature' ),
                            'required' => array('navigation-style','equals',get_template_directory_uri().'/admin/preview/navigation/Berend.png')
                        ),
                        array(
                            'id'       => 'berend-nav-logo',
                            'type'     => 'media',
                            'title'    => esc_html__( 'Navigation Logo', 'signature' ),
                            'subtitle'     => esc_html__( 'Upload or Select the image. ', 'signature' ),
                            'required' => array('navigation-style','equals',get_template_directory_uri().'/admin/preview/navigation/Berend.png')
                        ),
                        array(
                            'id'       => 'berend-nav-logo2x',
                            'type'     => 'media',
                            'title'    => esc_html__( 'Navigation Logo (Retina)', 'signature' ),
                            'subtitle' => esc_html__( 'Upload your logo image for retina display. It should have the same name and doubled the sized than the regular. The name also need to contain the chars @2x at the end. Eg: \'mylogo.png\' becomes \'mylogo@2x.png\'.', 'signature' ),
                            'required' => array('navigation-style','equals',get_template_directory_uri().'/admin/preview/navigation/Berend.png')
                        ),
                        array(
                            'id'       => 'berend-nav-content',
                            'type'     => 'textarea',
                            'title'    => esc_html__( 'Navigation Text Content', 'signature' ),
                            'default'  => 'Basic - A premium template from Designova. Copyright &copy; 2015 <a href="http://designova.net">Designova</a>',
                            'required' => array('navigation-style','equals',get_template_directory_uri().'/admin/preview/navigation/Berend.png')
                        ),
                        array(
                            'id'       => 'claus-nav-bg-color',
                            'type'     => 'color',
                            'title'    => esc_html__( 'background Color', 'signature' ),
                            'subtitle' => esc_html__( 'Pick a background color for navigation panel.(default: #ffffff).', 'signature' ),
                            'default'  => '#ffffff',
                            'validate' => 'color',
                            'transparent' => false,
                            'required' => array('navigation-style','equals',get_template_directory_uri().'/admin/preview/navigation/Claus.png')
                        ),
                        array(
                            'id'       => 'claus-nav-logo',
                            'type'     => 'media',
                            'title'    => esc_html__( 'Navigation Logo', 'signature' ),
                            'subtitle'     => esc_html__( 'Upload or Select the image. ', 'signature' ),
                            'required' => array('navigation-style','equals',get_template_directory_uri().'/admin/preview/navigation/Claus.png')
                        ),
                        array(
                            'id'       => 'claus-nav-logo2x',
                            'type'     => 'media',
                            'title'    => esc_html__( 'Navigation Logo (Retina)', 'signature' ),
                            'subtitle' => esc_html__( 'Upload your logo image for retina display. It should have the same name and doubled the sized than the regular. The name also need to contain the chars @2x at the end. Eg: \'mylogo.png\' becomes \'mylogo@2x.png\'.', 'signature' ),
                            'required' => array('navigation-style','equals',get_template_directory_uri().'/admin/preview/navigation/Claus.png')
                        ),
                        array(
                            'id'       => 'dierk-nav-bg-color',
                            'type'     => 'color',
                            'title'    => esc_html__( 'Navigation Background Color', 'signature' ),
                            'subtitle' => esc_html__( 'Pick a background color for navigation panel.(default: #000000).', 'signature' ),
                            'default'  => '#000000',
                            'validate' => 'color',
                            'transparent' => false,
                            'required' => array('navigation-style','equals',get_template_directory_uri().'/admin/preview/navigation/Dierk.png')
                        ),
                        
                        array(
                            'id'       => 'dierk-nav-bar-logo',
                            'type'     => 'media',
                            'title'    => esc_html__( 'Navigation Bar Logo', 'signature' ),
                            'subtitle'     => esc_html__( 'Upload or Select the image. ', 'signature' ),
                            'required' => array('navigation-style','equals',get_template_directory_uri().'/admin/preview/navigation/Dierk.png')
                        ),
                        array(
                            'id'       => 'dierk-nav-bar-logo2x',
                            'type'     => 'media',
                            'title'    => esc_html__( 'Navigation Bar Logo (Retina)', 'signature' ),
                            'subtitle' => esc_html__( 'Upload your logo image for retina display. It should have the same name and doubled the sized than the regular. The name also need to contain the chars @2x at the end. Eg: \'mylogo.png\' becomes \'mylogo@2x.png\'.', 'signature' ),
                            'required' => array('navigation-style','equals',get_template_directory_uri().'/admin/preview/navigation/Dierk.png')
                        ),
                        array(
                            'id'       => 'dierk-nav-logo',
                            'type'     => 'media',
                            'title'    => esc_html__( 'Navigation Logo', 'signature' ),
                            'subtitle'     => esc_html__( 'Upload or Select the image. ', 'signature' ),
                            'required' => array('navigation-style','equals',get_template_directory_uri().'/admin/preview/navigation/Dierk.png')
                        ),
                        array(
                            'id'       => 'dierk-nav-logo2x',
                            'type'     => 'media',
                            'title'    => esc_html__( 'Navigation Logo (Retina)', 'signature' ),
                            'subtitle' => esc_html__( 'Upload your logo image for retina display. It should have the same name and doubled the sized than the regular. The name also need to contain the chars @2x at the end. Eg: \'mylogo.png\' becomes \'mylogo@2x.png\'.', 'signature' ),
                            'required' => array('navigation-style','equals',get_template_directory_uri().'/admin/preview/navigation/Dierk.png')
                        ),
                        array(
                            'id'       => 'ebert-layout',
                            'type'     => 'radio',
                            'title'    => esc_html__( 'Choose The Theme Layout', 'signature' ),
                            'subtitle' => esc_html__( '', 'signature' ),
                            'options'  => array(
                                '1' => 'Boxed',
                                '2' => 'Normal'
                            ),
                            'default'  => '1',
                            'required' => array('navigation-style','equals',get_template_directory_uri().'/admin/preview/navigation/Ebert.png')
                        ),
                        array(
                            'id'       => 'ebert-nav-bg-color',
                            'type'     => 'color',
                            'title'    => esc_html__( 'Background Color For Left Nav Panel', 'signature' ),
                            'subtitle' => esc_html__( 'Pick a background color for the left panel of the navigation.(default: #FFFFFF).', 'signature' ),
                            'default'  => '#FFFFFF',
                            'validate' => 'color',
                            'transparent' => false,
                            'required' => array('navigation-style','equals',get_template_directory_uri().'/admin/preview/navigation/Ebert.png')
                        ),
                        array(
                            'id'       => 'ebert-nav-bg-image',
                            'type'     => 'media',
                            'title'    => esc_html__( 'Navigation Right Panel background Image', 'signature' ),
                            'subtitle'     => esc_html__( 'Upload or Select the image. ', 'signature' ),
                            'required' => array('navigation-style','equals',get_template_directory_uri().'/admin/preview/navigation/Ebert.png')
                        ),
                        array(
                            'id'       => 'ebert-nav-bar-logo',
                            'type'     => 'media',
                            'title'    => esc_html__( 'Navigation Bar Logo', 'signature' ),
                            'subtitle'     => esc_html__( 'Upload or Select the image. ', 'signature' ),
                            'required' => array('navigation-style','equals',get_template_directory_uri().'/admin/preview/navigation/Ebert.png')
                        ),
                        array(
                            'id'       => 'ebert-nav-bar-logo2x',
                            'type'     => 'media',
                            'title'    => esc_html__( 'Navigation Bar Logo (Retina)', 'signature' ),
                            'subtitle' => esc_html__( 'Upload your logo image for retina display. It should have the same name and doubled the sized than the regular. The name also need to contain the chars @2x at the end. Eg: \'mylogo.png\' becomes \'mylogo@2x.png\'.', 'signature' ),
                            'required' => array('navigation-style','equals',get_template_directory_uri().'/admin/preview/navigation/Ebert.png')
                        ),
                        array(
                            'id'       => 'ebert-nav-content',
                            'type'     => 'textarea',
                            'title'    => esc_html__( 'Navigation Text Content', 'signature' ),
                            'default'  => 'Basic - A premium template from Designova. Copyright &copy; 2015 <a href="http://designova.net">Designova</a>',
                            'required' => array('navigation-style','equals',get_template_directory_uri().'/admin/preview/navigation/Ebert.png')
                        ),
                        array(
                            'id'       => 'ebert-nav-content-color',
                            'type'     => 'color',
                            'title'    => esc_html__( 'Font Color For Navigation Text Content', 'signature' ),
                            'subtitle' => esc_html__( 'choose the font color for the navigation text content.(default: #292929).', 'signature' ),
                            'default'  => '#292929',
                            'validate' => 'color',
                            'transparent' => false,
                            'required' => array('navigation-style','equals',get_template_directory_uri().'/admin/preview/navigation/Ebert.png')
                        ),
                        array(
                            'id'       => 'franz-nav-bar-bg-color',
                            'type'     => 'color',
                            'title'    => esc_html__( 'Background Color Navigation bar', 'signature' ),
                            'subtitle' => esc_html__( 'Pick a background color for the navigation bar.(default: #FFFFFF).', 'signature' ),
                            'default'  => '#FFFFFF',
                            'validate' => 'color',
                            'transparent' => false,
                            'required' => array('navigation-style','equals',get_template_directory_uri().'/admin/preview/navigation/Franz.png')
                        ),
                        array(
                            'id'       => 'franz-nav-panel-bg-color',
                            'type'     => 'color',
                            'title'    => esc_html__( 'Background Color For Navigation Panel', 'signature' ),
                            'subtitle' => esc_html__( 'Pick a background color for the navigation panel.(default: #FFFFFF).', 'signature' ),
                            'default'  => '#FFFFFF',
                            'validate' => 'color',
                            'transparent' => false,
                            'required' => array('navigation-style','equals',get_template_directory_uri().'/admin/preview/navigation/Franz.png')
                        ),
                        array(
                            'id'       => 'franz-nav-bar-logo',
                            'type'     => 'media',
                            'title'    => esc_html__( 'Navigation Bar Logo', 'signature' ),
                            'subtitle'     => esc_html__( 'Upload or Select the image. ', 'signature' ),
                            'required' => array('navigation-style','equals',get_template_directory_uri().'/admin/preview/navigation/Franz.png')
                        ),
                        array(
                            'id'       => 'franz-nav-bar-logo2x',
                            'type'     => 'media',
                            'title'    => esc_html__( 'Navigation Bar Logo (Retina)', 'signature' ),
                            'subtitle' => esc_html__( 'Upload your logo image for retina display. It should have the same name and doubled the sized than the regular. The name also need to contain the chars @2x at the end. Eg: \'mylogo.png\' becomes \'mylogo@2x.png\'.', 'signature' ),
                            'required' => array('navigation-style','equals',get_template_directory_uri().'/admin/preview/navigation/Franz.png')
                        ),
                        array(
                            'id'       => 'franz-nav-logo',
                            'type'     => 'media',
                            'title'    => esc_html__( 'Navigation Logo', 'signature' ),
                            'subtitle'     => esc_html__( 'Upload or Select the image. ', 'signature' ),
                            'required' => array('navigation-style','equals',get_template_directory_uri().'/admin/preview/navigation/Franz.png')
                        ),
                        array(
                            'id'       => 'franz-nav-logo2x',
                            'type'     => 'media',
                            'title'    => esc_html__( 'Navigation Logo (Retina)', 'signature' ),
                            'subtitle' => esc_html__( 'Upload your logo image for retina display. It should have the same name and doubled the sized than the regular. The name also need to contain the chars @2x at the end. Eg: \'mylogo.png\' becomes \'mylogo@2x.png\'.', 'signature' ),
                            'required' => array('navigation-style','equals',get_template_directory_uri().'/admin/preview/navigation/Franz.png')
                        ),
                        array(
                            'id'       => 'gozzo-nav-bg-color',
                            'type'     => 'color',
                            'title'    => esc_html__( 'Background Color Navigation', 'signature' ),
                            'subtitle' => esc_html__( 'Pick a background color for the navigation.(default: #FFFFFF).', 'signature' ),
                            'default'  => '#FFFFFF',
                            'validate' => 'color',
                            'transparent' => false,
                            'required' => array('navigation-style','equals',get_template_directory_uri().'/admin/preview/navigation/Gozzo.png')
                        ),
                        array(
                            'id'       => 'gozzo-nav-logo',
                            'type'     => 'media',
                            'title'    => esc_html__( 'Navigation Logo', 'signature' ),
                            'subtitle'     => esc_html__( 'Upload or Select the image. ', 'signature' ),
                            'required' => array('navigation-style','equals',get_template_directory_uri().'/admin/preview/navigation/Gozzo.png')
                        ),
                        array(
                            'id'       => 'gozzo-nav-logo2x',
                            'type'     => 'media',
                            'title'    => esc_html__( 'Navigation Logo (Retina)', 'signature' ),
                            'subtitle' => esc_html__( 'Upload your logo image for retina display. It should have the same name and doubled the sized than the regular. The name also need to contain the chars @2x at the end. Eg: \'mylogo.png\' becomes \'mylogo@2x.png\'.', 'signature' ),
                            'required' => array('navigation-style','equals',get_template_directory_uri().'/admin/preview/navigation/Gozzo.png')
                        ),
                        array(
                            'id'       => 'hans-nav-bg-color',
                            'type'     => 'color',
                            'title'    => esc_html__( 'Navigation Background Color', 'signature' ),
                            'subtitle' => esc_html__( 'Pick a background color for navigation panel.(default: #FFFFFF).', 'signature' ),
                            'default'  => '#FFFFFF',
                            'validate' => 'color',
                            'transparent' => false,
                            'required' => array('navigation-style','equals',get_template_directory_uri().'/admin/preview/navigation/Hans.png')
                        ),
                        array(
                            'id'       => 'hans-nav-bar-logo',
                            'type'     => 'media',
                            'title'    => esc_html__( 'Navigation Bar Logo', 'signature' ),
                            'subtitle' => esc_html__( 'Upload or Select the image. ', 'signature' ),
                            'required' => array('navigation-style','equals',get_template_directory_uri().'/admin/preview/navigation/Hans.png')
                        ),
                        array(
                            'id'       => 'hans-nav-bar-logo2x',
                            'type'     => 'media',
                            'title'    => esc_html__( 'Navigation Bar Logo (Retina)', 'signature' ),
                            'subtitle' => esc_html__( 'Upload your logo image for retina display. It should have the same name and doubled the sized than the regular. The name also need to contain the chars @2x at the end. Eg: \'mylogo.png\' becomes \'mylogo@2x.png\'.', 'signature' ),
                            'required' => array('navigation-style','equals',get_template_directory_uri().'/admin/preview/navigation/Hans.png')
                        ),
                        array(
                            'id'       => 'igor-nav-bar-logo',
                            'type'     => 'media',
                            'title'    => esc_html__( 'Navigation Bar Logo', 'signature' ),
                            'subtitle' => esc_html__( 'Upload or Select the image. ', 'signature' ),
                            'required' => array('navigation-style','equals',get_template_directory_uri().'/admin/preview/navigation/Igor.png')
                        ),
                        array(
                            'id'       => 'igor-nav-bar-logo2x',
                            'type'     => 'media',
                            'title'    => esc_html__( 'Navigation Bar Logo (Retina)', 'signature' ),
                            'subtitle' => esc_html__( 'Upload your logo image for retina display. It should have the same name and doubled the sized than the regular. The name also need to contain the chars @2x at the end. Eg: \'mylogo.png\' becomes \'mylogo@2x.png\'.', 'signature' ),
                            'required' => array('navigation-style','equals',get_template_directory_uri().'/admin/preview/navigation/Igor.png')
                        ),
                        array(
                            'id'       => 'johan-nav-bar-bg-color',
                            'type'     => 'color',
                            'title'    => esc_html__( 'Navigation-bar Background Color', 'signature' ),
                            'subtitle' => esc_html__( 'Pick a background color for navigation panel.(default: #FFFFFF).', 'signature' ),
                            'default'  => '#FFFFFF',
                            'validate' => 'color',
                            'transparent' => false,
                            'required' => array('navigation-style','equals',get_template_directory_uri().'/admin/preview/navigation/Johan.png')
                        ),
                        array(
                            'id'       => 'johan-nav-bar-logo',
                            'type'     => 'media',
                            'title'    => esc_html__( 'Navigation Bar Logo', 'signature' ),
                            'subtitle' => esc_html__( 'Upload or Select the image. ', 'signature' ),
                            'required' => array('navigation-style','equals',get_template_directory_uri().'/admin/preview/navigation/Johan.png')
                        ),
                        array(
                            'id'       => 'johan-nav-bar-logo2x',
                            'type'     => 'media',
                            'title'    => esc_html__( 'Navigation Bar Logo (Retina)', 'signature' ),
                            'subtitle' => esc_html__( 'Upload your logo image for retina display. It should have the same name and doubled the sized than the regular. The name also need to contain the chars @2x at the end. Eg: \'mylogo.png\' becomes \'mylogo@2x.png\'.', 'signature' ),
                            'required' => array('navigation-style','equals',get_template_directory_uri().'/admin/preview/navigation/Johan.png')
                        ),
                        array(
                            'id'       => 'johan-nav-bg-color',
                            'type'     => 'color',
                            'title'    => esc_html__( 'Navigation Background Color', 'signature' ),
                            'subtitle' => esc_html__( 'Pick a background color for navigation panel.(default: #292929).', 'signature' ),
                            'default'  => '#292929',
                            'validate' => 'color',
                            'transparent' => false,
                            'required' => array('navigation-style','equals',get_template_directory_uri().'/admin/preview/navigation/Johan.png')
                        ),
                        array(
                            'id'       => 'karl-nav-bar-bg-color',
                            'type'     => 'color',
                            'title'    => esc_html__( 'Navigation-bar Background Color', 'signature' ),
                            'subtitle' => esc_html__( 'Pick a background color for navigation bar.(default: #FFFFFF).', 'signature' ),
                            'default'  => '#FFFFFF',
                            'validate' => 'color',
                            'transparent' => false,
                            'required' => array('navigation-style','equals',get_template_directory_uri().'/admin/preview/navigation/Karl.png')
                        ),
                        array(
                            'id'       => 'karl-nav-bg-color',
                            'type'     => 'color',
                            'title'    => esc_html__( 'Navigation Background Color', 'signature' ),
                            'subtitle' => esc_html__( 'Pick a background color for navigation panel.(default: #FFFFFF).', 'signature' ),
                            'default'  => '#292929',
                            'validate' => 'color',
                            'transparent' => false,
                            'required' => array('navigation-style','equals',get_template_directory_uri().'/admin/preview/navigation/Karl.png')
                        ),
                        array(
                            'id'       => 'karl-nav-bg-img',
                            'type'     => 'media',
                            'title'    => esc_html__( 'Navigation Background Image', 'signature' ),
                            'subtitle' => esc_html__( 'Upload or Select the image. ', 'signature' ),
                            'required' => array('navigation-style','equals',get_template_directory_uri().'/admin/preview/navigation/Karl.png')
                        ),
                        array(
                            'id'       => 'karl-nav-bar-logo',
                            'type'     => 'media',
                            'title'    => esc_html__( 'Navigation Bar Logo', 'signature' ),
                            'subtitle' => esc_html__( 'Upload or Select the image. ', 'signature' ),
                            'required' => array('navigation-style','equals',get_template_directory_uri().'/admin/preview/navigation/Karl.png')
                        ),
                        array(
                            'id'       => 'karl-nav-bar-logo2x',
                            'type'     => 'media',
                            'title'    => esc_html__( 'Navigation Bar Logo (Retina)', 'signature' ),
                            'subtitle' => esc_html__( 'Upload your logo image for retina display. It should have the same name and doubled the sized than the regular. The name also need to contain the chars @2x at the end. Eg: \'mylogo.png\' becomes \'mylogo@2x.png\'.', 'signature' ),
                            'required' => array('navigation-style','equals',get_template_directory_uri().'/admin/preview/navigation/Karl.png')
                        ),
                        array(
                            'id'       => 'leon-nav-bar-bg-color',
                            'type'     => 'color',
                            'title'    => esc_html__( 'Navigation-bar Background Color', 'signature' ),
                            'subtitle' => esc_html__( 'Pick a background color for navigation bar.(default: #FFFFFF).', 'signature' ),
                            'default'  => '#FFFFFF',
                            'validate' => 'color',
                            'transparent' => false,
                            'required' => array('navigation-style','equals',get_template_directory_uri().'/admin/preview/navigation/Leon.png')
                        ),
                        array(
                            'id'       => 'leon-nav-bg-color',
                            'type'     => 'color',
                            'title'    => esc_html__( 'Navigation Background Color', 'signature' ),
                            'subtitle' => esc_html__( 'Pick a background color for navigation panel.(default: #FFFFFF).', 'signature' ),
                            'default'  => '#292929',
                            'validate' => 'color',
                            'transparent' => false,
                            'required' => array('navigation-style','equals',get_template_directory_uri().'/admin/preview/navigation/Leon.png')
                        ),
                        array(
                            'id'       => 'leon-nav-bg-img',
                            'type'     => 'media',
                            'title'    => esc_html__( 'Navigation Background Image', 'signature' ),
                            'subtitle' => esc_html__( 'Upload or Select the image. ', 'signature' ),
                            'required' => array('navigation-style','equals',get_template_directory_uri().'/admin/preview/navigation/Leon.png')
                        ),
                        array(
                            'id'       => 'leon-nav-bar-logo',
                            'type'     => 'media',
                            'title'    => esc_html__( 'Navigation Bar Logo', 'signature' ),
                            'subtitle' => esc_html__( 'Upload or Select the image. ', 'signature' ),
                            'required' => array('navigation-style','equals',get_template_directory_uri().'/admin/preview/navigation/Leon.png')
                        ),
                        array(
                            'id'       => 'leon-nav-bar-logo2x',
                            'type'     => 'media',
                            'title'    => esc_html__( 'Navigation Bar Logo (Retina)', 'signature' ),
                            'subtitle' => esc_html__( 'Upload your logo image for retina display. It should have the same name and doubled the sized than the regular. The name also need to contain the chars @2x at the end. Eg: \'mylogo.png\' becomes \'mylogo@2x.png\'.', 'signature' ),
                            'required' => array('navigation-style','equals',get_template_directory_uri().'/admin/preview/navigation/Leon.png')
                        ),
                        array(
                            'id'       => 'moritz-nav-bar-bg-color',
                            'type'     => 'color',
                            'title'    => esc_html__( 'Navigation-bar Background Color', 'signature' ),
                            'subtitle' => esc_html__( 'Pick a background color for navigation bar.(default: #FFFFFF).', 'signature' ),
                            'default'  => '#FFFFFF',
                            'validate' => 'color',
                            'transparent' => false,
                            'required' => array('navigation-style','equals',get_template_directory_uri().'/admin/preview/navigation/Moritz.png')
                        ),
                        array(
                            'id'       => 'moritz-nav-bg-color',
                            'type'     => 'color',
                            'title'    => esc_html__( 'Navigation Background Color', 'signature' ),
                            'subtitle' => esc_html__( 'Pick a background color for navigation panel.(default: #FFFFFF).', 'signature' ),
                            'default'  => '#292929',
                            'validate' => 'color',
                            'transparent' => false,
                            'required' => array('navigation-style','equals',get_template_directory_uri().'/admin/preview/navigation/Moritz.png')
                        ),
                        array(
                            'id'       => 'moritz-nav-bg-img',
                            'type'     => 'media',
                            'title'    => esc_html__( 'Navigation Background Image', 'signature' ),
                            'subtitle' => esc_html__( 'Upload or Select the image. ', 'signature' ),
                            'required' => array('navigation-style','equals',get_template_directory_uri().'/admin/preview/navigation/Moritz.png')
                        ),
                        array(
                            'id'       => 'moritz-nav-bar-logo',
                            'type'     => 'media',
                            'title'    => esc_html__( 'Navigation Bar Logo', 'signature' ),
                            'subtitle' => esc_html__( 'Upload or Select the image. ', 'signature' ),
                            'required' => array('navigation-style','equals',get_template_directory_uri().'/admin/preview/navigation/Moritz.png')
                        ),
                        array(
                            'id'       => 'moritz-nav-bar-logo2x',
                            'type'     => 'media',
                            'title'    => esc_html__( 'Navigation Bar Logo (Retina)', 'signature' ),
                            'subtitle' => esc_html__( 'Upload your logo image for retina display. It should have the same name and doubled the sized than the regular. The name also need to contain the chars @2x at the end. Eg: \'mylogo.png\' becomes \'mylogo@2x.png\'.', 'signature' ),
                            'required' => array('navigation-style','equals',get_template_directory_uri().'/admin/preview/navigation/Moritz.png')
                        ),
                        array(
                            'id'       => 'moritz-nav-content',
                            'type'     => 'textarea',
                            'title'    => esc_html__( 'Navigation Text Content', 'signature' ),
                            'default'  => 'Basic - A premium template from Designova. Copyright &copy; 2015 <a href="http://designova.net">Designova</a>',
                            'required' => array('navigation-style','equals',get_template_directory_uri().'/admin/preview/navigation/Moritz.png')
                        ),
                        array(
                            'id'       => 'moritz-nav-content-color',
                            'type'     => 'color',
                            'title'    => esc_html__( 'Font Color For Navigation Text Content', 'signature' ),
                            'subtitle' => esc_html__( 'choose the font color for the navigation text content.(default: #FFFFFF).', 'signature' ),
                            'default'  => '#FFFFFF',
                            'validate' => 'color',
                            'transparent' => false,
                            'required' => array('navigation-style','equals',get_template_directory_uri().'/admin/preview/navigation/Moritz.png')
                        ),
                        array(
                            'id'       => 'nemo-nav-bar-bg-color',
                            'type'     => 'color',
                            'title'    => esc_html__( 'Navigation-bar Background Color', 'signature' ),
                            'subtitle' => esc_html__( 'Pick a background color for navigation bar.(default: #FFFFFF).', 'signature' ),
                            'default'  => '#FFFFFF',
                            'validate' => 'color',
                            'transparent' => false,
                            'required' => array('navigation-style','equals',get_template_directory_uri().'/admin/preview/navigation/Nemo.png')
                        ),
                        array(
                            'id'       => 'nemo-nav-bg-color',
                            'type'     => 'color',
                            'title'    => esc_html__( 'Navigation Background Color', 'signature' ),
                            'subtitle' => esc_html__( 'Pick a background color for navigation panel.(default: #FFFFFF).', 'signature' ),
                            'default'  => '#292929',
                            'validate' => 'color',
                            'transparent' => false,
                            'required' => array('navigation-style','equals',get_template_directory_uri().'/admin/preview/navigation/Nemo.png')
                        ),
                        array(
                            'id'       => 'nemo-nav-bg-img',
                            'type'     => 'media',
                            'title'    => esc_html__( 'Navigation Background Image', 'signature' ),
                            'subtitle' => esc_html__( 'Upload or Select the image. ', 'signature' ),
                            'required' => array('navigation-style','equals',get_template_directory_uri().'/admin/preview/navigation/Nemo.png')
                        ),
                        array(
                            'id'       => 'nemo-nav-bar-logo',
                            'type'     => 'media',
                            'title'    => esc_html__( 'Navigation Bar Logo', 'signature' ),
                            'subtitle' => esc_html__( 'Upload or Select the image. ', 'signature' ),
                            'required' => array('navigation-style','equals',get_template_directory_uri().'/admin/preview/navigation/Nemo.png')
                        ),
                        array(
                            'id'       => 'nemo-nav-bar-logo2x',
                            'type'     => 'media',
                            'title'    => esc_html__( 'Navigation Bar Logo (Retina)', 'signature' ),
                            'subtitle' => esc_html__( 'Upload your logo image for retina display. It should have the same name and doubled the sized than the regular. The name also need to contain the chars @2x at the end. Eg: \'mylogo.png\' becomes \'mylogo@2x.png\'.', 'signature' ),
                            'required' => array('navigation-style','equals',get_template_directory_uri().'/admin/preview/navigation/Nemo.png')
                        ),
                        array(
                            'id'       => 'orwin-nav-bar-logo',
                            'type'     => 'media',
                            'title'    => esc_html__( 'Navigation Bar Logo', 'signature' ),
                            'subtitle' => esc_html__( 'Upload or Select the image. ', 'signature' ),
                            'required' => array('navigation-style','equals',get_template_directory_uri().'/admin/preview/navigation/Orwin.png')
                        ),
                        array(
                            'id'       => 'orwin-nav-bar-logo2x',
                            'type'     => 'media',
                            'title'    => esc_html__( 'Navigation Bar Logo (Retina)', 'signature' ),
                            'subtitle' => esc_html__( 'Upload your logo image for retina display. It should have the same name and doubled the sized than the regular. The name also need to contain the chars @2x at the end. Eg: \'mylogo.png\' becomes \'mylogo@2x.png\'.', 'signature' ),
                            'required' => array('navigation-style','equals',get_template_directory_uri().'/admin/preview/navigation/Orwin.png')
                        ),
                        array(
                            'id'       => 'phil-nav-bg-color',
                            'type'     => 'color',
                            'title'    => esc_html__( 'Background Color Navigation', 'signature' ),
                            'subtitle' => esc_html__( 'Pick a background color for the navigation.(default: #FFFFFF).', 'signature' ),
                            'default'  => '#FFFFFF',
                            'validate' => 'color',
                            'transparent' => false,
                            'required' => array('navigation-style','equals',get_template_directory_uri().'/admin/preview/navigation/Phil.png')
                        ),
                        array(
                            'id'       => 'phil-nav-logo',
                            'type'     => 'media',
                            'title'    => esc_html__( 'Navigation Logo', 'signature' ),
                            'subtitle'     => esc_html__( 'Upload or Select the image. ', 'signature' ),
                            'required' => array('navigation-style','equals',get_template_directory_uri().'/admin/preview/navigation/Phil.png')
                        ),
                        array(
                            'id'       => 'phil-nav-logo2x',
                            'type'     => 'media',
                            'title'    => esc_html__( 'Navigation Logo (Retina)', 'signature' ),
                            'subtitle' => esc_html__( 'Upload your logo image for retina display. It should have the same name and doubled the sized than the regular. The name also need to contain the chars @2x at the end. Eg: \'mylogo.png\' becomes \'mylogo@2x.png\'.', 'signature' ),
                            'required' => array('navigation-style','equals',get_template_directory_uri().'/admin/preview/navigation/Phil.png')
                        ),
                        array(
                            'id'       => 'phil-nav-border-color',
                            'type'     => 'color',
                            'title'    => esc_html__( 'Separator Color', 'signature' ),
                            'subtitle' => esc_html__( 'Pick a color for the navigation separator.(default: #121212).', 'signature' ),
                            'default'  => '#121212',
                            'validate' => 'color',
                            'transparent' => false,
                            'required' => array('navigation-style','equals',get_template_directory_uri().'/admin/preview/navigation/Phil.png')
                        ),
                        array(
                            'id'       => 'quartz-nav-bar-logo',
                            'type'     => 'media',
                            'title'    => esc_html__( 'Navigation Bar Logo', 'signature' ),
                            'subtitle' => esc_html__( 'Upload or Select the image. ', 'signature' ),
                            'required' => array('navigation-style','equals',get_template_directory_uri().'/admin/preview/navigation/Quartz.png')
                        ),
                        array(
                            'id'       => 'quartz-nav-bar-logo2x',
                            'type'     => 'media',
                            'title'    => esc_html__( 'Navigation Bar Logo (Retina)', 'signature' ),
                            'subtitle' => esc_html__( 'Upload your logo image for retina display. It should have the same name and doubled the sized than the regular. The name also need to contain the chars @2x at the end. Eg: \'mylogo.png\' becomes \'mylogo@2x.png\'.', 'signature' ),
                            'required' => array('navigation-style','equals',get_template_directory_uri().'/admin/preview/navigation/Quartz.png')
                        ),
                        array(
                            'id'       => 'rein-nav-bg-color',
                            'type'     => 'color',
                            'title'    => esc_html__( 'Navigation Background Color', 'signature' ),
                            'subtitle' => esc_html__( 'Pick a background color for navigation panel.(default: #FFFFFF).', 'signature' ),
                            'default'  => '#FFFFFF',
                            'validate' => 'color',
                            'transparent' => false,
                            'required' => array('navigation-style','equals',get_template_directory_uri().'/admin/preview/navigation/Rein.png')
                        ),
                        array(
                            'id'       => 'rein-nav-bar-logo',
                            'type'     => 'media',
                            'title'    => esc_html__( 'Navigation Bar Logo', 'signature' ),
                            'subtitle'     => esc_html__( 'Upload or Select the image. ', 'signature' ),
                            'required' => array('navigation-style','equals',get_template_directory_uri().'/admin/preview/navigation/Rein.png')
                        ),
                        array(
                            'id'       => 'rein-nav-bar-logo2x',
                            'type'     => 'media',
                            'title'    => esc_html__( 'Navigation Bar Logo (Retina)', 'signature' ),
                            'subtitle' => esc_html__( 'Upload your logo image for retina display. It should have the same name and doubled the sized than the regular. The name also need to contain the chars @2x at the end. Eg: \'mylogo.png\' becomes \'mylogo@2x.png\'.', 'signature' ),
                            'required' => array('navigation-style','equals',get_template_directory_uri().'/admin/preview/navigation/Rein.png')
                        ),
                        array(
                            'id'       => 'rein-nav-logo',
                            'type'     => 'media',
                            'title'    => esc_html__( 'Navigation Logo', 'signature' ),
                            'subtitle'     => esc_html__( 'Upload or Select the image. ', 'signature' ),
                            'required' => array('navigation-style','equals',get_template_directory_uri().'/admin/preview/navigation/Rein.png')
                        ),
                        array(
                            'id'       => 'rein-nav-logo2x',
                            'type'     => 'media',
                            'title'    => esc_html__( 'Navigation Logo (Retina)', 'signature' ),
                            'subtitle' => esc_html__( 'Upload your logo image for retina display. It should have the same name and doubled the sized than the regular. The name also need to contain the chars @2x at the end. Eg: \'mylogo.png\' becomes \'mylogo@2x.png\'.', 'signature' ),
                            'required' => array('navigation-style','equals',get_template_directory_uri().'/admin/preview/navigation/Rein.png')
                        ),
                        array(
                            'id'       => 'stefan-nav-bg-color',
                            'type'     => 'color',
                            'title'    => esc_html__( 'Background Color Navigation', 'signature' ),
                            'subtitle' => esc_html__( 'Pick a background color for the navigation.(default: #292929).', 'signature' ),
                            'default'  => '#292929',
                            'validate' => 'color',
                            'transparent' => false,
                            'required' => array('navigation-style','equals',get_template_directory_uri().'/admin/preview/navigation/Stefan.png')
                        ),
                        array(
                            'id'       => 'stefan-nav-logo',
                            'type'     => 'media',
                            'title'    => esc_html__( 'Navigation Logo', 'signature' ),
                            'subtitle'     => esc_html__( 'Upload or Select the image. ', 'signature' ),
                            'required' => array('navigation-style','equals',get_template_directory_uri().'/admin/preview/navigation/Stefan.png')
                        ),
                        array(
                            'id'       => 'stefan-nav-logo2x',
                            'type'     => 'media',
                            'title'    => esc_html__( 'Navigation Logo (Retina)', 'signature' ),
                            'subtitle' => esc_html__( 'Upload your logo image for retina display. It should have the same name and doubled the sized than the regular. The name also need to contain the chars @2x at the end. Eg: \'mylogo.png\' becomes \'mylogo@2x.png\'.', 'signature' ),
                            'required' => array('navigation-style','equals',get_template_directory_uri().'/admin/preview/navigation/Stefan.png')
                        ),
                        array(
                            'id'       => 'theo-nav-bg-color',
                            'type'     => 'color',
                            'title'    => esc_html__( 'Background Color Navigation', 'signature' ),
                            'subtitle' => esc_html__( 'Pick a background color for the navigation.(default: #353535).', 'signature' ),
                            'default'  => '#353535',
                            'validate' => 'color',
                            'transparent' => false,
                            'required' => array('navigation-style','equals',get_template_directory_uri().'/admin/preview/navigation/Theo.png')
                        ),
                        array(
                            'id'       => 'theo-nav-bg-img',
                            'type'     => 'media',
                            'title'    => esc_html__( 'Navigation Background Image', 'signature' ),
                            'subtitle' => esc_html__( 'Upload or Select the image. ', 'signature' ),
                            'required' => array('navigation-style','equals',get_template_directory_uri().'/admin/preview/navigation/Theo.png')
                        ),
                        array(
                            'id'       => 'theo-nav-logo',
                            'type'     => 'media',
                            'title'    => esc_html__( 'Navigation Logo', 'signature' ),
                            'subtitle'     => esc_html__( 'Upload or Select the image. ', 'signature' ),
                            'required' => array('navigation-style','equals',get_template_directory_uri().'/admin/preview/navigation/Theo.png')
                        ),
                        array(
                            'id'       => 'theo-nav-logo2x',
                            'type'     => 'media',
                            'title'    => esc_html__( 'Navigation Logo (Retina)', 'signature' ),
                            'subtitle' => esc_html__( 'Upload your logo image for retina display. It should have the same name and doubled the sized than the regular. The name also need to contain the chars @2x at the end. Eg: \'mylogo.png\' becomes \'mylogo@2x.png\'.', 'signature' ),
                            'required' => array('navigation-style','equals',get_template_directory_uri().'/admin/preview/navigation/Theo.png')
                        ),
                        array(
                            'id'       => 'uno-nav-bg-color',
                            'type'     => 'color',
                            'title'    => esc_html__( 'Background Color Navigation Panel', 'signature' ),
                            'subtitle' => esc_html__( 'Pick a background color for the navigation panel.(default: #060606).', 'signature' ),
                            'default'  => '#060606',
                            'validate' => 'color',
                            'transparent' => false,
                            'required' => array('navigation-style','equals',get_template_directory_uri().'/admin/preview/navigation/Uno.png')
                        ),
                        array(
                            'id'       => 'uno-nav-logo',
                            'type'     => 'media',
                            'title'    => esc_html__( 'Navigation Logo', 'signature' ),
                            'subtitle'     => esc_html__( 'Upload or Select the image. ', 'signature' ),
                            'required' => array('navigation-style','equals',get_template_directory_uri().'/admin/preview/navigation/Uno.png')
                        ),
                        array(
                            'id'       => 'uno-nav-logo2x',
                            'type'     => 'media',
                            'title'    => esc_html__( 'Navigation Logo (Retina)', 'signature' ),
                            'subtitle' => esc_html__( 'Upload your logo image for retina display. It should have the same name and doubled the sized than the regular. The name also need to contain the chars @2x at the end. Eg: \'mylogo.png\' becomes \'mylogo@2x.png\'.', 'signature' ),
                            'required' => array('navigation-style','equals',get_template_directory_uri().'/admin/preview/navigation/Uno.png')
                        ),
                        array(
                            'id'       => 'uno-nav-border-color',
                            'type'     => 'color',
                            'title'    => esc_html__( 'Border Color Navigation', 'signature' ),
                            'subtitle' => esc_html__( 'Pick a border color for the navigation.(default: #FFFFFF).', 'signature' ),
                            'default'  => '#FFFFFF',
                            'validate' => 'color',
                            'transparent' => false,
                            'required' => array('navigation-style','equals',get_template_directory_uri().'/admin/preview/navigation/Uno.png')
                        ),
                        array(
                            'id'       => 'velten-nav-logo',
                            'type'     => 'media',
                            'title'    => esc_html__( 'Navigation Logo', 'signature' ),
                            'subtitle'     => esc_html__( 'Upload or Select the image. ', 'signature' ),
                            'required' => array('navigation-style','equals',get_template_directory_uri().'/admin/preview/navigation/Velten.png')
                        ),
                        array(
                            'id'       => 'velten-nav-logo2x',
                            'type'     => 'media',
                            'title'    => esc_html__( 'Navigation Logo (Retina)', 'signature' ),
                            'subtitle' => esc_html__( 'Upload your logo image for retina display. It should have the same name and doubled the sized than the regular. The name also need to contain the chars @2x at the end. Eg: \'mylogo.png\' becomes \'mylogo@2x.png\'.', 'signature' ),
                            'required' => array('navigation-style','equals',get_template_directory_uri().'/admin/preview/navigation/Velten.png')
                        ),
                        array(
                            'id'       => 'velten-nav-bg-color',
                            'type'     => 'color',
                            'title'    => esc_html__( 'Background Color Navigation Panel', 'signature' ),
                            'subtitle' => esc_html__( 'Pick a background color for the navigation panel.(default: #F0F4F4).', 'signature' ),
                            'default'  => '#F0F4F4',
                            'validate' => 'color',
                            'transparent' => false,
                            'required' => array('navigation-style','equals',get_template_directory_uri().'/admin/preview/navigation/Velten.png')
                        ),
                        array(
                            'id' => 'velten-nav-content',
                            'type' => 'textarea',
                            'title' => esc_html__('Navigation Content', 'signature'), 
                            'subtitle' => esc_html__('', 'signature'),
                            'default' => 'A beautiful web template for elegant websites',
                            'required' => array('navigation-style','equals',get_template_directory_uri().'/admin/preview/navigation/Velten.png')
                        ),
                        array(
                            'id'       => 'wilmar-nav-logo',
                            'type'     => 'media',
                            'title'    => esc_html__( 'Navigation Logo', 'signature' ),
                            'subtitle'     => esc_html__( 'Upload or Select the image. ', 'signature' ),
                            'required' => array('navigation-style','equals',get_template_directory_uri().'/admin/preview/navigation/Wilmar.png')
                        ),
                        array(
                            'id'       => 'wilmar-nav-logo2x',
                            'type'     => 'media',
                            'title'    => esc_html__( 'Navigation Logo (Retina)', 'signature' ),
                            'subtitle' => esc_html__( 'Upload your logo image for retina display. It should have the same name and doubled the sized than the regular. The name also need to contain the chars @2x at the end. Eg: \'mylogo.png\' becomes \'mylogo@2x.png\'.', 'signature' ),
                            'required' => array('navigation-style','equals',get_template_directory_uri().'/admin/preview/navigation/Wilmar.png')
                        ),
                        array(
                            'id' => 'wilmar-nav-content',
                            'type' => 'textarea',
                            'title' => esc_html__('Navigation Content', 'signature'), 
                            'subtitle' => esc_html__('', 'signature'),
                            'default' => 'Photography Portfolio of Elena Steinberg',
                            'required' => array('navigation-style','equals',get_template_directory_uri().'/admin/preview/navigation/Wilmar.png')
                        ),
                        array(
                            'id'       => 'xaver-nav-logo',
                            'type'     => 'media',
                            'title'    => esc_html__( 'Navigation Logo', 'signature' ),
                            'subtitle'     => esc_html__( 'Upload or Select the image. ', 'signature' ),
                            'required' => array('navigation-style','equals',get_template_directory_uri().'/admin/preview/navigation/Xaver.png')
                        ),
                        array(
                            'id'       => 'xaver-nav-logo2x',
                            'type'     => 'media',
                            'title'    => esc_html__( 'Navigation Logo (Retina)', 'signature' ),
                            'subtitle' => esc_html__( 'Upload your logo image for retina display. It should have the same name and doubled the sized than the regular. The name also need to contain the chars @2x at the end. Eg: \'mylogo.png\' becomes \'mylogo@2x.png\'.', 'signature' ),
                            'required' => array('navigation-style','equals',get_template_directory_uri().'/admin/preview/navigation/Xaver.png')
                        ),
                        array(
                            'id' => 'xaver-nav-content',
                            'type' => 'textarea',
                            'title' => esc_html__('Navigation Content', 'signature'), 
                            'subtitle' => esc_html__('', 'signature'),
                            'default' => 'Basic - A premium template from Designova. Copyright &copy; 2015 Designova.',
                            'required' => array('navigation-style','equals',get_template_directory_uri().'/admin/preview/navigation/Xaver.png')
                        ),
                        array(
                            'id'       => 'xaver-nav-bg-img',
                            'type'     => 'media',
                            'title'    => esc_html__( 'Navigation Background Image', 'signature' ),
                            'subtitle' => esc_html__( 'Upload or Select the image. ', 'signature' ),
                            'required' => array('navigation-style','equals',get_template_directory_uri().'/admin/preview/navigation/Xaver.png')
                        ),
                        array(
                            'id'       => 'york-nav-logo',
                            'type'     => 'media',
                            'title'    => esc_html__( 'Navigation Logo', 'signature' ),
                            'subtitle'     => esc_html__( 'Upload or Select the image. ', 'signature' ),
                            'required' => array('navigation-style','equals',get_template_directory_uri().'/admin/preview/navigation/York.png')
                        ),
                        array(
                            'id'       => 'york-nav-logo2x',
                            'type'     => 'media',
                            'title'    => esc_html__( 'Navigation Logo (Retina)', 'signature' ),
                            'subtitle' => esc_html__( 'Upload your logo image for retina display. It should have the same name and doubled the sized than the regular. The name also need to contain the chars @2x at the end. Eg: \'mylogo.png\' becomes \'mylogo@2x.png\'.', 'signature' ),
                            'required' => array('navigation-style','equals',get_template_directory_uri().'/admin/preview/navigation/York.png')
                        ),
                        array(
                            'id'       => 'zircon-nav-logo',
                            'type'     => 'media',
                            'title'    => esc_html__( 'Navigation Logo', 'signature' ),
                            'subtitle'     => esc_html__( 'Upload or Select the image. ', 'signature' ),
                            'required' => array('navigation-style','equals',get_template_directory_uri().'/admin/preview/navigation/Zircon.png')
                        ),
                        array(
                            'id'       => 'zircon-nav-logo2x',
                            'type'     => 'media',
                            'title'    => esc_html__( 'Navigation Logo (Retina)', 'signature' ),
                            'subtitle' => esc_html__( 'Upload your logo image for retina display. It should have the same name and doubled the sized than the regular. The name also need to contain the chars @2x at the end. Eg: \'mylogo.png\' becomes \'mylogo@2x.png\'.', 'signature' ),
                            'required' => array('navigation-style','equals',get_template_directory_uri().'/admin/preview/navigation/Zircon.png')
                        ),
                        array(
                            'id'       => 'amor-nav-bg-color',
                            'type'     => 'color',
                            'title'    => esc_html__( 'background Color', 'signature' ),
                            'subtitle' => esc_html__( 'Pick a background color for navigation panel.  (default: #FFFFFF).', 'signature' ),
                            'default'  => '#ffffff',
                            'validate' => 'color',
                            'transparent' => false,
                            'required' => array('navigation-style','equals',get_template_directory_uri().'/admin/preview/navigation/Amor.png')
                        ),
                        array(
                            'id'       => 'amor-nav-logo',
                            'type'     => 'media',
                            'title'    => esc_html__( 'Navigation Logo', 'signature' ),
                            'subtitle'     => esc_html__( 'Upload or Select the image. ', 'signature' ),
                            'required' => array('navigation-style','equals',get_template_directory_uri().'/admin/preview/navigation/Amor.png')
                        ),
                        array(
                            'id'       => 'amor-nav-logo2x',
                            'type'     => 'media',
                            'title'    => esc_html__( 'Navigation Logo (Retina)', 'signature' ),
                            'subtitle' => esc_html__( 'Upload your logo image for retina display. It should have the same name and doubled the sized than the regular. The name also need to contain the chars @2x at the end. Eg: \'mylogo.png\' becomes \'mylogo@2x.png\'.', 'signature' ),
                            'required' => array('navigation-style','equals',get_template_directory_uri().'/admin/preview/navigation/Amor.png')
                        ),
                        array(
                            'id'       => 'boston-nav-bg-color',
                            'type'     => 'color',
                            'title'    => esc_html__( 'Navigation Background Color', 'signature' ),
                            'subtitle' => esc_html__( 'Pick a background color for navigation panel.(default: #292929).', 'signature' ),
                            'default'  => '#292929',
                            'validate' => 'color',
                            'transparent' => false,
                            'required' => array('navigation-style','equals',get_template_directory_uri().'/admin/preview/navigation/Boston.png')
                        ),
                        array(
                            'id'       => 'boston-nav-bg-img',
                            'type'     => 'media',
                            'title'    => esc_html__( 'Navigation Background Image', 'signature' ),
                            'subtitle' => esc_html__( 'Upload or Select the image. ', 'signature' ),
                            'required' => array('navigation-style','equals',get_template_directory_uri().'/admin/preview/navigation/Boston.png')
                        ),
                        array(
                            'id'       => 'boston-nav-bar-logo',
                            'type'     => 'media',
                            'title'    => esc_html__( 'Navigation Bar Logo', 'signature' ),
                            'subtitle' => esc_html__( 'Upload or Select the image. ', 'signature' ),
                            'required' => array('navigation-style','equals',get_template_directory_uri().'/admin/preview/navigation/Boston.png')
                        ),
                        array(
                            'id'       => 'boston-nav-bar-logo2x',
                            'type'     => 'media',
                            'title'    => esc_html__( 'Navigation Bar Logo (Retina)', 'signature' ),
                            'subtitle' => esc_html__( 'Upload your logo image for retina display. It should have the same name and doubled the sized than the regular. The name also need to contain the chars @2x at the end. Eg: \'mylogo.png\' becomes \'mylogo@2x.png\'.', 'signature' ),
                            'required' => array('navigation-style','equals',get_template_directory_uri().'/admin/preview/navigation/Boston.png')
                        ),
                        
                        
                        
                    )   
                );
                                

                $this->sections[] = array(
                    'icon'   => 'el-icon-font',
                    'title'  => esc_html__( 'Font Settings', 'signature' ),
                    'fields' => array(
                        array(
                            'id'       => 'default-font-size',
                            'type'     => 'spinner', 
                            'title'    => esc_html__('Basic Font Size (in pixels)', 'redux-framework-demo'),
                            'subtitle'     => esc_html__('Basic font size for paragraphs and normal text.', 'redux-framework-demo'),
                            'default'  => '14',
                            'min'      => '1',
                            'step'     => '1',
                            'max'      => '200',
                        ),
                        array(
                            'id'       => 'default-line-height',
                            'type'     => 'spinner', 
                            'title'    => esc_html__('Basic Line Height (in pixels)', 'redux-framework-demo'),
                            'subtitle'     => esc_html__('Basic line height for paragraphs and normal text.', 'redux-framework-demo'),
                            'default'  => '21',
                            'min'      => '1',
                            'step'     => '1',
                            'max'      => '207',
                        ),
                        array(
                            'id'       => 'default-letter-spacing',
                            'type'     => 'spinner', 
                            'title'    => esc_html__('Basic Letter Spacing (in pixels)', 'redux-framework-demo'),
                            'subtitle'     => esc_html__('Basic letter spacing for paragraphs and normal text.', 'redux-framework-demo'),
                            'default'  => '0',
                            'min'      => '0',
                            'step'     => '1',
                            'max'      => '20',
                        ),
                        array(
                            'id'       => 'body-font',
                            'type'     => 'typography',
                            'title'    => esc_html__( 'Body Font', 'signature' ),
                            'subtitle' => esc_html__( 'Specify the body font.', 'signature' ),
                            'google'   => true,
                            'font-weight' => false,
                            'font-size' => false,
                            'line-height' => false,
                            'color' => false,
                            'text-align' => false,
                            'font-style' => false,
                            'default'  => array(
                                'font-family' => 'Open Sans'
                            ),
                            'fonts'  => array(
                                'Designova Sinkin Sans Regular Premium' => 'designova_ss_regular',
                                'Designova Halis Grotesque Regular Premium' => 'designova_hgr_regular'
                            ),
                        ),
                        array(
                            'id'       => 'heading-font',
                            'type'     => 'typography',
                            'title'    => esc_html__( 'Heading Font', 'signature' ),
                            'subtitle' => esc_html__( 'Specify the heading font.', 'signature' ),
                            'google'   => true,
                            'font-weight' => false,
                            'font-size' => false,
                            'line-height' => false,
                            'color' => false,
                            'text-align' => false,
                            'font-style' => false,
                            'default'  => array(
                                'font-family' => 'Montserrat'
                            ),
                        ),
                        array(
                            'id'    => 'info_success',
                            'type'  => 'info',
                            'style' => 'success',
                            'title' => esc_html__('Premium Font', 'redux-framework-demo'),
                            'icon'  => 'el-icon-info-sign',
                            'desc'  => esc_html__( 'The following fonts are Premium Fonts which is free to use with this product only', 'redux-framework-demo')
                        ),
                        array(
                            'id'       => 'alter-body-font',
                            'type'     => 'typography',
                            'title'    => esc_html__( 'Alternative Body Font', 'signature' ),
                            'subtitle' => esc_html__( 'Specify the alternative body font.', 'signature' ),
                            'google'   => true,
                            'font-weight' => false,
                            'font-size' => false,
                            'line-height' => false,
                            'color' => false,
                            'text-align' => false,
                            'font-style' => false,
                            'default'  => array(
                                'font-family' => 'Designova Sinkin Sans Regular Premium'
                            ),
                            'fonts'  => array(
                                'Designova Sinkin Sans Regular Premium' => 'designova_ss_regular',
                                'Designova Halis Grotesque Regular Premium' => 'designova_hgr_regular',
                                'Porter Sans' => 'Porter Sans'
                            ),
                        ),
                        array(
                            'id'       => 'alter-heading-font',
                            'type'     => 'typography',
                            'title'    => esc_html__( 'Alternative Heading Font', 'signature' ),
                            'subtitle' => esc_html__( 'Specify the alternative heading font.', 'signature' ),
                            'google'   => true,
                            'font-weight' => false,
                            'font-size' => false,
                            'line-height' => false,
                            'color' => false,
                            'text-align' => false,
                            'font-style' => true,
                            'default'  => array(
                                'font-family' => 'Designova Sinkin Sans Regular Premium'
                            ),
                            'fonts'  => array(
                                'Designova Sinkin Sans Regular Premium' => 'designova_ss_regular',
                                'Designova Halis Grotesque Regular Premium' => 'designova_hgr_regular'
                            ),
                        ),
                        array(
                            'id'       => 'thin-font',
                            'type'     => 'typography',
                            'title'    => esc_html__( 'Thin Font', 'signature' ),
                            'subtitle' => esc_html__( 'Specify the thin font.', 'signature' ),
                            'google'   => true,
                            'font-weight' => false,
                            'font-size' => false,
                            'line-height' => false,
                            'color' => false,
                            'text-align' => false,
                            'font-style' => false,
                            'default'  => array(
                                'font-family' => 'Designova Sinkin Sans Thin Premium'
                            ),
                            'fonts'  => array(
                                'Designova Sinkin Sans Thin Premium' => 'designova_ss_thin',
                                'Designova Halis Grotesque Thin Premium' => 'designova_hgr_thin'
                            ),
                        ),
                        array(
                            'id'       => 'light-font',
                            'type'     => 'typography',
                            'title'    => esc_html__( 'Light Font', 'signature' ),
                            'subtitle' => esc_html__( 'Specify the light font.', 'signature' ),
                            'google'   => true,
                            'font-weight' => false,
                            'font-size' => false,
                            'line-height' => false,
                            'color' => false,
                            'text-align' => false,
                            'font-style' => false,
                            'default'  => array(
                                'font-family' => 'Designova Sinkin Sans Light Premium'
                            ),
                            'fonts'  => array(
                                'Designova Sinkin Sans Light Premium' => 'designova_ss_light',
                                'Designova Halis Grotesque Light Premium' => 'designova_hgr_light'
                            ),
                        ),
                        array(
                            'id'       => 'xlight-font',
                            'type'     => 'typography',
                            'title'    => esc_html__( 'Extra Light Font', 'signature' ),
                            'subtitle' => esc_html__( 'Specify the extra light font.', 'signature' ),
                            'google'   => true,
                            'font-weight' => false,
                            'font-size' => false,
                            'line-height' => false,
                            'color' => false,
                            'text-align' => false,
                            'font-style' => false,
                            'default'  => array(
                                'font-family' => 'Designova Sinkin Sans Extra Light Premium'
                            ),
                            'fonts'  => array(
                                'Designova Sinkin Sans Extra Light Premium' => 'designova_ss_xlight',
                            ),
                        ),
                        array(
                            'id'       => 'bold-font',
                            'type'     => 'typography',
                            'title'    => esc_html__( 'Bold Font', 'signature' ),
                            'subtitle' => esc_html__( 'Specify the bold font.', 'signature' ),
                            'google'   => true,
                            'font-weight' => false,
                            'font-size' => false,
                            'line-height' => false,
                            'color' => false,
                            'text-align' => false,
                            'font-style' => false,
                            'default'  => array(
                                'font-family' => 'Designova Sinkin Sans Bold Premium'
                            ),
                            'fonts'  => array(
                                'Designova Sinkin Sans Bold Premium' => 'designova_ss_bold',
                                'Designova Halis Grotesque Bold Premium' => 'designova_hgr_bold'
                            ),
                        ),
                        array(
                            'id'       => 'black-font',
                            'type'     => 'typography',
                            'title'    => esc_html__( 'Black Font', 'signature' ),
                            'subtitle' => esc_html__( 'Specify the black font.', 'signature' ),
                            'google'   => true,
                            'font-weight' => false,
                            'font-size' => false,
                            'line-height' => false,
                            'color' => false,
                            'text-align' => false,
                            'font-style' => false,
                            'default'  => array(
                                'font-family' => 'Designova Sinkin Sans Black Premium'
                            ),
                            'fonts'  => array(
                                'Designova Sinkin Sans Black Premium' => 'designova_ss_black',
                                'Designova Halis Grotesque Black Premium' => 'designova_hgr_black'
                            ),
                        ),
                        array(
                            'id'       => 'xblack-font',
                            'type'     => 'typography',
                            'title'    => esc_html__( 'Extra Black Font', 'signature' ),
                            'subtitle' => esc_html__( 'Specify the extra black font.', 'signature' ),
                            'google'   => true,
                            'font-weight' => false,
                            'font-size' => false,
                            'line-height' => false,
                            'color' => false,
                            'text-align' => false,
                            'font-style' => false,
                            'default'  => array(
                                'font-family' => 'Designova Sinkin Sans Extra Black Premium'
                            ),
                            'fonts'  => array(
                                'Designova Sinkin Sans Extra Black Premium' => 'designova_ss_xblack',
                            ),
                        ),

                        
                    )
                );

                // $this->sections[] = array(
                //     'type' => 'divide',
                // );

                
                $this->sections[] = array(
                    'icon'   => 'el-icon-envelope',
                    'title'  => esc_html__( 'Contact Form Settings', 'signature' ),
                    'fields' => array(
                        array(
                            'id' => 'name_placeholder',
                            'type' => 'text',
                            'title' => esc_html__('Placeholder For Name', 'signature'), 
                            'subtitle' => esc_html__('', 'signature'),
                            'default' => 'Your Name'
                            ),
                        array(
                            'id' => 'name_err_msg',
                            'type' => 'text',
                            'title' => esc_html__('Error Message For Name', 'signature'), 
                            'subtitle' => esc_html__('', 'signature'),
                            'default' => 'Name must not be empty'
                            ),
                        array(
                            'id' => 'email_placeholder',
                            'type' => 'text',
                            'title' => esc_html__('Placeholder For Email', 'signature'), 
                            'subtitle' => esc_html__('', 'signature'),
                            'default' => 'Your Email ID'
                            ),
                        array(
                            'id' => 'email_err_msg',
                            'type' => 'text',
                            'title' => esc_html__('Error Message For Email', 'signature'), 
                            'subtitle' => esc_html__('', 'signature'),
                            'default' => 'Please provide a valid email'
                            ),
                        array(
                            'id' => 'message_placeholder',
                            'type' => 'text',
                            'title' => esc_html__('Placeholder For Message', 'signature'), 
                            'subtitle' => esc_html__('', 'signature'),
                            'default' => 'Your Message'
                            ),
                        array(
                            'id' => 'message_err_msg',
                            'type' => 'text',
                            'title' => esc_html__('Error Message For Message', 'signature'), 
                            'subtitle' => esc_html__('', 'signature'),
                            'default' => 'Message should not be empty'
                            ),
                        array(
                            'id' => 'submit_btn_txt',
                            'type' => 'text',
                            'title' => esc_html__('Text For Submit Button', 'signature'), 
                            'subtitle' => esc_html__('', 'signature'),
                            'default' => 'Send Message'
                            ),
                        array(
                            'id' => 'thanks_msg_header',
                            'type' => 'text',
                            'title' => esc_html__('Thanks Message Header', 'signature'), 
                            'subtitle' => esc_html__('', 'signature'),
                            'default' => 'Thanks For Your Comment'
                            ),
                        array(
                            'id' => 'thanks_msg',
                            'type' => 'textarea',
                            'title' => esc_html__('Thanks Message', 'signature'), 
                            'subtitle' => esc_html__('', 'signature'),
                            'default' => 'Lorem ipsum dolor siter amet mundium corpes illon tolves lorem ipsum dolor. Quisque nec est id ante consectetur tristique. Suspendisse potenti.'
                            ),
                        array(
                            'id' => 'contact_email',
                            'type' => 'text',
                            'title' => esc_html__('Contact form Email', 'signature'),
                            'validate' => 'email', 
                            'subtitle' => esc_html__('Contact form submissions will be mailed to this address', 'signature'),
                            'default' => 'mail@domain.tld'
                            ),
                        array(
                            'id' => 'contact_email_sub',
                            'type' => 'text',
                            'title' => esc_html__('Contact Email Subject', 'signature'),
                            'subtitle' => esc_html__('', 'signature'),
                            'default' => 'Contact form submission from Signature'
                            )

                    )
                );


                

                $this->sections[] = array(
                    'icon'   => 'ion ion-ios7-paw',
                    'title'  => esc_html__( 'Footer Settings', 'signature' ),
                    'fields' => array(
                        array(
                            'id'       => 'footer-style',
                            'type'     => 'select_image',
                            'title'    => esc_html__( 'Select Footer Style', 'signature' ),
                            'subtitle' => esc_html__( 'A preview of the selected footer style will appear underneath the select box.', 'signature' ),
                            'options'  => $footer_styles,
                            'default'  => 'Adler.png',
                        ),
                        array(
                            'id'       => 'foot_bg_color',
                            'type'     => 'color',
                            'title'    => esc_html__( 'background Color', 'signature' ),
                            'subtitle' => esc_html__( 'Pick a background color for footer(default: #FFFFFF).', 'signature' ),
                            'default'  => '#FFFFFF',
                            'validate' => 'color',
                            'transparent' => false
                        ),
                        array(
                            'id'       => 'signature-footer-logo',
                            'type'     => 'media',
                            'title'    => esc_html__( 'Footer Logo', 'signature' ),
                            'subtitle'     => esc_html__( 'Upload or Select the image. ', 'signature' ),
                        ),
                        array(
                            'id'       => 'signature-footer-logo2x',
                            'type'     => 'media',
                            'title'    => esc_html__( 'Footer Logo (Retina)', 'signature' ),
                            'subtitle' => esc_html__( 'Upload your logo image for retina display. It should have the same name and doubled the sized than the regular. The name also need to contain the chars @2x at the end. Eg: \'mylogo.png\' becomes \'mylogo@2x.png\'.', 'signature' ),
                        ),
                        array(
                            'id'          => 'signature-social-media-icons',
                            'type'        => 'slides',
                            'title'       => esc_html__( 'Social Icon Options', 'signature' ),
                            'subtitle'    => esc_html__( 'Unlimited icons with drag and drop option.', 'signature' ),
                            'url'         => true,
                            'description' => false,
                            'placeholder' => array(
                                'title'       => esc_html__( 'This is a title', 'signature' ),
                                'description' => esc_html__( 'Description Here', 'signature' ),
                            ),
                        ),
                        array(
                            'id' => 'signature-footer-copy',
                            'type' => 'textarea',
                            'title' => esc_html__('Copyright Text', 'signature'), 
                            'subtitle' => esc_html__('', 'signature'),
                            'default' => 'Copyright &copy; 2015',
                        ),
                        array(
                            'id'       => 'adler-footer-content',
                            'type'     => 'textarea',
                            'title'    => esc_html__( 'Footer Text Content', 'signature' ),
                            'default'  => 'Copyright &copy; 2015 <a href="http://designova.net">Designova</a><a href="http://designova.net">Buy this theme</a>',
                            'required' => array('footer-style','equals',get_template_directory_uri().'/admin/preview/footer/Adler.png')
                        ),
                        array(
                            'id'       => 'berend-footer-content',
                            'type'     => 'textarea',
                            'title'    => esc_html__( 'Footer Text Content', 'signature' ),
                            'default'  => 'Official portfolio of Able Muller',
                            'required' => array('footer-style','equals',get_template_directory_uri().'/admin/preview/footer/Berend.png')
                        ),
                        array(
                            'id'       => 'johan-footer-border-color',
                            'type'     => 'color',
                            'title'    => esc_html__( 'Top Border Color', 'signature' ),
                            'subtitle' => esc_html__( 'Pick top border color for footer(default: #FFFFFF).', 'signature' ),
                            'default'  => '#FFFFFF',
                            'validate' => 'color',
                            'transparent' => false,
                            'required' => array('footer-style','equals',get_template_directory_uri().'/admin/preview/footer/Johan.png')
                        ),
                        array(
                            'id' => 'uno-footer-text',
                            'type' => 'textarea',
                            'title' => esc_html__('Footer Text', 'signature'), 
                            'subtitle' => esc_html__('', 'signature'),
                            'default' => 'Lorem ipsum dolor sit amet consectetur adipiscing elit.',
                            'required' => array('footer-style','equals',get_template_directory_uri().'/admin/preview/footer/Uno.png')
                        ),
                        array(
                            'id'       => 'uno-footer-border-color',
                            'type'     => 'color',
                            'title'    => esc_html__( 'Footer Text Border Color', 'signature' ),
                            'subtitle' => esc_html__( 'Pick top border color for footer text(default: #292929).', 'signature' ),
                            'default'  => '#292929',
                            'validate' => 'color',
                            'transparent' => false,
                            'required' => array('footer-style','equals',get_template_directory_uri().'/admin/preview/footer/Uno.png')
                        ),
                        array(
                            'id' => 'zircon-footer-text',
                            'type' => 'textarea',
                            'title' => esc_html__('Footer Text', 'signature'), 
                            'subtitle' => esc_html__('', 'signature'),
                            'default' => 'Lorem ipsum dolor sit amet, feugiat delicat.',
                            'required' => array('footer-style','equals',get_template_directory_uri().'/admin/preview/footer/Zircon.png')
                        ),
                        array(
                            'id' => 'zircon-flickr-gal-name',
                            'type' => 'text',
                            'title' => esc_html__('Flickr Gallery Title', 'signature'),
                            'subtitle' => esc_html__('Title displays above the image tiles.', 'signature'),
                            'default' => 'Gallery',
                            'required' => array('footer-style','equals',get_template_directory_uri().'/admin/preview/footer/Zircon.png')
                        ),
                        array(
                            'id' => 'zircon-flickr-user-id',
                            'type' => 'text',
                            'title' => esc_html__('Flickr User ID', 'signature'),
                            'subtitle' => esc_html__('', 'signature'),
                            'default' => '9890806@N04',
                            'required' => array('footer-style','equals',get_template_directory_uri().'/admin/preview/footer/Zircon.png')
                        ),
                        array(
                            'id'       => 'amor-footer-content',
                            'type'     => 'textarea',
                            'title'    => esc_html__( 'Footer Text Content', 'signature' ),
                            'default'  => 'Copyright &copy; 2015 <a href="http://designova.net">Designova</a><a href="http://designova.net">Buy this theme</a>',
                            'required' => array('footer-style','equals',get_template_directory_uri().'/admin/preview/footer/Amor.png')
                        ),
                        
                        
                    )
                );

                

                $this->sections[] = array(
                    'icon'   => 'ion ion-code',
                    'title'  => esc_html__( 'Additional CSS', 'signature' ),
                    'fields' => array(
                        array(
                            'id'       => 'additional_css',
                            'type'     => 'ace_editor',
                            'title'    => esc_html__( 'Additional CSS Code', 'signature' ),
                            'subtitle' => esc_html__( 'Paste your CSS code here.', 'signature' ),
                            'mode'     => 'css',
                            'theme'    => 'monokai',
                            'desc'     => '',
                            'default'  => "#item-selector{\nmargin: 0 auto;\n}"
                        )
                        
                    )
                );

                $this->sections[] = array(
                    'id'     => 'wbc_importer_section',
                    'title'  => esc_html__( 'Demo Importer', 'signature' ),
                    'desc'   => '<p class="description">'. apply_filters( 'wbc_importer_description', esc_html__( 'Works best to import on a new install of WordPress', 'framework' ) ).'</p>',
                    'icon'   => 'el-icon-delicious',
                    'fields' => array(
                        array(
                            'id'   => 'wbc_demo_importer',
                            'type' => 'wbc_importer'
                        )
                    )
                );

                

                $theme_info = '<div class="redux-framework-section-desc">';
                $theme_info .= '<p class="redux-framework-theme-data description theme-uri">' . esc_html__( '<strong>Theme URL:</strong> ', 'signature' ) . '<a href="' . $this->theme->get( 'ThemeURI' ) . '" target="_blank">' . $this->theme->get( 'ThemeURI' ) . '</a></p>';
                $theme_info .= '<p class="redux-framework-theme-data description theme-author">' . esc_html__( '<strong>Author:</strong> ', 'signature' ) . $this->theme->get( 'Author' ) . '</p>';
                $theme_info .= '<p class="redux-framework-theme-data description theme-version">' . esc_html__( '<strong>Version:</strong> ', 'signature' ) . $this->theme->get( 'Version' ) . '</p>';
                $theme_info .= '<p class="redux-framework-theme-data description theme-description">' . $this->theme->get( 'Description' ) . '</p>';
                $tabs = $this->theme->get( 'Tags' );
                if ( ! empty( $tabs ) ) {
                    $theme_info .= '<p class="redux-framework-theme-data description theme-tags">' . esc_html__( '<strong>Tags:</strong> ', 'signature' ) . implode( ', ', $tabs ) . '</p>';
                }
                $theme_info .= '</div>';

                

                

                

                $this->sections[] = array(
                    'title'  => esc_html__( 'Import / Export', 'signature' ),
                    'desc'   => esc_html__( 'Import and Export your Redux Framework settings from file, text or URL.', 'signature' ),
                    'icon'   => 'el-icon-refresh',
                    'fields' => array(
                        array(
                            'id'         => 'opt-import-export',
                            'type'       => 'import_export',
                            'title'      => 'Import Export',
                            'subtitle'   => 'Save and restore your Redux options',
                            'full_width' => false,
                        ),
                    ),
                );

                $this->sections[] = array(
                    'type' => 'divide',
                );

                $this->sections[] = array(
                    'icon'   => 'el-icon-info-circle',
                    'title'  => esc_html__( 'Theme Information', 'signature' ),
                    'desc'   => esc_html__( '<p class="description">This is the Description. Again HTML is allowed</p>', 'signature' ),
                    'fields' => array(
                        array(
                            'id'      => 'opt-raw-info',
                            'type'    => 'raw',
                            'content' => $item_info,
                        )
                    ),
                );

                
            }

            public function setHelpTabs() {

                // Custom page help tabs, displayed using the help API. Tabs are shown in order of definition.
                $this->args['help_tabs'][] = array(
                    'id'      => 'redux-help-tab-1',
                    'title'   => esc_html__( 'Theme Information 1', 'signature' ),
                    'content' => esc_html__( '<p>This is the tab content, HTML is allowed.</p>', 'signature' )
                );

                $this->args['help_tabs'][] = array(
                    'id'      => 'redux-help-tab-2',
                    'title'   => esc_html__( 'Theme Information 2', 'signature' ),
                    'content' => esc_html__( '<p>This is the tab content, HTML is allowed.</p>', 'signature' )
                );

                // Set the help sidebar
                $this->args['help_sidebar'] = esc_html__( '<p>This is the sidebar content, HTML is allowed.</p>', 'signature' );
            }

            /**
             * All the possible arguments for Redux.
             * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
             * */
            public function setArguments() {

                $theme = wp_get_theme(); // For use with some settings. Not necessary.

                $this->args = array(
                    // TYPICAL -> Change these values as you need/desire
                    'opt_name'             => 'signature_wp',
                    // This is where your data is stored in the database and also becomes your global variable name.
                    'display_name'         => $theme->get( 'Name' ),
                    // Name that appears at the top of your panel
                    'display_version'      => $theme->get( 'Version' ),
                    // Version that appears at the top of your panel
                    'menu_type'            => 'menu',
                    //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
                    'allow_sub_menu'       => true,
                    // Show the sections below the admin menu item or not
                    'menu_title'           => esc_html__( 'Theme Options', 'signature' ),
                    'page_title'           => esc_html__( 'Theme Options', 'signature' ),
                    // You will need to generate a Google API key to use this feature.
                    // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
                    'google_api_key'       => '',
                    // Set it you want google fonts to update weekly. A google_api_key value is required.
                    'google_update_weekly' => false,
                    // Must be defined to add google fonts to the typography module
                    'async_typography'     => true,
                    // Use a asynchronous font on the front end or font string
                    //'disable_google_fonts_link' => true,                    // Disable this in case you want to create your own google fonts loader
                    'admin_bar'            => true,
                    // Show the panel pages on the admin bar
                    'admin_bar_icon'     => 'dashicons-heart',
                    // Choose an icon for the admin bar menu
                    'admin_bar_priority' => 50,
                    // Choose an priority for the admin bar menu
                    'global_variable'      => '',
                    // Set a different name for your global variable other than the opt_name
                    'dev_mode'             => false,
                    // Show the time the page took to load, etc
                    'update_notice'        => true,
                    // If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
                    'customizer'           => true,
                    // Enable basic customizer support
                    //'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
                    //'disable_save_warn' => true,                    // Disable the save warning when a user changes a field

                    // OPTIONAL -> Give you extra features
                    'page_priority'        => null,
                    // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
                    'page_parent'          => 'themes.php',
                    // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
                    'page_permissions'     => 'manage_options',
                    // Permissions needed to access the options panel.
                    'menu_icon'            => 'dashicons-heart',
                    // Specify a custom URL to an icon
                    'last_tab'             => '',
                    // Force your panel to always open to a specific tab (by id)
                    'page_icon'            => 'icon-themes',
                    // Icon displayed in the admin panel next to your menu_title
                    'page_slug'            => 'signature_options',
                    // Page slug used to denote the panel
                    'save_defaults'        => true,
                    // On load save the defaults to DB before user clicks save or not
                    'default_show'         => false,
                    // If true, shows the default value next to each field that is not the default value.
                    'default_mark'         => '',
                    // What to print by the field's title if the value shown is default. Suggested: *
                    'show_import_export'   => true,
                    // Shows the Import/Export panel when not used as a field.

                    // CAREFUL -> These options are for advanced use only
                    'transient_time'       => 60 * MINUTE_IN_SECONDS,
                    'output'               => true,
                    // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
                    'output_tag'           => true,
                    // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
                    // 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.

                    // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
                    'database'             => '',
                    // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
                    'system_info'          => false,
                    // REMOVE

                    // HINTS
                    'hints'                => array(
                        'icon'          => 'icon-question-sign',
                        'icon_position' => 'right',
                        'icon_color'    => 'lightgray',
                        'icon_size'     => 'normal',
                        'tip_style'     => array(
                            'color'   => 'light',
                            'shadow'  => true,
                            'rounded' => false,
                            'style'   => '',
                        ),
                        'tip_position'  => array(
                            'my' => 'top left',
                            'at' => 'bottom right',
                        ),
                        'tip_effect'    => array(
                            'show' => array(
                                'effect'   => 'slide',
                                'duration' => '500',
                                'event'    => 'mouseover',
                            ),
                            'hide' => array(
                                'effect'   => 'slide',
                                'duration' => '500',
                                'event'    => 'click mouseleave',
                            ),
                        ),
                    )
                );

                // ADMIN BAR LINKS -> Setup custom links in the admin bar menu as external items.
                $this->args['admin_bar_links'][] = array(
                    'id'    => 'redux-docs',
                    'href'   => 'http://docs.reduxframework.com/',
                    'title' => esc_html__( 'Documentation', 'signature' ),
                );

                $this->args['admin_bar_links'][] = array(
                    //'id'    => 'redux-supp ort',
                    'href'   => 'https://www.designova.net/support.html',
                    'title' => esc_html__( 'Support', 'signature' ),
                );

                

                // SOCIAL ICONS -> Setup custom links in the footer for quick links in your panel footer icons.
                
                $this->args['share_icons'][] = array(
                    'url'   => 'https://www.facebook.com/designovastudio',
                    'title' => 'Like us on Facebook',
                    'icon'  => 'el-icon-facebook'
                );
                $this->args['share_icons'][] = array(
                    'url'   => 'https://twitter.com/designovastudio',
                    'title' => 'Follow us on Twitter',
                    'icon'  => 'el-icon-twitter'
                );
                

                // Panel Intro text -> before the form
                if ( ! isset( $this->args['global_variable'] ) || $this->args['global_variable'] !== false ) {
                    if ( ! empty( $this->args['global_variable'] ) ) {
                        $v = $this->args['global_variable'];
                    } else {
                        $v = str_replace( '-', '_', $this->args['opt_name'] );
                    }
                    $this->args['intro_text'] = sprintf( esc_html__( 'For theme support please contact us through our support system: http://www.designova.net/support.html', 'signature' ), $v );
                } else {
                    $this->args['intro_text'] = esc_html__( 'For theme support please contact us through our support system: http://www.designova.net/support.html', 'signature' );
                }

                // Add content after the form.
                $this->args['footer_text'] = esc_html__( 'For theme support please contact us through our support system: http://www.designova.net/support.html', 'signature' );
            }

            public function validate_callback_function( $field, $value, $existing_value ) {
                $error = true;
                $value = 'just testing';

                /*
              do your validation

              if(something) {
                $value = $value;
              } elseif(something else) {
                $error = true;
                $value = $existing_value;
                
              }
             */

                $return['value'] = $value;
                $field['msg']    = 'your custom error message';
                if ( $error == true ) {
                    $return['error'] = $field;
                }

                return $return;
            }

            public function class_field_callback( $field, $value ) {
                print_r( $field );
                echo 'CLASS CALLBACK';
                print_r( $value );
            }

        }

        global $reduxConfig;
        $reduxConfig = new Redux_Framework_sample_config();
    } else {
        echo "The class named Redux_Framework_sample_config has already been called. <strong>Developers, you need to prefix this class with your company name or you'll run into problems!</strong>";
    }

    /**
     * Custom function for the callback referenced above
     */
    if ( ! function_exists( 'redux_my_custom_field' ) ):
        function redux_my_custom_field( $field, $value ) {
            print_r( $field );
            echo '';
            print_r( $value );
        }
    endif;

    /**
     * Custom function for the callback validation referenced above
     * */
    if ( ! function_exists( 'redux_validate_callback_function' ) ):
        function redux_validate_callback_function( $field, $value, $existing_value ) {
            $error = true;
            $value = 'just testing';

            /*
          do your validation

          if(something) {
            $value = $value;
          } elseif(something else) {
            $error = true;
            $value = $existing_value;
            
          }
         */

            $return['value'] = $value;
            $field['msg']    = 'your custom error message';
            if ( $error == true ) {
                $return['error'] = $field;
            }

            return $return;
        }
    endif;
