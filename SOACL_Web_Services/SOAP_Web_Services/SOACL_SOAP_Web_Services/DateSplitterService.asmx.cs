using System;
using System.Web.Services;

namespace SOACL_SOAP_Web_Services
{
    /// <summary>
    /// This service splits a date into the year, the month (full and short name) and the day.
    /// </summary>
    [WebService(Namespace = "https://soap-web-service-svenbaerten.azurewebsites.net")]
    [WebServiceBinding(ConformsTo = WsiProfiles.BasicProfile1_1)]
    [System.ComponentModel.ToolboxItem(false)]
    // To allow this Web Service to be called from script, using ASP.NET AJAX, uncomment the following line. 
    // [System.Web.Script.Services.ScriptService]
    public class DateSplitterService : System.Web.Services.WebService
    {
        public class Date
        {
            public int year;
            public int month;
            public string monthNameLong;
            public string monthNameShort;
            public int day;

            public Date()
            {
                year = 0;
                month = 0;
                monthNameLong = "null";
                monthNameShort = "null";
                day = 0;                
            }

            public Date(int year, int month, string monthNameLong, string monthNameShort, int day)
            {                
                this.year = year;
                this.month = month;
                this.monthNameLong = monthNameLong;
                this.monthNameShort = monthNameShort;
                this.day = day;
            }
        }

        const string WebMethodDescription = @"
        <table>
            <tr>
                <td>Summary:</td><td>Splits a date into the year, the month (with name), and the day.</td>
            </tr>
            <tr>
                <td>Expected date:</td><td>Format year-month-day e.g. 1981-12-15. If missing, default values for year, month and day are 0, and for the month name 'null'. </td>
            </tr>
        </table>";
        [WebMethod(Description = WebMethodDescription)] // From MikeM and Ahmed Magdy, see https://stackoverflow.com/questions/6390806/asmx-web-service-documentation
        public Date Date2YearMonthDay(string Date)
        {
            // Error catching
            if (Date == null)
            {
                return new Date(0, 0, "null", "null", 0);
            }

            // Accepted format: "YEAR-MONTH-DAY" e.g. "1981-12-15"
            int[] dateSplitted = Array.ConvertAll(Date.Replace(" ", "").Split('-'), int.Parse);

            int numOfItems = dateSplitted.Length;

            string[] months = {"January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December" };
            string[] monthsShort = { "Jan.", "Feb.", "Mar.", "Apr.", "May", "Jun.", "Jul.", "Aug.", "Sep.", "Oct.", "Nov.", "Dec." };

            int year = 0;
            int month = 0;
            string monthNameLong = "null";
            string monthNameShort = "null";
            int day = 0;

            if (numOfItems == 1)
            {
                year = dateSplitted[0];
            }
            else if (numOfItems == 2)
            {
                year = dateSplitted[0];                
                if (dateSplitted[1] >= 1 && dateSplitted[1] <= 12)
                {
                    month = dateSplitted[1];
                    monthNameLong = months[month - 1];
                    monthNameShort = monthsShort[month - 1];
                }
            }
            else
            {
                year = dateSplitted[0];
                if (dateSplitted[1] >= 1 && dateSplitted[1] <= 12)
                {
                    month = dateSplitted[1];
                    monthNameLong = months[month - 1];
                    monthNameShort = monthsShort[month - 1];
                }
                day = dateSplitted[2];                
            }
            return new Date(year, month, monthNameLong, monthNameShort, day);
        }
    }
}
