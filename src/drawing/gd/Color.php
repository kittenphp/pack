<?php


namespace kitten\pack\drawing\gd;


class Color
{
    private $red=255;
    private $green=255;
    private $blue=255;
    private $alpha=0;


    /**
     * Color constructor.
     * @param int $red
     * @param int $green
     * @param int $blue
     * @param int $alpha
     */
    public function __construct(int $red=255,int $green=255,int $blue=255,int $alpha=0)
    {
        $this->red=$red;
        $this->green=$green;
        $this->blue=$blue;
        $this->alpha=$alpha;
    }

    /**
     * @return int
     */
    public function getRed()
    {
        return $this->red;
    }

    /**
     * @param int $red
     */
    public function setRed(int $red)
    {
        $this->red = $red;
    }

    /**
     * @return int
     */
    public function getGreen()
    {
        return $this->green;
    }

    /**
     * @param int $green
     */
    public function setGreen(int $green)
    {
        $this->green = $green;
    }

    /**
     * @return int
     */
    public function getBlue()
    {
        return $this->blue;
    }

    /**
     * @param int $blue
     */
    public function setBlue(int $blue)
    {
        $this->blue = $blue;
    }

    /**
     * @return int
     */
    public function getAlpha()
    {
        return $this->alpha;
    }

    /**
     * @param int $alpha
     */
    public function setAlpha(int $alpha)
    {
        $this->alpha = $alpha;
    }
}