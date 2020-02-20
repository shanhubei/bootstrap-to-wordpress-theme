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
	<ul id="menu-%e9%a1%b6%e9%83%a8%e8%8f%9c%e5%8d%95" class="nav navbar-nav"><li itemscope="itemscope" itemtype="https://www.schema.org/SiteNavigationElement" id="menu-item-39" class="menu-item menu-item-type-custom menu-item-object-custom current-menu-item current_page_item menu-item-home active menu-item-39 nav-item"><a title="首页" href="http://www.era-visa.com/" class="nav-link" aria-current="page">首页</a></li>
<li itemscope="itemscope" itemtype="https://www.schema.org/SiteNavigationElement" id="menu-item-32" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children dropdown menu-item-32 nav-item">

<a href="#" class="dropdown-toggle" data-toggle="dropdown" >Dropdown <span class="caret"></span></a>
<ul class="dropdown-menu" role="menu">
	<li itemscope="itemscope" itemtype="https://www.schema.org/SiteNavigationElement" id="menu-item-40" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-40 nav-item"><a title="示例页面22" href="http://www.era-visa.com/?page_id=2" class="dropdown-item">示例页面22</a></li>
	<li itemscope="itemscope" itemtype="https://www.schema.org/SiteNavigationElement" id="menu-item-36" class="menu-item menu-item-type-post_type menu-item-object-post menu-item-36 nav-item"><a title="世界，您好！" href="http://www.era-visa.com/?p=1" class="dropdown-item">世界，您好！</a></li>
</ul>
</li>
<li itemscope="itemscope" itemtype="https://www.schema.org/SiteNavigationElement" id="menu-item-35" class="menu-item menu-item-type-post_type menu-item-object-post menu-item-35 nav-item"><a title="测试" href="http://www.era-visa.com/?p=27" class="nav-link">测试</a></li>
</ul>	</ul>


	</div>
	</nav>