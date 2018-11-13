<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package airco
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

            <div class="container" style="margin-top: 80px;">
                <section class="error-404 not-found">
                    <header class="page-header">
                        <h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'airco' ); ?></h1>
                    </header><!-- .page-header -->

                    <div class="page-content">
                        <p><?php esc_html_e( 'It looks like nothing was found at this location.', 'airco' ); ?></p>
                        <p><a href="/" class="btn btn-lg btn-primary">Take me back home</a></p>
                    </div><!-- .page-content -->
                </section><!-- .error-404 -->
            </div>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();