<?php
$allowed_filetypes = array('.jpg','.jpeg','.png','.gif');
$upload_path = 'map/';

$filename = $_POST["image"];
echo($fielname);
$ext = substr($filename, strpos($filename,'.'), strlen($filename)-1);

if(!in_array($ext,$allowed_filetypes))
  die('The file you attempted to upload is not allowed.');

if(move_uploaded_file($filename,$upload_path . $filename)){
echo 'Your file upload was successful!';
} else {
     echo 'There was an error during the file upload.  Please try again.';
}
?>