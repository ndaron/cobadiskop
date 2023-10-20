<?php get_header(); ?>
<div class="clearfix"></div>
<div id="main">
	<div id="content">
	<?php echo dimox_breadcrumbs(); ?>
	<?php $postcounter = 1; if (have_posts()) : ?>
	<?php while (have_posts()) : $postcounter = $postcounter + 1; the_post(); $do_not_duplicate = $post->ID; $the_post_ids = get_the_ID(); ?>
	<div class="post post-<?php echo $postcounter ;?>">
	<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a></h2>
	<?php the_post_thumbnail('thumb80', array('class' => 'thumb')); ?>
	<p><?php echo excerpt(40); ?></p>
	</div>
	<div class='clearfix'></div>
	<?php endwhile; ?>
	<div class="navigation">
			<div class="alignleft"><?php next_posts_link(); ?></div>
			<div class="alignright"><?php previous_posts_link(); ?></div>
	</div>
	</div>
	<?php else : ?>
		<div class="entry">
		<h2>Not Found</h2>
		<p>Sorry, but you are looking for something that isn't here.</p></div>
	</div>
	<?php endif; ?>
<?php get_sidebar(); ?>
<div class='clearfix'></div>
<?php get_footer(); ?>