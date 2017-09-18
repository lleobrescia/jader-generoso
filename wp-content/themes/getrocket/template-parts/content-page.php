<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Get Rocket
 */

?>

<article id="post-<?php the_ID(); ?>" class="container" <?php post_class(); ?>>
<header class="entry-header row">
  <div class="col-xs-12 text-center">
    <?php
    if ( is_singular() ) :
      the_title( '<h1 class="entry-title text-center">', '</h1>' );
    endif;
    ?>
  </div>
</header><!-- .entry-header -->

<div class="entry-content row">
  <div class="col-xs-12">
    <?php the_content(); ?>
  </div>
</div><!-- .entry-content -->
</article><!-- #post-<?php the_ID(); ?> -->
