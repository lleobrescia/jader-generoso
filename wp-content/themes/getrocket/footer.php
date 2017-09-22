<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Get Rocket
 */

?>

  </div><!-- #content -->
    <?php $bg = get_field('imagem_de_fundo_do_rodape', 'option'); if ($bg) :?>
  <style>
    .footer__top{
      background: url('<?= $bg['url']; ?>')  no-repeat center;
    }
  </style>
    <?php endif; ?>
  <section class="footer__top">
    <div class="container">
      <div class="row">
        <div class="col-xs-12 text-center">
          <nav class="footer-navigation">
            <?php
              wp_nav_menu( array(
                'theme_location' => 'menu-1',
                'menu_id'        => 'primary-menu',
              ) );
            ?>
          </nav><!-- #footer-navigation -->
          <?php
              $facebook  = get_field('facebook', 'option');
              $instagram = get_field('instagram', 'option');
              $youtube   = get_field('youtube', 'option');
              $twitter   = get_field('twitter', 'option');

            if ($facebook || $instagram || $youtube || $twitter) :
            ?>
            <ul class="footer_social_menu">
            <?php if ($facebook) : ?>
                <li>
                  <a href="<?= $facebook; ?>" target="_blank" rel="external" title="<?php bloginfo( 'name' ); ?> Facebook"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                </li>
                <?php endif; ?>
            <?php if ($instagram) : ?>
                <li>
                  <a href="<?= $instagram; ?>" target="_blank" rel="external" title="<?php bloginfo( 'name' ); ?> Instagram"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                </li>
                <?php endif; ?>
            <?php if ($youtube) : ?>
                <li>
                  <a href="<?= $youtube; ?>" target="_blank" rel="external" title="<?php bloginfo( 'name' ); ?> YouTube"><i class="fa fa-youtube-play" aria-hidden="true"></i></a>
                </li>
                <?php endif; ?>
            <?php if ($twitter) : ?>
                <li>
                  <a href="<?= $twitter; ?>" target="_blank" rel="external" title="<?php bloginfo( 'name' ); ?> Twitter"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                </li>
                <?php endif; ?>
            </ul>
            <?php                                                                                                                                                                                                                                                                                                                           endif; ?>
        </div>
        <!-- col-xs-12 -->
      </div>
      <!-- row -->

      <div class="row footer__detalhes">
        <div class="col-sm-4">
          <h3>Blog</h3>

          <p ng-repeat="item in main.posts"><a ng-href="{{item.link}}" target="_blank">{{item.title.rendered}}</a></p>
        </div>
        <!-- col-sm-4 -->
        <div class="col-sm-4">
          <h3>INSTAGRAM</h3>
          <script src="//lightwidget.com/widgets/lightwidget.js"></script><iframe src="//lightwidget.com/widgets/266b04f2c5eb53b7908289d837de4c1e.html" scrolling="no" allowtransparency="true" class="lightwidget-widget" style="width: 100%; border: 0; overflow: hidden;"></iframe>
        </div>
        <!-- col-sm-4 -->
        <div class="col-sm-4">
          <h3>Facebook</h3>
          <div class="fb-page" data-href="https://www.facebook.com/Jadergenerosobr/" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/Jadergenerosobr/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/Jadergenerosobr/">Jader Generoso</a></blockquote></div>
        </div>
        <!-- col-sm-4 -->
      </div>
      <!-- row -->
    </div>
    <!-- container -->
  </section>

    <footer id="colophon" class="site-footer">
        <div class="site-info container">
            <div class="row">
        <div class="col-xs-12">
          <span><?php echo date("Y"); ?>    &copy; Todos os direitos reservados.</span>
          <a href="http://getrocket.com.br/" target="_blank" class="get_rocket" rel="external" title="Get Rocket" style="width: 100px;">
            <img src="<?= get_template_directory_uri(); ?>/images/get_rocket.png" alt="Get Rocket">
          </a>
        </div>
        <!-- col-xs-12 -->
      </div>
      <!-- row -->
        </div><!-- .site-info -->
    </footer><!-- #colophon -->
</div><!-- #page -->

<script>
  (function () {
    'use strict';

    angular
      .module('app')
      .controller('MainController', MainController);

    MainController.$inject = ['$http'];

    function MainController($http) {
      var vm = this;
      var site = 'http://jadergeneroso.com.br/blog';

      vm.posts = [];

      activate();

      ////////////////

      function activate() {
        $http.get(site+'/wp-json/wp/v2/posts/?per_page=3&_embed').then(function(data){

          vm.posts = data.data;
          console.log(data);
        });
      }
    }
  })();
</script>

<?php wp_footer(); ?>

</body>
</html>
