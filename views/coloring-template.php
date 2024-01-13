<?php get_header();
?>

<?php

if (isset($_GET['image_id'])) {
    $id = $_GET['image_id'];
    $image_size = isset($_GET['size']) ? $_GET['size'] : "full";
    $image_attributes = wp_get_attachment_image_src($id, $image_size);
    if ($image_attributes) {
?>

        <style>
            main {
                min-height: 80vh;
                display: flex;
                justify-content: center;
                align-items: center;
                width: 100%;
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