<?php
/*adding sections for header social options */
$wp_customize->add_section( 'supermag-header-social', array(
    'priority'       => 20,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Social Options', 'supermag' ),
    'panel'          => 'supermag-header-panel'
) );

/*facebook url*/
$wp_customize->add_setting( 'supermag_theme_options[supermag-facebook-url]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['supermag-facebook-url'],
    'sanitize_callback' => 'esc_url_raw',
) );
$wp_customize->add_control( 'supermag_theme_options[supermag-facebook-url]', array(
    'label'		=> __( 'Facebook url', 'supermag' ),
    'section'   => 'supermag-header-social',
    'settings'  => 'supermag_theme_options[supermag-facebook-url]',
    'type'	  	=> 'url',
    'priority'  => 20
) );

/*twitter url*/
$wp_customize->add_setting( 'supermag_theme_options[supermag-twitter-url]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['supermag-twitter-url'],
    'sanitize_callback' => 'esc_url_raw',
) );
$wp_customize->add_control( 'supermag_theme_options[supermag-twitter-url]', array(
    'label'		=> __( 'Twitter url', 'supermag' ),
    'section'   => 'supermag-header-social',
    'settings'  => 'supermag_theme_options[supermag-twitter-url]',
    'type'	  	=> 'url',
    'priority'  => 25
) );

/*youtube url*/
$wp_customize->add_setting( 'supermag_theme_options[supermag-youtube-url]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['supermag-youtube-url'],
    'sanitize_callback' => 'esc_url_raw',
) );
$wp_customize->add_control( 'supermag_theme_options[supermag-youtube-url]', array(
    'label'		=> __( 'Youtube url', 'supermag' ),
    'section'   => 'supermag-header-social',
    'settings'  => 'supermag_theme_options[supermag-youtube-url]',
    'type'	  	=> 'url',
    'priority'  => 25
) );

/*enable social*/
$wp_customize->add_setting( 'supermag_theme_options[supermag-enable-social]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['supermag-enable-social'],
    'sanitize_callback' => 'supermag_sanitize_checkbox',
) );
$wp_customize->add_control( 'supermag_theme_options[supermag-enable-social]', array(
    'label'		=> __( 'Enable social', 'supermag' ),
    'section'   => 'supermag-header-social',
    'settings'  => 'supermag_theme_options[supermag-enable-social]',
    'type'	  	=> 'checkbox',
    'priority'  => 30
) );