<!DOCTYPE html>
    <html <?php language_attributes(); ?>>
      <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>">
        <title><?php wp_title( '&hearts;', true, 'right' ); ?></title>
     <link href="<?php bloginfo('stylesheet_url');?>" rel="stylesheet">
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
  <nav>
  <div class="container">
	<ul class="nav nav-pills">
	<?php
			wp_nav_menu( array(
			'theme_location' => 'header-menu',
			'container' => '',
			'menu_class' => 'nav navbar-nav',
			'fallback_cb' => 'wp_bootstrap_navwalker::fallback',
			'before' => '',
			'after' => '',
			'walker' => new wp_bootstrap_navwalker())
			);
			?>
	</ul>


	</div>
	</nav>