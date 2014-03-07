<?php
/**
 * IMPORTANT
 * The thumb folder need writte permisions.
 * If you will change the IMG folder or Thumb folder 
 * 
 * Original code was get on http://bgallz.org/270/php-create-thumbnail-images/#codesyntax_2
 * 
 * Example of use:
 * $t = new ImgToThumb();
 * $t->setImgPath('img/'); //Path to original images folder.
 * $t->setThumbsPath('thumb/'); //Path to folder where you will create the thumbs.
 * $t->setThumbHeight(150); // Height of thumbs files.
 * $t->generateThumbs($t->getImgPath(), $t->getThumbsPath($path), $t->getThumbHeight()); //Declaration.
 */
class ImgTothumb {

    //Variables
    private $pathToScreens = "img/";
    private $pathToThumbs = "thumb/";
    private $thumbHeight = 100;

    //Constructor
    function __construct() {
        //$this->generateThumbs($this->getImgPath(), $this->getThumbsPath(), $this->getThumbHeight());
       // echo $this->getThumbHeight();
    }
    function generateThumbs($pathToScreens, $pathToThumbs, $thumbHeight) {
        $dir = opendir($pathToScreens) or die("Could not open directory");
        while (($fname = readdir($dir)) !== false) {
            if ($fname != "." && $fname != "..") {
                // Remove folders.
                $valid_extensions = array("jpg", "jpeg"); // Only jpeg images allowed.
                $info = pathinfo($pathToScreens . $fname); // Get info on the screenshot
                if (in_array(strtolower($info["extension"]), $valid_extensions)) {
                    // Make sure the file is an image file by checking its extension to the array of image extensions.
                    $img = imagecreatefromjpeg($pathToScreens . $fname); // Select the file as an image from the directory.
                    $width = imagesx($img);
                    $height = imagesy($img);
                    // Collect its width and height.
                    $newHeight = floor($thumbHeight * ($width / $height)); // Calculate new height for thumbnail.
                    $tempImage = imagecreatetruecolor( $newHeight,$thumbHeight); // Create a temporary image of the thumbnail.
                    // Copy and resize old image into new image.
                    imagecopyresized($tempImage, $img, 0, 0, 0, 0, $newHeight, $thumbHeight, $width, $height);
                    $genThumb = imagejpeg($tempImage, $pathToThumbs . $fname);
                    // Create the thumbnail with the new width and height in the thumbnails directory.
                    // I added a rand 3 digit number in front of the file name to avoid overwrite.
                }
            }
        }
        closedir($dir); // Close the directory.
    }//End of generateThumbs

//GETTERS & SETTERS
    //pathToScreens
    function getImgPath() {
        return $this->pathToScreens;
    }

    function setImgPath($path) {
        $this->pathToScreens = $path;
    }

    //pathToThumbs	
    function getThumbsPath() {
        return $this->pathToThumbs;
    }

    function setThumbsPath($path) {
        $this->pathToThumbs = $path;
    }

    //ThumbHeight
    function getThumbHeight() {
        return $this->thumbHeight;
    }

    function setThumbHeight($px) {
        $this->thumbHeight = $px;
    }

} //Enf of class
?>
