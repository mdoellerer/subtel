<?php
    namespace Mdoellerer\Subtel;

    require 'vendor/autoload.php';

    if (!is_null($argv[1])){
        $guid = $argv[1];
    }
    //The following ELSE is just because we are in a DEMO software, this was the example
    // used for check all cases, I only left this here so it is quicker to test and to show.
    else{
        $guid = 'c5f987b9-52da-4358-a425-760262482fc0';
    }

    new App($guid);
?>