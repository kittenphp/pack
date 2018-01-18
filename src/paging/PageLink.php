<?php


namespace kitten\pack\paging;


class PageLink
{
    public $text='';
    public $num=1;
    public $isActive=false;
    public $isFeature=false;

    /**
     * PageLink constructor.
     * @param string $text
     * @param int $num
     * @param bool $isActive
     * @param bool $isFeature
     */
    public function __construct(string $text,int $num,bool $isActive,bool $isFeature)
    {
        $this->text = $text;
        $this->num = $num;
        $this->isActive = $isActive;
        $this->isFeature = $isFeature;
    }
}