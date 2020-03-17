<?php

function saveImg($path, $filename){
    if (!file_exists($_FILES['imagen']['tmp_name']) || !is_uploaded_file($_FILES['imagen']['tmp_name'])){
        $uploadOk = 0;
    }else{
        $target_dir = $path;
        $newname = $filename;
        $ext = pathinfo($_FILES["imagen"]["name"],PATHINFO_EXTENSION);
        $target_file = $target_dir . $newname . '.' .$ext;
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        
        // Check if image file is a actual image or fake image
        $check = getimagesize($_FILES["imagen"]["tmp_name"]);
        if($check !== false) {
            $uploadOk = 1;
            move_uploaded_file($_FILES["imagen"]["tmp_name"], $target_file);
            return $newname. '.' . $ext;
        } else {
            $uploadOk = 0;
        }
    }
}
?>