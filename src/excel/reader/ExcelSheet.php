<?php


namespace kitten\pack\excel\reader;


use kitten\pack\excel\reader\parser\XLSXWorksheet;

class ExcelSheet
{
    /** @var ExcelColumnCollection|null  */
    private $columnCollection;
    /** @var XLSXWorksheet  */
    private $sheet;

    /**
     * ExcelSheet constructor.
     * @param XLSXWorksheet $sheet
     * @param ExcelColumnCollection|null $columnCollection
     */
    public function __construct(XLSXWorksheet $sheet,ExcelColumnCollection $columnCollection=null)
    {
        $this->sheet=$sheet;
        $this->columnCollection=$columnCollection;
    }

    /**
     * @param bool $ignoreFirstLine
     * @return mixed
     */
    public function getRawData(bool $ignoreFirstLine=true){
        $result=$this->sheet->getData();
        if ($ignoreFirstLine){
            array_shift($result);
        }
        return $result;
    }

    /**
     * @param bool $ignoreFirstLine
     * @return array|mixed
     */
    public function getWorkData(bool $ignoreFirstLine=true){
        $rawData=$this->getRawData($ignoreFirstLine);
        if (is_null($this->columnCollection) || $this->columnCollection->getCount()==0){
            return $rawData;
        }else{
            return $this->_getWorkData($rawData);
        }
    }

    /**
     * @param array $rawData
     * @return array
     */
    private function _getWorkData(array $rawData){
        $columns=$this->columnCollection->getColumns();
        $colCount=count($columns);
        $workData=[];
        foreach ($rawData as $row){
            $rowData=[];
            for ($i = 0; $i <= $colCount-1; $i++){
                $column=$columns[$i];
                $colType=$column->getColumnType();
                $cellData=$row[$i];
                switch ($colType){
                    case 'string':
                        $cellData=(string)is_null($cellData)?'':$cellData;
                        break;
                    case 'integer':
                        $cellData=(int)(is_null($cellData) || !is_int($cellData))?0:$cellData;
                        break;
                    case 'decimal':
                        $cellData=(float)(is_null($cellData) && !is_numeric($cellData))?0:$cellData;
                        break;
                    case 'date':
                        if (!is_null($cellData)){
                            $cellData=(!is_int($cellData))?null:$cellData;
                            if (!is_null($cellData)){
                                $cellData=ExcelDateTime::getDateTimeString($cellData,$column->getDatetimeFormat());
                            }
                        }
                        break;
                }
                $rowData[]=$cellData;
            }
            $workData[]=$rowData;
        }
        return $workData;
    }
    /**
     * @return ExcelColumnCollection|null
     */
    public function getColumnCollection()
    {
        return $this->columnCollection;
    }

    /**
     * @param ExcelColumnCollection $columnCollection
     * @return $this
     */
    public function setColumnCollection(ExcelColumnCollection $columnCollection=null)
    {
        $this->columnCollection = $columnCollection;
        return $this;
    }
}