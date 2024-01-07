<?php
// Get the header
get_header(); ?>

<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">

        <?php
        // Start the loop.
        while (have_posts()) : the_post();

            $image_size = 'medium'; // Set image size
            $image_data = wp_get_attachment_image_src(get_the_ID(), $image_size);
            $image_url = $image_data[0];
        ?>

            <style>
                .attachment-page-conten {
                    min-height: 80vh;
                    display: flex;
                    flex-direction: column;
                    justify-content: center;
                    align-items: center;
                    width: 100%;
                    gap:20;
                }
            </style>

            <div class="attachment-page-content">
                <!-- Display the medium sized image -->
                <img src="<?php echo esc_url($image_url); ?>" alt="<?php the_title_attribute(); ?>">

                <!-- Text next to the image -->
                <gallery-controls src="<?php echo esc_url($image_url) ?>" id="<?php echo get_the_ID() ?>" title="<?php the_title_attribute(get_the_ID());?>"></gallery-controls>
            </div>

        <?php
        // End the loop.
        endwhile;
        ?>

    </main><!-- .site-main -->
</div><!-- .content-area -->

<?php
// Get the footer
get_footer();
?>