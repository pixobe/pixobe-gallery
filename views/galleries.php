<?php

/**
 * 
 * 
 *  Admin Menu screen
 */

use PixobeGallery\Plugins\Pixobe_Gallery_Utils;

$galleries = Pixobe_Gallery_Utils::get_galleries();

?>
<ul>
    <?php
    foreach ($galleries as $key=>$value) {
    ?>
        <li>
            <a href="?page=pixobe-gallery&id=<?php echo $key;?>">Gallery-<?php echo $key;?></a>
        </li>
    <?php } ?>
</ul>

