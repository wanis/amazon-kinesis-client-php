<?php
namespace Wanis\Aws\Kinesis\Messages\Output;

use Wanis\Aws\Kinesis\Messages\Output;

class Status extends Output
{
    public $action = 'status';
    public $responseFor;

    public function handleData($data)
    {
        $this->responseFor = $data['responseFor'];
    }
}