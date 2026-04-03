<?php
namespace AJE\Utils;

class SaveImageHanddler{
    private array $images;
    private string $artName;
    private string $idArt;
    private string $imageDirectory;

    public function __construct(array $images, string $an, string $idArticle)
    {
        echo("passage");
        $this->images = $images;
        $this->artName = DataTransformer::removeWhitespaces($an);
        $this->artName = strtolower($this->artName);
        $this->idArt = $idArticle;
        $this->createImageDirectory();
        $this->saveImage();
    }

    private function createImageDirectory() : void {
        if(!is_dir(ARTICLES_IMAGES . "/" . $this->idArt . $this->artName)){
            mkdir(ARTICLES_IMAGES . "/" . $this->idArt . $this->artName);
        }
        $this->imageDirectory = ARTICLES_IMAGES . "/" . $this->idArt . $this->artName . "/";

    }

    private function saveImage() : void {
        var_dump($this->images['tmp_name']);
        for($i = 0; $i < count($this->images['tmp_name']); $i++){
            $tempName = $this->images['tmp_name'][$i];
            $extenstion = $this->setupImageExtension($this->images['type'][$i]);
            $fileName = "image". $i .$extenstion;
            if(!move_uploaded_file($tempName, $this->imageDirectory . $fileName)){
                echo "Pas de bol";
            }
            else{
                echo "Ok";
            }

        }
        
    }
    private function setupImageExtension(string $type) : string {
        $ext = ".";
        $ext .= preg_replace("/image\//", "", $type);
        return $ext;
    }


}