<?php


namespace kitten\pack\drawing\gd;

use kitten\pack\drawing\ImageResponse;

abstract class AbstractImage
{
    /** @var resource  */
    protected $img;
    protected $format='';

    /**
     * AbstractImage constructor.
     * @param $resource
     * @param string $type
     */
    protected function __construct($resource,$type='png')
    {
        $this->img=$resource;
        $this->format=$type;
    }
    /**
     * @return null|resource
     */
    public function getResource(){
        return $this->img;
    }
    /**
     * @param resource $resource
     */
    protected function setResource($resource){
        $this->img=$resource;
    }

    /**
     * @return string
     */
    public function getFormat()
    {
        return $this->format;
    }

    /**
     * @return int
     */
    public function getWidth()
    {
        return imagesx($this->img);
    }

    /**
     * @return int
     */
    public function getHeight()
    {
        return imagesy($this->img);
    }

    /**
     * @param int $width
     * @param int $height
     * @return AbstractImage
     */
    public function resize(int $width,int $height){
        $oldWidth=$this->getWidth();
        $oldHeight=$this->getHeight();
        $newImage = imagecreatetruecolor($width, $height);
        imagecopyresampled($newImage, $this->img, 0, 0, 0, 0, $width, $height, $oldWidth, $oldHeight);
        $this->img=$newImage;
        return $this;
    }
    protected abstract function generateImage();

    /**
     * @return ImageResponse
     */
    public function getResponse(){
        $this->generateImage();
        return new ImageResponse($this->img);
    }

    /**
     * @param int $newHeight
     * @return AbstractImage
     */
    public function resizeToHeight(int $newHeight){
        $oldWidth=$this->getWidth();
        $oldHeight=$this->getHeight();
        $newWidth=($oldWidth*$newHeight)/$oldHeight;
        return $this->resize($newWidth,$newHeight);
    }

    /**
     * @param int $newWidth
     * @return AbstractImage
     */
    public function resizeToWidth(int $newWidth){
        $oldWidth=$this->getWidth();
        $oldHeight=$this->getHeight();
        $newHeight=($oldHeight*$newWidth)/$oldWidth;
        return $this->resize($newWidth,$newHeight);
    }

    /**
     * @param int $maxHeight
     * @param int $maxWidth
     * @param bool $fillSpace
     * @return AbstractImage
     */
    public function autoResize(int $maxHeight,int $maxWidth,bool $fillSpace=true){
        $oldWidth=$this->getWidth();
        $oldHeight=$this->getHeight();
        if ($oldHeight<=$maxHeight && $oldWidth<=$maxWidth){
            if ($fillSpace){
                if ($oldHeight>$oldWidth){
                    return $this->resizeToHeight($maxHeight);
                }else{
                    return $this->resizeToWidth($maxWidth);
                }
            }else{
                return $this;
            }
        }elseif ($oldWidth>$maxWidth && $oldHeight<=$maxHeight){
            return $this->resizeToWidth($maxWidth);
        }elseif ($oldHeight>$maxHeight && $oldWidth<=$maxWidth){
            return $this->resizeToHeight($maxHeight);
        }else{
            if ($oldWidth>$oldHeight){
                $newHeight=($oldHeight*$maxWidth)/$oldWidth;
                return $this->resize($maxWidth,$newHeight);
            }else{
                $newWidth=($oldWidth*$maxHeight)/$oldHeight;
                return $this->resize($newWidth,$maxHeight);
            }
        }
    }
    public function centerCrop(int $width,int $height){
        $image=$this->img;
        $target_w = $width;
        $target_h = $height;
        $source_w = imagesx($image);
        $source_h = imagesy($image);
        $judge = (($source_w / $source_h) > ($target_w / $target_h));
        $resize_w = $judge ? ($source_w * $target_h) / $source_h : $target_w;
        $resize_h = !$judge ? ($source_h * $target_w) / $source_w : $target_h;
        $start_x = $judge ? ($resize_w - $target_w) / 2 : 0;
        $start_y = !$judge ? ($resize_h - $target_h) / 2 : 0;
        $resize_img = imagecreatetruecolor($resize_w, $resize_h);
        imagecopyresampled($resize_img, $image, 0, 0, 0, 0, $resize_w, $resize_h, $source_w, $source_h);
        $target_img = imagecreatetruecolor($target_w, $target_h);
        imagecopy($target_img, $resize_img, 0, 0, $start_x, $start_y, $resize_w, $resize_h);
        $this->img=$target_img;
    }


    /**
     * @param WatermarkImageInterface $logo
     * @param int $margeRight
     * @param int $margeBottom
     * @param int $pct
     * @return AbstractImage
     */
    public function watermark(WatermarkImageInterface $logo,int $margeRight=10,int $margeBottom=10,int $pct=20){
        $img=$this->img;
        if ($logo  instanceof TextWatermarkImage){
            $logo->generateImage();
            $sx = $logo->getWidth();
            $sy = $logo->getHeight();
            imagecopymerge($img, $logo->getResource(), imagesx($img) - $sx - $margeRight, imagesy($img) - $sy - $margeBottom, 0, 0, $sx, $sy,$pct);
        }elseif($logo instanceof PhotoWatermarkImage){
            $logo->generateImage();
            $sx = $logo->getWidth();
            $sy = $logo->getHeight();
            imagecopy($img, $logo->getResource(), imagesx($img) - $sx - $margeRight, imagesy($img) - $sy - $margeBottom, 0, 0, $sx, $sy);
        }
        return $this;
    }

    /**
     * @param string $filePath
     * @return bool
     */
    public function save(string $filePath) {
        $this->generateImage();
        $type=$this->format;
        $img=$this->img;
        switch ($type){
            case 'jpg':
                $isSuccess= imagejpeg($img,$filePath,100);
                break;
            case 'gif':
                $isSuccess=imagegif($img,$filePath);
                break;
            case 'png':
                $isSuccess=imagepng($img,$filePath);
                break;
            default:
                $isSuccess=false;
        }
        return $isSuccess;
    }

    public function __destruct()
    {
        ImageDestroy($this->img);
    }
}