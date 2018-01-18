<?php


namespace kitten\pack\drawing\gd;


class TextWatermarkImage extends AbstractImage implements WatermarkImageInterface
{
    /** @var TextWatermarkConfig  */
    protected $config;
    protected $isDraw=false;
    public function __construct(TextWatermarkConfig $config)
    {
        $this->config=$config;
        $resource=imagecreatetruecolor($config->getWidth(),$config->getHeight());
        parent::__construct($resource, 'png');
    }

    private function drawBackground(){
        $c=$this->config;
        $img=$this->img;
        $b=$c->getBackgroundColor();
        //for transparent background
        imagealphablending($img, false);
        imagesavealpha($img, true);
        $color=imagecolorallocatealpha($img,$b->getRed(),$b->getBlue(),$b->getBlue(),127);
        imagefill($img, 0, 0, $color);
    }

    private function drawText(){
        $img=$this->img;
        $cfg=$this->config;
        $text=$cfg->getText();
        $fColor=$this->config->getForegroundColor();
        $leftM=$cfg->getLeftMadding();
        $topM=$cfg->getTopMadding();
        $color = imagecolorallocate($this->img, $fColor->getRed(), $fColor->getGreen(), $fColor->getBlue());
        imagettftext($img,$cfg->getSize(),$cfg->getAngle(),$leftM,$topM,$color,$cfg->getFont(),$text);
    }
    protected function generateImage()
    {
        if ($this->isDraw==false){
            $this->drawBackground();
            $this->drawText();
            $this->isDraw=true;
        }
    }
}