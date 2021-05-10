

<html> 
  <head>
     <title>Upload and Store video to MySQL Database with PHP</title>
  </head>
  <body>
      
<?php
$target_dir = "/storage/ssd3/315/15909315/public_html/smartSrv/videos/";
$target_file = $target_dir . basename($_FILES["file"]["name"]);

// Select file type
$videoFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Valid file extensions
$extensions_arr = array("mp4","avi","3gp","mov","mpeg");

if( in_array($videoFileType,$extensions_arr) ){
    if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
    echo "The file ". htmlspecialchars( basename( $_FILES["file"]["name"])). " has been uploaded.";
  } else {
    echo "Sorry, there was an error uploading your file.";
  }
} else {
    echo "Sorry, the file is not video or the type is not supported";
}



?>
      
    <form method="post" action="" enctype='multipart/form-data'>
      <input type='file' name='file' />
      <input type='submit' value='Upload' name='but_upload'>
    </form>

  </body>
</html>