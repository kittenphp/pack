<?php


namespace kitten\pack\drawing;


use Symfony\Component\HttpFoundation\Response;

//http://stackoverflow.com/questions/27605429/symfony2-send-image-created-with-imagecreate-via-responsehttpfoundation
//http://stackoverflow.com/questions/7365622/convert-image-to-string-for-symfony2-response?rq=1

class ImageResponse extends Response
{
    private $image;

    /**
     * ImageResponse constructor.
     * @param resource $img
     * @param string $imgType
     */
    public function __construct($img,$imgType='jpeg')
    {
        $this->image=$img;
        $contentType=$this->getContentType($imgType);
        $headers= array(
            'Content-type'=>$contentType,
            'Pragma'=>'no-cache',
            'Cache-Control'=>'no-cache',
            'X-Accel-Buffering'=>'no'
        );
        ob_start();
        imagejpeg($img);
        $imageString = ob_get_clean();
        parent::__construct($imageString, 200, $headers);
    }

    /**
     * @param string $imgType
     * @return string
     */
    protected function getContentType(string $imgType){
        switch ($imgType){
            case 'jpg':
                $type='image/jpeg';
                break;
            case 'gif':
                $type='image/gif';
                break;
            case 'png':
                $type='image/png';
                break;
            default:
                $type='image/jpeg';
        }
        return $type;
    }
}