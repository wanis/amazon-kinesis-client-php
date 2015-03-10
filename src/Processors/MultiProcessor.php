<?php
namespace Wanis\Aws\Kinesis\Processors;


use Wanis\Aws\Kinesis\Checkpointer;

class MultiProcessor implements Processor
{
    private $processors = array();

    public function add(Processor $processor)
    {
        $this->processors[] = $processor;
    }

    public function initialize($shardId)
    {
        foreach ($this->processors as $processor) {
            $processor->initialize($shardId);
        }
    }

    public function processRecords($records, Checkpointer $checkpointer)
    {
        foreach ($this->processors as $processor) {
            $processor->processRecords($records, $checkpointer);
        }
    }

    public function shutdown(Checkpointer $checkpointer, $reason)
    {
        foreach ($this->processors as $processor) {
            $processor->shutdown($checkpointer, $reason);
        }
    }
}