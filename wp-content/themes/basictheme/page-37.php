<?php get_header(); ?>

<?php 
	
	if( have_posts() ):
		
		while( have_posts() ): the_post(); ?>
<?php the_content(); ?>
</div>
</div>
    <div class="row d-xs-block d-md-none">
        <div class="col-12">
            <h3 class="px-4">
                <?php the_title(); ?>
            </h3>
        </div>
    </div>
    <div class="bio-wrap">
    <div class="row d-xs-block d-md-none">
        <div class="col-12">
            <?php the_content(); ?>
        </div>
    </div>
</div>
<?php endwhile;
	endif;
	?>
<?php get_footer(); ?>
