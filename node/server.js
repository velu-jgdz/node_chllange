
const express = require('express');
const mysqlConnection = require('./connection');
const bodyPraser = require('body-parser');

const PeopleRoute = require('./routes/people');

var app = express();

app.use(bodyPraser.json());

app.use("/people", PeopleRoute);


app.listen(3000);