<?php # -*- coding: utf-8 -*-
/**
 * Plugin Name: my Posttype
 * Description: Create Posttype
 * Author:      René Reimann
 * Author URI:  http://www.rene-reimann.de
 * Version:     0.1
 * Domain Path: /languages
 * License:     GPLv3
 */
namespace playground\tool;

function init() {

	$files = array(
		'posttype/registerInterface',
		'posttype/register',
	);

	foreach ( $files as $file ) {
		require __DIR__ . '/inc/' . $file . '.php';
	}

	$posttypes = array(
		'posttypes' => array(

			# Mailibg
			'mailing' => array(
				'name'          => 'Mailings',
				'singular_name' => 'Mailing',
				'slug'          => 'mailing',
				'supports'      => array(
					'title',
					'page-attributes',
					'revisions',
					'thumbnail',
					'author',
					'editor'
				),
				'taxonomies'    => array( FALSE ),
				'attributes'    => array(
					'hierarchical'      => TRUE,
					'custom_capability' => TRUE
				)
			),

		),

	);

	$posttypes = new \posttype\register_posttype( false, $posttypes );
	$posttypes->add();

}

add_action( 'init', __NAMESPACE__ . '\init' );