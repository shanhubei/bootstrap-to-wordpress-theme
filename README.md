# bootstrap-to-wordpress-theme

#### 介绍
bootstrap-to-wordpress-theme

#### 说明
bootstrap-to-wordpress-theme wordpress主题完整包


#### 详细介绍
http://www.shanhubei.com/bootstrap-to-wordpress-theme.html



# 一、建立基本环境以及主题模板
## 1.1、搭建环境
当然是要在本地搭建基本环境。一般用集成的环境，既方便又快捷。
## 1.2、新建主题的基本文件：
在wordpress的wp-content\themes文件夹bootstrapwp下建立两个文件index.php，style.css
index.php ------------------主模版
style.css ------------------主样式表
## 1.3、增加主题的描述内容
在style.css放入如下内容：
```
/*  
Theme Name: bootstrapwp练手主题 
Theme URI: http://www.shanhubei.com  //这里填主题介绍的网址，没有就填你的博客网址吧  
Description: 基于Bootstrap框架构建的自适应Wordpress主题  //这里填主题的简短介绍  
Version: 0.1  
Author: Andy  
Author URI: http://www.shanhubei.com  //作者的网址  
Tags: Bootstrap自适应demo,Wordpress   //标签，多个用半角逗号隔开  
*/
```
这个是主题的描述性文字，可以安装自己需求来写。
>注意：这个主题可以放一张==效果图==，即往主题目录里面上传一个名为screenshot.png的图片就行了，图片尺寸是300 * 225，这张图既可以使你的设计效果图或者是你的制作完成后最终效果也行。
## 1.4、主题文件夹bootstrapwp下建立以下三个文件

头部 header.php， 使用get_header()嵌入;

侧栏 sidebar.php, 使用 get_sidebar();嵌入;

底部 footer.php, 使用 get_footer()嵌入;

#### 在`index.php`中分别使用以上命令嵌入这三个文件

`<?php get_header(); ?>`//调用头部文件的内容
`<?php get_sidebar(); ?>`//调用边栏文件的内容
`<?php get_footer(); ?>`//调用网页底部文件的内容
如果你想加载多个边栏，比如右边栏，先建立一个sidebar-right.php,主意命名格式sidebar-right，让后在引入文件中，php get_sidebar('right'); 这样就能加载多个边栏文件了。
```
<?php get_header(); ?>//调用头部文件的内容
<?php get_sidebar('right'); ?>//调用右边栏文件的内容
<?php get_sidebar(); ?>//调用边栏文件的内容
<?php get_footer(); ?>//调用网页底部文件的内容
```
当然不同的页头，页脚都可以使用这种载入方法，所以你可以在一个主题中创建不同的页脚，和页头文件，让你的主题风格多样性。

