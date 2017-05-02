<?php
/*
Plugin Name: ESO Widgets
Description: ESO Widgets enables ingame-like tooltips and skill bars for Elder Scrolls Online on your site.
Version:     1.0
Author:      ElderScrollsBote.de
Author URI:  http://www.elderscrollsbote.de/
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

add_action( 'plugins_loaded', 'ESOWidgets::setup' );

final class ESOWidgets
{
	public function __construct() { }

	public static function setup()
	{
		$esowidgets = new ESOWidgets();
		add_action( 'wp_head', array( $esowidgets, 'addScript' ) );
		add_action( 'wp_head', array( $esowidgets, 'addStyle' ) );
		add_action( 'admin_init', array( $esowidgets, 'addStyle' ) );

		wp_embed_register_handler( 'eso-widgets-planer', '~https?://(?:www\.)elderscrollsbote\.de/planer/#1-(.*)~', array( $esowidgets, 'embedHandler' ) );
	}

	public function addScript()
	{
		// Limit browser side caching to max one day
		echo '<script async src="' . esc_url( '//www.elderscrollsbote.de/esodb/tooltips.js?_ts=' . strtotime( 'today midnight' ) ) . '"></script>';
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

	public function getLinkTarget()
	{
		// You can force all skill links to open in a new tab.
		// Just add the following line to the functions.php of your theme:
		// add_filter( 'eso_widgets_open_in_new_tabs', '__return_true' );

		if ( apply_filters( 'eso_widgets_open_in_new_tabs', false ) ) {
			return ' target="_blank"';
		}

		return '';
	}

	public function embedHandler( $matches, $attr, $url )
	{
		if ( count( $matches ) < 2 ) {
			return '<p>The build link seems to be incorrect (<a href="' . esc_url( $url ) . '">link</a>).';
		}

		// Extract selected bar skills
		$parts        = explode( '-', $matches[1] );
		$activeSkills = explode( ':', array_pop( $parts ) );

		if ( count( $activeSkills ) !== 12 ) {
			return '<p>The build link seems to be incomplete (<a href="' . esc_url( $url ) . '">link</a>).';
		}

		$linkTarget = $this->getLinkTarget();

		$html = '';
		for ( $bar = 0; $bar < 2; ++ $bar ) {
			$html .= '<ul class="eso-widgets-bar">';
			for ( $slot = 0; $slot < 6; ++ $slot ) {

				$index      = $bar * 6 + $slot;
				$isUltimate = 0 === ( $index + 1 ) % 6;
				$skillId    = absint( $activeSkills[ $index ] );
				$hotkey     = '<span>' . ( $isUltimate ? 'R' : ( $slot + 1 ) ) . '</span>';

				$link = $skillId > 0 ? '<a href="' . esc_url( 'http://www.elderscrollsbote.de/skill=' . $skillId ) . '"' . $linkTarget . '><img src="//www.elderscrollsbote.de/esodb/images/skills/' . $skillId . '.png" alt="Slot ' . ( $slot + 1 ) . '">' . $hotkey . '</a>' : '<img src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" alt="No skill selected">';
				$html .= '<li' . ( $isUltimate ? ' class="eso-widgets-ultimate"' : '' ) . '>' . $link . '</li>';
			}
			$html .= '</ul>';
		}

		$classes = array(
			'a' => 'Dragonknight',
			'b' => 'Nightblade',
			'c' => 'Sorcerer',
			'd' => 'Templar',
			'e' => 'Warden'
		);
		$caption = 'Show full build';

		// Not worth to add the overhead of language files for this...
		if ( 'de' === substr( trim( get_locale() ), 0, 2 ) ) {
			$caption = 'Zeige gesamten Build';
			$classes = array(
				'a' => 'Drachenritter',
				'b' => 'Nachklinge',
				'c' => 'Zauberer',
				'd' => 'Templer',
				'e' => 'Hüter'
			);
		}

		$className = ( isset( $classes[ $matches[1][1] ] ) ) ? '<em>' . $classes[ $matches[1][1] ] . '</em>' : '';

		return '<div class="eso-widgets-build"><p>' . $className . ' <a style="float:right" href="' . esc_url( $url ) . '"' . $linkTarget . '>' . $caption . ' &raquo;</a></p>' . $html . '</div>';
	}
}