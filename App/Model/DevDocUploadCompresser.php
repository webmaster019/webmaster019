<?php


class DevDocUploadCompresser
{
    private  $out_put=null;
    private  $index=null;
    public function __construct($indexFille,$out_put=null)
    {
        $this->index=$indexFille;
        $this->out_put=$out_put;

    }

    public  function Compreser_multiple($size)
    {
        if (isset($_FILES[$this->index])) {
            $tab=null;
            $list=null;
            $filesCount= count($_FILES[$this->index]['name']);
            //foreach($_FILES[$this->index]['name'] as $keys=>$val) {
            for ($keys=0; $keys < $filesCount; $keys++){
                if (!$_FILES[$this->index]['error'][$keys]){

                    $post_photo = $_FILES[$this->index]['name'][$keys];
                    $post_photo_tmp = $_FILES[$this->index]['tmp_name'][$keys];
                    //$nom=basename($_FILES[$this->index]['name']);
                    $nom = rand() . "fk" . basename($post_photo);
                    $verif_image_ext = getimagesize($post_photo_tmp);
                    $ext = pathinfo($post_photo, PATHINFO_EXTENSION);
                    if ($verif_image_ext && $verif_image_ext[2] < 4) {


                        if ($ext == 'jpg' || $ext == 'jpeg' || $ext == 'JPG' || $ext == 'JPEG') {
                            $src = imagecreatefromjpeg($post_photo_tmp);
                        }

                        if ($ext == 'png' || $ext == 'PNG') {
                            $src = imagecreatefrompng($post_photo_tmp);
                        }
                        if ($ext == 'gif' || $ext == 'GIF') {
                            $src = imagecreatefromgif($post_photo_tmp);
                        }
                        list($width_min, $height_min) = getimagesize($post_photo_tmp);
                        $newwidth_min = $size;
                        $newheight_min = ($height_min / $width_min) * $newwidth_min;
                        $tmp_min = imagecreatetruecolor($newwidth_min, $newheight_min);

                        imagecopyresampled($tmp_min, $src, 0, 0, 0, 0, $newwidth_min, $newheight_min, $width_min, $height_min);
// imagejpeg($tmp_min, "uploads/e".$post_photo,8O);
                        if (file_exists($this->out_put == null ? $this->out_put . '/' : $this->out_put)) {

                            if (imagejpeg($tmp_min, $this->out_put . $nom, 80)) {
                                $list[]=$nom;
                            } else {
                                return false;
                            }
                        } else {
                            return false;
                        }


                    }
                }
            }

        }else {
            throw new Exception("l'index {$this->index} n'existe pas",404);
        }
        $tab= (array) $list;
        return $tab ;
    }



    public  function NonCompresor_multiple()
    {
        if (isset($_FILES[$this->index])) {
            $tab=null;
            $filesCount= count($_FILES[$this->index]['name']);
            //foreach($_FILES[$this->index]['name'] as $keys=>$val) {
            for ($keys=0; $keys < $filesCount; $keys++){
                if (!$_FILES[$this->index]['error'][$keys]){

                    $post_photo = $_FILES[$this->index]['name'][$keys];
                    $post_photo_tmp = $_FILES[$this->index]['tmp_name'][$keys];
                    $nom = rand() . "fk" . basename($_FILES[$this->index]['name'][$keys]);
                    $verif_image_ext = getimagesize($post_photo_tmp);
                    if ($verif_image_ext && $verif_image_ext[2] < 4) {
                        if (file_exists($this->out_put == null ? $this->out_put . '/' : $this->out_put)) {
                            if (move_uploaded_file($post_photo_tmp, $this->out_put . $nom)) {
                                $list[$keys]=[
                                    "nom"=>$nom
                                ];
                            } else {
                                return "probleme uploade";
                            }
                        } else {
                            return 'problème output';
                        }


                    } else {
                        return "extention";
                    }
                }
            }

        }else {
            return "erreur file";
        }
        $tab['images']=$list;
        return $tab ;



    }


    public  function Compreser_mono($size)
    {
        if (isset($_FILES[$this->index]) AND !$_FILES[$this->index]['error']){
            $post_photo=$_FILES[$this->index]['name'];
            $post_photo_tmp=$_FILES[$this->index]['tmp_name'];
            $nom=rand()."fk".basename($_FILES[$this->index]['name']);
            $verif_image_ext=getimagesize($post_photo_tmp);
            $ext=pathinfo($post_photo,PATHINFO_EXTENSION);
            if ($verif_image_ext && $verif_image_ext[2]<4) {


                if ($ext == 'jpg' || $ext == 'jpeg' || $ext == 'JPG' || $ext == 'JPEG') {
                    $src = imagecreatefromjpeg($post_photo_tmp);
                }

                if ($ext == 'png' || $ext == 'PNG') {
                    $src = imagecreatefrompng($post_photo_tmp);
                }
                if ($ext == 'gif' || $ext == 'GIF') {
                    $src = imagecreatefromgif($post_photo_tmp);
                }
                list($width_min, $height_min) = getimagesize($post_photo_tmp);
                $newwidth_min = $size;
                $newheight_min = ($height_min / $width_min) * $newwidth_min;
                $tmp_min = imagecreatetruecolor($newwidth_min, $newheight_min);

                imagecopyresampled($tmp_min, $src, 0, 0, 0, 0, $newwidth_min, $newheight_min, $width_min, $height_min);
// imagejpeg($tmp_min, "uploads/e".$post_photo,8O);
                if (file_exists($this->out_put == null ? $this->out_put . '/' : $this->out_put)) {
                    if (imagejpeg($tmp_min, $this->out_put . $nom, 80)) {
                        return $nom;
                    } else {
                        return false;
                    }
                }else{
                    return  false;
                }


            }

        }else {
            return false;
        }
        return false;
    }

    public  function Non_compresor_mono()
    {
        if (isset($_FILES[$this->index]) AND !$_FILES[$this->index]['error']){
            $post_photo=$_FILES[$this->index]['name'];
            $post_photo_tmp=$_FILES[$this->index]['tmp_name'];
            $nom=rand()."fk".basename($_FILES[$this->index]['name']);
            $verif_image_ext=getimagesize($post_photo_tmp);
            if ($verif_image_ext && $verif_image_ext[2]<4) {

                if (file_exists($this->out_put == null ? $this->out_put . '/' : $this->out_put)) {
                    if (move_uploaded_file($post_photo_tmp, $this->out_put . $nom)) {
                        return $nom;
                    } else {
                        return false;
                    }
                }else{
                    return false;
                }


            }

        }else {
            return false;
        }
        return false;

    }

    public function delete_image($fille,$image)
    {
        if (!empty($fille) && !empty($image)){
            $dir_name=$fille.$image;
            if (file_exists($dir_name)){
                if (unlink($dir_name)){
                    return true;
                }else return false;

            }else return false;

        }else return false;

    }

    public function mage_unset($image)
    {
        if ( !empty($image)){
            $dir_name=$this->out_put.DIRECTORY_SEPARATOR.$image;
            if (file_exists($dir_name)){
                if (unlink($dir_name)){
                    return true;
                }else return false;

            }else return false;

        }else return false;

    }

}