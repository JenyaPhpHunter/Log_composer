<?php


require __DIR__ . '/Logging/Logger.php';
require __DIR__ . '/Logging/FormatterInterface.php';
require __DIR__ . '/Logging/StringFormatter.php';
require __DIR__ . '/Logging/FileWriter.php';
require __DIR__ . '/vendor/autoload.php';

use Learning\Logging\StringFormatter;
use Learning\Logging\FileWriter;
use Learning\Logging\Logger;

$filename = __DIR__ . '/logs/log.txt';
$context = ['some context'];
$message = 'some message to write';
$level = '';
$format = '{date} {level} {message} {context}';

$formatter = new StringFormatter($format);
$string_context = $formatter->getStringContext($context);
$result = ['level' => $level, 'date' => date('d-m-Y H:i:s'), 'message' => $message, 'context' => $string_context];
$result_log = $formatter->formatter($format,$result);
$writer = new FileWriter($filename);
$logger = new Logger($filename, $format, $message, $context);

$writer->write($result_log);
$logger->debug("Some message", ['key' => 'value']);
