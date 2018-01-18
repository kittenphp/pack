<?php


namespace kitten\pack\paging;

use InvalidArgumentException;
use kitten\component\database\DBHelper;
use kitten\utils\StringTools;

class PageQuery
{
    protected $dbHelper;
    protected $pageConfig;
    public function __construct(DBHelper $DBHelper,PageConfig $config)
    {
        $this->dbHelper=$DBHelper;
        $this->pageConfig=$config;
    }

    /**
     * @param int $currentPage
     * @param string $table
     * @param array $where
     * @param string $orderByColumn
     * @param bool $isDESC
     * @return array
     */
    public function getDataFromTable(int $currentPage,string $table,array $where,string $orderByColumn,bool $isDESC=true){
        $onePageSize=$this->pageConfig->getOnePageSize();
        if (StringTools::isNullOrEmptyString($table)){
            throw new InvalidArgumentException('Table name can not be empty');
        }
        if (empty($currentPage) || $currentPage<=0){
            throw new InvalidArgumentException('current Page number must be greater than 0');
        }
        if (empty($onePageSize) || $onePageSize<=0){
            throw new InvalidArgumentException('one Page Size must be greater than 0');
        }
        if (StringTools::isNullOrEmptyString($orderByColumn)){
            throw new InvalidArgumentException('order by column cannot be empty');
        }
        $limit=($currentPage-1)*$onePageSize;
        $offset=$onePageSize;
        $whereDetails = '';
        if (!empty($where)){
            $i = 0;
            foreach ($where as $key => $value) {
                if ($i == 0) {
                    $whereDetails .= "$key = :$key";
                } else {
                    $whereDetails .= " AND $key = :$key";
                }
                $i++;
            }
            $whereDetails = ltrim($whereDetails, ' AND ');
            $whereDetails=' where '.$whereDetails;
        }
        if ($isDESC){
            $orderBy='DESC';
        }else{
            $orderBy='ASC';
        }
        $sql="select * from {$table} {$whereDetails} ORDER BY {$orderByColumn} {$orderBy} LIMIT {$limit},{$offset};";
        $records=$this->dbHelper->getMoreRows($sql,$where);
        return $records;
    }

    /**
     * @param int $currentPage
     * @param string $sql
     * @param array $args
     * @return array
     */
    public function getDataFromSql(int $currentPage,string $sql, array $args = []){
        $onePageSize=$this->pageConfig->getOnePageSize();
        $limit=($currentPage-1)*$onePageSize;
        $offset=$onePageSize;
        if (empty($onePageSize) || $onePageSize<=0){
            throw new InvalidArgumentException('one Page Size must be greater than 0');
        }
        if (stristr($sql,'ORDER')===false){
            throw new InvalidArgumentException('Paging SQL must contain "order by" statement.');
        }
        $sql=trim($sql);
        $sql=rtrim($sql,";");
        $sql="{$sql} LIMIT {$limit},{$offset};";
        $records=$this->dbHelper->getMoreRows($sql,$args);
        return $records;
    }
}