<?php
namespace Wanis\Aws\Kinesis;

use Wanis\Aws\Kinesis\Messages\MessageFactory;
use Wanis\Aws\Kinesis\Processors\Processor;
use Wanis\Aws\Kinesis\Streams\Stream;

class Worker {
    private $processor;

    /**
     * @var Stream
     */
    private $stream;
    private $checkpointer;

    function __construct(Stream $stream, Processor $processor, Checkpointer $checkpointer)
    {
        $this->stream = $stream;
        $this->processor = $processor;
        $this->checkpointer = $checkpointer;
    }

    public function run()
    {
        while (true) {
            $message = MessageFactory::createFromInputLine($this->stream->readLine(), $this->checkpointer);
            $responds = $message->getRespond($this->processor);
            $this->stream->writeLine($responds->asString());
        }
    }
}