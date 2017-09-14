<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Get Rocket
 */

get_header();
while ( have_posts() ) : the_post();
?>

	<div id="primary" class="content-area container ebook__conainer">
		<main id="main" class="site-main row">

      <article id="ebook-<?php the_ID(); ?>" class="container" <?php post_class(); ?>>
        <header class="entry-header row">
          <div class="col-xs-12">
            <?php
              the_title( '<h1 class="entry-title">', '</h1>' );
            ?>
          </div>
        </header><!-- .entry-header -->
      
        <div class="entry-content row">

          <section class="col-sm-7 content">
            <?php the_content(); ?>
          </section>
          <aside class="col-sm-5"> 
            <div class="ebook__aside">
              <h2><?php the_field('tilulo'); ?></h2>

              <div class="ebook_aside_desc">
                <?php the_field('descricao'); ?>
              </div>
              <!-- ebook_aside_desc -->

              <div class="formulario__wrapper">
               <?php the_field('formulario'); ?>
              </div>
              <!-- formulario__wrapper -->
            </div>
            <!-- ebook__aside -->
          </aside>
        </div><!-- .entry-content -->

      </article><!-- #ebook-<?php the_ID(); ?> -->

		</main><!-- #main -->
  </div><!-- #primary -->
  <?php  get_template_part( 'template-parts/content-builder' ); ?>

<?php
endwhile; // End of the loop.
get_footer();
