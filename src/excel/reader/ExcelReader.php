<?php


namespace kitten\pack\excel\reader;


use kitten\pack\excel\reader\parser\XLSXReader;

class ExcelReader
{
    /** @var XLSXReader  */
    private $excelFile;

    /**
     * ExcelReader constructor.
     * @param string $fileName
     */
    public function __construct(string $fileName)
    {
        $this->excelFile=new XLSXReader($fileName);
    }

    /**
     * @return ExcelSheet
     * @throws \Exception
     */
    public function getFirstSheet(){
        $sheetNames =$this->excelFile->getSheetNames();
        $firstSheetName= reset($sheetNames);
        $firstSheet=$this->excelFile->getSheet($firstSheetName);
        return new ExcelSheet($firstSheet);
    }
    public function getSheetNames(){
        return $this->getSheetNames();
    }

    /**
     * @return ExcelSheet[]
     * @throws \Exception
     */
    public function getAllSheet(){
        $sheetNames =$this->excelFile->getSheetNames();
        $readSheets=[];
        foreach ($sheetNames as $name){
            $sheet=$this->excelFile->getSheet($name);
            $readSheets[]=new ExcelSheet($sheet);
        }
        return $readSheets;
    }
}