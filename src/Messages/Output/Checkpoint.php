<?php
namespace Wanis\Aws\Kinesis\Messages\Output;

use Wanis\Aws\Kinesis\Messages\Output;

class Checkpoint extends Output
{
    public $action = 'checkpoint';
    public $checkpoint;

    public function handleData($data)
    {
        $this->checkpoint = $data['checkpoint'];
    }
}