<?php
namespace Wanis\Aws\Kinesis\Messages;


use Wanis\Aws\Kinesis\Messages\Output\Status;
use Wanis\Aws\Kinesis\Processors\Processor;

abstract class Input extends AbstractMessage
{
    /**
     * @param Processor $processor
     * @return Output
     */
    abstract public function getRespond(Processor $processor);

    public function getStatusMessage()
    {
        $message = new Status();
        $message->responseFor = $this->action;
        return $message;
    }
} 