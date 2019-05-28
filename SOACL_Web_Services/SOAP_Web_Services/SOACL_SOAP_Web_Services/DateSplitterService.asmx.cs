using System;
using System.Web.Services;

namespace SOACL_SOAP_Web_Services
{
    /// <summary>
    /// This service splits a date into a year, a month (full and short name) and a day.
    /// </summary>
    [WebService(Namespace = "http://tempuri.org/")]
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
                monthNameLong = "January";
                monthNameShort = "Jan.";
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

        [WebMethod]
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

            if (numOfItems == 1)
            {
                int year = dateSplitted[0];
                return new Date(year, 0, "null", "null", 0);
            }
            else if (numOfItems == 2)
            {
                int year = dateSplitted[0];
                int month = dateSplitted[1];
                string monthNameLong = months[month-1];
                string monthNameShort = monthsShort[month-1];           
                return new Date(year, month, monthNameLong, monthNameShort, 0);
            }
            else
            {
                int year = dateSplitted[0];
                int month = dateSplitted[1];
                string monthNameLong = months[month-1];
                string monthNameShort = monthsShort[month-1];
                int day = dateSplitted[2];
                return new Date(year, month, monthNameLong, monthNameShort, day);
            }
        }
    }
}
