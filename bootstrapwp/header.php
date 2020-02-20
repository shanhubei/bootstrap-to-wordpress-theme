<!DOCTYPE html>
    <html <?php language_attributes(); ?>>
      <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>">
        <title><?php wp_title( '&hearts;', true, 'right' ); ?></title>
     <link href="<?php bloginfo('stylesheet_url');?>" rel="stylesheet">
	 <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <?php wp_head(); ?>
       </head>
  <body>
 
 <header>
      <div class="container">
        <div class="row">
          <div class="col-md-8">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php esc_attr_e( '返回首页', 'bootstrapwp' ); ?>">
              <img id="logo" src="http://www.shanhubei.com/wp-content/uploads/2018/10/logo2.png" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
            </a>
          </div>
          <div class="col-md-4">
            <?php get_search_form(); ?> 
          </div>
        </div>
        </div>
  </header>


  <div class="container">
<nav class="navbar navbar-expand-md navbar-light bg-light" role="navigation">
  <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-controls="bs-example-navbar-collapse-1" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

        <?php
        wp_nav_menu( array(
            'theme_location'    => 'header-menu',
            'depth'             => 2,
            'container'         => 'div',
            'container_class'   => 'collapse navbar-collapse',
            'container_id'      => 'bs-example-navbar-collapse-1',
            'menu_class'        => 'nav navbar-nav',
            'fallback_cb'       => 'WP_Bootstrap_Navwalker::fallback',
            'walker'            => new WP_Bootstrap_Navwalker(),
        ) );
        ?>
    </div>
</nav>
