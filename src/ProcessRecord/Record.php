<?php
namespace Wanis\Aws\Kinesis\ProcessRecord;


class Record
{
    public $data;
    public $partitionKey;
    public $sequenceNumber;
} 