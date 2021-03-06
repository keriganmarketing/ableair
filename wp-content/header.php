<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package airco
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
<link href="https://fonts.googleapis.com/css?family=Raleway:400,800" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/Zebra_datepicker/1.9.4/css/default.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">


    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'airco' ); ?></a>
    <div class="top-top">
        <div class="container">
            <div class="row align-items-center">
                <div class="col top-license-info">
                    State of GA #CN210937 | State of FL #CAC1813971
                </div>
                <div class="col-lg-2 flex-end top-call-btn">
                <a class="clicktocall btn btn-success" href="tel:404-313-7021"><i class="fa fa-phone fa-lg"> </i> &nbsp;404-313-7021</a>
                </div>
            </div>
        </div>
    </div>
    <div id="top" class="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-md-4">
                <a class="navbar-brand" href="/">
                    <img src="<?php echo get_template_directory_uri(); ?>/img/AAC_logo.png"
                         alt="Atlanta Air Company">
                </a>
            </div>
            <div class="col-md-8">
                <div class="float-right">
                    <a class="book-btn" href="/book-now/">Book Now</a>
                </div>
                <?php get_template_part('template-parts/content', 'nav'); ?>
            </div>

        </div>
    </div>


	<div id="content" class="site-content">
