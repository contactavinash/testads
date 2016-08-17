<?php 
$siteurl =  "http://" . $_SERVER['SERVER_NAME'].substr($_SERVER['REQUEST_URI'], 0, strrpos($_SERVER['REQUEST_URI'], '/') + 1);
@unlink('gallery/'.$_REQUEST['file']);
?>
