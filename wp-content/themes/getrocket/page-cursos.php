<?php
/**
 * Template Name: Cursos
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Get Rocket
 */

get_header(); 

while (have_posts()) : the_post();

?>

    <section id="primary" class="content-area container">
        <header class="row">
          <div class="col-xs-12 text-center">
            <h1 class="materiais__title"><?php the_title(); ?></h1>
            <?php if(get_field('descricao')): ?>
            <div class="materiais__desc">
              <?php the_field('descricao'); ?>
            </div>
            <!-- materiais__desc -->
            <?php endif;?>
          </div>
          <!-- col-xs-12 -->
        </header>
        <main id="main" class="site-main row">
        <?php
        // WP_Query arguments
          $arg = array(
          'posts_per_page' => '-1',
          'post_type'      => 'cursos'
          );

        // The Query
          $materiais = new WP_Query( $arg );

          if ($materiais->have_posts()) :
           while ($materiais->have_posts()) :
            $materiais->the_post();
            $descricao = get_field('descricao');
            $link = get_field('link');
          ?>

          <div class="material col-sm-4" id="material-<?php the_ID(); ?>">
            <figure>
              <?= get_the_post_thumbnail( );?>
            </figure>
            <h3><?= get_the_title(); ?></h3>
            <div class="material__descricao">
              <?php echo $descricao; ?>
            </div>
            <!-- material__descricao -->

            <a  class="saiba-mais"href="<?= $link; ?>" title="<?= get_the_title(); ?>">Saiba Mais</a>
          </div>
          <!-- material-<?php the_ID(); ?> -->
          
          <?php
            endwhile;
          endif; 
          ?>
        </main><!-- #main -->
    </section><!-- #primary -->
    <?php the_content(); ?>
    <?php get_template_part( 'template-parts/content-builder' ); ?>  

<?php
endwhile; // End of the loop.
get_footer();
