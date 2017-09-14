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


  <?php elseif( get_row_layout() == 'captura_de_lead' ): ?>
    <section class="lead">
      <div class="container">
        <div class="row">
          <div class="col-sm-3">
            <?= wp_get_attachment_image( get_sub_field('imagem')['id'], 'full', "", "" );  ?>
          </div>
          <!-- col-sm-3 -->
          <div class="col-sm-5 texto">
            <span>
            <?php the_sub_field('texto');?>
            </span>
            
          </div>
          <!-- col-sm-5 -->
          <div class="col-sm-3 botao">
            <span>
              <a href="<?php the_sub_field('link_do_botão');?>" target="_blank"><?php the_sub_field('texto_do_boão');?></a>
            </span>
            <style>
              .lead a{
                background:<?php the_sub_field('cor_de_fundo_do_botão');?>;
                color:<?php the_sub_field('cor_da_fonte');?>;
              }
            </style>
          </div>
        </div>
        <!-- row -->
      </div>
      <!-- container -->
    </section>
    <!-- lead -->
  

  <?php elseif( get_row_layout() == 'imagemtexto' ): ?>
    <section class="imagem__texto container">
      <div class="row">
        <div class="col-sm-3 col-sm-offset-1">
          <?= wp_get_attachment_image( get_sub_field('imagem')['id'], 'full', "", "" );  ?>
        </div>
        <!-- col-sm-3 -->
        <div class="col-sm-6 col-sm-offset-1">
          <h1><?php the_sub_field('titulo');?></h1>

          <div class="texto">
            <?php the_sub_field('texto');?>
          </div>
          <!-- texto -->
          <?php if(get_sub_field('link')): ?>
            <a href="<?= get_sub_field('link') ?>" class="pull-right botao">Saiba mais <i class="fa fa-arrow-right" aria-hidden="true"></i></a>
          <?php endif;?>
            
          <?php if(get_field('facebook', 'option')): ?>
            <div class="social">
              <h4>Siga a Elena no Facebook</h4>
              <div class="fb-page" data-href="<?= get_field('facebook', 'option')?>" data-small-header="true" data-adapt-container-width="true" data-hide-cover="true" data-show-facepile="true"><blockquote cite="<?= get_field('facebook', 'option')?>" class="fb-xfbml-parse-ignore"><a href="<?= get_field('facebook', 'option')?>">Elena Klein</a></blockquote></div>
            </div>
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
          <div class="col-xs-12 text-center">
            <h2><?php the_sub_field('titulo_principal');?></h2>
          </div>
          <!-- col-xs-12 -->
        </div>
        <!-- row -->

        <div class="row">
          <div class="col-sm-4 imagem">
            <?= wp_get_attachment_image( get_sub_field('imagem')['id'], 'full', "", "" );  ?>
          </div>
          <!-- col-sm-4 -->

          <div class="col-sm-7 col-sm-offset-1">
            <h3><?php the_sub_field('titulo');?></h3>
            <div ckass="texto">
              <?php the_sub_field('descricao');?>
            </div>
            <!-- texto -->
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
        <div class="row">
          <div class="col-xs-12">
            <a href="<?php the_sub_field('link_do_botao');?>" class="center-block botao"><?php the_sub_field('texto_do_botao');?></a>
          </div>
          <!-- col-xs-12 -->
        </div>
        <!-- row -->
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
  
  <?php elseif( get_row_layout() == 'youtube' ): ?>
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
          background:<?php the_sub_field('cor_de_fundo_do_botão');?>;
          color:<?php the_sub_field('cor_da_fonte_do_botão');?>;
        }
      </style>
    </section>
    <!-- blog -->
  <?php endif;?>

  <?php endwhile; ?>
<?php endif;?>
