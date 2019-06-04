using System;
using System.Text.RegularExpressions;
using System.Web.Services;

namespace SOACL_SOAP_Web_Services
{
    /// <summary>
    /// This service splits a YouTube music video title into the artist name and the track title.
    /// </summary>
    [WebService(Namespace = "https://soap-web-service-svenbaerten.azurewebsites.net")]
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

        const string WebMethodDescription = @"
        <table>
            <tr>
                <td>Summary:</td><td>Splits a YouTube music video title into the artist name and the track title.</td>
            </tr>
            <tr>
                <td>Expected title:</td><td>artist - track title; the - is essential.</td>
            </tr>
        </table>";
        [WebMethod(Description = WebMethodDescription)] // From MikeM and Ahmed Magdy, see https://stackoverflow.com/questions/6390806/asmx-web-service-documentation
        public YouTubeVideo YouTube2ArtistTrack(string YouTubeVideoTitle)
        {
            // Expected format: Coldplay - A Sky Full Of Stars (Official Video) -> artist = "Coldplay" and track title = "A Sky Full Of Stars"
            // TODO:
            //  * Allow more title formats.
            //  * Extract all artist names.
            if (YouTubeVideoTitle == null || !YouTubeVideoTitle.Contains("-"))
            {
                return new YouTubeVideo("null", "null");
            }

            // Remove (...) and [...]
            string regex = "(\\[.*?\\])|(\".*?\")|('.*?')|(\\(.*?\\))"; // From Kelsey, see https://stackoverflow.com/questions/1359412/remove-text-in-between-delimiters-in-a-string-using-a-regex
            //System.Diagnostics.Debug.WriteLine(YouTubeVideoTitle);
            string filtered = Regex.Replace(YouTubeVideoTitle, regex, "");
            //System.Diagnostics.Debug.WriteLine(filtered);

            // Split to artist and video title
            string[] split = filtered.Split('-');
            string artist = split[0].Trim();
            string track = split[1].Trim();

            // Extra processing
            artist = artist.Split(',')[0]; // x, y -> x

            return new YouTubeVideo(artist, track);
        }
    }
}
