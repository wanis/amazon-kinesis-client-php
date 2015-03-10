<?php
namespace Wanis\Aws\Kinesis\Messages;

use Wanis\Aws\Kinesis\Checkpointer;
use Wanis\Aws\Kinesis\Exception;
use Wanis\Aws\Kinesis\Messages\Input\CheckpointError;
use Wanis\Aws\Kinesis\Messages\Input\Initialize;
use Wanis\Aws\Kinesis\Messages\Input\ProcessRecords;
use Wanis\Aws\Kinesis\Messages\Input\Shutdown;

class MessageFactory
{
    /**
     * @param $line
     * @return Input
     * @throws Exception
     */
    public static function createFromInputLine($line, Checkpointer $checkpointer)
    {
        $parsed = json_decode($line, true);
        switch ($parsed['action']) {
            case 'initialize':
                $message = new Initialize();
                break;
            case 'processRecords':
                $message = new ProcessRecords($checkpointer);
                break;
            case 'shutdown':
                $message = new Shutdown($checkpointer);
                break;
            case 'checkpoint':
                $message = new CheckpointError();
                break;
            default:
                throw new Exception('Cannot parse input line as input Message');
        }
        $message->handleData($parsed);
        return $message;
    }

}