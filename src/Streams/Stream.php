<?php
namespace Wanis\Aws\Kinesis\Streams;

interface Stream
{
    public function readLine();
    public function writeLine($line);
    public function error($message);
}