<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
if(isset($_POST)){
    
    if(!empty($_FILES['image'])){
        
        $file_size = round($_FILES["image"]['size'] / 1024);
        if($file_size <= 0){
            $messages[] = array("message" => "Tamanho da foto não é válido.", "type" => "warning");
        }
        
//        if($file_size > 500){
//            $messages[] = array("message" => "Tamanho da foto maior que o permitido.", "type" => "warning");
//        }
        
        $allowed_ext = array("gif", "jpeg", "jpg", "png");
        $temp = explode(".", $_FILES["image"]["name"]);
        $extension = strtolower(end($temp));
        if(!in_array($extension, $allowed_ext)){
            $messages[] = array("message" => "O tipo da foto não é válido.", "type" => "warning");
        }

        if(!isset($messages)){
            
//            $new_file_name = md5($user->hot_id.$user->usu_id).".".$extension;
            $new_file_name = "foto.".$extension;
            $save = $_SERVER["TMP"] . DS . $new_file_name;
            foreach ($allowed_ext as $ext){
                $exist_file_name = $_SERVER["TMP"] . DS . "foto." . $ext;
                if(file_exists($exist_file_name)){
                    chmod($exist_file_name,0755);
                    unlink($exist_file_name);
                }
            }

            list($width_orig, $height_orig) = getimagesize($_FILES["image"]['tmp_name']);
            
            list($width, $height) = explode('X', $_POST['dimension']);

//            $width = 800;
//            $height = 600;

            if($width_orig < $height_orig) {
                $width = ($height/$height_orig)*$width_orig;
            }elseif($width_orig > $height_orig){
                $height = ($width/$width_orig)*$height_orig;
            }elseif($width_orig == $height_orig){
                $width = ($height/$height_orig)*$width_orig;
            }

            $dst_r = ImageCreateTrueColor( $width, $height );

            switch($extension){
                case "gif":
                    $image = @imagecreatefromgif($_FILES["image"]['tmp_name']);
                    break;
                case "jpg":
                    $image = @imagecreatefromjpeg($_FILES["image"]['tmp_name']);
                    break;
                case "jpeg":
                    $image = @imagecreatefromjpeg($_FILES["image"]['tmp_name']);
                    break;
                case "png":
                    $image = @imagecreatefrompng($_FILES["image"]['tmp_name']);
                    break;
            }

            @imagecopyresampled($dst_r, $image, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);

            switch($extension){
                case "gif":
                    if(!@imagegif($dst_r,$save)){
                        $messages[] = array("message" => "Permissão negada [GIF].", "type" => "error");
                    }
                    break;
                case "jpg":
                    if(!@imagejpeg($dst_r, $save, 100)){
                        $messages[] = array("message" => "Permissão negada [JPG].", "type" => "error");
                    }
                    break;
                case "jpeg":
                    if(!@imagejpeg($dst_r, $save, 100)){
                        $messages[] = array("message" => "Permissão negada [JPEG].", "type" => "error");
                    }
                    break;
                case "png":
                    if(!@imagepng($dst_r, $save, 0)){
                        $messages[] = array("message" => "Permissão negada [PNG].", "type" => "error");
                    }
                    break;
            }
            
            if(is_resource($dst_r)){
                $imgBinary = fread(fopen($save, "r"), filesize($save));
                @imagedestroy($dst_r);
            }

            $reponse = array(
                "image" => '<img src="data:image/'.$extension.';base64,'.base64_encode($imgBinary).'" style="opacity: 0.8"/>',
                "name" => $new_file_name,
                "width" => (int)$width,
                "height" => (int)$height,
            );
        }else{
            $reponse = array(
                "messages" => $messages
            );
        }
        
        echo (json_encode($reponse));
    }
}
?>
