using System;
using System.Text.RegularExpressions;
using System.Web.Services;

namespace SOACL_SOAP_Web_Services
{
    /// <summary>
    /// This service splits a YouTube music video title into an artist name and track title.
    /// </summary>
    [WebService(Namespace = "http://tempuri.org/")]
    [WebServiceBinding(ConformsTo = WsiProfiles.BasicProfile1_1)]
    [System.ComponentModel.ToolboxItem(false)]
    // To allow this Web Service to be called from script, using ASP.NET AJAX, uncomment the following line. 
    // [System.Web.Script.Services.ScriptService]
    public class YouTubeSplitterService : System.Web.Services.WebService
    {
        public class YouTubeVideo
        {
            public String artist;
            public String track;          

            public YouTubeVideo()
            {
                artist = "null";
                track = "null";
            }

            public YouTubeVideo(String artist, String track)
            {
                this.artist = artist;
                this.track = track;
            }
        }

        [WebMethod]
        public YouTubeVideo YouTube2ArtistTrack(string YouTubeVideoTitle)
        {
            // Expected format: Coldplay - A Sky Full Of Stars (Official Video)
            // -> artist = "Coldplay" and track title = "A Sky Full Of Stars"
            // TODO: allow more title formats and extract all artist names
            if (YouTubeVideoTitle == null)
            {
                return new YouTubeVideo("null", "null");
            }

            if (YouTubeVideoTitle.Contains("-"))
            {
                // Remove (...) and [...]
                string regex = "(\\[.*\\])|(\".*\")|('.*')|(\\(.*\\))"; // From Kelsey, see https://stackoverflow.com/questions/1359412/remove-text-in-between-delimiters-in-a-string-using-a-regex
                string filtered = Regex.Replace(YouTubeVideoTitle, regex, "");

                // Split to artist and video title
                string[] split = filtered.Split('-');
                string artist = split[0].Trim();
                string track = split[1].Trim();

                return new YouTubeVideo(artist, track);
            }
            else
            {
                return new YouTubeVideo("null", "null");
            }
        }
    }
}
