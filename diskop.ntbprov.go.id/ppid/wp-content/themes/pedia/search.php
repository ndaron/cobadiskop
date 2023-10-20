<?php get_header(); ?>
<div class="clearfix"></div>
<div id="main">
	<div id="content">
	<?php echo dimox_breadcrumbs(); ?>
	<?php $postcounter = 0; if (have_posts()) : ?>
	<?php while (have_posts()) : $postcounter = $postcounter + 1; the_post(); $do_not_duplicate = $post->ID; $the_post_ids = get_the_ID(); ?>
	<div class="post post-<?php echo $postcounter ;?>">
	<?php the_post_thumbnail('thumb125', array('class' => 'thumb')); ?>
	<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a></h2>
	<div class="meta">
		<span class="date">On <?php the_time('l, F jS, Y') ?></span>
		<span class="author">By <?php the_author_posts_link(); ?></span>
	</div>
	<p><span class="link"><?php the_category(', ') ?></span><?php echo excerpt(23); ?></p>
	</div>
	<div class='clearfix'></div>
	<?php endwhile; ?>
	<div class="pagenavi">
		<?php wp_pagenavi('', '', '', '', 10, false); ?>
	<div class="clearfix"></div>
	</div>	
	</div>
	<?php else : ?>
<?php
 $rand_posts = get_posts('numberposts=10&orderby=rand'); //angka 10 = jumlah postingan yang mau ditampilkan
 foreach( $rand_posts as $post ) :
 setup_postdata($post);
 ?>
	<div id="content">
	
	
	<div class="post post-<?php echo $postcounter ;?>">
	<?php the_post_thumbnail('thumb125', array('class' => 'thumb')); ?>
	<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a></h2>
	<div class="meta">
		<span class="date">On <?php the_time('l, F jS, Y') ?></span>
		<span class="author">By <?php the_author_posts_link(); ?></span>
	</div>
	<p><span class="link"><?php the_category(', ') ?></span><?php echo excerpt(23); ?></p>
	</div>
	<div class='clearfix'></div>
	
	<div class="pagenavi">
		<?php wp_pagenavi('', '', '', '', 10, false); ?>
	<div class="clearfix"></div>
	</div>
	</div>	
	

<?php endforeach; ?>
</div>
	<?php endif; ?>
<?php get_sidebar(); ?>
<div class='clearfix'></div>
<?php get_footer(); ?>