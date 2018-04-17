<?php

namespace cmu\ddd\directory\infrastructure\domain\model\dto;

class DTO
{

    private $data = [];

    function __construct(array $arr)
    {
        $this->data = $arr; //$arr not passed as pointer, also local memory, so safe allocation
    }

    public function get($key)
    {

        if(key_exists($this->data, $key))
            return $this->data[$key];

        return null; //default return

    }

    public function set($key, $value)
    {

        $this->data[$key] = $value;

    }

    public function getDataArray() : array
    {

        return $this->data;

    }
    public function serialize()
    {

        return json_encode($this->data);

    }

}