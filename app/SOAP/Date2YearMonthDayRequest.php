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
     * Get the date.
     * 
     * @return string The date.
     */
    public function getDate()
    {
        return $this->Date;
    }
}