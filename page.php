<?php get_header(); ?>

<main>
    <?php while (have_posts()) : the_post(); ?>

        <section class="section center">
            <div class="section__inner">
                <article>
                    <?php the_content(); ?>
                </article>
            </div>
        </section>

    <?php endwhile; ?>
</main>

<?php get_footer(); ?>