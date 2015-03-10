<?php

namespace Wanis\Aws\Kinesis\Processors;


use Wanis\Aws\Kinesis\Checkpointer;

class VoidProcessor implements Processor
{

    public function initialize($shardId)
    {
        // TODO: Implement initialize() method.
    }

    public function processRecords($records, Checkpointer $checkpointer)
    {
        // TODO: Implement processRecords() method.
    }

    public function shutdown(Checkpointer $checkpointer, $reason)
    {
        // TODO: Implement shutdown() method.
    }
}