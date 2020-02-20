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
	<?php wp_list_comments( array(
		'callback'     =>  'bootstrapwp_comment',
	  ) ); ?>
  </ol>
</section>

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