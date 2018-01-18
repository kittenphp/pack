<?php


namespace kitten\pack\excel\reader;


class ExcelColumn
{
    /** @var string  */
    protected $columnType='string';
    /** @var string  */
    protected $datetimeFormat='Y-m-d H:i:s';

    /**
     * @return string
     */
    public function getDatetimeFormat()
    {
        return $this->datetimeFormat;
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
        $this->columnType='decimal';
        return $this;
    }

    /**
     * @param string $format
     * @return $this
     */
    public function setDateType(string $format='Y-m-d'){
        $this->columnType='date';
        $this->datetimeFormat=$format;
        return $this;
    }

    /**
     * @param string $format
     * @return $this
     */
    public function setDateTimeType(string $format='Y-m-d H:i:s'){
        $this->columnType='date';
        $this->datetimeFormat=$format;
        return $this;
    }
    /**
     * @return string
     */
    public function getColumnType()
    {
        return $this->columnType;
    }
}