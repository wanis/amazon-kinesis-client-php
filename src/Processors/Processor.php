<?php
namespace Wanis\Aws\Kinesis\Processors;


use Wanis\Aws\Kinesis\Checkpointer;

interface Processor
{
    public function initialize($shardId);

    public function processRecords($records, Checkpointer $checkpointer);

    public function shutdown(Checkpointer $checkpointer, $reason);

}