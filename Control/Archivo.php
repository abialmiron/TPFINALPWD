<?php
class Archivo{
    private $temp_name;
    private $name;
    private $type;
    private $size;
    private $error;


    public function __construct($temp_name,$name,$type,$size,$error){
        $this->temp_name = $temp_name;
        $this->name = $name;
        $this->type = $type;
        $this->size = $size;
    }

    
    public function setTempName($temp_name) {
        $this->temp_name = $temp_name;
    }

    public function getTempName() {
        return $this->temp_name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getName() {
        return $this->name;
    }

    public function setType($type) {
        $this->type = $type;
    }

    public function getType() {
        return $this->type;
    }

    public function setSize($size) {
        $this->size = $size;
    }

    public function getSize() {
        return $this->size;
    }

    public function setError($error) {
        $this->error = $error;
    }

    public function getError() {
        return $this->error;
    }

    public function subirImagen(){
        $resp = false;
        $size = getimagesize($this->getTempName());
        if ($size > 0){
            if (!copy($this->getTempName(), $this->getName())) {
                $this->setError("ERROR: no se pudo copiar la imágen");
            }else{
                $resp = true;;
            }
        } else {
            $this->setError("ERROR: se debe subir una imágen");
        }
        return $resp;
    }
}
?>