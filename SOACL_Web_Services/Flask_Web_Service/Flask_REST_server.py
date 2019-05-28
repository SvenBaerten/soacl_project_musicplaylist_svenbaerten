from flask import Flask, current_app
from flask_restful import Api, Resource
import spotify.Spotify as Spotify
from flask_cors import CORS

# Reference to Flask: http://flask.pocoo.org/

class Start(Resource):
    def get(self):
        return current_app.send_static_file('index.html')

class SpotifyTrack(Resource):
    def __init__(self, spotify):
        self.spotify = spotify

    def get(self, artist, title):
        return self.spotify.get_track_info(artist=artist, title=title)
    
    def post(self):
        pass

    def put(self):
        pass
    
    def delete(self):
        pass

if __name__ == '__main__':
    app = Flask(__name__)
    CORS(app)

    api = Api(app)    

    spotify = Spotify.Spotify()
    api.add_resource(Start, "/")
    api.add_resource(SpotifyTrack, "/api/track/<string:artist>/<string:title>", resource_class_kwargs={'spotify':spotify})
    

    # app.run(debug=True, port=80)
    app.run(host='0.0.0.0', port=80)