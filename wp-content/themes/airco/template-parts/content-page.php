<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package airco
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="entry-content pb-4">
        <header class="entry-header">
            <div class="overlay">
                <div class="container">
                    <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
                </div>
            </div>
        </header><!-- .entry-header -->
        <div class="container">
		<?php
			the_content();

            if(get_field('service_request_form')){
                include('servicerequest.php');
            }
        ?>
        </div>

    </div><!-- .entry-content -->

</article><!-- #post-## -->
