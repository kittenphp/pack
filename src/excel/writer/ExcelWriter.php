<?php


namespace kitten\pack\excel\writer;

use kitten\pack\excel\writer\parser\XLSXWriter;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;

class ExcelWriter
{
    protected $columnCollection;
    public function __construct(ExcelColumnCollection $collection)
    {
        $this->columnCollection=$collection;
    }

    /**
     * @param array $rowData
     * @param string $filename
     * @return Response
     */
    public function generateFile(array $rowData,string $filename='data'){
        $headers=$this->columnCollection->getHeaders();
        $options=['widths'=>$this->columnCollection->getWidths()];
        $writer = new XLSXWriter();
        $writer->writeSheetHeader('Sheet1', $headers,$options);
        foreach ($rowData as $row){
            $writer->writeSheetRow('Sheet1', $row);
        }
        $tempFileName = uniqid(rand(), true) . '.xlsx';
        $tempFilePath=sys_get_temp_dir().'/'.$tempFileName;
        $writer->writeToFile($tempFilePath);
        $response = new BinaryFileResponse($tempFilePath);
        $response->headers->set('Content-Type', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        $response->setContentDisposition(
            ResponseHeaderBag::DISPOSITION_ATTACHMENT,
            $filename.'.xlsx'
        );
        $response->deleteFileAfterSend(true);
        return $response;
    }
}