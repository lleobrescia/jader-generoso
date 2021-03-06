<?php
/**
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Get Rocket
 */


 if( have_rows('layout') ):
  
    // loop through the rows of data
    while ( have_rows('layout') ) : the_row();
  ?>

  <?php  if( get_row_layout() == 'slider' ): ?>
    <section class="slider hidden-xs"> 
      <?php if( have_rows('slide') ): ?>
        <div class="owl-carousel owl-theme">
          <?php while ( have_rows('slide') ) : the_row(); ?>
            <div class="item">
              <?php if(get_sub_field('link')): ?>
                <a href="<?= get_sub_field('link'); ?>" >
                  <?= wp_get_attachment_image( get_sub_field('imagem')['id'], 'full', "", "" );  ?>
                </a>
              <?php else: ?>
                <?= wp_get_attachment_image( get_sub_field('imagem')['id'], 'full', "", "" );  ?>
              <?php endif;?>
            </div>
          <?php endwhile;  ?>
        </div>
        <!-- owl-carousel -->
      <?php endif;?>
    </section>


  <?php elseif( get_row_layout() == 'captura_de_lead' ): $bg_lead = get_sub_field('bg_lead')  ?>
    <style>
      .lead{
        background: url('<?= $bg_lead['url']; ?>')  center !important;
      }
    </style>
    <section class="lead">
      <div class="container">
        <div class="row">
          <div class="col-sm-8">
            <div class="texto">
              <?php the_sub_field('texto');?>
            </div>
            <!-- texto -->
          </div>
          <!-- col-sm-8 -->

          <div class="col-sm-4">
            <?php the_sub_field('formulario');?>
          </div>
          <!-- col-sm-4 -->
        </div>
        <!-- row -->
      </div>
      <!-- container -->
    </section>
    <!-- lead -->

    <?php elseif( get_row_layout() == 'captura_de_lead2' ): 
      $token = md5(uniqid(""));
      $bg_lead2 = get_sub_field('bg_lead')
    ?>
    <section class="lead2" id="<?= $token; ?>">
      <div class="container">
        <div class="row">
          <div class="col-sm-4">
            <?= wp_get_attachment_image( get_sub_field('imagem')['id'], 'full', "", "" );  ?>
          </div>
          <!-- col-sm-3 -->
          <div class="col-sm-8">
            <?php the_sub_field('formulario');?>
          </div>
          <!-- col-sm-7 -->
        </div>
        <!-- row -->
      </div>
      <!-- container -->
    </section>
    <!-- lead -->
    <style>
      .lead2 {
        background: url('<?= $bg_lead2['url']; ?>')  center !important;
      }
    </style>
  

  <?php elseif( get_row_layout() == 'imagemtexto' ): ?>
    <section class="imagem__texto container">
      <div class="row">
        <div class="col-xs-12 text-center">
          <h1><?php the_sub_field('titulo');?></h1>
        </div>
        <!-- col-xs-12 -->
      </div>
      <!-- row -->

      <div class="row">
        <div class="col-sm-3 col-sm-offset-1">
          <?= wp_get_attachment_image( get_sub_field('imagem')['id'], 'full', "", "" );  ?>
        </div>
        <!-- col-sm-3 -->
        <div class="col-sm-6 col-sm-offset-1">
          

          <div class="texto">
            <?php the_sub_field('texto');?>
          </div>
          <!-- texto -->
          <?php if(get_sub_field('link')): ?>
            <a href="<?= get_sub_field('link') ?>" class="pull-right botao">Saiba mais <i class="fa fa-arrow-right" aria-hidden="true"></i></a>
          <?php endif;?>
            
        </div>
        <!-- col-sm-6 -->
      </div>
      <!-- row -->
    </section>
    <!-- imagem__texto -->

  <?php elseif( get_row_layout() == 'cursos' ): ?>
    <section class="cursos">
      <div class="container">

        <div class="row">
          <div class="col-sm-4 imagem">
            <?= wp_get_attachment_image( get_sub_field('imagem')['id'], 'full', "", "" );  ?>
          </div>
          <!-- col-sm-4 -->

          <div class="col-sm-7 col-sm-offset-1">
            
            <img style="margin-bottom: 40px" src="<?= get_template_directory_uri();?>/images/mechas-poderosas.png" alt="Mechas Poderosas" class="img-responsive center-block">
            <div ckass="texto">
              <?php the_sub_field('descricao');?>
            </div>
            <!-- texto -->
            <?php if(get_sub_field('link_do_botao')): ?>
              <a href="<?php the_sub_field('link_do_botao');?>" class="center-block botao pull-right"><?php the_sub_field('texto_do_botao');?></a>
            <?php endif;?>
          </div>
          <!-- col-sm-7 -->
        </div>
        <!-- row -->
        
        <?php if( have_rows('itens') ): ?>
        <div class="row">
          <div class="col-xs-12">
            <div class="itens">
              <?php while ( have_rows('itens') ) : the_row(); ?>
              <div class="item">
                <?= wp_get_attachment_image( get_sub_field('imagem_ico')['id'], 'full', "", "" );  ?>
                <h4><?= get_sub_field('texto'); ?></h4>
              </div>
              <!-- item -->
              <?php endwhile;  ?>
            </div>
            <!-- itens -->
          </div>
          <!-- col-xs-12 -->
        </div>
        <!-- row -->
        <?php endif;?>
        
        <?php if(get_sub_field('link_do_botao')): ?>
        <style>
          .cursos .botao {
            background:<?php the_sub_field('cor_de_fundo_do_botao');?>;
            color:<?php the_sub_field('cor_do_texto_do_botao');?>;
          }
        </style>
        <?php endif;?>

      </div>
      <!-- container -->
    </section>

    <style>
      .cursos{
        background:<?php the_sub_field('cor_de_fundo');?>;
        color:<?php the_sub_field('cor_da_fonte');?>;
      }
    </style>
  
  <?php elseif( get_row_layout() == 'youtube' ): $youtube_bg = get_sub_field('youtube_bg') ?>
    <style>
      .youtube{
        background: url('<?= $youtube_bg['url']; ?>')  no-repeat center !important;
      }
    </style>
    <section class="youtube">
      <div class="container">
        <div class="row">
          <div class="col-xs-12 text-center">
            <h2><?php the_sub_field('titulo');?></h2>
          </div>
          <!-- col-xs-12 -->
        </div>
        <!-- row -->

        <div class="row">
          <div class="col-xs-12 text-center">
            <?php echo do_shortcode( '[youtube_channel num=3 nolightbox=true]' ); ?>
          </div>
          <!-- col-xs-12 -->
        </div>
        <!-- row -->

        <div class="row">
          <div class="col-xs-12">
            <div class="youtube__inscricao">
              <span class="texto"><?php the_sub_field('texto');?></span>

              <div class="botao__inscricao">
                <script src="https://apis.google.com/js/platform.js"></script>

                <div class="g-ytsubscribe" data-channelid="<?php the_sub_field('nome_ou_id_do_canal');?>" data-layout="full" data-count="default"></div>
              </div>
              <!-- botao__inscricao -->
            </div>
            <!-- youtube__inscricao -->
          </div>
          <!-- col-xs-12 -->
        </div>
        <!-- row -->
      </div>
      <!-- container -->
    </section>
    <!-- youtube -->
    
    <style>
      .youtube{
        background:<?php the_sub_field('cor_de_fundo');?>;
      }
    </style>

  <?php elseif( get_row_layout() == 'blog' ): ?>
    <section class="blog container">
      <div class="row">
        <div class="col-xs-12 text-center">
          <h2><?php the_sub_field('titulo');?></h2>
          <h3><?php the_sub_field('sub-titulo');?></h3>
        </div>
        <!-- col-xs-12 -->
      </div>
      <!-- row -->

      <div class="row post__list">
        <div class="col-sm-4" ng-repeat="item in main.posts">
          <div class="single__post">
            <img class="img-responsive center-block" ng-src="{{item._embedded['wp:featuredmedia'][0].source_url}}" alt="">

            <div class="single_post_text">
              <h4>{{item.title.rendered}}</h4>

              <a ng-href="{{item.link}}" target="_blank" class="pull-right">Saiba mais <i class="fa fa-arrow-right" aria-hidden="true"></i></a>
              <div class="clearfix"></div>
            </div>
            <!-- single_post_text -->
          </div>
          <!-- single__post -->
        </div>
        <!-- col-sm-4 -->
      </div>
      <!-- row -->

      <div class="row">
        <div class="col-xs-12">
          <a href="<?php the_sub_field('link_do_blog');?>" class="center-block botao" target="_blank"><?php the_sub_field('texto_do_botao');?></a>
        </div>
        <!-- col-xs-12 -->
      </div>
      <!-- row -->

      <style>
        .blog .botao{
          background:<?php the_sub_field('cor_de_fundo_do_bot??o');?>;
          color:<?php the_sub_field('cor_da_fonte_do_bot??o');?>;
        }
      </style>
    </section>
    <!-- blog -->
  <?php endif;?>

  <?php endwhile; ?>
<?php endif;?>
