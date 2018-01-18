<?php


namespace kitten\pack\drawing\gd;


class FileImage extends AbstractImage
{
    protected $imgPath='';

    /**
     * FileImage constructor.
     * @param string $imgPath
     */
    public function __construct(string $imgPath)
    {
        if (!is_file($imgPath)){
            throw new \InvalidArgumentException($imgPath.':The image file provided is in the wrong path');
        }
        $type=exif_imagetype($imgPath);
        if ($type===false){
            throw new \InvalidArgumentException($imgPath.':This file is not a picture format');
        }
        switch ($type) {
            case IMAGETYPE_JPEG:
                $image = imagecreatefromjpeg($imgPath);
                $format='jpg';
                break;
            case IMAGETYPE_PNG:
                $image = imagecreatefrompng($imgPath);
                $format='png';
                break;
            case IMAGETYPE_GIF:
                $image = imagecreatefromgif($imgPath);
                $format='gif';
                break;
            default:
                throw new \InvalidArgumentException($imgPath.":This image format is not supported, you need to provide gif, png, jpq");
        }
        $this->imgPath=$imgPath;
        parent::__construct($image, $format);
    }
    protected function generateImage(){}

    /**
     * @return string
     */
    public function getImgPath()
    {
        return $this->imgPath;
    }

}