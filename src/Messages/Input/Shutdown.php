<?php
namespace Wanis\Aws\Kinesis\Messages\Input;

use Wanis\Aws\Kinesis\Messages\Input;
use Wanis\Aws\Kinesis\Messages\Output;
use Wanis\Aws\Kinesis\Processors\Processor;

class Shutdown extends Input
{
    public $action = 'shutdown';
    public $reason;

    private $checkpointer;

    public function __construct(Checkpointer $checkpointer)
    {
        $this->checkpointer = $checkpointer;
    }

    public function handleData($data)
    {
        $this->reason = $data['reason'];
    }

    /**
     * @param Processor $processor
     * @return Output
     */
    public function getRespond(Processor $processor)
    {
        $processor->shutdown($this->checkpointer, $this->reason);
        return $this->getStatusMessage();
    }
}