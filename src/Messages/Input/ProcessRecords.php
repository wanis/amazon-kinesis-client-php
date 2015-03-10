<?php
namespace Wanis\Aws\Kinesis\Messages\Input;

use Wanis\Aws\Kinesis\Checkpointer;
use Wanis\Aws\Kinesis\Messages\Input;
use Wanis\Aws\Kinesis\Messages\Output;
use Wanis\Aws\Kinesis\Processors\Processor;
use Wanis\Aws\Kinesis\ProcessRecord\Factory;

class ProcessRecords extends Input
{
    public $action = 'processRecords';
    public $records;

    private $checkpointer;

    function __construct(Checkpointer $checkpointer)
    {
        $this->checkpointer = $checkpointer;
    }


    public function handleData($data)
    {
        $this->records = Factory::getRecordList($data['records']);
    }

    /**
     * @param Processor $processor
     * @return Output
     */
    public function getRespond(Processor $processor)
    {
        $processor->processRecords($this->records, $this->checkpointer);
        return $this->getStatusMessage();

    }
}