<?php

namespace App\Soap;

class Date2YearMonthDayRequest
{
    /**
     * @var string
     */
    protected $Date;

    /**
     * Date2YearMonthDayRequest constructor.
     * 
     * @param string $Date 
     */
    public function __construct($Date)
    {
        $this->Date = $Date;
    }

    /**
     * @return string
     */
    public function getDate()
    {
        return $this->Date;
    }
}