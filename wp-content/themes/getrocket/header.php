<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Get Rocket
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="profile" href="http://gmpg.org/xfn/11">

  <!-- Google Tag Manager -->
  <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
  new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
  j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
  'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
  })(window,document,'script','dataLayer','GTM-M4CXZQC');</script>
  <!-- End Google Tag Manager -->

  <?php wp_head(); ?>
  <!--[if lt IE 9]>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>

<body <?php body_class(); ?> ng-app="app" ng-controller="MainController as main">

<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-M4CXZQC"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v2.10&appId=1131169193604351";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'get-rocket' ); ?></a>
  <?php if ( get_rocket_show_page_header() ) : ?>
	<header id="masthead" class="site-header">
    <div class="container">
      <div class="row">
        <section class="site-branding col-sm-3">
          <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" title="<?php bloginfo( 'name' ); ?>">
            <?php 
              $imagem = get_field('logo_cabecalho', 'option'); 
            ?>
            <img src="<?= $imagem['url'] ?>" alt="<?php bloginfo( 'name' ); ?>">
          </a>
        </section><!-- .site-branding -->

        <section class="col-sm-9">
          <nav id="site-navigation" class="main-navigation ">
            <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><i class="fa fa-bars" aria-hidden="true"></i></button>
            <?php
              wp_nav_menu( array(
                'theme_location' => 'menu-1',
                'menu_id'        => 'primary-menu',
              ) );
            ?>
            <?php
              $facebook  = get_field('facebook', 'option');
              $instagram = get_field('instagram', 'option');
              $youtube   = get_field('youtube', 'option');
              $twitter   = get_field('twitter', 'option');

              if($facebook || $instagram || $youtube || $twitter):
            ?>
              <ul class="top_social_menu">
                <?php if($facebook): ?>
                  <li>
                    <a href="<?= $facebook; ?>" target="_blank" rel="external" title="<?php bloginfo( 'name' ); ?> Facebook"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                  </li>
                <?php endif; ?>
                <?php if($instagram): ?>
                  <li>
                    <a href="<?= $instagram; ?>" target="_blank" rel="external" title="<?php bloginfo( 'name' ); ?> Instagram"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                  </li>
                <?php endif; ?>
                <?php if($youtube): ?>
                  <li>
                    <a href="<?= $youtube; ?>" target="_blank" rel="external" title="<?php bloginfo( 'name' ); ?> YouTube"><i class="fa fa-youtube-play" aria-hidden="true"></i></a>
                  </li>
                <?php endif; ?>
                <?php if($twitter): ?>
                  <li>
                    <a href="<?= $twitter; ?>" target="_blank" rel="external" title="<?php bloginfo( 'name' ); ?> Twitter"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                  </li>
                <?php endif; ?>
              </ul>
            <?php endif; ?>
          </nav><!-- #site-navigation -->
        </section>
      </div>
      <!-- row -->
    </div>
    <!-- container -->
	</header><!-- #masthead -->
  <?php endif; ?>
	<div id="content" class="site-content">
