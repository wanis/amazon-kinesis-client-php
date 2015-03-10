<?php
namespace Wanis\Aws\Kinesis;


use Wanis\Aws\Kinesis\Messages\Input\CheckpointError;
use Wanis\Aws\Kinesis\Messages\MessageFactory;
use Wanis\Aws\Kinesis\Messages\Output;
use Wanis\Aws\Kinesis\Messages\Output\Checkpoint;
use Wanis\Aws\Kinesis\Streams\Stream;

class Checkpointer
{
    /**
     * @var Stream
     */
    private $stream;

    public function __construct(Stream $stream)
    {
        $this->stream = $stream;
    }

    public function checkpoint()
    {
        $message = new Checkpoint();
        $this->dispatchMessage($message);
    }

    public function checkpointSequence($sequenceNumber)
    {
        $message = new Checkpoint();
        $message->checkpoint = $sequenceNumber;
        $this->dispatchMessage($message);
    }

    private function dispatchMessage(Output $message)
    {
        $this->stream->writeLine($message->asString());
        /** @var CheckpointError $message */
        $message = MessageFactory::createFromInputLine($this->stream->readLine(), $this);
        if ($message->error) {
            $this->stream->error('Error occurred then trying to checkpoint: ' . $message->error);
        }


    }
} 