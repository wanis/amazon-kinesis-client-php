<?php
namespace Wanis\Aws\Kinesis\ProcessRecord;


class Factory
{
    public static function getRecordList($data)
    {
        $list = array();
        foreach($data as $recordArray) {
            /** @var Record $record */
            $record = self::fromArray($recordArray);
            $record->data = base64_decode($record->data);
            if ($record->data[0] == '{' || $record->data[0] == '[') {
                $record->data = json_decode($record->data, true);
            }
            $list[] = $record;

        }
        return $list;
    }

    public static function fromStdObject($object)
    {
        return unserialize('O:38:"Wanis\Aws\Kinesis\ProcessRecord\Record"' . substr(serialize($object), 14)) ;
    }
    public static function fromArray($array)
    {
        return unserialize('O:38:"Wanis\Aws\Kinesis\ProcessRecord\Record"' . substr(serialize($array), 1)) ;
    }

} 