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

    <div class="home-content">
        <?php

        the_content();

        ?>

    </div><!-- .entry-content -->

</article><!-- #post-## -->
