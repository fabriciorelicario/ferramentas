<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
defined('_EXEC') or die('PATH_LIBRARIES não definida corretamente ' . basename(__FILE__));

class PhotoController extends Controller
{
    public function __construct($config = array()) {
        $config['base_path'] = dirname(__FILE__); 
        $config['model_prefix'] = 'PhotoModel';
        $config['model_path'] = PATH_MODELS . '/photo';

        parent::__construct($config);
    }

    
    public function setUserPhoto (){

        $post = Request::get('post');
        $model = $this->getModel('Photo');
        $allowed_ext = array("gif", "jpeg", "jpg", "png");

        if($post["usu_id"] == ""){
            $this->setMessage("Usuário não selecionado.","error");
            $this->setRedirect("index2.php?view=users&layout=photo");
            return false;
        }
        
        $old_image = $_SERVER["TMP"] .DS . $post['tmp_image'];
        if(file_exists($old_image)){
            
            $extension = end(explode(".", $old_image));
            
            if(!is_dir('img/hotels/'.$post['hot_id'])){
                mkdir('img\\hotels\\'.$post['hot_id'], 0755, true);
            }
            
            if(!is_dir('img/hotels/'.$post['hot_id'].'/users/')){
                mkdir('img\\hotels\\'.$post['hot_id'].'\\users', 0755, true);
            }
            
            
            $save = 'img/hotels/'.$post['hot_id'].'/users/'.$post['tmp_image'];
            foreach ($allowed_ext as $ext){
                $exist_file_name = 'img/hotels/'.$post['hot_id'].'/users/'.md5($post['usu_id']).".".$ext;
                if(file_exists($exist_file_name)){
                    chmod($exist_file_name,0755);
                    unlink($exist_file_name);
                }
            }
            
            if(!empty($post['w'])){
                
                switch($extension){
                    case "gif":
                        $image = @imagecreatefromgif($old_image);
                        break;
                    case "jpg":
                        $image = @imagecreatefromjpeg($old_image);
                        break;
                    case "jpeg":
                        $image = @imagecreatefromjpeg($old_image);
                        break;
                    case "png":
                        $image = @imagecreatefrompng($old_image);
                        break;
                }
                $dst_r = ImageCreateTrueColor( $post['w'], $post['h'] );
                @imagecopyresampled($dst_r,$image,0,0,$post['x'],$post['y'],$post['w'],$post['h'],$post['w'],$post['h']);
                
                switch($extension){
                    case "gif":
                        if(!@imagegif($dst_r, $save)){
                            $this->setMessage("Permissão negada [GIF].", "error");
                        }else{
                            $post['usu_image'] = $post['tmp_image'];
                            if(!$model->addPhotoUser($post)){
                                $this->setMessage($this->getError(), 'error');
                                return false;
                            }
                            $_SESSION['user']->usu_image = $post['tmp_image'];
                        }
                        break;
                    case "jpg":
                        if(!@imagejpeg($dst_r, $save, 100)){
                            $this->setMessage("Permissão negada [JPG].", "error");
                        }else{
                            $post['usu_image'] = $post['tmp_image'];
                            if(!$model->addPhotoUser($post)){
                                $this->setMessage($this->getError(), 'error');
                                return false;
                            }
                            $_SESSION['user']->usu_image = $post['tmp_image'];
                        }
                        break;
                    case "jpeg":
                        if(!@imagejpeg($dst_r, $save, 100)){
                            $this->setMessage("Permissão negada [JPEG].", "error");
                        }else{
                            $post['usu_image'] = $post['tmp_image'];
                            if(!$model->addPhotoUser($post)){
                                $this->setMessage($this->getError(), 'error');
                                return false;
                            }
                            $_SESSION['user']->usu_image = $post['tmp_image'];
                        }
                        break;
                    case "png":
                        if(!@imagepng($dst_r, $save, 0)){
                            $this->setMessage("Permissão negada [PNG].", "error");
                        }else{
                            $post['usu_image'] = $post['tmp_image'];
                            if(!$model->addPhotoUser($post)){
                                $this->setMessage($this->getError(), 'error');
                                return false;
                            }
                            $_SESSION['user']->usu_image = $post['tmp_image'];
                        }
                        break;
                        
                        
                }
                
                @imagedestroy($dst_r);
            }else{
                if(!rename($old_image, $save)){
                    $this->setMessage("Imagem não foi movida para diretório de destino", 'error');
                    return false;
                }
                
                $post['usu_image'] = $post['tmp_image'];
                if(!$model->addPhotoUser($post)){
                    $this->setMessage($this->getError(), 'error');
                    return false;
                }
                $_SESSION['user']->usu_image = $post['tmp_image'];
            }
        }else{
            $this->setMessage("Imagem no diretório temporário não foi localizada", 'error');
            return false;
        }
        
        if(!unlink($old_image)){
            $this->setMessage("Imagem temporaia não foi removida.", "info");
        }
        
        $this->setMessage("Imagem adicionada com sucesso", 'success');
        $this->setRedirect("index2.php?view=users&layout=photo");
    }
}
?>