# 二、引入主题需要的css和js文件
## 2.1、下载最新版 bootstrap
下载新版[bootstrap](https://v3.bootcss.com/getting-started/#download)
然后在我们的主题目录下面新建一个文件夹bootstarp把下载的bootstrap解压的三个文件夹js,css,fonts剪切进去，新建文件夹images,js,现在的主题文件目录结构如下
```language
bootstarp下的js,css,fonts文件夹；images；js；几个文件
```
## 2.2、引入文件
打开header.php,把以下代码复制进去
```language
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
  <head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <title><?php wp_title( '&hearts;', true, 'right' ); ?></title>
    <?php wp_head(); ?>
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/style.css">
    <script src="<?php echo get_template_directory_uri(); ?>/bootstrap/js/bootstrap.js"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/js/bootstrapwp.js"></script>
  </head>
```
`php language_attributes()`;动态生成语言代码；
`bloginfo( 'charset' )`;获得网站的字符集；
`php wp_head()`;钩子函数，很多插件把自己的函数挂到这个函数上面，去加载需要的样式表和脚本文件，它允许插件开发者向你的站点动态地添加CSS和 javascript ，如果我们不在模板中引入这个，一个插件将不能工作；
`get_template_directory_uri()`; 获得主题文件的位置，echo get_template_directory_uri(); 输出位置，正确加载 bootstrap.css 和 style.css;
`bootstrapwp.js`是我们的主题自己使用的js文件
`wp_title()`; 不同的页面动态的生成文章标题，但是我们想根据不同的页面去获得不同的标题效果，所以我们需要在functions.php文件中自定义一个函数挂到 wp_title(); 函数中，首先在我们的主题根目录下建立 functions.php 文件，复制以下代码：
```language
function bootstrapwp_wp_title( $title, $sep ) {
	global $paged, $page;
 
	if ( is_feed() )
		return $title;
 
	// 添加网站名称
	$title .= get_bloginfo( 'name' );
 
	// 为首页添加网站描述
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title = "$title $sep $site_description";
 
	// 在页面标题中添加页码
	if ( $paged >= 2 || $page >= 2 )
		$title = "$title $sep " . sprintf( __( 'Page %s', 'bootstrapwp' ), max( $paged, $page ) );
 
	return $title;
}
add_filter( 'wp_title', 'bootstrapwp_wp_title', 10, 2 );
```
为了简化我们的头部文件header.php，css链接我们也可以修改如下：
```language
<link href="<?php bloginfo('stylesheet_url');?>" rel="stylesheet">
```

然后在style.css文件中，添加如下代码：
```
@import url('bootstrap/css/bootstrap.css'); 
body { 
     padding-top: 60px; 
     padding-bottom: 40px; 
}
```
在此完成的部分中使用了一个特殊的WordPress标签，不管在我们网站的哪个页面它都能自动把 bootstrap 的CSS链到我们的主题，你会看到这个代码bloginfo()函数将以不同的方式在本教程中使用。然后我们使用 @import 标签从我们的主style.css文件中引入Bootstrap的CSS文件。
现在的header.php是这样子的
```language
<!DOCTYPE html>
 
    <html <?php language_attributes(); ?>>
      <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>">
 
        <title><?php wp_title( '&hearts;', true, 'right' ); ?></title>
 
     <link href="<?php bloginfo('stylesheet_url');?>" rel="stylesheet">
    <?php wp_enqueue_script("jquery"); ?>
    <?php wp_head(); ?>
       </head>
```
## 2.3、footer.php页脚部分

接下来我们添加 wp_footer() 标签，它和wp_head()拥有同样的功能。我们闭合body标签前把这些放好。我们也要改变我们加载JavaScript文件的方法，将它们移至header.php文件，所以更新你的footer.php变成这样：
```language
<!-- Footer -->
    <div class="container">
	<hr>
	<footer>
        <p>版权所有 &copy;  Company 2020  <?php bloginfo('name'); ?></p>
      </footer>
    </div> <!-- /container -->
 
 
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/jquery.min.js"></script>
    <script src="./bootstrap/js/bootstrap.min.js"></script>
    <?php wp_footer(); ?>  
  </body>
</html>
```
现在我们可以回来通过WordPress推荐的加载JavaScript的方式添加JavaScript，这个方法包括使用 wp_enqueue_script() 函数。
首先，我们在wp_head()前面使用这个函数来加载 jquery ，接下来在你的header.php文件中放置下面代码：
```language
<?php wp_enqueue_script("jquery"); ?>
<?php wp_head(); ?>
```
下面我们将用wp_head()方法加载JavaScript，请记住，wp_head()方法是插件和主题中经常用来向header.php文件中添加CSS和JavaScript的。

我们要在functions.php加载我们的JavaScript，这可能看起来像用很多多余的步骤去加载一个JavaScript 文件，但由于你的主题会变得越来越复杂，这将有助于一切保持清洁和有组织。
functions.php文件，粘贴下面的代码：
```
<?php 
/*
 * 自定义函数加载js文件
 */
function bootstrapwp_scripts_with_jquery()
{
  // Register the script like this for a theme:
  wp_register_script( 'custom-script', get_template_directory_uri() . '/bootstrap/js/bootstrap.js', array( 'jquery' ) );
  // For either a plugin or a theme, you can then enqueue the script:
  wp_enqueue_script( 'custom-script' );
}
add_action( 'wp_enqueue_scripts', 'bootstrapwp_scripts_with_jquery' );
?>
```
## 2.4、注册菜单搜索和导航
2.4.1、在functions.php中复制以下代码，这样在后头外观-里就有菜单选项了，我们注册了三个导航的位置，这里我们只使用第一个top-menu菜单位置，其他以后备用。
```language
// 注册菜单
	if(function_exists('register_nav_menus')){    
          register_nav_menus(  
           array(  
                 'header-menu' => __( 'top-menu' ),  
                 'footer-menu' => __( 'footer-menu' ),  
                 'sider-menu' => __('sider-menu')  
                )  
            );  
           }
```
在wordpress后台-文章-分类目录-下建立好你的网站导航目录，然后在外观-菜单-下创建一个新的菜单-主题位置选定top-menu
2.4.2、在functions.php中复制以下代码，通过自定义搜索函数bootstrapwp_search_form把我们的搜索样式挂在wordorss自带的搜索函数get_search_form()中
```
/*
 * 自定义搜索框
 */
 function bootstrapwp_search_form( $form ) {
 
    $form = '<form role="search" method="get" id="searchform" action="' . home_url( '/' ) . '" >
    <div class="input-group pull-right" id="search"><label class="hide screen-reader-text" for="s">' . __('Search for:') . '</label>
    <input class="form-control " type="text" value="' . get_search_query() . '" name="s" id="s" /> 
	<span class="input-group-btn">
	<input class="btn btn-default" type="submit" id="searchsubmit" value="'. esc_attr__('Search') .'" />
     </span>
    </div>
    </form>';
 
    return $form;
}
add_filter( 'get_search_form', 'bootstrapwp_search_form' );
?>
```
2.4.3、我们用wordpress自带wp_nav_menu()函数显示我们在后头定制的菜单
您可以参考 [wordpress-bootstrap-menu](http://www.shanhubei.com/wordpress-bootstrap-menu.html)。
在header.php中输出菜单的位置添加代码：
```language
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
```
2.4.4、目前header.php文件如下：
```language
<!DOCTYPE html>
    <html <?php language_attributes(); ?>>
      <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>">
        <title><?php wp_title( '&hearts;', true, 'right' ); ?></title>
     <link href="<?php bloginfo('stylesheet_url');?>" rel="stylesheet">
    <?php wp_enqueue_script("jquery"); ?>
    <?php wp_head(); ?>
       </head>
  <body>
 
 <header>
      <div class="container">
        <div class="row">
          <div class="col-md-8">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php esc_attr_e( '返回首页', 'bootstrapwp' ); ?>">
              <img id="logo" src="<?php echo get_template_directory_uri(); ?>/images/logo.png" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
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
```
# 三、编辑WordPress首页(index.php)
3.1、首先设计布局部分。代码如下：
```
<div class="container">
  <div class="row">
    <div class="col-md-9">          
          <div class="blog-post">
            <h2 class="blog-post-title">文章标题</h2>
            <p class="blog-post-meta">发布时间 by <a href="#">作者</a></p>
            <p>文章内容</p>           
          </div><!-- /.blog-post -->         
          <nav>
            <ul class="pager">
              <li><a href="#">Previous</a></li>
              <li><a href="#">Next</a></li>
            </ul>
          </nav>
        </div><!-- /.blog-main -->
```
3.2、WordPress循环，在WordPress代码中添加该页面的标题和内容，标题的代码为 the_title() 内容的代码为 the_content()，建议您阅读[函数列表]( WordPress主题制作基本模版文件以及基本函数)，循环代码如下：
```
 <?php if ( have_posts()):?>
		   <?php while( have_posts()): the_post();?>
          <div class="blog-post">
            <h2 class="blog-post-title"><?php the_title(); ?></h2>
            <p class="blog-post-meta"><?php the_time('y-m-d')?> by <a href="#"><?php the_author();?></a></p>
 
            <p><?php the_content(); ?></p>
 
          </div><!-- /.blog-post -->
          <?php endwhile; else: ?>
           <p><?php _e('Sorry, 还没有文章发布。'); ?></p>
         <?php endif; ?>
```
3.3、加入相关链接
我们添加一个新标签 `the_permalink()` ，我们可以用其作从主新闻页面链接到独立新闻文章的链接锚点，这个标记应该在 the_title() 外层，WordPress会在当前活动外观主题中查找若干模板文件，首个查找结果将会被用来显示给定页面打开链接，WordPress会按如下顺序查找文件：
页面所选用的"页面模板"
page.php
index.php
修改后的链接代码如下所示：
```
<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
```
3.4、为wordpress添加作者名及链接和显示作者文章
默认情况下,Wordpress将先使用author.php模板然后是archive.php最后是index.php来显示作者信息. 意思是,如果你没有author.php文件, WordPress将使用archive.php, 以此类推。

如果你想更换作者页面的外观, 你需要创建一个author.php文件(如果主题没有),方法:复制archive.php或index.php，然后根据自己的设计重新修改author.php。（以后设计......）
```
<a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>" title="查看<?php the_author(); ?>所有文章"><?php the_author(); ?></a>
```
3.5、首页文章内容摘要字数限制
把the_content换成以下代码,260摘要显示的字数
```
<?php echo mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 260,"......"); ?>
```
目前index.php文件代码
```
<?php get_header(); ?>
 
<div class="container">
      <div class="row">
      <div class="col-md-9">
          <?php if ( have_posts()):?>
		   <?php while( have_posts()): the_post();?>
          <div class="blog-post">
            <h2 class="blog-post-title"><h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2></h2>
            <p class="blog-post-meta"><?php the_time('y-m-d')?> by <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>" title="查看<?php the_author(); ?>所有文章"><?php the_author(); ?></a></a></p>
 
            <p><?php echo mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 260,"..."); ?></p>
 
          </div><!-- /.blog-post -->
          <?php endwhile; else: ?>
           <p><?php _e('Sorry, 还没有文章发布。'); ?></p>
         <?php endif; ?>
 
          <nav>
            <ul class="pager">
              <li><a href="#">Previous</a></li>
              <li><a href="#">Next</a></li>
            </ul>
          </nav>
 
        </div><!-- /.blog-main -->
```

# 四、创建single.php页
WordPress中，每篇文章的展示需要single.php，如果没有的话，系统会默认调用index.php，我们首先编写single.php的内容，以它为框架在细化每一个部分。singe.php同样用到了The Loop，因此可以将index.php复制一份来修改。
4.1、网页布局代码
将所有的内容放入一个container中居中，然后通过bootstrap的栅格系统分为左9右3的布局。右三用来输出sidebar的内容，代码如下：
```
<div class="container">
    <div class="row">
      <div class="col-md-9">
          <div class="post-content">
            <h2 class="post-title">文章标题</h2>
            <div>
             文章内容
            </div>
            <div>
             标签：
            </div>
            <ul class="pager">
              <li class="next">上一篇</li> 
              <li class="previous">下一篇</li> 
            </ul>
          </div>
          <div class="post-comment">
           评论部分
          </div>
        </div>
      <div class="col-md-3">
          导入边栏
       </div>
    </div>
</div>
```
4.2、加入函数命令，代码如下
```
<?php get_header();?>
<div class="container">
  <?php while(have_posts()):the_post();?>
    <div class="row">
      <div class="col-md-9">      
          <div class="post-content">
            <h2 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
            <div>
              <?php the_content(); ?>
            </div>
            <div><?php the_tags('标签：', ', ', ''); ?> </div>
            <ul class="pager">
              <li class="next"><?php previous_post_link('%link'); ?></li> 
              <li class="previous"><?php next_post_link('%link'); ?></li> 
            </ul>
          </div>
          <div class="post-comment">
            <?php comments_template(); ?>         
        </div>
      </div>
      <div class="col-md-3">        
          <?php get_sidebar(); ?>      
      </div>
    </div>
  <?php endwhile;?>
</div>
<?php get_footer();?>
```

# 五、编辑sidebar.php侧边栏
侧边栏的功能非常强大，扩展性定制性都非常的高，很多小工具都要放到这里，今天我们只是做一个初级入门教程，放入常用的分类目录、最新文章、标签云、文章存档等功能。
1、静态布局
```
 <div class="col-md-3">
       <h4>分类目录</h4>
        <ul>
          .......
        </ul>     
        <h4>最新文章</h4>
        <ul>
           <li>......</li>
        </ul>
        <h4>标签云</h4>
        <p>......</p>               
        <h4>文章存档</h4>
        <ul>
        .......
        </ul> 
 </div><!-- /.blog-sidebar -->
```
2、加入功能判断函数代码如下：
```
 <!-- Sidebar -->
    <?php if ( !function_exists('dynamic_sidebar') 
                        || !dynamic_sidebar('First_sidebar') ) : ?>
        <h4>分类目录</h4>
        <ul>
            <?php wp_list_categories('depth=1&title_li=&orderby=id&show_count=0&hide_empty=1&child_of=0'); ?>
        </ul>
    <?php endif; ?>
 
    <?php if ( !function_exists('dynamic_sidebar') 
                            || !dynamic_sidebar('Second_sidebar') ) : ?>        
        <h4>最新文章</h4>
        <ul>
            <?php
                $posts = get_posts('numberposts=6&orderby=post_date');
                foreach($posts as $post) {
                    setup_postdata($post);
                    echo '<li><a href="' . get_permalink() . '">' . get_the_title() . '</a></li>';
                }
                $post = $posts[0];
            ?>
        </ul>
    <?php endif; ?>
 
    <?php if ( !function_exists('dynamic_sidebar') 
                            || !dynamic_sidebar('Third_sidebar') ) : ?> 
        <h4>标签云</h4>
        <p><?php wp_tag_cloud('smallest=8&largest=22'); ?></p>
    <?php endif; ?>
 
    <?php if ( !function_exists('dynamic_sidebar') 
                        || !dynamic_sidebar('Fourth_sidebar') ) : ?>                    
        <h4>文章存档</h4>
        <ul>
            <?php wp_get_archives('limit=10'); ?>
        </ul>
    <?php endif; ?>
```
3、替换以下页面的边栏静态代码
在index.php、archive.php、page.php和single.php页面的边栏代码处改为：
```
<?php get_sidebar(); ?>
```
4、让我们的主题支持侧边栏小工具挂件
目前我们的主题还不支持在WordPress后台 – 外观 – 小工具，可以正常地拖动小工具到侧边栏的，无法让更多的小工具放到我们的边栏，我们需要在functions.php里注册我们的边栏小工具，想要了解更多功能建议你阅读 WordPress 函数register_sidebar()[wordpress-register_sidebar.html](http://www.shanhubei.com/wordpress-register_sidebar.html)
好了，打开functions.php复制以下代码我们就可以使用WordPress后台 – 外观 – 小工具了，这样让我们的侧边栏更加强大
```
if( function_exists('register_sidebar') ) {
	register_sidebar(array(
		'name' => 'First_sidebar',
		'id'           => 'sidebar-1',
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '<h4>',
		'after_title' => '</h4>'
	));
}
```

# 六、编辑comments.php
在文章的页面single.php要显示评论的话，可以使用`comments_template();`函数调用评论的模板，评论功能是和读者交互的重要途径，今天我们来实现主题的评论功能。

1、在single.php文章内容下面要显示评论的地方加入以下代码，通过`comments_template();`函数调用评论页面comments.php。
```
 <?php comments_template(); ?>
```
2、在我们的主题根目录下建立评论模板comments.php，设计评论样式。
```
<section id="comments">
  <h2>评论标题 </h2>
  <ol> 评论内容列表</ol>
</section>
 <ul class="pager">
    <li class="previous"> 上一页 </li>
    <li class="next"> 下一页   </li>
  </ul>
```
3、加入代码
```
<section id="comments">
  <h2>
  <?php printf( 
    _n( '&ldquo; %2$s &rdquo; comment %1$s', 
        '&ldquo; %2$s &rdquo; comments %1$s', 
         'bootstrapwp'
       ),
      '<span class="badge badge-important">' . get_comments_number() . '</span>',  
        get_the_title()
       );
  ?>
  </h2>
  <ol>
  <?php wp_list_comments(); ?>
  </ol>
</section>
```
get_comments_number() 获得评论的数量
get_the_title() 获得标题
wp_list_comments() 获取评论内容列表
4、使用自定义bootstrap评论列表
修改如下，首先我们要自定义评论列表，其中bootstrapwp_comment自定义的回调函数。建议你必须阅读 wp_list_comments()使用回调函数自定义评论展示方式
```
<ol>
  <?php wp_list_comments( array(
    'callback'     =>  'bootstrapwp_comment',
  ) ); ?>
  </ol>
```
在functions.php添加自定义回调函数bootstrapwp_comment，函数方法如下：
```
 /**          
 * 评论列表的显示
 */
if ( ! function_exists( 'bootstrapwp_comment' ) ) :
function bootstrapwp_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
	  // 用不同于其它评论的方式显示 trackbacks 。
	?>
	<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
		<p><?php _e( 'Pingback:', 'bootstrapwp' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( '(Edit)', 'bootstrapwp' ), '<span class="edit-link">', '</span>' ); ?>
		</p>
	<?php
		break;
		default :
		// 开始正常的评论
		global $post;
	 ?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="media comment">
			<div class="pull-left">
  			<?php // 显示评论作者头像 
  			  echo get_avatar( $comment, 64 ); 
  			?>
			</div>
			<?php // 未审核的评论显示一行提示文字
			  if ( '0' == $comment->comment_approved ) : ?>
  			<p class="comment-awaiting-moderation">
  			  <?php _e( 'Your comment is awaiting moderation.', 'bootstrapwp' ); ?>
  			</p>
			<?php endif; ?>
			<div class="media-body">
				<h4 class="media-heading">
  				<?php // 显示评论作者名称
  				    printf( '%1$s %2$s',
  						get_comment_author_link(),
  						// 如果当前文章的作者也是这个评论的作者，那么会出现一个标签提示。
  						( $comment->user_id === $post->post_author ) ? '<span class="label label-info"> ' . __( 'Post author', 'bootstrapwp' ) . '</span>' : ''
  					);
  				?>
  		    <small>
    				<?php // 显示评论的发布时间
    				    printf( '<a href="%1$s"><time datetime="%2$s">%3$s</time></a>',
    						esc_url( get_comment_link( $comment->comment_ID ) ),
    						get_comment_time( 'c' ),
    					  // 翻译: 1: 日期, 2: 时间
    						sprintf( __( '%1$s %2$s', 'fenikso' ), get_comment_date(), get_comment_time() )
    					);
    				?>
  				</small>
				</h4>
				<?php // 显示评论内容
				  comment_text(); 
				?>
				<?php // 显示评论的编辑链接 
				  edit_comment_link( __( 'Edit', 'bootstrapwp' ), '<p class="edit-link">', '</p>' ); 
				?>
				<div class="reply">
					<?php // 显示评论的回复链接 
					  comment_reply_link( array_merge( $args, array( 
					    'reply_text' =>  __( 'Reply', 'bootstrapwp' ), 
					    'after'      =>  ' <span>&darr;</span>', 
					    'depth'      =>  $depth, 
					    'max_depth'  =>  $args['max_depth'] ) ) ); 
					?>
				</div>
			</div>
		</article>
	<?php
		break;
	endswitch; // end comment_type check
}
endif;
```
5、使用自定义bootstrap表单元素
下面我们把姓名，email,url,提交按钮换成Bootstrap样式。
```
<?php
$commenter = wp_get_current_commenter();
$req = get_option( 'require_name_email' );
$aria_req = ( $req ? " aria-required='true'" : '' );
 
$comment_form_args = array(
    // 添加评论内容的文本域表单元素
  	'comment_field'         => '<label for="comment" class="control-label">' . 
          	                    _x( 'Comment', 'noun' ) . 
          	                   '</label>
          	                    <textarea id="comment" name="comment" cols="45" rows="5" class="form-control" aria-required="true">
          	                    </textarea>',
    // 评论之前的提示内容
  	'comment_notes_before'  => ' ',
  	// 评论之后的提示内容
  	'comment_notes_after'   => ' ',
  	// 默认的字段，用户未登录时显示的评论字段
  	'fields'                => apply_filters( 'comment_form_default_fields', array(
    // 作者名称字段
		'author'                => '<label for="author" class="control-label">' .  __( 'Name', 'bootstrapwp' ) . '</label> ' .   ( $req ? '<span class="required help-inline">*</span>' : '' ) . 
                		            '<div class="controls">' . 
                		            '<input id="author"class="form-control" placeholder="author" name="author" type="text" value="' .  esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' />'. 
                		            '</div>',
    // 电子邮件字段              
		'email'                 => '<label for="email" class="control-label">' .    __( 'Email', 'fenikso' ) .   '</label> ' . ( $req ? '<span class="required help-inline">*</span>' : '' ) . 
                		            '<div class="controls">' . 
                		            '<input id="email" class="form-control" placeholder="email" name="email" type="text" value="' . 
                		             esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' />' . 
                		             '</div>',
    // 网站地址字段            		             
  	'url'                   => '<label for="url" class="control-label">' .     __( 'Website', 'bootstrapwp' ) .  '</label>' .   ( $req ? '<span class="required help-inline">*</span>' : '' ) . 
                  		          '<div class="controls">' . 
                  		          '<input id="url" class="form-control"  placeholder="url"authorname="url" type="text" value="' . 
                  		           esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></br></div>' ) 
) );
?>
<?php comment_form( $comment_form_args ); ?>
```

# 七、archive.php文件
archive.php文件 又称文章归档页面。在WordPress中，文章归档页面是一个非常重要的页面，特别是当你的wordpress网站文章很多的时候，它将文章以年月日的分类方式对文章进行归类，可以让读者很方便的迅速找到某年某日的文章。现在，很多博客，比如腾讯微博，QQ空间都有时间轴的显示方式，今天我们用也用时间轴的形式来记录显示我们的wordpress网站文章归档页面，并且加入伸缩功能。
1、在我们的主题更目录下建立archive.php(文章归档页面)
输入以下代码：
```
<?php
/**
 * The template for displaying archive pages
 * BootstrapWp 0.1
 */
get_header(); ?>
<div class="container">
<div class="archives">
<?php
			$previous_year = $year = 0;
			$previous_month = $month = 0;
			$ul_open = false;
			$myposts = get_posts('numberposts=-1&orderby=post_date&order=DESC');
				foreach($myposts as $post) :
				setup_postdata($post);
			$year = mysql2date('Y', $post->post_date);
			$month = mysql2date('n', $post->post_date);
			$day = mysql2date('j', $post->post_date);
				if($year != $previous_year || $month != $previous_month) :
				if($ul_open == true) :
				echo '</ul>';
				endif;
				echo '<h4 class="m-title">'; echo the_time('Y-m'); echo '</h4>';
				echo '<ul class="archives-monthlisting">';
				$ul_open = true;
				endif;
			$previous_year = $year; $previous_month = $month;
			?>
			<li>
			<a href="<?php the_permalink(); ?>"><span><?php the_time('Y-m-j'); ?></span>
			<div class="atitle"><?php the_title(); ?></div></a>
			</li>
			<?php endforeach; ?>
			</ul>
			</div></div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
```
由于主题是采用了Bootstrap框架所以加了，
```
<div class="container">
```
根据你自己的主题，可以选择适当的布局。
2、打开主题根目录下的style.css文件，加入以下css代码
```
/*
 * 文章归档页面样式
 */
.archive-title{border-bottom:1px #eee solid;position:relative;padding-bottom:4px;margin-bottom:10px} 
.archives li{list-style-type:none}
.archives li a{padding:8px 0;display:block}
.archives li a:hover .atitle:after{background:#ff5c43}
.archives li a span{display: inline-block;width:100px;font-size:12px;text-indent:20px}
.archives li a .atitle{display: inline-block;padding:0 15px;position:relative}
.archives li a .atitle:after{position:absolute;left:-6px;background:#ccc;height:8px;width:8px;border-radius:6px;top:8px;content:""}
.archives li a .atitle:before{position:absolute;left:-8px;background:#fff;height:12px;width:12px;border-radius:6px;top:6px;content:""}
.archives{position:relative;padding:10px 0}
.archives:before{height:100%;width:4px;background:#eee;position:absolute;left:130px;content:"";top:0}
.m-title{position:relative;margin:10px 0;cursor:pointer} 
.m-title:hover:after{background:#ff5c43}
.m-title:before{position:absolute;left:127px; background:#fff; height:18px;width:18px;border-radius:6px;top:3px;content:""}
.m-title:after{position:absolute;left:127px;background:#ccc;height:12px;width:12px;border-radius:6px;top:6px;content:""}
```
如果你引入以上CSS显示效果错乱的话，那么你就得调整上面的css布局了。
3、点击年月实现伸缩功能的话需要引入以下js
```
$('.archives ul.archives-monthlisting').hide();
$('.archives ul.archives-monthlisting:first').show();
$('.archives .m-title').click(function() {
    $(this).next().slideToggle('fast');
    return false;
});
```
---end---