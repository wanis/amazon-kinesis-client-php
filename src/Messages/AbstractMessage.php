<?php
namespace Wanis\Aws\Kinesis\Messages;


abstract class AbstractMessage
{
    public $action;

    abstract public function handleData($data);
}