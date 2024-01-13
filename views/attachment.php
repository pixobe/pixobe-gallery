<?php get_header();
?>

<?php

$attachment_id = get_the_ID();
$post_details = get_post($attachment_id);

$image_size = "medium";

// attachments
$attachment = array(
    'alt' => get_post_meta($post_details->ID, '_wp_attachment_image_alt', true),
    'caption' => $post_details->post_excerpt,
    'description' => $post_details->post_content,
    'href' => get_permalink($post_details->ID),
    'src' => $post_details->guid,
    'title' => $post_details->post_title
);
?>
<style>
    main {
        display: flex;
        justify-content: center;
    }

    .item1 {
        grid-area: header;
    }

    .item2 {
        grid-area: main;
    }

    .item3 {
        grid-area: text;
    }

    .item4 {
        grid-area: desc;
    }

    .item5 {
        grid-area: capt;
    }

    .item6 {
        grid-area: print;
    }

    .item7 {
        grid-area: color;
    }

    .grid-container {
        display: grid;
        width: fit-content;
        grid-template-areas:
            'header header header'
            'main main text'
            'main main capt'
            'main main desc'
            'print color desc'
        ;
        gap: 10px;
        background-color: #2196F3;
        padding: 10px;
    }

    .grid-container>div {
        background-color: rgba(255, 255, 255, 0.8);
        text-align: center;
        padding: 20px 0;
        font-size: 30px;
    }

    #button-style {
        display: inline-block;
        padding: 1rem;
        margin: 0;
        background-color: #ff0000;
        color: #ffffff;
        text-decoration: none;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
        line-height: normal;
    }

    /* Hover effect */
    #button-style:hover {
        background-color: #cc0000;
    }
</style>



<main>
    <div class="grid-container" id="pixobe-attachment">
        <div class="item1">
            <h1 class="title"><?php echo $attachment['title'] ?></h1>
        </div>
        <div class="item2"> <?php echo wp_get_attachment_image($attachment_id, 'medium'); ?></div>
        <div class="item3"> <?php echo $attachment['alt']; ?></div>
        <div class="item4"><?php echo $attachment['caption']; ?></div>
        <div class="item5"><?php echo $attachment['description']; ?></div>
        <div class="item6"><button id="button-style">Print</button></div>
        <div class="item7"><a id="button-style" href="/pixobe-coloring?size=<?php echo esc_attr($image_size) ?>&image_id=<?php echo esc_attr($attachment_id) ?>">Color</a></div>
    </div>
</main>

<script src="https://printjs-4de6.kxcdn.com/print.min.js" defer></script>


<script>
    const container = document.getElementById("pixobe-attachment");

    const btn = container.querySelector("button#button-style");
    if (btn) {
        btn.addEventListener("click", () => {
            printJS("<?php echo  $attachment['src'] ?>", 'image');
        });
    }
</script>

<?php get_footer();
?>