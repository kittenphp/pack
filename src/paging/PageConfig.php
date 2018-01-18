<?php


namespace kitten\pack\paging;


class PageConfig
{
    protected $onePageSize=20;
    protected $isShowPrevious=true;
    protected $isShowNext=true;
    protected $isShowFirst=true;
    protected $isShowLast=true;
    protected $isDynamicUrl=true;
    protected $firstBtnText='&lt;&lt;';
    protected $previousBtnText='&lt;';
    protected $lastBtnText='&gt;&gt;';
    protected $nextBtnText='&gt;';
    protected $btnCount=10;

    /**
     * @return int
     */
    public function getOnePageSize()
    {
        return $this->onePageSize;
    }

    /**
     * @param int $onePageSize
     * @return PageConfig
     */
    public function setOnePageSize(int $onePageSize)
    {
        $this->onePageSize = $onePageSize;
        return $this;
    }

    /**
     * @return bool
     */
    public function isShowPrevious()
    {
        return $this->isShowPrevious;
    }

    /**
     * @param bool $isShowPrevious
     * @return $this
     */
    public function setIsShowPrevious(bool $isShowPrevious)
    {
        $this->isShowPrevious = $isShowPrevious;
        return $this;
    }

    /**
     * @return bool
     */
    public function isShowNext()
    {
        return $this->isShowNext;
    }

    /**
     * @param bool $isShowNext
     * @return PageConfig
     */
    public function setIsShowNext(bool $isShowNext)
    {
        $this->isShowNext = $isShowNext;
        return $this;
    }

    /**
     * @return bool
     */
    public function isShowFirst()
    {
        return $this->isShowFirst;
    }

    /**
     * @param bool $isShowFirst
     * @return PageConfig
     */
    public function setIsShowFirst(bool $isShowFirst)
    {
        $this->isShowFirst = $isShowFirst;
        return $this;
    }

    /**
     * @return bool
     */
    public function isShowLast()
    {
        return $this->isShowLast;
    }

    /**
     * @param bool $isShowLast
     * @return $this
     */
    public function setIsShowLast(bool $isShowLast)
    {
        $this->isShowLast = $isShowLast;
        return $this;
    }

    /**
     * @return bool
     */
    public function isDynamicUrl()
    {
        return $this->isDynamicUrl;
    }

    /**
     * @param bool $isDynamicUrl
     */
    public function setIsDynamicUrl(bool $isDynamicUrl)
    {
        $this->isDynamicUrl = $isDynamicUrl;
    }

    /**
     * @return string
     */
    public function getFirstBtnText()
    {
        return $this->firstBtnText;
    }

    /**
     * @param string $firstBtnText
     * @return $this
     */
    public function setFirstBtnText(string $firstBtnText)
    {
        $this->firstBtnText = $firstBtnText;
        return $this;
    }

    /**
     * @return string
     */
    public function getPreviousBtnText()
    {
        return $this->previousBtnText;
    }

    /**
     * @param string $previousBtnText
     * @return $this
     */
    public function setPreviousBtnText(string $previousBtnText)
    {
        $this->previousBtnText = $previousBtnText;
        return $this;
    }

    /**
     * @return string
     */
    public function getLastBtnText()
    {
        return $this->lastBtnText;
    }

    /**
     * @param string $lastBtnText
     * @return $this
     */
    public function setLastBtnText(string $lastBtnText)
    {
        $this->lastBtnText = $lastBtnText;
        return $this;
    }

    /**
     * @return string
     */
    public function getNextBtnText()
    {
        return $this->nextBtnText;
    }

    /**
     * @param string $nextBtnText
     * @return $this
     */
    public function setNextBtnText(string $nextBtnText)
    {
        $this->nextBtnText = $nextBtnText;
        return $this;
    }

    /**
     * @return int
     */
    public function getBtnCount()
    {
        return $this->btnCount;
    }

    /**
     * @param int $btnCount
     * @return $this
     */
    public function setBtnCount(int $btnCount)
    {
        if ($btnCount<0){
            throw new \InvalidArgumentException('The number of paging buttons must be greater than 0');
        }
        $this->btnCount = $btnCount;
        return $this;
    }

}