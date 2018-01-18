<?php


namespace kitten\pack\paging;


class PageRender
{
    /** @var PageConfig  */
    protected $config;
    /** @var int */
    protected $totalRows=0;
    /** @var  PageParser */
    protected $parser;

    public function __construct(PageConfig $config)
    {
        $this->config=$config;
        $this->parser=new PageParser($config);
    }

    /**
     * @param int $totalNum
     * @param int $currentPage
     * @param string $baseUrl
     * @return string
     */
    public function buildHtml(int $totalNum,int $currentPage,string $baseUrl) {
        $html='<ul class="pagination">';
        $buttons=$this->createButtons($totalNum,$currentPage);
        foreach ($buttons as $button){
            $html=$html.$button->toHtml($baseUrl);
        }
        $html=$html.'</ul>';
        return $html;
    }

    /**
     * @param int $totalNum
     * @param int $currentPage
     * @return PageButton[]
     */
    protected function createButtons(int $totalNum,int $currentPage){
        $btnList=[];
        $links=$this->parser->parse($totalNum,$currentPage);
        foreach ($links as $link){
            $btnList[]=new PageButton($link,$this->config);
        }
        return $btnList;
    }
}
