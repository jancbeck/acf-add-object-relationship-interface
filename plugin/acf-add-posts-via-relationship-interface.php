<?php
/*
Plugin Name: ACF - Add posts via relationship interface
Description: Create posts from the relationship interface of the advanced custom fields plugin if they do not exist yet.
Plugin URI: https://github.com/jancbeck/acf-add-posts-via-relationship-interface
Author: Jan Beck
Author URI: http://jancbeck.com
Version: 1.0.6
License: GPL2
Text Domain: acf-add-posts-via-relationship-interface
*/

/*

    Copyright (C) 2015 Jan Beck mail@jancbeck.com

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

define( 'ACF_ADD_REL_PATH', plugin_dir_path( __FILE__ ) );
define( 'ACF_ADD_REL_URL', plugin_dir_url( __FILE__ ) );

/**
 *  Register plugins styles and scripts
 *
 *  @return  void
 */
function admin_enqueue_scripts_acf_rel() {
	wp_enqueue_style( 'acf-add-rel', ACF_ADD_REL_URL . 'css/acf-add-rel.css', array( 'acf-input' ), '1.0.0' );
	wp_enqueue_script( 'acf-add-rel', ACF_ADD_REL_URL . 'js/acf-add-rel.js', array( 'acf-input' ), '1.0.0', true );
	wp_localize_script( 'acf-add-rel', 'ACFaddRelL10n', array( 'confirmTitle' => __( 'Do you want to create a new object called "{title}"?', 'acf-add-posts-via-relationship-interface' ) ) );
}
add_action('acf/input/admin_enqueue_scripts', 'admin_enqueue_scripts_acf_rel');

/**
 *  Create new posts via ajax.
 *  Requires title and post_type to be present in $_POST
 *
 *  @return  array
 */
function acf_create_rel_post() {

	// validate nonce first
	if( ! wp_verify_nonce( $_POST['nonce'], 'acf_nonce' ) ) {
		wp_send_json_error();
	}
	if ( ! current_user_can( 'publish_posts' ) ) {
		wp_send_json_error();
	}

	// collect and santize data before insertion
	$title     = sanitize_post_field( 'post_title', $_POST['title'], null, 'db' );
	$post_type = sanitize_post_field( 'post_type', $_POST['post_type'][0], null, 'db' );

	if ( ! empty( $title ) && ! empty( $post_type ) ) {
		// allow other developers to filter arguments
		$post_id = wp_insert_post( apply_filters( 'acf_add_rel_post_args', array( 'post_type' => $post_type, 'post_title' => $title ) ) );
	}

	wp_send_json_success( apply_filters( 'acf_add_rel_post_created', $post_id ));

}
add_action( 'wp_ajax_acf/fields/relationship/create_post', 'acf_create_rel_post' );

function acf_load_plugin_textdomain() {
    load_plugin_textdomain( 'acf-add-posts-via-relationship-interface', FALSE, basename( dirname( __FILE__ ) ) );
}
add_action( 'plugins_loaded', 'acf_load_plugin_textdomain' );
