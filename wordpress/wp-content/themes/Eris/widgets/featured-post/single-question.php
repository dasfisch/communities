<?php the_post(); ?>
<?php get_template_part('parts/header', 'widget') ;?>
    <?php $c = get_the_category(); ?>
    <?php if (is_widget()->show_category || is_widget()->show_date) : ?>

        <div class="content-details clearfix">
            <?php if (is_widget()->show_category) : ?>
                <span class="content-category">
                    <a href="<?php get_category_link(get_query_var($c[0]->term->id)); ?>" title="<?php echo $c[0]->cat_name; ?>">
                        <?php echo $c[0]->cat_name; ?>
                    </a>
                </span>
            <?php endif; //show category; ?>

            <time class="content-date" datetime="<?php the_time('Y-m-d'); ?>">
                <?php the_time('F j, Y'); ?>
            </time>
        </div>

    <?php endif; //show category or show date ?>


    <?php if (is_widget()->show_thumbnail) : ?>
        <div class="category-image">

            <img src="<?php (function_exists('get_category_image_url')) ? get_category_image_url((int)$c[0]->term_id) : ''; ?>" />
        </div>
    <?php endif; ?>

    <h6 class="content-headline">
        Q:<a href="<?php the_permalink(); ?>">
            
            <?php the_title(); ?>
        </a>
    </h6>
    
    <?php  if(is_widget()->show_content) : ?>
        <p class="content-excerpt">
            <?php the_excerpt(); ?>
        <p>
    <?php endif; //is_widget_show_content ?>


    <ul class="content-comments">
        <li><?php custom_comment_count('answer'); ?> answers</li>
    </ul>

    <section class="post-actions">
        <?php get_partial( 'parts/share' ); ?>
    </section>

<?php get_template_part('parts/footer', 'widget') ;?>
