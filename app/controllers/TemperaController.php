<?php

class TemperaController extends BaseController {

    //protected $service;

    public function __construct($service = '')
    //public function __construct()
    {
        $this->_service = $service;
    }

    public function getAverage()
    {
        $total = 0;
        for ($i=0;$i<3;$i++)
        {
            $total += $this->_service->readTemp();
        }
        return $total/3;
    }

}
