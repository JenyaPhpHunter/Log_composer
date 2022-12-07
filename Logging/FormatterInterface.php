<?php

namespace Learning\Logging;

interface FormatterInterface
{
    public function formatter($format,$data);
}