<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Playlist;
use App\Song;
use App\SOAP\ChartLyricsRequest;
use Illuminate\Support\Facades\DB;
use Artisaninweb\SoapWrapper\SoapWrapper;

class SongLyricsController extends Controller
{    
    /**
     * Get the song lyrics by its artist and title.
     *
     * @return \Illuminate\Http\Response
     */
    public function getSongLyricsByArtistTitle(Request $request)  // https://itsolutionstuff.com/post/how-to-get-query-strings-value-in-laravel-5example.html
    {        
        // Call the Chart Lyrics SOAP API: http://www.chartlyrics.com/api.aspx
        $soapWrapper = new SoapWrapper();
        $soapWrapper->add('ChartLyrics', function ($service) {
            $service
              ->wsdl('http://api.chartlyrics.com/apiv1.asmx?WSDL')
              ->trace(true)
              ->classmap([
                ChartLyricsRequest::class
              ]);
          });
        $response = $soapWrapper->call('ChartLyrics.SearchLyricDirect', [
            new ChartLyricsRequest($request->input('artist'), $request->input('title'))
        ]);          
        
        $lyric = $response->SearchLyricDirectResult->Lyric;

        return preg_replace("/\r|\n/", "<br>", $lyric);
    }
}
