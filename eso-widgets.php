<?php
/*
Plugin Name: ESO Widgets
Description: ESO Widgets enables ingame-like tooltips and skill bars for Elder Scrolls Online on your site.
Version:     1.3
Author:      ElderScrollsBote.de
Author URI:  https://www.elderscrollsbote.de/
License:     GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html

ESO Widgets is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.

ESO Widgets is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with ESO Widgets. If not, see https://www.gnu.org/licenses/gpl-2.0.html.
*/

defined( 'ABSPATH' ) || exit;

final class ESOWidgets
{
	public function __construct() { }

	public static function instance()
	{
		static $instance = null;

		if ( null === $instance ) {
			$instance = new ESOWidgets();

			add_action( 'wp_head', array( $instance, 'addScript' ) );
			add_action( 'wp_head', array( $instance, 'addStyle' ) );
			add_action( 'admin_init', array( $instance, 'addStyle' ) );

			$provider = 'https://www.elderscrollsbote.de/wp-json/oembed/1.0/embed';

			// Sites run in German can request a German translation of the widget
			if ( 'de' === substr( trim( get_locale() ), 0, 2 ) ) {
				$provider = add_query_arg( 'lang', 'de', $provider );
			}

			wp_oembed_add_provider( '~https?://(?:www\.)elderscrollsbote\.de/planer/#1-.*~i', $provider, true );
		}

		return $instance;
	}

	public function addScript()
	{
		// Limit browser side caching
		echo '<script async src="' . esc_url( 'https://www.elderscrollsbote.de/esodb/tooltips.js?_ts=' . date( 'Ymd' ) ) . '"></script>';
	}

	public function addStyle()
	{
		$fileName = 'eso-widgets.min.css';
		if ( is_admin() ) {
			// Render the widget in visual editor
			add_editor_style( plugins_url( $fileName, __FILE__ ) );
		} else {
			// The content is tiny and will be embedded inline to save a network request for visitors
			echo '<style>';
			include plugin_dir_path( __FILE__ ) . $fileName;
			echo '</style>';
		}
	}
}

/**
 * This function returns the true ESOWidgets instance.
 */
function esowidgets() {
	return ESOWidgets::instance();
}

add_action( 'plugins_loaded', 'esowidgets' );