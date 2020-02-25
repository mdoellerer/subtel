<?php
declare (strict_types = 1);

namespace Mdoellerer\Subtel;

class FileServices
{
    private $filesToRead = [];

    public function getFilesCollection(string $pathToFiles){
        foreach(glob("json-files/*.json") as $file){            
            $this->addFileToCollection($file);
        }
        return $this->filesToRead;
    }

    private function addFileToCollection(string $pathToFile){
        $this->filesToRead[] = $pathToFile;
    }

}