<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package airco
 */
$pagetext = get_post_meta($post->ID, 'page_content_page_content', true);
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="entry-content">
        <header class="entry-header">
			<div class="overlay">
			<div class="container">
				<?php
				if ( is_single() ) :
					the_title( '<h1 class="entry-title">', '</h1>' );
				else :
					the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
				endif;
				?>
			</div>
			</div>
		</header><!-- .entry-header -->
		<div class="container">
			<?php echo $pagetext;	?>
		</div>
	</div><!-- .entry-content -->

</article><!-- #post-## -->
