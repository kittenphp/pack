<?php


namespace kitten\pack\excel\writer;


class ExcelColumnCollection
{
    /** @var ExcelColumn[] */
    protected $columns=[];

    /**
     * @param string $title
     * @return ExcelColumn
     */
    public function createColumn(string $title){
        $column=new ExcelColumn();
        $column->setColumnTitle($title);
        $this->columns[]=$column;
        return $column;
    }

    /**
     * @return array
     */
    public function getHeaders(){
        $headers=[];
        foreach ($this->columns as $column){
            $headers[$column->getColumnTitle()]=$column->getColumnType();
        }
        return $headers;
    }

    /**
     * @return array
     */
    public function getWidths(){
        //['widths'=>[10,20,30,40,50,60,70,20]
        $widths=[];
        foreach ($this->columns as $column){
            $widths[]=$column->getWidth();
        }
        return $widths;
    }
}