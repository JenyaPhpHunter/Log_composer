<?php

namespace Learning\Logging;

interface WriterInterface
{
    public function write($result_log);
}