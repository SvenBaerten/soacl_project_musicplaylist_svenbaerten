// Code based on https://nodejs.org/de/docs/guides/nodejs-docker-webapp/

'use strict';

var express = require('express'); // https://expressjs.com/
var cors = require('cors');       // https://expressjs.com/en/resources/middleware/cors.html
var path = require('path');

// Constants
const PORT = 80;
const HOST = '0.0.0.0';

// App
var app = express();
app.use(cors());

app.get('/', (req, res) => {
    res.sendFile(path.join(__dirname+'/index.html'));
});

app.get('/api/dateSplitter/:date', (req, res) => {
    console.log(req.params.date);
    res.json(dateSplitter(req.params.date));
});


/**
 * Split a date into the year, the month (also long and short names) and the day.
 * 
 * @param {string} date The date we want to split. The format must be YEAR-MONTH-DAY e.g. '2019-1-20' or '2019-1' or '2019'.
 */
function dateSplitter(date) {
    if (date == "") return {'year':0, 'month':0, 'monthNameLong':'null', 'monthNameShort':'null', 'day':0};

    var dateSplitted = date.split('-');
    var numOfItems = dateSplitted.length;
   
    var months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
    var monthsShort = ["Jan.", "Feb.", "Mar.", "Apr.", "May", "Jun.", "Jul.", "Aug.", "Sep.", "Oct.", "Nov.", "Dec."]

    var year = 0;
    var day = 0;
    var month = 0;
    var monthNameLong = 'null';
    var monthNameShort = 'null';

    if (numOfItems >= 1) year = dateSplitted[0];
    if (numOfItems >= 2) {
        if (dateSplitted[1] >= 1 && dateSplitted[1] <= 12) {
            month = dateSplitted[1];
            monthNameLong = months[parseInt(month)-1];
            monthNameShort = monthsShort[parseInt(month)-1];
        }
    }
    if (numOfItems == 3) day = dateSplitted[2];

    // Same return as already impelemented soap service 'DateSplitterService.asmx -> Date2YearMonthDay':
    // <year>2013</year>
    // <month>3</month>
    // <monthNameLong>March</monthNameLong>
    // <monthNameShort>Mar.</monthNameShort>
    // <day>4</day>

    return {'year':parseInt(year), 'month':parseInt(month), 'monthNameLong':monthNameLong, 'monthNameShort':monthNameShort, 'day':parseInt(day)};
}

app.listen(PORT, HOST);
console.log(`Running on http://${HOST}:${PORT}`);