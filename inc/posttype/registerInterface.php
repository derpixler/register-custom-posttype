<?php # -*- coding: utf-8 -*-

namespace posttype;

/**
 * Interface register_posttype_interface
 *
 * @package posttype
 */
interface register_posttype_interface {

	/**
	 * @return string
	 */
	public function add();

	/**
	 * @return array
	 */
	public function labels();

	/**
	 * @return array
	 */
	public function supports();

	/**
	 * @return array
	 */
	public function taxonomies();

	/**
	 * @return array
	 */
	public function rewrite();

	/**
	 * @return array
	 */
	public function attributes();
}