<?php
/**
 * 
 * 
 *  Admin Menu screen
 */

 wp_enqueue_media();

 $id = "";

 if (isset($_GET['id'])) {
    $id = $_GET['id'];
 }

 ?>

 <pixobe-gallery-admin id="<?php echo $id?>"></pixobe-gallery-admin>
 