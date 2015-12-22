<?php

/**
 * Content Wrappers Start
 *
 * Override this template by copying it to yourtheme/deals-engine/global/wrapper-start.php
 *
 * @author 		Social Deals Engine
 * @package 	Deals-Engine/Includes/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

$template = get_option( 'template' );

switch( $template ) {
	case 'twentyeleven' :
		echo '<div id="primary"><div id="content" role="main">';
		break;
	case 'twentythirteen' :
		echo '<div id="primary" class="site-content"><div id="content" role="main" class="entry-content twentythirteen">';
		break;
	case 'twentyfourteen' :
		echo '<div id="primary" class="content-area"><div id="content" role="main" class="site-content twentyfourteen"><div class="tfwc">';
		break;
	case 'twentyfifteen' :
		echo '<div id="primary" class="content-area"><main id="main" class="site-main" role="main"><article class="wpsdeals type-wpsdeals status-publish hentry"><div class="entry-content">';
		break;
	case 'superstore' :
		echo '<div id="content" class="col-full"><div id="main" class="col-left"><div class="post"><div class="entry fix">';
		break;
	default :
		echo '<div id="primary" class="site-content"><div id="content" role="main">';
		break;
}