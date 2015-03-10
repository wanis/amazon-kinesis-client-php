<?php
namespace Wanis\Aws\Kinesis\Streams;

use Wanis\Aws\Kinesis\Streams\Stream;

class LoggingStream implements Stream
{

    /**
     * @var Stream
     */
    private $stream;
    private $logFilePath;

    function __construct($logFilePath, Stream $stream)
    {
        $this->logFilePath = $logFilePath;
        $this->stream = $stream;
    }


    public function readLine()
    {
        $line = $this->stream->readLine();
        file_put_contents($this->logFilePath, "IN: ". $line . PHP_EOL, FILE_APPEND);
        return $line;
    }

    public function writeLine($line)
    {
        $this->stream->writeLine($line);
        file_put_contents($this->logFilePath, "OUT: ". $line . PHP_EOL, FILE_APPEND);
    }

    public function error($message)
    {
        $this->stream->error($message);
        file_put_contents($this->logFilePath, "ERROR: ". $message . PHP_EOL, FILE_APPEND);
    }
}