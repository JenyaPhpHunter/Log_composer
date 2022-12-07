<?php

namespace Learning\Logging;

require __DIR__ . '/WriterInterface.php';

class FileWriter implements WriterInterface
{
    private string $filename;

    public function __construct($filename)
    {
        $this->filename = $filename;
    }
    public function write($result_log)
    {
        file_put_contents(
            $this->filename,
            $result_log[0] . ' ' . $result_log[1] . ' ' . $result_log[2] . ' ' . $result_log[3] . PHP_EOL,
            FILE_APPEND
        );
        return 0;
    }
}