<?php
//Find Component
namespace App\Controller\Component;
use App\Controller\AppController;
use Cake\Controller\Component;
class FindComponent extends Component
{
    private $d = 0;
    private $w = 0;

    function maxWidth($array)
    {
        $this->w = 0;
        if(!empty($array))
        {
            foreach ($array as $key => $data) {
                $this->w++;
                if(!empty($data['children']))
                    $this->calculateMaxWidth($data['children']);
            }
        }
        return $this->w;
    }

    function calculateMaxWidth($array)
    {
        if(!empty($array))
        {
            foreach ($array as $key => $data) {
                $this->w++;
                if(!empty($data['children']))
                    $this->calculateMaxWidth($data['children']);
            }
        }
    }

    function arrayWidth($array)
    {
        $this->w = 0;
        if(!empty($array))
        {
            if (!empty($array['children'])) 
            {
                $this->getWidth($array['children']);
            }
            if (!empty($array['sub_exams'])) 
            {
                $this->getWidth($array['sub_exams']);
            }
        }
        $width = $this->w;
        return $width;
    }

    function getWidth($array)
    {
        foreach ($array as $key => $value) 
        {
            if (!empty($value['children']) || !empty($value['sub_exams'])) 
            {
                $this->getWidth(@$value['children'] ? $value['children'] : $value['sub_exams']);
            }
            else
                $this->w++;
        }
    }

	function arrayDepth($array) {
        $this->d = 0;
        $array2 = [];
        if(!empty($array))
        {
            $i=0;
                if((isset($array['children']) && !empty($array['children'])) || (isset($array['sub_exams']) && !empty($array['sub_exams'])))
                {
                    $array2[$i] = @$array['children'] ? $array['children'] : $array['sub_exams'];
                    $i++;
                }
            //pr($array2);exit;
            $this->getArrays($array2); 
        }
        return $this->d;
    }

    function maxDepth($array) {
        $this->d = 0;
        $array2 = [];
        if(!empty($array))
        {
            $this->d++;
            $i=0;
            foreach ($array as $key => $value) {
                if((isset($value['children']) && !empty($value['children'])) || (isset($value['sub_exams']) && !empty($value['sub_exams'])))
                {
                    $array2[$i] = @$value['children'] ? $value['children'] : $value['sub_exams'];
                    $i++;
                }
            }
            //pr($array2);exit;
            $this->getArrays($array2); 
        }
        return $this->d;
    }

    function getArrays($array)
    {
        $a = [];
        if(!empty($array))
        {
            foreach ($array as $key => $value) 
            {
                foreach ($value as $key2 => $v) {
                    if((isset($v['children']) && !empty($v['children'])) || (isset($v['sub_exams']) && !empty($v['sub_exams'])))
                    {
                        $a[] = @$v['children'] ? $v['children'] : $v['sub_exams'];
                    }
                }
            }
                $this->d++;
            $this->getArrays($a);
        }
        return 0;
    }

    function nextChild($array)
    {
        $a = [];
        if(!empty($array))
        {
            foreach ($array as $key => $value) 
            {
                if((isset($value['children']) && !empty($value['children'])) || (isset($value['sub_exams']) && !empty($value['sub_exams'])))
                {
                    if(@$value['children'])
                        foreach ($value['children'] as $key => $v) {
                            $a[] = $v;
                        }
                    if(@$value['sub_exams'])
                        foreach ($value['sub_exams'] as $key => $v) {
                            $a[] = $v;
                        }
                }
            }
        }
        return $a;
    }
}