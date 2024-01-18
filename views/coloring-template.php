<?php get_header();
?>

<?php

if (isset($_GET['image_id'])) {
    $id = $_GET['image_id'];
    $image_width = $_GET['image_width'] ?? "75";
    $image_attributes = wp_get_attachment_image_src($id, "full");

    if ($image_attributes) {
?>

        <style>
            main {
                height: 100%;
                display:flex;
                margin:0 auto;
                width: <?php echo esc_html($image_width) ?>%;
            }

            @media only screen and (max-width: 600px) {
                main {
                    width: 100%;
                }
            }
        </style>

        <main>
            <?php echo do_shortcode("[pixobecoloringbook src=\"$image_attributes[0]\"]") ?>
        </main>
<?php
    }
}
?>
<?php get_footer();
?>