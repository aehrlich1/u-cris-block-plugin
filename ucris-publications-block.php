<?php
/**
 * Plugin Name:       u:cris Publications Block
 * Description:       Block to display publications from the u:cris platform.
 * Requires at least: 6.6
 * Requires PHP:      7.2
 * Version:           0.1.0
 * Author:            The WordPress Contributors
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       ucris-publications-block
 *
 * @package CreateBlock
 */


if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}


/**
 * Registers the block using the metadata loaded from the `block.json` file.
 * Behind the scenes, it registers also all assets so they can be enqueued
 * through the block editor in the corresponding context.
 *
 * @see https://developer.wordpress.org/reference/functions/register_block_type/
 */
function create_block_ucris_publications_block_block_init() {
	register_block_type( __DIR__ . '/build' );
}

add_action( 'init', 'create_block_ucris_publications_block_block_init' );

include_once( __DIR__ . '/php/Publication.php' );
include_once( __DIR__ . '/php/PublicationRepository.php' );
include_once( __DIR__ . '/php/PublicationService.php' );
include_once( __DIR__ . '/php/UcrisPublicationsPlugin.php' );
include_once( __DIR__ . '/php/functions.php' );

$ucrisPublicationsPlugin = new UcrisPublicationsPlugin();
