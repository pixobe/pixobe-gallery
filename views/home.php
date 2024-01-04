<?php

/**
 * 
 * 
 *  Admin Menu screen
 */

 ?>


 <h1> Add Gallery</h1>

 <button id="media-open">Open</button>

<pixobe-media-admin></pixobe-media-admin>



<script lang="javascript">

  const btn = document.getElementById("media-open");

  btn.addEventListener("click",()=>{
	 const gallery =  wp.media({title:"hello"});
	 gallery.open();
  })

</script>