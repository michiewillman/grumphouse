<?php

/*	-----------------------------------------------------------------------------------------------
	THEME SUPPORTS
--------------------------------------------------------------------------------------------------- */

function grumphouse_setup() {
	add_editor_style( 'style.css' );
}
add_action( 'after_setup_theme', 'grumphouse_setup' );


/*	-----------------------------------------------------------------------------------------------
	ENQUEUE STYLES
--------------------------------------------------------------------------------------------------- */

function grumphouse_styles() {
	wp_enqueue_style( 'grumphouse-styles', get_template_directory_uri() . '/style.css', array(), wp_get_theme( 'grumphouse' )->get( 'Version' ) );
}
add_action( 'wp_enqueue_scripts', 'grumphouse_styles' );


/*	-----------------------------------------------------------------------------------------------
	BLOCK PATTERN CATEGORIES
	Register categories for the block patterns.
--------------------------------------------------------------------------------------------------- */

if ( ! function_exists( 'grumphouse_register_block_patterns' ) ) : 
	function grumphouse_register_block_patterns() {

		// The block pattern categories included in grumphouse.
		$grumphouse_block_pattern_categories = apply_filters( 'grumphouse_block_pattern_categories', array(
			'grumphouse-blog' => array(
				'label'			=> esc_html__( 'grumphouse Blog', 'grumphouse' ),
			),
			'grumphouse-cta'  => array(
				'label'			=> esc_html__( 'grumphouse Call to Action', 'grumphouse' ),
			),
			'grumphouse-footer' => array(
				'label'			=> esc_html__( 'grumphouse Footer', 'grumphouse' ),
			),
			'grumphouse-general' => array(
				'label'			=> esc_html__( 'grumphouse General', 'grumphouse' ),
			),
			'grumphouse-header' => array(
				'label'			=> esc_html__( 'grumphouse Header', 'grumphouse' ),
			),
			'grumphouse-hero' => array(
				'label'			=> esc_html__( 'grumphouse Hero', 'grumphouse' ),
			),
			'grumphouse-restaurant' => array(
				'label'			=> esc_html__( 'grumphouse Restaurant', 'grumphouse' ),
			),
		) );

		// Sort the block pattern categories alphabetically based on the label value, to ensure alphabetized order when the strings are localized.
		uasort( $grumphouse_block_pattern_categories, function( $a, $b ) { 
			return strcmp( $a["label"], $b["label"] ); }
		);

		// Register block pattern categories.
		foreach ( $grumphouse_block_pattern_categories as $slug => $settings ) {
			register_block_pattern_category( $slug, $settings );
		}
	
	}
	add_action( 'init', 'grumphouse_register_block_patterns' );
endif;


/*	-----------------------------------------------------------------------------------------------
	BLOCK STYLES
	Register theme specific block styles.
--------------------------------------------------------------------------------------------------- */

if ( ! function_exists( 'grumphouse_register_block_styles' ) ) :
	function grumphouse_register_block_styles() {

		// Shared: Shaded.
		$supports_shaded_block_style = apply_filters( 'grumphouse_supports_shaded_block_style', array( 'core/columns', 'core/group', 'core/image', 'core/media-text', 'core/social-links' ) );

		foreach ( $supports_shaded_block_style as $block_name ) {
			register_block_style( $block_name, array(
				'name'  	=> 'grumphouse-shaded',
				'label' 	=> esc_html__( 'Shaded', 'grumphouse' ),
			) );
		}

		// Button: Plain
		register_block_style( 'core/button', array(
			'name'  	=> 'grumphouse-plain',
			'label' 	=> esc_html__( 'Plain', 'grumphouse' ),
		) );

		// Query Pagination: Vertical separators
		register_block_style( 'core/query-pagination', array(
			'name'  	=> 'grumphouse-vertical-separators',
			'label' 	=> esc_html__( 'Vertical Separators', 'grumphouse' ),
		) );

		// Query Pagination: Top separator
		register_block_style( 'core/query-pagination', array(
			'name'  	=> 'grumphouse-top-separator',
			'label' 	=> esc_html__( 'Top Separator', 'grumphouse' ),
		) );

		// Table: Vertical borders
		register_block_style( 'core/table', array(
			'name'  	=> 'grumphouse-vertical-borders',
			'label' 	=> esc_html__( 'Vertical Borders', 'grumphouse' ),
		) );
		
	}
	add_action( 'init', 'grumphouse_register_block_styles' );
endif;
