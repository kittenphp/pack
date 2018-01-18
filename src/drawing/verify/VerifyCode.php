<?php


namespace kitten\pack\drawing\verify;


use kitten\pack\drawing\ImageResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;

class VerifyCode
{
    private $charset = 'abcdefhkmnprstuvwxyABCDEFGHKMNPRSTUVWXY345678';//Random
    private $code;//VerifyCode
    private $codeLength = 5;
    private $width = 120;
    private $height = 30;
    private $img;
    private $font;
    private $fontSize = 20;
    private $fontColor;
    /** @var Session  */
    private $session;
    private $fontPath='';
    public function __construct(Session $session)
    {
        $fontPath= __DIR__ . '/new.ttf';
        $this->fontPath=$fontPath;
        $this->session=$session;
    }


    /**
     * @param int $length
     * @return VerifyCode
     */
    public function setCodeLength(int $length){
        $this->codeLength=$length;
        return $this;
    }

    /**
     * @param int $width
     * @return VerifyCode
     */
    public function setWidth(int $width){
        $this->width=$width;
        return $this;
    }

    /**
     * @param int $height
     * @return VerifyCode
     */
    public function setHeight(int $height){
        $this->height=$height;
        return $this;
    }

    /**
     * @return VerifyCode
     */
    public function setFont(){
        $this->font=$this->fontPath;
        return $this;
    }

    //Generate random code
    private function createCode() {
        $_len = strlen($this->charset)-1;
        for ($i=0; $i<$this->codeLength; $i++) {
            $this->code .= $this->charset[mt_rand(0,$_len)];
        }
    }
    //background
    private function createBg() {
        $this->img = imagecreatetruecolor($this->width, $this->height);
        $color = imagecolorallocate($this->img, mt_rand(157,255), mt_rand(157,255), mt_rand(157,255));
        imagefilledrectangle($this->img,0,$this->height,$this->width,0,$color);
    }
    //text
    private function createFont() {
        $_x = $this->width / $this->codeLength;
        for ($i=0; $i<$this->codeLength; $i++) {
            $this->fontColor = imagecolorallocate($this->img,mt_rand(0,156),mt_rand(0,156),mt_rand(0,156));
            imagettftext($this->img,$this->fontSize,mt_rand(-30,30),$_x*$i+mt_rand(1,5),$this->height / 1.4,$this->fontColor,$this->font,$this->code[$i]);
        }
    }
    //Generated lines, snowflakes
    private function createLine() {
        //lines
        for ($i=0;$i<6;$i++) {
            $color = imagecolorallocate($this->img,mt_rand(0,156),mt_rand(0,156),mt_rand(0,156));
            imageline($this->img,mt_rand(0,$this->width),mt_rand(0,$this->height),mt_rand(0,$this->width),mt_rand(0,$this->height),$color);
        }
        //snowflakes
        for ($i=0;$i<100;$i++) {
            $color = imagecolorallocate($this->img,mt_rand(200,255),mt_rand(200,255),mt_rand(200,255));
            imagestring($this->img,mt_rand(1,5),mt_rand(0,$this->width),mt_rand(0,$this->height),'*',$color);
        }
    }
    private function writeSession(){
        $this->session->getFlashBag()->set('_VerifyCode',$this->code);
    }

    /**
     * @param string $inputText
     * @return bool
     */
    public function check(string $inputText) {
        if (empty($inputText)){
            return false;
        }
        $session=$this->session;
        $code=$session->getFlashBag()->get('_VerifyCode');
        if (empty($code)){
            return false;
        }else{
            $sessionText=$code[0];
            if (strcasecmp($inputText,$sessionText)===0){
                return true;
            }
            else{
                return false;
            }
        }
    }

    /**
     * @param int $width
     * @param int $height
     * @param int $codeLength
     * @param int $fontSize
     * @return Response
     */
    public function getResponse(int $width=120,int $height=30,int $codeLength=5,int $fontSize=20) {
        $this->width=$width;
        $this->height=$height;
        $this->codeLength=$codeLength;
        $this->fontSize=$fontSize;
        $this->setFont();
        $this->createBg();
        $this->createCode();
        $this->createLine();
        $this->createFont();
        $this->writeSession();
        return new ImageResponse($this->img);
    }
    public function __destruct()
    {
        imagedestroy($this->img);
    }
}