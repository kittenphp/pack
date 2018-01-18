<?php


namespace kitten\pack\log;

use Monolog\Formatter\LineFormatter;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Logger;

class LogFactory
{
    private $logger;

    /**
     * LogFactory constructor.
     * @param string $directory
     * @param string $fileNamePrefix
     */
    public function __construct(string $directory,string $fileNamePrefix='log')
    {
        if (empty($fileNamePrefix)){
            throw new \InvalidArgumentException('log file name prefix Can not be empty');
        }
        $directory=rtrim($directory, '/');
        if (!is_dir($directory)){
           if (!mkdir($directory)){
               throw new \InvalidArgumentException($directory.': Incorrect directory name or no permission to create');
           }
        }
        $allPath=$directory.'/'.$fileNamePrefix;
        $log=new Logger('exception');
        $formatter = new LineFormatter();
        $stream = new RotatingFileHandler($allPath,30);
        $stream->setFormatter($formatter);
        $log->pushHandler($stream);
        $this->logger=$log;
    }
    public function getLogger(){
        return $this->logger;
    }
}