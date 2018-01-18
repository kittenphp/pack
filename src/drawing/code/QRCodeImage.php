<?php


namespace kitten\pack\drawing\code;


use BaconQrCode\Common\ErrorCorrectionLevel;
use BaconQrCode\Encoder\Encoder;
use kitten\pack\drawing\gd\FileImage;
use kitten\pack\drawing\ImageResponse;
use BaconQrCode\Writer;

class QRCodeImage
{
    private $text='';
    /** @var ImageRender  */
    private $render;
    /** @var FileImage */
    private $logo;

    /**
     * QRCodeImage constructor.
     * @param string $text
     */
    public function __construct(string $text)
    {
        $this->text=$text;
        $render=new ImageRender();
        $render->setWidth(200);
        $render->setHeight(200);
        $render->setMargin(1);
        $this->render=$render;
    }

    /**
     * @param int $size
     * @return QRCodeImage
     */
    public function setSize(int $size=200){
        if ($size<=0){
            throw new \InvalidArgumentException('size must be greater than 0');
        }
        $this->render->setWidth($size);
        $this->render->setHeight($size);
        return $this;
    }

    /**
     * @param int $margin
     * @return QRCodeImage
     */
    public function setMargin(int $margin=1){
        if ($margin<=0){
            throw new \InvalidArgumentException('margin value can not be less than 0');
        }
        $this->render->setMargin($margin);
        return $this;
    }

    /**
     * @param string $filePath
     * @return QRCodeImage
     */
    public function setLogo(string $filePath){
        $this->logo= new FileImage($filePath);
        return $this;
    }

    /**
     * @return ImageResponse
     */
    public function getResponse():ImageResponse{
        $resource=$this->createImage();
        $response=new ImageResponse($resource,'png');
        return $response;
    }

    /**
     * @return resource
     */
    private function createImage(){
        $render=$this->render;
        $writer=new Writer($render);
        $writer->writeString($this->text,Encoder::DEFAULT_BYTE_MODE_ECODING,ErrorCorrectionLevel::H);
        $img= $render->getResource();
        if (!empty($this->logo)) {
            $logo=$this->logo->getResource();
            //https://gist.github.com/NTICompass/1283249
            $QR_width = imagesx($img);
            $QR_height = imagesy($img);
            $logo_width = imagesx($logo);
            $logo_height = imagesy($logo);
            $logo_qr_width = $QR_width/4;
            $scale = $logo_width/$logo_qr_width;
            $logo_qr_height = $logo_height/$scale;
            imagecopyresampled($img, $logo,  ($QR_width-$logo_qr_width)/2, ($QR_height-$logo_qr_height)/2, 0, 0, $logo_qr_width, $logo_qr_height, $logo_width, $logo_height);
        }
        return $img;
    }
}