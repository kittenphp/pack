<?php


namespace kitten\pack\drawing\code;
use BaconQrCode\Renderer\Image\Png;

class ImageRender extends Png
{
    public function getResource(){
        return $this->image;
    }
}