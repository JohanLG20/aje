<?php

namespace AJE\Utils;

class ImageHanddler
{

    /**
     * Returns an uniqid
     * @return string An uniqid
     */
    public function generateUniqid(): string
    {
        return uniqid();
    }

    /**
     * Creates a directory inside the images folder on the server with the given name
     * @param string $uniqid A uniqid that will be the name of the folder created
     * 
     * @return string The complete path of the created directory
     */
    public function createImageDirectory(string $uniqid): string
    {
        if (!is_dir(ARTICLES_IMAGES . "/" . $uniqid)) {
            mkdir(ARTICLES_IMAGES . "/" . $uniqid);
        }

        return ARTICLES_IMAGES . "/" . $uniqid . "/";
    }

    /**
     * Saves images in the serveur, at the given location on the server. If the location doesn't already exists, false will be returned
     * @param array $images An array that contains the post informations of the files
     * 
     * @return bool True if the save was successful, false otherwise
     */
    public function saveImages(array $images, string $uniqid): bool
    {

        clearstatcache(); //Clearing the cache infos to make sure to retrieve the directory even if it is recetly created
        $directory = ARTICLES_IMAGES . "/" . $uniqid . "/";

        if (is_dir($directory)) {
            for ($i = 0; $i < count($images['tmp_name']); $i++) {
                $tempName = $images['tmp_name'][$i]; //Sets up the name
                $extenstion = "." . preg_replace("/image\//", "", $images['type'][$i]); //Sets up the extension of the image
                $fileName = "image" . $i . $extenstion;
                if (!move_uploaded_file($tempName, $directory . $fileName)) {
                    return false;
                }
            }

            return true;
        }

        return false;
    }


    /**
     *  Note : The image path returned will be the first one in alphabetic order. If a modification of the images naming pattern is done, this function has to be updated too.
     * @param string $uniqid The uniqid where the image is stored
     * 
     * @return string The path to the image. If no images are found, return the link to the not found image
     */
    public function getFirstImage(string $uniqid): string
    {

        $directory = ARTICLES_IMAGES . "/" . $uniqid . "/";

        if (is_dir($directory)) {
            $dir = ARTICLES_IMAGES . "/" . $uniqid;
            $allImagesPath = array_values(array_diff(scandir($dir), ["..", "."])); // Remove the . and .. directory of the folder

            //Check if there is an image to display
            if (isset($allImagesPath[0])) {
                $image = IMAGE_LINK . "/" . $uniqid . "/" . $allImagesPath[0];
            } else {
                $image = IMAGE_NOT_FOUND_LINK;
            }

            return $image;
        } else {
            return IMAGE_NOT_FOUND_LINK;
        }
    }
}
