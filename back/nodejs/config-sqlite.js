var sqlite3 = require('sqlite3').verbose();
var db = new sqlite3.Database('/var/www/todo/back/database/todos.db');

module.exports = db;