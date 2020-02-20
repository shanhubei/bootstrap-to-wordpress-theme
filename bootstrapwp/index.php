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
		
		<div class="col-md-3">        
			<?php get_sidebar(); ?>      
		</div>
		
		</div>
</div>


<?php get_footer(); ?>