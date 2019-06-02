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
    protected function getLyrics($artist, $song)
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
            new ChartLyricsRequest($artist, $song)
        ]);          
        
        $lyric = $response->SearchLyricDirectResult->Lyric;

        return preg_replace("/\r|\n/", "<br>", $lyric);
    }

    public function getLyricsByArtistTitle(Request $request)  // https://itsolutionstuff.com/post/how-to-get-query-strings-value-in-laravel-5example.html
    {        
        return SongLyricsController::getLyrics($request->input('artist'), $request->input('title'));
    }

}
