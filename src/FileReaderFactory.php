<?php
declare (strict_types = 1);

namespace Mdoellerer\Subtel;

class FileReaderFactory
{
    public static function createReader(string $fileType){
        switch ($fileType){
            case 'json':
                $reader = new FileReaderJson();
                break;
            default :
                throw new \Exception("File Reader of Type $fileType not implemented");
        }
        return $reader;
    }
}