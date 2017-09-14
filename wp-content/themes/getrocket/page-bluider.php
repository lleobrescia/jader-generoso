<?php
/**
 * template name:builder
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Get Rocket
 */

get_header(); ?>

    <div id="primary" class="content-area">
        <main id="main" class="site-main">
          <?php
            while (have_posts()) :
                the_post();
                the_content();
                get_template_part( 'template-parts/content-builder' );

            endwhile; // End of the loop.
          ?>  
        </main><!-- #main -->
    </div><!-- #primary -->

<?php
get_footer();
