'''Class for retrieving data from the Spotify Web API.'''
# See https://developer.spotify.com/documentation/web-api/ for more information.

import requests
import time
import json
import base64
from collections import Counter

class Spotify():
    '''
    Class for retrieving data from the Spotify Web API.
    '''
    def __init__(self):
        '''
        Constructor.
        '''
        self.previousTime = time.time()
        self.token = None
        self.__name__ = "Spotify"        

    def get_token(self):
        '''
        Method that refreshes the authentication token.
        '''
        if int(time.time()) - self.previousTime > 3590 or self.token == None: # Spotify API token needs to be renewed every hour.
            self.previousTime = int(time.time())
            print("Refresh token")

            # User settings: (Spotify account: sven.baerten@student.uhasselt.be)
            client_id = "dfc5911d647841d2b38b9df9b81577a5"      # Enter your client id here
            client_secret = "b29f8a6ac2c84e549b4e114a3e67126a"  # Enter your client secret here
            authorization_string = client_id+":"+client_secret
            authorization = 'Basic ' + str(base64.b64encode(authorization_string.encode()).decode())   # authorization = 'Basic ZGZjNTkxMWQ2NDc4NDFkMmIzOGI5ZGY5YjgxNTc3YTU6YjI5ZjhhNmFjMmM4NGU1NDliNGUxMTRhM2U2NzEyNmE=' # Base64 encoding of 'client_id:client_secret'

            # POST URL with settings.
            post_url = 'https://accounts.spotify.com/api/token'
            payload = {'grant_type': 'client_credentials'}
            headers = {'Authorization': authorization, 'Content-Type':'application/x-www-form-urlencoded'}

            # Get response.
            response = requests.post(post_url, data=payload, headers=headers)

            # Parse response.
            status = response.status_code
            if status != requests.codes.ok:
                return response
            json_data = json.loads(response.text)

            self.token = json_data['access_token']           
                
        return self.token
    
    def search_track(self, artist, title):
        '''
        Get raw Spotify information about a track.

        Arguments:
        - artist: The artist name (e.g. Kanye%20West).
        - title: The track title (e.g. Power).

        Returns:
        - The raw JSON track object.
        '''
        ## SEARCH TRACK (See https://developer.spotify.com/documentation/web-api/reference/search/search/)
        get_url = 'https://api.spotify.com/v1/search?q=track:'+title+'+artist:'+artist+'+&type=track&limit=1'
        headers = {'Authorization': 'Bearer ' + self.get_token()}
        response = requests.get(get_url, headers=headers)

        status = response.status_code
        if status != requests.codes.ok:
            return response

        track_json_raw = json.loads(response.text)

        return track_json_raw
    
    def search_artist(self, artistID):
        '''
        Get raw Spotify information about an artist.

        Arguments:
        - artistID: The artist ID (e.g. Kanye%20West -> 6M2wZ9GZgrQXHCFfjv46we).

        Returns:
        - The raw JSON artist object.
        '''
        ## GET ARTIST (See https://developer.spotify.com/documentation/web-api/reference/artists/get-artist/)
        get_url = 'https://api.spotify.com/v1/artists/'+str(artistID)
        headers = {'Authorization': 'Bearer ' + self.get_token()}
        response = requests.get(get_url, headers=headers)

        status = response.status_code
        if status != requests.codes.ok:
            return response

        artist_json_raw = json.loads(response.text)

        return artist_json_raw

    def get_track_info(self, artist, title):
        '''
        Get compressed Spotify information about a music track.

        Arguments:
        - artist: The artist name (e.g. Kanye%20West).
        - title: The track title (e.g. Power).

        Returns:
        - The compressed JSON track object.
        '''
        # Parse raw JSON track object.
        track_json_raw = self.search_track(artist, title)
        track = track_json_raw['tracks']['items'][0]
        track_id = track['id']
        track_name = track['name']
        track_number = track['track_number']
        track_popularity = track['popularity']
        track_isExplicit = track['explicit']        
        artist = track['artists']
        artist_id = artist[0]['id'] # TODO: Multiple artists
        artist_name = artist[0]['name']
        album = track['album']
        album_id = album['id']
        album_name = album['name']
        album_release_date = album['release_date']
        album_release_date_precision = album['release_date_precision']
        album_cover = album['images'][0]['url']
        album_total_tracks = album['total_tracks']
        
        # Parse raw JSON artist object.
        artist_json_raw = self.search_artist(artist_id)
        genres = artist_json_raw['genres'] # E.g. [ "chicago rap", "pop rap", "rap" ]
        genre = genres[-1]  # Other option: genre = Counter([sub for g in genres for sub in g.replace(';',' ').replace(',',' ').replace('-',' ').replace(' - ',' ').split()]).most_common()[0][0]
        artist_image =  artist_json_raw["images"][0]["url"]
        artist_popularity = artist_json_raw["popularity"]
        artist_followers = artist_json_raw["followers"]['total']     

        # Combine into single JSON object.
        track_summary = {'track_id':track_id, 'track_name':track_name, 'track_genre':genre, 'track_number':track_number, 'track_popularity':track_popularity, 'track_isExplicit':track_isExplicit}
        artist_summary = {'artist_id':artist_id, 'artist_name':artist_name, 'artist_image':artist_image, 'artist_popularity':artist_popularity, 'artist_followers':artist_followers}
        album_summary = {'album_id':album_id, 'album_name':album_name, 'album_release_date':album_release_date, 'album_release_date_precision':album_release_date_precision, 'album_cover':album_cover, 'album_total_tracks':album_total_tracks}
        summary = {'track':track_summary, 'artist':artist_summary, 'album':album_summary}

        return summary

if __name__ == '__main__':
    spotify = Spotify()
    # print(spotify.get_track_info('Kanye West', 'Stronger'))
