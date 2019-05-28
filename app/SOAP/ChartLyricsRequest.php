<?php

namespace App\Soap;

class ChartLyricsRequest
{
    /**
     * @var string
     */
    protected $artist;

    /**
     * @var string
     */
    protected $song;

    /**
     * Date2YearMonthDayRequest constructor.
     * 
     * @param string $artist, sSong 
     */
    public function __construct($artist, $song)
    {
        $this->artist = $artist;
        $this->song = $song;
    }

    /**
     * @return string
     */
    public function getArtist()
    {
        return $this->artist;
    }

    /**
     * @return string
     */
    public function getSong()
    {
        return $this->song;
    }
}