<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Playlist;
use App\Song;
use Illuminate\Support\Facades\DB;

use Artisaninweb\SoapWrapper\SoapWrapper;
use App\SOAP\YouTube2ArtistTrackRequest;
use App\SOAP\Date2YearMonthDayRequest;

class SongController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Song::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $playlists = Playlist::All();
        return view('songForm')->with("playlists", $playlists); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Set this flag to True to use the custom made Azure web service implementations.
        $FLAG_USE_AZURE = false;

        // Set this flag to True to the use the Node.js DateSplitter web service instead of the SOAP version.
        $FLAG_USE_NODEJS_DATESPLITTER = true;

        // Extract data from request
        $playlist = Playlist::where('name', $request["playlist_name"])->first();
        $youtube_code = $request["youtube_code"];
        $rating = $request["rating"];

        // Make song
        $song = new Song();        

        // Get data from YouTube REST API: https://developers.google.com/youtube/v3/getting-started
        $youtube_video = $youtube_code;
        $youtube_api_key = "AIzaSyDhlP6ib-VdhlrxgU03n0QNng744giYvFY"; // See above link for how to generate.
        $youtube_url = "https://www.googleapis.com/youtube/v3/videos?id=" . $youtube_video . "&key=" . $youtube_api_key . "&part=snippet,statistics";
         
        $curl = curl_init();            // From https://laravelcode.com/post/laravel-55-how-to-make-curl-http-request-example
        curl_setopt_array($curl, array(
            CURLOPT_URL => $youtube_url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30000,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                // Set here required headers
                "accept: */*",
                "accept-language: en-US,en;q=0.8",
                "content-type: application/json",
            ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        // if ($err) ; 

        $json = json_decode($response, true);
        // return $json;
        $youtube_entity = $json['items'][0];
        $youtube_snippet = $youtube_entity['snippet'];
        $youtube_title = $youtube_snippet['title'];
        // $youtube_description = $youtube_snippet['description'];
        $youtube_thumbnail = $youtube_snippet['thumbnails']['medium']['url'];


        // Call custom made SOAP web service 'YouTubeSplitterService.asmx' -> YouTube2ArtistTrack 
        // It converts a YouTube video title to the artist and track title.
        // For example 'Coldplay - Paradise (Official Video)' to artist 'Coldplay' and track 'Paradise'.
        if ($FLAG_USE_AZURE) 
        {
            $soapWrapper = new SoapWrapper();
            $soapWrapper->add('YouTubeSplitterService', function ($service) {
                $service
                ->wsdl('https://soap-web-service-svenbaerten.azurewebsites.net/YouTubeSplitterService.asmx?WSDL')
                ->trace(true)
                ->classmap([
                    YouTube2ArtistTrackRequest::class,
                ]);
            });
        }
        else
        {
            $soapWrapper = new SoapWrapper();
            $soapWrapper->add('YouTubeSplitterService', function ($service) {
                $service
                ->wsdl('http://localhost:60946/YouTubeSplitterService.asmx?WSDL')
                ->trace(true)
                ->classmap([
                    YouTube2ArtistTrackRequest::class,
                ]);
            });
        }

        $response = $soapWrapper->call('YouTubeSplitterService.YouTube2ArtistTrack', [
            new YouTube2ArtistTrackRequest($youtube_title)
        ]);                
        $artist = $response->YouTube2ArtistTrackResult->artist;
        $title = $response->YouTube2ArtistTrackResult->track;


        // Get song data from Spotify REST API: https://developer.spotify.com/documentation/web-api/
        // We call here a custom made REST service in Python Flask that provides a simple interface to the Spotify API.
        if ($FLAG_USE_AZURE) 
        {
            $flask_base_url = 'http://flask-web-service-svenbaerten.westeurope.azurecontainer.io/api/track';
        }
        else
        {            
            $flask_base_url = 'http://192.168.99.100:8000/api/track'; // When running docker container do '-p 8000:80'.
        }
        
        $flask_url = $flask_base_url . '/' . str_replace(' ', '%20', $artist) . '/' . str_replace(' ', '%20', $title); // GET: http://127.0.0.1:5000/api/track/<string:artist>/<string:title>

        $curl = curl_init();            // From https://laravelcode.com/post/laravel-55-how-to-make-curl-http-request-example
        curl_setopt_array($curl, array(
            CURLOPT_URL => $flask_url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30000,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                // Set here required headers
                "accept: */*",
                "accept-language: en-US,en;q=0.8",
                "content-type: application/json",
            ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        // if ($err) ; 

        $json = json_decode($response, true);
        $spotify_code = $json['track']['track_id'];
        $genre = $json['track']['track_genre'];
        $spotify_artist_code = $json['artist']['artist_id'];
        $spotify_artist_image = $json['artist']['artist_image'];
        $album = $json['album']['album_name'];
        $spotify_album_code = $json['album']['album_id'];
        $release_date = $json['album']['album_release_date'];
        $spotify_album_cover = $json['album']['album_cover'];


        // $FLAG_USE_NODEJS_DATESPLITTER = False => Call custom made SOAP web service DateSplitterService.asmx (Date2YearMonthDay).   
        // $FLAG_USE_NODEJS_DATESPLITTER = True => Call custom made Node.js web service dateSplitter.
        // It converts a date to the year, month (also name) and day.
        // For example 2011-10-24 -> year 2011, month 10 (also October) and day 24.
        if ($FLAG_USE_NODEJS_DATESPLITTER == false)
        {
            if ($FLAG_USE_AZURE) 
            {
                $soapWrapper = new SoapWrapper();
                $soapWrapper->add('DateSplitterService', function ($service) {
                    $service
                    ->wsdl('https://soap-web-service-svenbaerten.azurewebsites.net/DateSplitterService.asmx?WSDL')
                    ->trace(true)
                    ->classmap([
                        YouTube2ArtistTrackRequest::class,
                    ]);
                });
            }
            else
            {
                $soapWrapper = new SoapWrapper();
                $soapWrapper->add('DateSplitterService', function ($service) {
                    $service
                    ->wsdl('http://localhost:60946/DateSplitterService.asmx?WSDL')
                    ->trace(true)
                    ->classmap([
                        YouTube2ArtistTrackRequest::class,
                    ]);
                });
            }

            $response = $soapWrapper->call('DateSplitterService.Date2YearMonthDay', [
                new Date2YearMonthDayRequest($release_date)
            ]);       
            $year = $response->Date2YearMonthDayResult->year;
            $month = $response->Date2YearMonthDayResult->month;
            $month_name = $response->Date2YearMonthDayResult->monthNameLong;
            $day = $response->Date2YearMonthDayResult->day;
        }
        else
        {
            if ($FLAG_USE_AZURE) 
            {
                $nodejs_dateSplitter_base_url = 'http://nodejs-web-service-svenbaerten.westeurope.azurecontainer.io/api/dateSplitter'; 
            }
            else
            {                
                $nodejs_dateSplitter_base_url = 'http://192.168.99.100:8001/api/dateSplitter';
            }
            $nodejs_url = $nodejs_dateSplitter_base_url . '/' . $release_date;

            $curl = curl_init();            // From https://laravelcode.com/post/laravel-55-how-to-make-curl-http-request-example
            curl_setopt_array($curl, array(
                CURLOPT_URL => $nodejs_url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30000,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_HTTPHEADER => array(
                    // Set here required headers
                    "accept: */*",
                    "accept-language: en-US,en;q=0.8",
                    "content-type: application/json",
                ),
            ));
            $response = curl_exec($curl);
            $err = curl_error($curl);
            curl_close($curl);
            // if ($err) ;   

            $json = json_decode($response, true);
            $year =  $json['year'];
            $month = $json['month'];
            $month_name = $json['monthNameLong'];
            $day = $json['day'];
        }
        
        // Save song
        $song->title = $title;
        $song->artist = $artist;
        $song->genre = $genre;
        $song->album = $album;
        $song->year = $year;
        $song->month = $month;
        $song->month_name = $month_name;
        $song->day = $day;
        $song->rating = $rating;
        $song->youtube_code = $youtube_code;
        $song->youtube_title = $youtube_title;
        $song->youtube_thumbnail = $youtube_thumbnail;
        $song->spotify_code = $spotify_code;
        $song->spotify_artist_code = $spotify_artist_code;
        $song->spotify_artist_image = $spotify_artist_image;
        $song->spotify_album_code = $spotify_album_code;
        $song->spotify_album_cover = $spotify_album_cover;

        $playlist->songs()->save($song);

        return $song;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Song::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

