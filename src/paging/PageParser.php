<?php


namespace kitten\pack\paging;


use InvalidArgumentException;

class PageParser
{
    protected $config;
    public function __construct(PageConfig $config)
    {
        $this->config=$config;
    }

    /**
     * @param int $totalNum
     * @param int $currentPage
     * @return PageLink[]
     * @throws NotFindPageException
     */
    public function parse(int $totalNum,int $currentPage){
        if (empty($currentPage) || $currentPage<=0){
            throw new InvalidArgumentException('current Page number must be greater than 0');
        }
        $config=$this->config;
        $pageCount=$this->getTotalPages($totalNum);
        if ($currentPage>1 && $currentPage>$pageCount){
            throw new NotFindPageException("not find {$currentPage} page");
        }
        $linkArray=[];
        $firstText=$config->getFirstBtnText();
        $lastText=$config->getLastBtnText();
        $previousText=$config->getPreviousBtnText();
        $nextText=$config->getNextBtnText();
        if ($config->isShowFirst()){
            if ($currentPage>1 && $pageCount>1){
                $linkArray[]=new PageLink($firstText,1,false,true);
            }
        }
        if ($config->isShowPrevious()){
            if ($currentPage>1 && $pageCount>1){
                $linkArray[]=new PageLink($previousText,$currentPage-1,false,true);
            }
        }
        $numLinks=$this->createNumLinks($totalNum,$currentPage);
        $linkArray=array_merge($linkArray,$numLinks);
        if ($config->isShowNext()){
            $nextNum=$currentPage+1;
            if ($nextNum<$pageCount){
                $linkArray[]=new PageLink($nextText,$nextNum,false,true);
            }
        }
        if ($config->isShowLast()){
            if ($currentPage<$pageCount){
                $linkArray[]=new PageLink($lastText,$totalNum,false,true);
            }
        }
        return $linkArray;
    }

    /**
     * @param int $totalNum
     * @param int $currentPage
     * @return PageLink[]
     */
    protected function createNumLinks(int $totalNum,int $currentPage){
        $links=[];
        $btnCount=$this->config->getBtnCount();
        $pageCount=$this->getTotalPages($totalNum);
        if ($pageCount>$btnCount){
            $count=$btnCount;
            $middleNum=(int)floor($count/2);
            $beginNum=$currentPage-$middleNum;
            if ($beginNum<1){
                $beginNum=1;
            }
            $endNum=$beginNum+$count-1;
            if ($endNum>$pageCount){
                $endNum=$pageCount;
                $beginNum=$endNum-$count;
            }
        }else{
            $beginNum=1;
            $endNum=$pageCount;
        }
        for ($i=$beginNum;$i<=$endNum;$i++){
            if ($i==$currentPage){
                $isActive=true;
            }else{
                $isActive=false;
            }
            $links[]=new PageLink((string)$i,$i,$isActive,false);
        }
        return $links;
    }

    /**
     * @param int $totalNum
     * @return int
     */
    public function getTotalPages(int $totalNum){
        $onePageSize=$this->config->getOnePageSize();
        $totalPages= (int)ceil( $totalNum/$onePageSize);
        return $totalPages;
    }
}