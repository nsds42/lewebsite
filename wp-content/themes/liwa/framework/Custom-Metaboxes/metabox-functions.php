<?php
/**
 * Include and setup custom metaboxes and fields.
 *
 * @category YourThemeOrPlugin
 * @package  Metaboxes
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     https://github.com/jaredatch/Custom-Metaboxes-and-Fields-for-WordPress
 */

add_filter( 'cmb_meta_boxes', 'cmb_sample_metaboxes' );
/**
 * Define the metabox and field configurations.
 *
 * @param  array $meta_boxes
 * @return array
 */
function cmb_sample_metaboxes( array $meta_boxes ) {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_cmb_';
	
    $meta_boxes[] = array(
        'id'         => 'page_setting',
        'title'      => 'Page Setting',
        'pages'      => array('page'), // Post type
        'context'    => 'normal',
        'priority'   => 'high',
        'show_names' => true, // Show field names on the left
        //'show_on'    => array( 'key' => 'id', 'value' => array( 2, ), ), // Specific post IDs to display this metabox
        'fields' => array(
            array(
                'name' => 'Page Sub Title',
                'desc' => 'Set Page Sub Title',
                'id'   => $prefix . 'page_sub_title',
                'type' => 'wysiwyg',
				'options' => array(),
            ),   
			array(
				'name' => __( 'Icon Class', 'cmb' ),
				'desc' => __( 'Add icon class. Ex: icon-beaker (link icon: http://fortawesome.github.io/Font-Awesome/3.2.1/icons/)', 'cmb' ),
				'id'   => $prefix . 'icon_class',
				'type' => 'text'
			),	
			array(
                'name' => 'Show/Hide Breadcrumb',
                'desc' => 'Show/Hide Breadcrumb -> Only Page Canvas',
                'id'   => $prefix . 'breadcrumb_page',
                'type'    => 'select',
                'options' => array(
                    array( 'name' => 'Show', 'value' => 'show', ),
                    array( 'name' => 'Hide', 'value' => 'hide', ),
                    )
            ), 	
        )
    );
	// Add other metaboxes as needed
	
	$meta_boxes[] = array(
        'id'         => 'post_setting',
        'title'      => 'Post Setting',
        'pages'      => array('post'), // Post type
        'context'    => 'normal',
        'priority'   => 'high',
        'show_names' => true, // Show field names on the left
        //'show_on'    => array( 'key' => 'id', 'value' => array( 2, ), ), // Specific post IDs to display this metabox
        'fields' => array(              			 
            array(
				'name' => __( 'Link Audio', 'cmb' ),
				'desc' => __( 'Add link Audio Soundcloud. Ex: https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/139083759', 'cmb' ),
				'id'   => $prefix . 'link_audio',
				'type' => 'text'
			),
			array(
				'name' => __( 'Link Video', 'cmb' ),
				'desc' => __( 'Add link Video Youtube, Vimeo. Ex: http://www.youtube.com/embed/eP2VWNtU5rw or http://player.vimeo.com/video/20249835', 'cmb' ),
				'id'   => $prefix . 'link_video',
				'type' => 'text'
			), 
        )
    );
	// Add other metaboxes as needed
	
	$meta_boxes[] = array(
        'id'         => 'portfolio_setting',
        'title'      => 'Portfolio Setting',
        'pages'      => array('portfolio'), // Post type
        'context'    => 'normal',
        'priority'   => 'high',
        'show_names' => true, // Show field names on the left
        //'show_on'    => array( 'key' => 'id', 'value' => array( 2, ), ), // Specific post IDs to display this metabox
        'fields' => array(        
			array(
                'name' => 'Selected Single Layout',
                'desc' => 'Options Single Layout.',
                'id'   => $prefix . 'project_layout',
                'type'    => 'select',
                'options' => array(
                    array( 'name' => 'Two Columns', 'value' => 'half', ),
                    array( 'name' => 'Full Width ', 'value' => 'wide', ),
                    )
            ), 
			array(
				'name' => 'Information',
				'desc' => 'Description Information (optional)',
				'id' => $prefix . 'information',
				'type' => 'wysiwyg',
				'options' => array(),
			),
			array(
                'name' => 'Launch Project',
                'desc' => 'Link Out Project',
                'id'   => $prefix . 'portfolio_project',
                'type'    => 'text',
            ),    
			array(
                'name' => 'Link Audio',
                'desc' => 'Add link Audio Soundcloud. Ex: https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/139083759',
                'id'   => $prefix . 'portfolio_audio',
                'type'    => 'text',
            ),
			array(
                'name' => 'Link video',
                'desc' => 'Link youtube, link vimeo, Example: http://www.youtube.com/embed/0ecv0bT9DEo',
                'id'   => $prefix . 'portfolio_video',
                'type'    => 'text',
            ), 
        )
    );
	// Add other metaboxes as needed
	
	$meta_boxes[] = array(
        'id'         => 'team_setting',
        'title'      => 'Our Team Setting',
        'pages'      => array('team'), // Post type
        'context'    => 'normal',
        'priority'   => 'high',
        'show_names' => true, // Show field names on the left
        //'show_on'    => array( 'key' => 'id', 'value' => array( 2, ), ), // Specific post IDs to display this metabox
        'fields' => array(      
			array(
                'name' => 'Job',
                'desc' => 'Job',
                'id'   => $prefix . 'team_job',
                'type'    => 'text',
            ), 
			array(
                'name' => 'Upload Background Image for Top Single Page',
                'desc' => 'Upload an image or enter an URL.',
                'id' => $prefix . 'image_thumbnail',
                'type' => 'file',
                'allow' => array( 'url', 'attachment' ) // limit to just attachments with array( 'attachment' )
            ), 
			array(
                'name' => 'Link Twitter',
                'desc' => 'Link Out Social',
                'id'   => $prefix . 'twitter',
                'type'    => 'text',
            ), 	
			array(
                'name' => 'Link Facebook',
                'desc' => 'Link Out Social',
                'id'   => $prefix . 'facebook',
                'type'    => 'text',
            ), 	
			array(
                'name' => 'Link Linkedin',
                'desc' => 'Link Out Social',
                'id'   => $prefix . 'linkedin',
                'type'    => 'text',
            ), 
			array(
                'name' => 'Link Google Plus',
                'desc' => 'Link Out Social',
                'id'   => $prefix . 'googleplus',
                'type'    => 'text',
            ), 
			array(
                'name' => 'Link Dribbble',
                'desc' => 'Link Out Social',
                'id'   => $prefix . 'dribbble',
                'type'    => 'text',
            ), 
			array(
                'name' => 'Link Forrst',
                'desc' => 'Link Out Social',
                'id'   => $prefix . 'forrst',
                'type'    => 'text',
            ), 
			array(
                'name' => 'Link Pinterest',
                'desc' => 'Link Out Social',
                'id'   => $prefix . 'pinterest',
                'type'    => 'text',
            ), 
			array(
                'name' => 'Link Github',
                'desc' => 'Link Out Social',
                'id'   => $prefix . 'github',
                'type'    => 'text',
            ), 
			array(
                'name' => 'Link Instagram',
                'desc' => 'Link Out Social',
                'id'   => $prefix . 'instagram',
                'type'    => 'text',
            ), 
			array(
                'name' => 'Link Tumblr',
                'desc' => 'Link Out Social',
                'id'   => $prefix . 'tumblr',
                'type'    => 'text',
            ), 
			array(
				'name' => 'My Skills',
				'desc' => 'Add My Skills (optional)',
				'id' => $prefix . 'teamskills',
				'type' => 'wysiwyg',
				'options' => array(),
			),
        )
    );
	// Add other metaboxes as needed
	
	$meta_boxes[] = array(
		'id'         => 'seo_fields',
		'title'      => 'WordPress SEO by VergaTheme',
		'pages'      => array( 'page', 'post','portfolio'), // Post type
		'context'    => 'normal',
        'priority'   => 'high',
        'show_names' => true, // Show field names on the left
		//'show_on'    => array( 'key' => 'id', 'value' => array( 2, ), ), // Specific post IDs to display this metabox
		'fields' => array(
			array(
                'name' => 'Focus Keyword:',
                'desc' => 'SEO keywords (optional)',
                'id'   => $prefix . 'seo_keywords',
                'type' => 'text',
            ),
			array(
				'name' => 'SEO Title:',
				'desc' => 'Title display in search engines is limited to 70 chars.',
				'id'   => $prefix . 'seo_title',
				'type' => 'text',
			),
            array(
                'name' => 'Meta Description:',
                'desc' => 'The meta description will be limited to 156 chars.',
                'id'   => $prefix . 'seo_description',
                'type' => 'textarea',
            ),
		)
	);
	// Add other metaboxes as needed
	
	return $meta_boxes;
}

add_action( 'init', 'cmb_initialize_cmb_meta_boxes', 9999 );
/**
 * Initialize the metabox class.
 */
function cmb_initialize_cmb_meta_boxes() {

	if ( ! class_exists( 'cmb_Meta_Box' ) )
		require_once 'init.php';

}
