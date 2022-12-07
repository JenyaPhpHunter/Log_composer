<?php

namespace Learning\Logging;

require_once __DIR__ . '/../vendor/autoload.php';

use Psr\Log\LogLevel;

class Logger
{
    private string $filename;
    private string $format;
    private string $message;
    private array $context;

    public function __construct($filename,$format,$message,$context)
    {
        $this->filename = $filename;
        $this->format = $format;
        $this->message = $message;
        $this->context = $context;
    }

    public function emergency($message, array $context = array())
    {
        $this->log(LogLevel::EMERGENCY, $message, $context);
    }

    /**
     * Action must be taken immediately.
     *
     * Example: Entire website down, database unavailable, etc. This should
     * trigger the SMS alerts and wake you up.
     *
     * @param string  $message
     * @param mixed[] $context
     *
     * @return void
     */
    public function alert($message, array $context = array())
    {
        $this->log(LogLevel::ALERT, $message, $context);
    }

    /**
     * Critical conditions.
     *
     * Example: Application component unavailable, unexpected exception.
     *
     * @param string  $message
     * @param mixed[] $context
     *
     * @return void
     */
    public function critical($message, array $context = array())
    {
        $this->log(LogLevel::CRITICAL, $message, $context);
    }

    /**
     * Runtime errors that do not require immediate action but should typically
     * be logged and monitored.
     *
     * @param string  $message
     * @param mixed[] $context
     *
     * @return void
     */
    public function error($message, array $context = array())
    {
        $this->log(LogLevel::ERROR, $message, $context);
    }

    /**
     * Exceptional occurrences that are not errors.
     *
     * Example: Use of deprecated APIs, poor use of an API, undesirable things
     * that are not necessarily wrong.
     *
     * @param string  $message
     * @param mixed[] $context
     *
     * @return void
     */
    public function warning($message, array $context = array())
    {
        $this->log(LogLevel::WARNING, $message, $context);
    }

    /**
     * Normal but significant events.
     *
     * @param string  $message
     * @param mixed[] $context
     *
     * @return void
     */
    public function notice($message, array $context = array())
    {
        $this->log(LogLevel::NOTICE, $message, $context);
    }

    /**
     * Interesting events.
     *
     * Example: User logs in, SQL logs.
     *
     * @param string  $message
     * @param mixed[] $context
     *
     * @return void
     */
    public function info($message, array $context = array())
    {
        $this->log(LogLevel::INFO, $message, $context);
    }

    /**
     * Detailed debug information.
     *
     * @param string  $message
     * @param mixed[] $context
     *
     * @return void
     */
    public function debug($message, array $context = array())
    {
        $this->log(LogLevel::DEBUG, $message, $context);
    }

    public function log($level, $message, array $context = array())
    {

        $formatter = new StringFormatter($this->format);
        $writer = new FileWriter($this->filename);
        $result = [
            "level" => $level,
            'date' => date('d-m-Y H:i:s'),
            'message' => $message,
            'context' => $formatter->getStringContext($context)
        ];
        $writer->write($formatter->formatter($this->format,$result));
    }
}