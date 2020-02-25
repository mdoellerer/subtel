<?php
declare (strict_types = 1);

namespace Mdoellerer\Subtel;

class FileReaderJson implements FileReaderAbstract
{
    public function readFile(string $file){
        $content = file_get_contents($file);

        return json_decode($content); 
    }
}