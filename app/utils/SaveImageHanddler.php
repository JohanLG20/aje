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
        return ARTICLES_IMAGES . "/" . $uniqid . "/";
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

    public static function addFirstImageToArray(array $arr): array
    {
        //We use the index to modify the array by referencing it
        foreach ($arr as $index => $val) {
            $image = SaveImageHanddler::getFirstImage($val['image_repertory']);
            $arr[$index]['image'] = $image ?? IMAGE_NOT_FOUND_LINK;
        }

        return $arr;
    }

    /**
     *  Note : The image path returned will be the first one in alphabetic order. If a modification of the images naming pattern is done, this function has to be updated too. Can return null
     * @param string $uniqid The uniqid where the image is stored
     * 
     * @return ?string The path to the image
     */
    public static function getFirstImage(string $uniqid): ?string
    {

        if (is_dir(ARTICLES_IMAGES . "/" . $uniqid)) {

            $dir = ARTICLES_IMAGES . "/" . $uniqid;
            $allImagesPath = array_diff(scandir($dir), ["..", "."]);

            if (isset($allImagesPath[2])) {
                $image = IMAGE_LINK . "/" . $uniqid . "/" . $allImagesPath[2];
            } else {
                $image = null;
            }

            return $image;
        } else {
            return null; //TODO: add non found image path
        }
    }
}
