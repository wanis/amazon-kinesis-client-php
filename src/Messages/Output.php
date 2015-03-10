<?php
namespace Wanis\Aws\Kinesis\Messages;

abstract class Output extends AbstractMessage
{
    public function asString()
    {
        return json_encode($this);
    }
} 