<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Get Rocket
 */

?>

<article id="post-<?php the_ID(); ?>" class="container" <?php post_class(); ?>>
	<header class="entry-header row">
    <div class="col-xs-12">
      <?php
      if ( is_singular() ) :
        the_title( '<h1 class="entry-title">', '</h1>' );
      endif;
      ?>
    </div>
	</header><!-- .entry-header -->

	<div class="entry-content row">
		<div class="col-xs-12 content">
    <?php the_content(); ?>
    </div>
	</div><!-- .entry-content -->
</article><!-- #post-<?php the_ID(); ?> -->
