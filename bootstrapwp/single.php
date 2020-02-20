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