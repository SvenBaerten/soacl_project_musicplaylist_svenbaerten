<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Playlist;
use App\Song;

class MainController extends Controller
{
    /**
     * Show the index view with playlists and songs.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return view('index');
    }

    /**
     * Show the documentation view.
     *
     * @return \Illuminate\Http\Response
     */
    public function getDocumentation() {
        return view('documentation');
    }
}
