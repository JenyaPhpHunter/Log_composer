<?php

namespace Learning\Logging;

class StringFormatter implements FormatterInterface
{
    private string $format;

    public function __construct($format)
    {
        $this->format = $format;
    }

    public function getStringContext($context): string
    {
        $words = "";

        foreach ($context as $word) {
            $words .= $word . " ";
        }
        return $words;
    }

    public function formatter($format,$result): array
    {
        $exploded = explode("{", $format);
        unset($exploded[0]);
        $imploded = implode("", $exploded);
        $finish_exploded = explode("}", $imploded);
        unset($finish_exploded[4]);
        $result_log = [];
        foreach($finish_exploded as $item){
            $item = ltrim($item, ' ');
            $replaced[] = $replaced = str_replace($result, $item, $result);
            $result_log[] = $result[$item];
        }
        return $result_log;
    }
}