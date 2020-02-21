<?php
    $filesPath = dirname(__FILE__)  . '//json-files//';

    //START ALL HERE
    outputFilesGlob($filesPath);


    function outputFilesGlob (string $filePath){
        foreach(glob("json-files/*.json") as $file){            
            readJsonFile($file);
        }
    }

    function readJsonFile (string $file){
        echo basename($file) . " (size: " . filesize($file) . " bytes)" . PHP_EOL;
        $content = file_get_contents($file);

        $json_content = json_decode($content);
        var_export($json_content) ;
    }

?>