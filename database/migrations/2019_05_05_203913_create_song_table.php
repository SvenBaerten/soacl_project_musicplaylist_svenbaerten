<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSongTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('songs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('playlist_id'); // Key for Playlist
            
            $table->string('title')->default('null');
            $table->string('artist')->default('null');  
            $table->string('genre')->default('null');
            $table->string('album')->default('null');
            $table->integer('year')->default(0);
            $table->integer('month')->default(0);
            $table->string('month_name')->default('null');
            $table->integer('day')->default(0);          
            $table->integer('rating')->default(0);           
              
            // YouTube
            $table->string('youtube_code')->default('null');
            $table->string('youtube_title')->default('null');
            $table->string('youtube_thumbnail')->default('null');            
            // Spotify
            $table->string('spotify_code')->default('null');
            $table->string('spotify_artist_code')->default('null');
            $table->string('spotify_artist_image')->default('null');
            $table->string('spotify_album_code')->default('null');             
            $table->string('spotify_album_cover')->default('null');          

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('songs');
    }
}
