<?php

    function outputFilesScandirLong($path)
    {
        if(file_exists($path) && is_dir($path)){
            $result = scandir($path);
            
            // Filter out the current (.) and parent (..) directories
            $files = array_diff($result, array('.', '..'));
            
            if(count($files) > 0){
                foreach($files as $file){
                    if(is_file("$path/$file")){
                        // Display filename
                        echo $file . "<br>";
                    } else if(is_dir("$path/$file")){
                        outputFiles("$path/$file");
                    }
                }
            } else{
                echo "ERROR: No files found in the directory.";
            }
        } else {
            echo "ERROR: The directory does not exist.";
        }
    }

    function outputFilesGlobLong($path){
        // Check directory exists or not
        if(file_exists($path) && is_dir($path)){
            // Search the files in this directory
            $files = glob($path ."/*");
            if(count($files) > 0){
                // Loop through retuned array
                foreach($files as $file){
                    if(is_file("$file")){
                        // Display only filename
                        echo basename($file) . "<br>";
                    } else if(is_dir("$file")){
                        // Recursively call the function if directories found
                        outputFiles("$file");
                    }
                }
            } else{
                echo "ERROR: No such file found in the directory.";
            }
        } else {
            echo "ERROR: The directory does not exist.";
        }
    }

?>