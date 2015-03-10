<?php
namespace Wanis\Aws\Kinesis\Messages\Input;


use Wanis\Aws\Kinesis\Messages\Input;
use Wanis\Aws\Kinesis\Processors\Processor;

class Initialize extends Input
{
    public $action = 'initialize';
    public $shardId;

    public function handleData($data)
    {
        $this->shardId = $data['shardId'];
    }

    /**
     * @param Processor $processor
     * @return Output
     */
    public function getRespond(Processor $processor)
    {
        $processor->initialize($this->shardId);
        return $this->getStatusMessage();
    }
}