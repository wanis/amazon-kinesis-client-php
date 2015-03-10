<?php
namespace Wanis\Aws\Kinesis\Processors;


use Wanis\Aws\Kinesis\Checkpointer;
use Wanis\Aws\Kinesis\Messages\Output\Status;
use Wanis\Aws\Kinesis\Streams\Stream;

class ExitProcessor implements Processor
{
    private $stream;
    private $subProcess;

    function __construct(Stream $stream, Processor $subProcess)
    {
        $this->stream = $stream;
        $this->subProcess = $subProcess;
    }


    public function initialize($shardId)
    {
        $this->subProcess->initialize($shardId);
    }

    public function processRecords($records, Checkpointer $checkpointer)
    {
        $this->subProcess->processRecords($records, $checkpointer);
    }

    public function shutdown(Checkpointer $checkpointer, $reason)
    {
        $this->subProcess->shutdown($checkpointer, $reason);
        $message = new Status();
        $message->responseFor = 'shutdown';
        $this->stream->writeLine($message->asString());
        exit(0);
    }
}