<?php


namespace kitten\pack\drawing\gd;


class TextWatermarkConfig
{
    private $width=100;
    private $height=30;
    /** @var Color */
    private $backgroundColor;
    /** @var Color */
    private $foregroundColor;
    /** @var string  */
    private $font='';
    private $size=10;
    private $angle=0;
    private $leftMadding=10;
    private $topMadding=20;
    private $text='';

    /**
     * TextWatermarkConfig constructor.
     * @param string $text
     */
    public function __construct(string $text)
    {
        $this->backgroundColor=new Color();
        $this->foregroundColor=new Color();
        $this->font=__DIR__.'/HELR45W.ttf';
        $this->text=$text;
    }

    /**
     * @return int
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * @param int $width
     * @return TextWatermarkConfig
     */
    public function setWidth(int $width)
    {
        $this->width = $width;
        return $this;
    }

    /**
     * @return int
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * @param int $height
     * @return TextWatermarkConfig
     */
    public function setHeight(int $height)
    {
        $this->height = $height;
        return $this;
    }

    /**
     * @return Color
     */
    public function getBackgroundColor()
    {
        return $this->backgroundColor;
    }

    /**
     * @param Color $backgroundColor
     * @return TextWatermarkConfig
     */
    public function setBackgroundColor(Color $backgroundColor)
    {
        $this->backgroundColor = $backgroundColor;
        return $this;
    }

    /**
     * @return Color
     */
    public function getForegroundColor()
    {
        return $this->foregroundColor;
    }

    /**
     * @param Color $foregroundColor
     * @return TextWatermarkConfig
     */
    public function setForegroundColor(Color $foregroundColor)
    {
        $this->foregroundColor = $foregroundColor;
        return $this;
    }

    /**
     * @return string
     */
    public function getFont()
    {
        return $this->font;
    }

    /**
     * @param string $font
     * @return TextWatermarkConfig
     */
    public function setFont(string $font)
    {
        $this->font = $font;
        return $this;
    }

    /**
     * @return int
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * @param int $size
     * @return TextWatermarkConfig
     */
    public function setSize(int $size)
    {
        $this->size = $size;
        return $this;
    }

    /**
     * @return int
     */
    public function getAngle()
    {
        return $this->angle;
    }


    /**
     * @param int $angle
     * @return TextWatermarkConfig
     */
    public function setAngle(int $angle)
    {
        $this->angle = $angle;
        return $this;
    }

    /**
     * @return int
     */
    public function getLeftMadding()
    {
        return $this->leftMadding;
    }

    /**
     * @param int $leftMadding
     * @return TextWatermarkConfig
     */
    public function setLeftMadding(int $leftMadding)
    {
        $this->leftMadding = $leftMadding;
        return $this;
    }

    /**
     * @return int
     */
    public function getTopMadding()
    {
        return $this->topMadding;
    }

    /**
     * @param int $topMadding
     * @return TextWatermarkConfig
     */
    public function setTopMadding(int $topMadding)
    {
        $this->topMadding = $topMadding;
        return $this;
    }

    /**
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @param string $text
     * @return TextWatermarkConfig
     */
    public function setText(string $text)
    {
        $this->text = $text;
        return $this;
    }

}