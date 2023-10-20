<?php get_header(); ?>
<div class="clearfix"></div>
<div id="main">
	<div id="content">
	<?php echo dimox_breadcrumbs(); ?>
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	<div class="entry">
	<h1 class="title"><?php the_title(); ?></h1>
	<div class="meta">
		<span>By <?php the_author_posts_link(); ?></span>
		<span>On <?php the_time('l, F jS, Y') ?></span>
		<span>Categories : <?php the_category(', ') ?></span>
	</div>
<hr>

	<?php the_content(); ?>
	<?php $ads2 = of_get_option('ads2'); if(($ads2 == '')) { ?>
	<?php } else { ?>
	<div class='ads'>
	<?php $ads_txt2 = of_get_option('ads_txt2'); if(($ads_txt2 == '1')) { ?>
	<span>Advertisement</span>
	<?php } else { ?>
	<?php } ?>
	<div class="widget_ads">
	<?php echo of_get_option('ads2'); ?>
	</div>
	</div>
	<?php } ?>
	</div>
	<div class="sharebar">
	<?php get_template_part( 'sharebar' ); ?>
	</div>
	<div class='clearfix'></div>
	<?php $hreview = of_get_option('hreview'); if(($hreview == '1')) { ?>
	<div class="reviewsnip">
	<div itemscope itemtype="http://data-vocabulary.org/Review">
	<span itemprop="itemreviewed"><?php the_title(); ?></span> &#124;
	<span itemprop="reviewer">
		<span class="author vcard"><a class="url fn n" href="<?php echo of_get_option('gplusid');?>" title="<?php the_author() ?>" rel="author me"><?php the_author() ?></a></span>
	</span> &#124;
	<span itemprop="rating" class="rating">4.5</span></div> 
	</div>
	<div class='clearfix'></div>
	<?php } else { ?>
	<?php } ?>	
	<div class="related_posts">
	<?php get_template_part( 'related' ); ?>
	</div>
	<?php $fbappid = of_get_option('fbappid'); if(($fbappid == '')) { ?>
	<?php } else { ?>	
	<?php if( comments_open() ): ?>
    <div id="fb-comments">
    <h5 class="widget-title"><span>Leave a Reply</span></h5>
	<div id="fb-root"></div>
	<script src="http://connect.facebook.net/en_US/all.js#xfbml=1"></script>
	<fb:comments href="<?php the_permalink(); ?>" width="585" num_posts="10"></fb:comments>  
    </div>
	<div class='clearfix'></div>
	<?php endif; // end comments_open() ?>
	<?php } ?>
	<?php endwhile; ?>
	<div class='clearfix'></div>
	</div>
	<?php else : ?>
		<h2>Not Found</h2>
		<div class="entry">Sorry, but you are looking for something that isn't here.</div></div>
	<?php endif; ?>
<?php get_sidebar(); ?>
<div class='clearfix'></div>
<?php get_footer(); ?>