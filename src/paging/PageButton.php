<?php


namespace kitten\pack\paging;


class PageButton
{
    /** @var  PageLink */
   protected $link;
   protected $config;
   public function __construct(PageLink $link,PageConfig $config)
   {
       $this->link=$link;
       $this->config=$config;
   }
    public function toHtml($baseUrl){
       if ($this->link->num==1){
           $url=$baseUrl;
       }else{
           $baseUrl=$baseUrl.rtrim('/');
           if ($this->config->isDynamicUrl()){
               $url=$baseUrl.'/?page='.$this->link->num;
           }else{
               $url=$baseUrl.'/page/'.$this->link->num;
           }
       }
        $text=$this->link->text;
        if ($this->link->isActive){
            $activeCss='class="page-item active"';
        }else{
            $activeCss='class="page-item"';
        }
        $html="<li {$activeCss}><a class=\"page-link\" href=\"{$url}\">{$text}</a></li>";
        return $html;
    }
}