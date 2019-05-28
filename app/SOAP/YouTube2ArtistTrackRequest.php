<?php

namespace App\Soap;

class YouTube2ArtistTrackRequest
{
    /**
     * @var string
     */
    protected $YouTubeVideoTitle;

    /**
     * YouTube2ArtistTrackRequest constructor.
     * 
     * @param string $YouTubeVideoTitle 
     */
    public function __construct($YouTubeVideoTitle)
    {
        $this->YouTubeVideoTitle = $YouTubeVideoTitle;
    }

    /**
     * @return string
     */
    public function getYouTubeVideoTitle()
    {
        return $this->YouTubeVideoTitle;
    }
}