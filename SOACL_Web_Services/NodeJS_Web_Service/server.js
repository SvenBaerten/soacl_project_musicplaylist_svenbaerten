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
  res.json(dateSplitter(req.params.date));
});


/**
 * Split a date into the year, month (also long and short names) and day.
 * @param {*} date The date we want to split. Valid formats: '2019', '2019-1' and '2019-1-20.
 */
function dateSplitter(date) {
    var dateSplitted = date.split('-');
    var numOfItems = dateSplitted.length;
   
    var months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
    var monthsShort = ["Jan.", "Feb.", "Mar.", "Apr.", "May", "Jun.", "Jul.", "Aug.", "Sep.", "Oct.", "Nov.", "Dec."]

    var year = 0;
    var day = 0;
    var month = 0;
    var monthNameLong = 'null';
    var monthNameShort = 'null';

    if (numOfItems == 1) {
        year = dateSplitted[0];
    }
    else if (numOfItems == 2) {
        year = dateSplitted[0];
        month = dateSplitted[1];
        monthNameLong = months[parseInt(month)-1];
        monthNameShort = monthsShort[parseInt(month)-1];
    }
    else {
        year = dateSplitted[0];
        month = dateSplitted[1];
        monthNameLong = months[parseInt(month)-1];
        monthNameShort = monthsShort[parseInt(month)-1];
        day = dateSplitted[2];
    }

    // Same return as already impelemented soap service 'DateSplitterService.asmx -> Date2YearMonthDay':
    // <year>2013</year>
    // <month>3</month>
    // <monthNameLong>March</monthNameLong>
    // <monthNameShort>Mar.</monthNameShort>
    // <day>4</day>

    return {'year':year, 'month':month, 'monthNameLong':monthNameLong, 'monthNameShort':monthNameShort, 'day':day};
}

app.listen(PORT, HOST);
console.log(`Running on http://${HOST}:${PORT}`);