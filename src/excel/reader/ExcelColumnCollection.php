<?php


namespace kitten\pack\excel\reader;


class ExcelColumnCollection
{
    /** @var ExcelColumn[]  */
    private $columnCollection=[];

    /**
     * @return ExcelColumn
     */
    public function addColumn(){
        $column=new ExcelColumn();
        $this->columnCollection[]=$column;
        return $column;
    }

    /**
     * @return ExcelColumn[]
     */
    public function getColumns() {
        return $this->columnCollection;
    }

    /**
     * @return int
     */
    public function getCount(){
        return count($this->columnCollection);
    }
}