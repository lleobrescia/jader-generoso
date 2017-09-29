<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Get Rocket
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  <?php if(!FLBuilderModel::is_builder_enabled()): ?>
    <div class="container">
      <header class="entry-header row">
        <div class="col-xs-12 text-center">
          <?php
          if ( is_singular() ) :
            the_title( '<h1 class="entry-title">', '</h1>' );
          endif;
          ?>
        </div>
      </header><!-- .entry-header -->
    </div>
  <?php endif; ?>

  <?php if(FLBuilderModel::is_builder_enabled()): ?>
    <?php the_content(); ?>
    <?php else: ?>
    <div class="container">
      <div class="entry-content row">
        <div class="col-xs-12 content">
        <?php the_content(); ?>
        </div>
      </div><!-- .entry-content -->
    </div>
  <?php endif; ?>
</article><!-- #post-<?php the_ID(); ?> -->
