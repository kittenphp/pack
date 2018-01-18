<?php


namespace kitten\pack\excel\writer;


class ExcelColumn
{
    protected $columnType='string';
    protected $columnTitle='';
    protected $width=20;
    /**
     * @return string
     */
    public function getColumnType()
    {
        return $this->columnType;
    }

    /**
     * @return $this
     */
    public function setTextType(){
        $this->columnType='string';
        return $this;
    }

    /**
     * @return $this
     */
    public function setIntegerType(){
        $this->columnType='integer';
        return $this;
    }

    /**
     * @return $this
     */
    public function setDecimalType(){
        $this->columnType='#0.00';
        return $this;
    }

    /**
     * @return $this
     */
    public function setDateType(){
        $this->columnType='YYYY-MM-DD';
        return $this;
    }

    /**
     * @return $this
     */
    public function setDateTimeType(){
        $this->columnType='YYYY-MM-DD HH:MM:SS';
        return $this;
    }

    /**
     * @return string
     */
    public function getColumnTitle()
    {
        return $this->columnTitle;
    }

    /**
     * @param string $columnTitle
     */
    public function setColumnTitle(string $columnTitle)
    {
        $this->columnTitle = $columnTitle;
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
     */
    public function setWidth(int $width)
    {
        $this->width = $width;
    }
}



