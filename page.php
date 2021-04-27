<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Astra
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header(); ?>

<style>
    .elementor-2 .elementor-element.elementor-element-d92a599>.elementor-widget-container {
        padding: 0px 0px 0px 0px;
    }

    .elementor-2 .elementor-element.elementor-element-30d546a>.elementor-widget-container {
        padding: 0px 0px 0px 0px;
    }

    .elementor-2 .elementor-element.elementor-element-6887c27 .elementor-divider__text {
        font-size: 2em;
    }

    .elementor-2 .elementor-element.elementor-element-aac72e2 .elementor-divider__text {
        font-size: 2em;
    }

    .elementor-2 .elementor-element.elementor-element-9dd4624 {
        padding: 0px 0px 0px 0px;
    }

    .elementor-2 .elementor-element.elementor-element-8194d2b .elementor-swiper-button-next:hover {
        background-color: #000000a6;
    }

    .elementor-2 .elementor-element.elementor-element-8194d2b .elementor-swiper-button-prev:hover {
        background-color: #000000a6;
    }

    .elementor-2 .elementor-element.elementor-element-05d198e .elementor-swiper-button-next:hover {
        background-color: #000000a6;
    }

    .elementor-2 .elementor-element.elementor-element-05d198e .elementor-swiper-button-prev:hover {
        background-color: #000000a6;
    }

</style>

<?php if ( astra_page_layout() == 'left-sidebar' ) : ?>

<?php get_sidebar(); ?>

<?php endif ?>

<div id="primary" <?php astra_primary_class(); ?>>

    <?php astra_primary_content_top(); ?>

    <?php astra_content_page_loop(); ?>

    <?php astra_primary_content_bottom(); ?>

</div><!-- #primary -->

<?php if ( astra_page_layout() == 'right-sidebar' ) : ?>

<?php get_sidebar(); ?>

<?php endif ?>

<?php get_footer(); ?>
