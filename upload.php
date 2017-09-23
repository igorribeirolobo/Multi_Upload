<?php

class Upload {

    private $target_dir = "../midias/produtos/fotos";
    private $verifica = true;
    private $name = array();
    private $tmp_name = array();
    private $size = array();
    private $resultado = 0;
//$name -> recebe o nome do input  $tipo -> recebe o dado que deseja retorno
    public function busca($name, $tipo) {
        $i = 0;
        foreach ($_FILES[$name][$tipo] as $file) {
            if ($tipo == "name") {
                $this->name[$i] = $file;
                $i++;
            }
            if ($tipo == "tmp_name") {
                $this->tmp_name[$i] = $file;
                $i++;
            }
            if ($tipo == "size") {
                $this->size[$i] = $file;
                $i++;
            }
        }
    }
    public function getResultado()
    {
        return $this->resultado;
    }
    public function porcent($valorAtual, $valorTotal)
    {
        $this->resultado = (($valorAtual + 1) * 100) / $valorTotal;
        
        
    }
//$pos -> recebe a posição do vetor onde esta armazenado os dados do upload
    public function subir($pos) {
        $target_file = $this->target_dir . basename($this->name[$pos]);
        $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
        $retorno = "";

        $check = getimagesize($this->tmp_name[$pos]);
        if ($check !== false) {
            $retorno = "File is an image - " . $check["mime"] . ".<br />";
        } else {
            $retorno = "File is not an image.<br />";
            $this->verifica = false;
        }
        if (file_exists($target_file)) {
            $retorno .= "Sorry, file already exists.<br />";
            $this->verifica = false;
        }
        if ($this->size[$pos] > 300000) {
            $retorno .= "Sorry, your file is too large.<br />";
            $this->verifica = false;
        }
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            $retorno .= "Sorry, only JPG, JPEG, PNG & GIF files are allowed.<br />";
            $this->verifica = false;
        }
        if (!$this->verifica) {
            $retorno .= "Sorry, your file was not uploaded.<br />";
        } else {
            if (move_uploaded_file($this->tmp_name[$pos], $target_file)) {
                $retorno .= "The file " . basename($this->name[$pos]) . " has been uploaded.<br />";
            } else {
                $retorno .= "Sorry, there was an error uploading your file.<br />";
            }
        }

        return $retorno;
    }

//$pos -> recebe a posição do vetor onde esta armazenado os dados do upload
    public function getPath($pos) {
        
        return $this->target_dir.$this->name[$pos];
    }

}

?>