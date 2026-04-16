<?php

namespace AJE\Utils;

class SaveImageHanddler
{
    private string $imageDirectory;

    public function __construct(string $uniqid)
    {
        $this->imageDirectory = $this->createImageDirectory($uniqid);
    }

    public function generateUniqid(): string
    {
        return uniqid();
    }

    private function createImageDirectory(string $uniqid): string
    {
        if (!is_dir(ARTICLES_IMAGES . "/" . $uniqid)) {
            mkdir(ARTICLES_IMAGES . "/" . $uniqid);
        }
        return ARTICLES_IMAGES . "/" . $uniqid ."/";
    }

    public function saveImages(array $images): bool
    {

        for ($i = 0; $i < count($images['tmp_name']); $i++) {
            $tempName = $images['tmp_name'][$i];
            $extenstion = $this->setupImageExtension($images['type'][$i]);
            $fileName = "image" . $i . $extenstion;
            if (!move_uploaded_file($tempName, $this->imageDirectory . $fileName)) {
                return false;
            } 
        }

        return true;
    }
    private function setupImageExtension(string $type): string
    {
        $ext = ".";
        $ext .= preg_replace("/image\//", "", $type);
        return $ext;
    }
}
