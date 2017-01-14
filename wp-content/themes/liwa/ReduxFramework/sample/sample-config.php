<?php
/**
  ReduxFramework Sample Config File
  For full documentation, please visit: https://github.com/ReduxFramework/ReduxFramework/wiki
 * */

if (!class_exists("Redux_Framework_sample_config")) {

    class Redux_Framework_sample_config {

        public $args = array();
        public $sections = array();
        public $theme;
        public $ReduxFramework;

        public function __construct() {
            $this->initSettings();        
        }

        public function initSettings() {

            if ( !class_exists("ReduxFramework" ) ) {
                return;
            }       
            
            // Just for demo purposes. Not needed per say.
            $this->theme = wp_get_theme();

            // Set the default arguments
            $this->setArguments();

            // Set a few help tabs so you can see how it's done
            $this->setHelpTabs();

            // Create the sections and fields
            $this->setSections();

            if (!isset($this->args['opt_name'])) { // No errors please
                return;
            }

            // If Redux is running as a plugin, this will remove the demo notice and links
            //add_action( 'redux/plugin/hooks', array( $this, 'remove_demo' ) );
            // Function to test the compiler hook and demo CSS output.
            //add_filter('redux/options/'.$this->args['opt_name'].'/compiler', array( $this, 'compiler_action' ), 10, 2); 
            // Above 10 is a priority, but 2 in necessary to include the dynamically generated CSS to be sent to the function.
            // Change the arguments after they've been declared, but before the panel is created
            //add_filter('redux/options/'.$this->args['opt_name'].'/args', array( $this, 'change_arguments' ) );
            // Change the default value of a field after it's been set, but before it's been useds
            //add_filter('redux/options/'.$this->args['opt_name'].'/defaults', array( $this,'change_defaults' ) );
            // Dynamically add a section. Can be also used to modify sections/fields
            add_filter('redux/options/' . $this->args['opt_name'] . '/sections', array($this, 'dynamic_section'));

            $this->ReduxFramework = new ReduxFramework($this->sections, $this->args);
        }

        /**

          This is a test function that will let you see when the compiler hook occurs.
          It only runs if a field	set with compiler=>true is changed.

         * */
        function compiler_action($options, $css) {
            //echo "<h1>The compiler hook has run!";
            //print_r($options); //Option values
            //print_r($css); // Compiler selector CSS values  compiler => array( CSS SELECTORS )

            /*
              // Demo of how to use the dynamic CSS and write your own static CSS file
              $filename = dirname(__FILE__) . '/style' . '.css';
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

          Custom function for filtering the sections array. Good for child themes to override or add to the sections.
          Simply include this function in the child themes functions.php file.

          NOTE: the defined constants for URLs, and directories will NOT be available at this point in a child theme,
          so you must use get_template_directory_uri() if you want to use any of the built in icons

         * */
        function dynamic_section($sections) {
            //$sections = array();
            $sections[] = array(
                'title' => __('Section via hook', 'redux-framework-demo'),
                'desc' => __('<p class="description">This is a section created by adding a filter to the sections array. Can be used by child themes to add/remove sections from the options.</p>', 'redux-framework-demo'),
                'icon' => 'el-icon-paper-clip',
                // Leave this as a blank section, no options just some intro text set above.
                'fields' => array()
            );

            return $sections;
        }

        /**

          Filter hook for filtering the args. Good for child themes to override or add to the args array. Can also be used in other functions.

         * */
        function change_arguments($args) {
            //$args['dev_mode'] = true;

            return $args;
        }

        /**

          Filter hook for filtering the default value of any given field. Very useful in development mode.

         * */
        function change_defaults($defaults) {
            $defaults['str_replace'] = "Testing filter hook!";

            return $defaults;
        }

        // Remove the demo link and the notice of integrated demo from the redux-framework plugin
        function remove_demo() {

            // Used to hide the demo mode link from the plugin page. Only used when Redux is a plugin.
            if (class_exists('ReduxFrameworkPlugin')) {
                remove_filter('plugin_row_meta', array(ReduxFrameworkPlugin::get_instance(), 'plugin_meta_demo_mode_link'), null, 2);
            }

            // Used to hide the activation notice informing users of the demo panel. Only used when Redux is a plugin.
            remove_action('admin_notices', array(ReduxFrameworkPlugin::get_instance(), 'admin_notices'));
        }

        public function setSections() {

            /**
              Used within different fields. Simply examples. Search for ACTUAL DECLARATION for field examples
             * */
            // Background Patterns Reader
            $sample_patterns_path = ReduxFramework::$_dir . '../sample/patterns/';
            $sample_patterns_url = ReduxFramework::$_url . '../sample/patterns/';
            $sample_patterns = array();

            if (is_dir($sample_patterns_path)) :

                if ($sample_patterns_dir = opendir($sample_patterns_path)) :
                    $sample_patterns = array();

                    while (( $sample_patterns_file = readdir($sample_patterns_dir) ) !== false) {

                        if (stristr($sample_patterns_file, '.png') !== false || stristr($sample_patterns_file, '.jpg') !== false) {
                            $name = explode(".", $sample_patterns_file);
                            $name = str_replace('.' . end($name), '', $sample_patterns_file);
                            $sample_patterns[] = array('alt' => $name, 'img' => $sample_patterns_url . $sample_patterns_file);
                        }
                    }
                endif;
            endif;

            ob_start();

            $ct = wp_get_theme();
            $this->theme = $ct;
            $item_name = $this->theme->get('Name');
            $tags = $this->theme->Tags;
            $screenshot = $this->theme->get_screenshot();
            $class = $screenshot ? 'has-screenshot' : '';

            $customize_title = sprintf(__('Customize &#8220;%s&#8221;', 'redux-framework-demo'), $this->theme->display('Name'));
            ?>
            <div id="current-theme" class="<?php echo esc_attr($class); ?>">
            <?php if ($screenshot) : ?>
                <?php if (current_user_can('edit_theme_options')) : ?>
                        <a href="<?php echo wp_customize_url(); ?>" class="load-customize hide-if-no-customize" title="<?php echo esc_attr($customize_title); ?>">
                            <img src="<?php echo esc_url($screenshot); ?>" alt="<?php esc_attr_e('Current theme preview'); ?>" />
                        </a>
                <?php endif; ?>
                    <img class="hide-if-customize" src="<?php echo esc_url($screenshot); ?>" alt="<?php esc_attr_e('Current theme preview'); ?>" />
            <?php endif; ?>

                <h4>
            <?php echo $this->theme->display('Name'); ?>
                </h4>

                <div>
                    <ul class="theme-info">
                        <li><?php printf(__('By %s', 'redux-framework-demo'), $this->theme->display('Author')); ?></li>
                        <li><?php printf(__('Version %s', 'redux-framework-demo'), $this->theme->display('Version')); ?></li>
                        <li><?php echo '<strong>' . __('Tags', 'redux-framework-demo') . ':</strong> '; ?><?php printf($this->theme->display('Tags')); ?></li>
                    </ul>
                    <p class="theme-description"><?php echo $this->theme->display('Description'); ?></p>
                <?php
                if ($this->theme->parent()) {
                    printf(' <p class="howto">' . __('This <a href="%1$s">child theme</a> requires its parent theme, %2$s.') . '</p>', __('http://codex.wordpress.org/Child_Themes', 'redux-framework-demo'), $this->theme->parent()->display('Name'));
                }
                ?>

                </div>

            </div>

            <?php
            $item_info = ob_get_contents();

            ob_end_clean();

            $sampleHTML = '';
            if (file_exists(dirname(__FILE__) . '/info-html.html')) {
                /** @global WP_Filesystem_Direct $wp_filesystem  */
                global $wp_filesystem;
                if (empty($wp_filesystem)) {
                    require_once(ABSPATH . '/wp-admin/includes/file.php');
                    WP_Filesystem();
                }
                $sampleHTML = $wp_filesystem->get_contents(dirname(__FILE__) . '/info-html.html');
            }
			
            // ACTUAL DECLARATION OF SECTIONS          

            $this->sections[] = array(
                'icon' => 'el-icon-cogs',
                'title' => __('General Settings', 'liwa'),
                'fields' => array(					
					array(
                        'id' => 'google_id',
                        'type' => 'textarea',
                        'title' => __('Google Analytics Code javascript', 'liwa'),
                        'subtitle' => __('Input Javascript Code', 'liwa'),
                        'desc' => __('', 'liwa'),
                        'default' => ''
                    ),
					array(
                        'id' => 'seo_des',
                        'type' => 'textarea',
                        'title' => __('SEO Description', 'liwa'),
                        'subtitle' => __('', 'liwa'),
                        'desc' => __('', 'liwa'),
                        'default' => ''
                    ),
					array(
                        'id' => 'seo_key',
                        'type' => 'textarea',
                        'title' => __('SEO Keywords', 'liwa'),
                        'subtitle' => __('', 'liwa'),
                        'desc' => __('', 'liwa'),
                        'default' => ''
                    ), 
                )
            );
			
			$this->sections[] = array(
                'icon' => ' el-icon-picture',
                'title' => __('Logo & Favicon Settings', 'liwa'),
                'fields' => array(					
					array(
                        'id' => 'favicon',
                        'type' => 'media',
                        'url' => true,
                        'title' => __('Custom Favicon', 'liwa'),
                        'compiler' => 'true',
                        //'mode' => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                        'desc' => __('Upload your Favicon.', 'liwa'),
                        'subtitle' => __('', 'liwa'),
                        'default' => array('url' => get_template_directory_uri().'/images/favicon.ico'),
                    ),
					array(
                        'id' => 'logo',
                        'type' => 'media',
                        'url' => true,
                        'title' => __('Logo Upload', 'liwa'),
                        'compiler' => 'true',
                        //'mode' => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                        'desc' => __('', 'liwa'),
                        'subtitle' => __('Upload your logo.', 'liwa'),
                        'default' => array('url' => get_template_directory_uri().'/images/logo.png'),
                    ),
                )
            );
			
			$this->sections[] = array(
                'icon' => 'el-icon-list',
                'title' => __('Blog Settings', 'liwa'),
                'fields' => array(
					array(
                        'id' => 'blog_title',
                        'type' => 'text',
                        'title' => __('Blog Title', 'liwa'),
                        'subtitle' => __('Input Blog Title', 'liwa'),
                        'desc' => __('', 'liwa'),
                        'default' => 'Our blog'
                    ),							
					array(
                        'id' => 'blog_excerpt',
                        'type' => 'text',
                        'title' => __('Blog custom excerpt leng', 'liwa'),
                        'subtitle' => __('Input Blog custom excerpt leng', 'liwa'),
                        'desc' => __('', 'liwa'),
                        'default' => '30'
                    ),	
					array(
                        'id' => 'read_more',
                        'type' => 'text',
                        'title' => __('Button Text For Post', 'liwa'),
                        'subtitle' => __('Input Button Text', 'liwa'),
                        'desc' => __('', 'liwa'),
                        'default' => 'Read more'
                    ),
				 )
            );
			$this->sections[] = array(
                'icon' => 'el-icon-list',
                'title' => __('Portfolio Settings', 'liwa'),
                'fields' => array(								
					array(
                        'id' => 'portfolio_title_related',
                        'type' => 'text',
                        'title' => __('Portfolio Title Related', 'liwa'),
                        'subtitle' => __('', 'liwa'),
                        'desc' => __('', 'liwa'),
                        'default' => 'related projects'
                    ),					
                    array(
                        'id' => 'portfolio_project_details',
                        'type' => 'text',
                        'title' => __('Portfolio Project Details text', 'liwa'),
                        'subtitle' => __('', 'liwa'),
                        'desc' => __('', 'liwa'),
                        'default' => 'PROJECT DETAILS'
                    ),
					array(
                        'id' => 'portfolio_project_description',
                        'type' => 'text',
                        'title' => __('Portfolio Project Description text', 'liwa'),
                        'subtitle' => __('', 'liwa'),
                        'desc' => __('', 'liwa'),
                        'default' => 'Job Description'
                    ),
                    array(
                        'id' => 'portfolio_launch_project',
                        'type' => 'text',
                        'title' => __('Portfolio launch project text', 'liwa'),
                        'subtitle' => __('', 'liwa'),
                        'desc' => __('', 'liwa'),
                        'default' => 'Launch this project'
                    ),      
					array(
                        'id' => 'portfolio_read',
                        'type' => 'text',
                        'title' => __('Portfolio Take a look text', 'liwa'),
                        'subtitle' => __('', 'liwa'),
                        'desc' => __('', 'liwa'),
                        'default' => 'Take a look'
                    ), 	
				 )
            );
			$this->sections[] = array(
                'icon' => 'el-icon-group',
                'title' => __('Social Settings', 'liwa'),
                'fields' => array(
					array(
                        'id' => 'facebook',
                        'type' => 'text',
                        'title' => __('Facebook Url', 'liwa'),
                        //'mode' => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                        'default' => 'https://www.facebook.com/',
                    ),
					array(
                        'id' => 'google',
                        'type' => 'text',
                        'title' => __('Google+ Url', 'liwa'),
                        //'mode' => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                        'default' => 'https://plus.google.com',
                    ),
					array(
                        'id' => 'twitter',
                        'type' => 'text',
                        'title' => __('Twitter Url', 'liwa'),
                        //'mode' => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                        'default' => 'https://twitter.com/',
                    ),
					array(
                        'id' => 'linkedin',
                        'type' => 'text',
                        'title' => __('Linkedin Url', 'liwa'),
                        //'mode' => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                        'default' => 'https://www.linkedin.com/',
                    ),
					array(
                        'id' => 'dribbble',
                        'type' => 'text',
                        'title' => __('Dribbble Url', 'liwa'),
                        //'mode' => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                        'default' => 'https://www.dribbble.com/',
                    ),
					array(
                        'id' => 'pinterest',
                        'type' => 'text',
                        'title' => __('Pinterest Url', 'liwa'),
                        //'mode' => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                        'default' => '#'
                    ),
					array(
                        'id' => 'instagram',
                        'type' => 'text',
                        'title' => __('Instagram Url', 'liwa'),
                        //'mode' => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                        'default' => '#'
                    ),
					array(
                        'id' => 'vimeo',
                        'type' => 'text',
                        'title' => __('Vimeo Url', 'liwa'),
                        //'mode' => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                        'default' => '#'
                    ),
				)
			);
			$this->sections[] = array(
                'icon' => 'el-icon-graph',
                'title' => __('404 Settings', 'liwa'),
                'fields' => array(
					 array(
                        'id' => '404_title',
                        'type' => 'text',
                        'title' => __('404 Title', 'liwa'),
                        'subtitle' => __('Input 404 Title', 'liwa'),
                        'desc' => __('', 'liwa'),
                        'default' => '404'
                    ),						 		
					 array(
                        'id' => '404_content',
                        'type' => 'editor',
                        'title' => __('404 Content', 'liwa'),
                        'subtitle' => __('Enter 404 Content', 'liwa'),
                        'desc' => __('', 'liwa'),
                        'default' => 'The page you are looking for no longer exists. Perhaps you can return back to the sites homepage see you can find what you are looking for.'
                    ),					 
				 )
            );

			$this->sections[] = array(
                'icon' => ' el-icon-credit-card',
                'title' => __('Footer Settings', 'liwa'),
                'fields' => array(						
					array(
                        'id' => 'footer_text',
                        'type' => 'editor',
                        'title' => __('Footer Text', 'liwa'),
                        'subtitle' => __('Copyright Text', 'liwa'),
                        'default' => '<p>All rights reserved, 2014</p>',
                    )	
				)
			);
            $this->sections[] = array(
                'icon' => 'el-icon-website',
                'title' => __('Styling Options', 'liwa'),
                'fields' => array(
					array(
                        'id' => 'rtl',
                        'type' => 'checkbox',
                        'title' => __('Support RTL language', 'liwa'),
                        'subtitle' => '',
                        'desc' => '',
                        'default' => '0'// 1 = on | 0 = off
                    ),
                    array(
                        'id' => 'main-color',
                        'type' => 'color',
                        'title' => __('Theme Main Color', 'liwa'),
                        'subtitle' => __('Pick the main color for the theme (default: #4697c1).', 'liwa'),
                        'default' => '#4697c1',
                        'validate' => 'color',
                    ),	
                    array(
                        'id' => 'background-footer',
                        'type' => 'color',
                        'title' => __('Footer Background Color', 'liwa'),
                        'subtitle' => __('Pick a background color for the footer (default: #fafafa).', 'liwa'),
                        'default' => '#fafafa',
                        'validate' => 'color',
                    ),
					array(
                        'id' => 'color-footer',
                        'type' => 'color',
                        'title' => __('Footer  Color', 'liwa'),
                        'subtitle' => __('Pick a  color for the footer (default: #888888).', 'liwa'),
                        'default' => '#888888',
                        'validate' => 'color',
                    ),
                    
                    array(
                        'id' => 'body-font2',
                        'type' => 'typography',
						'output' => array('body'),
                        'title' => __('Body Font', 'liwa'),
                        'subtitle' => __('Specify the body font properties.', 'liwa'),
                        'google' => true,
                        'default' => array(
                            'color' => '#888888',
                            'font-size' => '14px',
                            'line-height' => '24px',
                            'font-family' => "",
                        ),
                    ),
                     array(
                        'id' => 'custom-css',
                        'type' => 'ace_editor',
                        'title' => __('CSS Code', 'liwa'),
                        'subtitle' => __('Paste your CSS code here.', 'liwa'),
                        'mode' => 'css',
                        'theme' => 'monokai',
                        'desc' => 'Possible modes can be found at <a href="http://ace.c9.io" target="_blank">http://ace.c9.io/</a>.',
                        'default' => "#header{\nmargin: 0 auto;\n}"
                    ),
                )
            );
			
            $theme_info = '<div class="redux-framework-section-desc">';
            $theme_info .= '<p class="redux-framework-theme-data description theme-uri">' . __('<strong>Theme URL:</strong> ', 'liwa') . '<a href="' . $this->theme->get('ThemeURI') . '" target="_blank">' . $this->theme->get('ThemeURI') . '</a></p>';
            $theme_info .= '<p class="redux-framework-theme-data description theme-author">' . __('<strong>Author:</strong> ', 'liwa') . $this->theme->get('Author') . '</p>';
            $theme_info .= '<p class="redux-framework-theme-data description theme-version">' . __('<strong>Version:</strong> ', 'liwa') . $this->theme->get('Version') . '</p>';
            $theme_info .= '<p class="redux-framework-theme-data description theme-description">' . $this->theme->get('Description') . '</p>';
            $tabs = $this->theme->get('Tags');
            if (!empty($tabs)) {
                $theme_info .= '<p class="redux-framework-theme-data description theme-tags">' . __('<strong>Tags:</strong> ', 'liwa') . implode(', ', $tabs) . '</p>';
            }
            $theme_info .= '</div>';

            if (file_exists(dirname(__FILE__) . '/../README.md')) {
                $this->sections['theme_docs'] = array(
                    'icon' => 'el-icon-list-alt',
                    'title' => __('Documentation', 'liwa'),
                    'fields' => array(
                        array(
                            'id' => '17',
                            'type' => 'raw',
                            'markdown' => true,
                            'content' => file_get_contents(dirname(__FILE__) . '/../README.md')
                        ),
                    ),
                );
            }//if
            

            $this->sections[] = array(
                'type' => 'divide',
            );

            $this->sections[] = array(
                'icon' => 'el-icon-info-sign',
                'title' => __('Theme Information', 'liwa'),
                'desc' => __('<p class="description">This is the Description. Again HTML is allowed</p>', 'liwa'),
                'fields' => array(
                    array(
                        'id' => 'raw_new_info',
                        'type' => 'raw',
                        'content' => $item_info,
                    )
                ),
            );

            if (file_exists(trailingslashit(dirname(__FILE__)) . 'README.html')) {
                $tabs['docs'] = array(
                    'icon' => 'el-icon-book',
                    'title' => __('Documentation', 'liwa'),
                    'content' => nl2br(file_get_contents(trailingslashit(dirname(__FILE__)) . 'README.html'))
                );
            }
        }

        public function setHelpTabs() {

            // Custom page help tabs, displayed using the help API. Tabs are shown in order of definition.
            $this->args['help_tabs'][] = array(
                'id' => 'redux-opts-1',
                'title' => __('Theme Information 1', 'liwa'),
                'content' => __('<p>This is the tab content, HTML is allowed.</p>', 'liwa')
            );

            $this->args['help_tabs'][] = array(
                'id' => 'redux-opts-2',
                'title' => __('Theme Information 2', 'liwa'),
                'content' => __('<p>This is the tab content, HTML is allowed.</p>', 'liwa')
            );

            // Set the help sidebar
            $this->args['help_sidebar'] = __('<p>This is the sidebar content, HTML is allowed.</p>', 'liwa');
        }

        /**

          All the possible arguments for Redux.
          For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments

         * */
        public function setArguments() {

            $theme = wp_get_theme(); // For use with some settings. Not necessary.

            $this->args = array(
                // TYPICAL -> Change these values as you need/desire
                'opt_name' => 'theme_option', // This is where your data is stored in the database and also becomes your global variable name.
                'display_name' => $theme->get('Name'), // Name that appears at the top of your panel
                'display_version' => $theme->get('Version'), // Version that appears at the top of your panel
                'menu_type' => 'menu', //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
                'allow_sub_menu' => true, // Show the sections below the admin menu item or not
                'menu_title' => __('Theme Options', 'liwa'),
                'page' => __('Theme Options', 'liwa'),
                // You will need to generate a Google API key to use this feature.
                // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
                'google_api_key' => 'AIzaSyBM9vxebWLN3bq4Urobnr6tEtn7zM06rEw', // Must be defined to add google fonts to the typography module
                //'admin_bar' => false, // Show the panel pages on the admin bar
                'global_variable' => '', // Set a different name for your global variable other than the opt_name
                'dev_mode' => true, // Show the time the page took to load, etc
                'customizer' => true, // Enable basic customizer support
                // OPTIONAL -> Give you extra features
                'page_priority' => null, // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
                'page_parent' => 'themes.php', // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
                'page_permissions' => 'manage_options', // Permissions needed to access the options panel.
                'menu_icon' => '', // Specify a custom URL to an icon
                'last_tab' => '', // Force your panel to always open to a specific tab (by id)
                'page_icon' => 'icon-themes', // Icon displayed in the admin panel next to your menu_title
                'page_slug' => '_options', // Page slug used to denote the panel
                'save_defaults' => true, // On load save the defaults to DB before user clicks save or not
                'default_show' => false, // If true, shows the default value next to each field that is not the default value.
                'default_mark' => '', // What to print by the field's title if the value shown is default. Suggested: *
                // CAREFUL -> These options are for advanced use only
                'transient_time' => 60 * MINUTE_IN_SECONDS,
                'output' => true, // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
                'output_tag' => true, // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
                //'domain'             	=> 'redux-framework', // Translation domain key. Don't change this unless you want to retranslate all of Redux.
                //'footer_credit'      	=> '', // Disable the footer credit of Redux. Please leave if you can help it.
                // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
                'database' => '', // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
                'show_import_export' => true, // REMOVE
                'system_info' => false, // REMOVE
                'help_tabs' => array(),
                'help_sidebar' => '', // __( '', $this->args['domain'] );            
            );


            // SOCIAL ICONS -> Setup custom links in the footer for quick links in your panel footer icons.		
            $this->args['share_icons'][] = array(
                'url' => 'https://github.com/ReduxFramework/ReduxFramework',
                'title' => 'Visit us on GitHub',
                'icon' => 'el-icon-github'
                    // 'img' => '', // You can use icon OR img. IMG needs to be a full URL.
            );
            $this->args['share_icons'][] = array(
                'url' => 'https://www.facebook.com/pages/Redux-Framework/243141545850368',
                'title' => 'Like us on Facebook',
                'icon' => 'el-icon-facebook'
            );
            $this->args['share_icons'][] = array(
                'url' => 'http://twitter.com/reduxframework',
                'title' => 'Follow us on Twitter',
                'icon' => 'el-icon-twitter'
            );
            $this->args['share_icons'][] = array(
                'url' => 'http://www.linkedin.com/company/redux-framework',
                'title' => 'Find us on LinkedIn',
                'icon' => 'el-icon-linkedin'
            );



            // Panel Intro text -> before the form
            if (!isset($this->args['global_variable']) || $this->args['global_variable'] !== false) {
                if (!empty($this->args['global_variable'])) {
                    $v = $this->args['global_variable'];
                } else {
                    $v = str_replace("-", "_", $this->args['opt_name']);
                }
                $this->args['intro_text'] = sprintf(__('<p>Did you know that Redux sets a global variable for you? To access any of your saved options from within your code you can use your global variable: <strong>$%1$s</strong></p>', 'liwa'), $v);
            } else {
                $this->args['intro_text'] = __('<p>This text is displayed above the options panel. It isn\'t required, but more info is always better! The intro_text field accepts all HTML.</p>', 'liwa');
            }

            // Add content after the form.
            $this->args['footer_text'] = __('<p>This text is displayed below the options panel. It isn\'t required, but more info is always better! The footer_text field accepts all HTML.</p>', 'liwa');
        }

    }

    new Redux_Framework_sample_config();
}


/**

  Custom function for the callback referenced above

 */
if (!function_exists('redux_my_custom_field')):

    function redux_my_custom_field($field, $value) {
        print_r($field);
        print_r($value);
    }

endif;

/**

  Custom function for the callback validation referenced above

 * */
if (!function_exists('redux_validate_callback_function')):

    function redux_validate_callback_function($field, $value, $existing_value) {
        $error = false;
        $value = 'just testing';
        /*
          do your validation

          if(something) {
          $value = $value;
          } elseif(something else) {
          $error = true;
          $value = $existing_value;
          $field['msg'] = 'your custom error message';
          }
         */

        $return['value'] = $value;
        if ($error == true) {
            $return['error'] = $field;
        }
        return $return;
    }


endif;
