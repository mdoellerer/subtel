<?php
declare (strict_types = 1);

namespace Mdoellerer\Subtel;

interface FileReaderAbstract
{
    public function readFile(string $filePath);
}