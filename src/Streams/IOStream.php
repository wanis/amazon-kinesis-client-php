<?php
namespace Wanis\Aws\Kinesis\Streams;

use Wanis\Aws\Kinesis\Streams\Stream;

class IOStream implements Stream
{

    private $input;
    private $output;
    private $error;

    function __construct($input, $output, $error)
    {
        $this->error = $error;
        $this->input = $input;
        $this->output = $output;
    }


    public function readLine()
    {
        return trim(fgets($this->input));
    }

    public function writeLine($line)
    {
        fputs($this->output, $line. PHP_EOL);
    }

    public function error($message)
    {
        fputs($this->error, $message. PHP_EOL);
    }
}