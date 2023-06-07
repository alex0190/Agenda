<?php
if(!empty($_SERVER["HTTP_X_REQUESTED_WITH"]) && strtolower($_SERVER["HTTP_X_REQUESTED_WITH"]) == "xmlhttprequest") 
{
   $ext = strtolower(pathinfo($_FILES["foto"]["name"], PATHINFO_EXTENSION));
		
   $nombre = uniqid();
   $path = "fotos/".$nombre.".".$ext;
	
   if(move_uploaded_file($_FILES["foto"]["tmp_name"], $path))
		echo $nombre.".".$ext;
   else
		echo "error"; 
}else{
    echo "error";
}
?>