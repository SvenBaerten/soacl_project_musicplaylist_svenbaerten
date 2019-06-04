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
     * @param string $artist, song 
     */
    public function __construct($artist, $song)
    {
        $this->artist = $artist;
        $this->song = $song;
    }

    /**
     * Get the artist.
     * 
     * @return string The artist.
     */
    public function getArtist()
    {
        return $this->artist;
    }

    /**
     * Get the song.
     * 
     * @return string The song.
     */
    public function getSong()
    {
        return $this->song;
    }
}