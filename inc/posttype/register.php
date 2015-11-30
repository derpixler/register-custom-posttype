<?php # -*- coding: utf-8 -*-
namespace posttype;

class register_posttype implements register_posttype_interface {

	/**
	 * internal list of posttypes
	 *
	 * @type array
	 */
	private $posttypes = array();

	/**
	 * a single posttype
	 *
	 * @type array
	 */
	private $posttype = array();

	/**
	 * @param $posttypes
	 */
	public function __construct( $init, $posttypes ) {

		$this->init = $init;
		$this->posttypes = $posttypes['posttypes'];

	}

	public function add() {

		foreach ( $this->posttypes as $posttype ) {

			$this->posttype = $posttype;

			register_post_type( $posttype[ 'slug' ], $this->attributes() );

		}

	}

	public function labels() {

		$labels = array(
			'name'               => _x( $this->posttype[ 'name' ], 'Post type general name', $this->posttype[ 'slug' ] ),
			'singular_name'      => _x( $this->posttype[ 'singular_name' ], 'Post type singular name', $this->posttype[ 'slug' ] ),
			'menu_name'          => _x( $this->posttype[ 'name' ], 'Post type menu name', $this->posttype[ 'slug' ] ),
			'name_admin_bar'     => _x( $this->posttype[ 'name' ], 'Post type admin bar name', $this->posttype[ 'slug' ] ),
			'all_items'          => __( $this->posttype[ 'name' ], $this->posttype[ 'slug' ] ),
			'add_new'            => _x( 'Erstellen', 'Add new post', $this->posttype[ 'slug' ] ),
			'add_new_item'       => __( 'Neues ' . $this->posttype[ 'singular_name' ] . ' erstellen', $this->posttype[ 'slug' ] ),
			'edit_item'          => __( $this->posttype[ 'singular_name' ] . ' bearbeiten', $this->posttype[ 'slug' ] ),
			'new_item'           => __( 'Neuen ' . $this->posttype[ 'singular_name' ], $this->posttype[ 'slug' ] ),
			'view_item'          => __( $this->posttype[ 'singular_name' ] . ' anzeigen', $this->posttype[ 'slug' ] ),
			'search_items'       => __( $this->posttype[ 'singular_name' ] . ' suchen', $this->posttype[ 'slug' ] ),
			'not_found'          => __( 'Keine ' . $this->posttype[ 'name' ] . ' gefunden.', $this->posttype[ 'slug' ] ),
			'not_found_in_trash' => __( 'Keinwn ' . $this->posttype[ 'singular_name' ] . ' im Papierkorb gefunden.', $this->posttype[ 'slug' ] ),
			'parent_item_colon'  => '',
			'parent'             => __( $this->posttype[ 'singular_name' ] )
		);

		return $labels;
	}

	/**
	 * @return array
	 */
	public function supports() {

		$defaults = array(
			'title',
			'editor',
			'author',
			'thumbnail',
			'excerpt',
			'trackbacks',
			'custom-fields',
			'comments',
			'revisions',
			'page-attributes',
			'post-formats',
		);

		$supports = $defaults;

		if ( ! empty( $this->posttype[ 'supports' ] ) ) {

			$supports = $this->posttype[ 'supports' ];
		}

		return $supports;

	}

	/**
	 * @return array
	 */
	public function taxonomies() {

		$defaults = array(
			'category',
			'post_tag',
		);

		$taxonomies = $defaults;

		if ( ! empty( $this->posttype[ 'taxonomies' ] ) ) {

			$taxonomies = $this->posttype[ 'taxonomies' ];

		}

		return $taxonomies;
	}

	/**
	 * @return array
	 */
	public function rewrite() {

		$defaults = array(
			'slug'       => $this->posttype[ 'slug' ],
			'with_front' => FALSE,
		);

		$rewrite = $defaults;

		if ( ! empty( $this->posttype[ 'rewrite' ] ) ) {
			$rewrite = wp_parse_args( $rewrite, $defaults );
		}

		return $rewrite;
	}

	/**
	 * @return mixed
	 */
	public function attributes() {

		$defaults = array(
			'labels'              => $this->labels(),
			'description'         => '',
			'public'              => TRUE,
			'exclude_from_search' => TRUE,
			'publicly_queryable'  => TRUE,
			'show_ui'             => TRUE,
			'show_in_nav_menus'   => TRUE,
			'show_in_menu'        => TRUE,
			'hierarchical'        => FALSE,
			'supports'            => $this->supports(),
			'taxonomies'          => $this->taxonomies(),
			'has_archive'         => TRUE,
			'rewrite'             => $this->rewrite(),
			'menu_icon'           => FALSE,

		);

		$attributes = wp_parse_args( $this->posttype[ 'attributes' ], $defaults );

		if ( isset( $this->posttype[ 'attributes' ][ 'custom_capability' ] ) ) {

			$attributes[ 'capability_type' ] = array( $this->posttype[ 'slug' ], $this->posttype[ 'slug' ] . 's' );
			$attributes[ 'map_meta_cap' ]    = TRUE;

		}

		return $attributes;
	}

}