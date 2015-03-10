<?php
namespace Wanis\Aws\Kinesis\Messages\Input;

use Wanis\Aws\Kinesis\Messages\Input;
use Wanis\Aws\Kinesis\Messages\Output;
use Wanis\Aws\Kinesis\Processors\Processor;

class CheckpointError extends Input
{
    public $action = 'checkpoint';
    public $checkpoint;
    public $error;

    public function handleData($data)
    {
        $this->checkpoint = $data['checkpoint'];
        $this->error = $data['error'];
    }

    /**
     * @param Processor $processor
     * @return Output
     */
    public function getRespond(Processor $processor)
    {
        // TODO: Implement getRespond() method.
    }
}