<?php

include_once('inc/class-wp-bootstrap-navwalker.php');

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
//add_action( 'wp_enqueue_scripts', 'bootstrapwp_scripts_with_jquery' );



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


/*
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

?>