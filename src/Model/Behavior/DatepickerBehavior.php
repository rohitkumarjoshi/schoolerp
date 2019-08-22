<?php
namespace App\Model\Behavior;

use Cake\ORM\Behavior;
use Cake\Event\Event;
use ArrayObject;

class DatepickerBehavior extends Behavior
{
    /**
     * Preparing the data
     *
     * @param \Cake\Event\Event $event
     * @param \ArrayObject $data
     * @param \ArrayObject $options
     * @return void
     */
    public function beforeMarshal(Event $event, ArrayObject $data, ArrayObject $options)
    {
        foreach ($data as $key => $value) 
        {
            $columnType = $this->getTable()->getSchema()->getColumnType($key);
            if($columnType=='date')
            {
                $data[$key] = date('Y-m-d',strtotime($data[$key]));
            }
        }
    }
        
}
