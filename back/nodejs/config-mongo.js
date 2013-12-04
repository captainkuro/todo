var databaseUrl = "todos"; // "username:password@example.com/mydb"
var collections = ["todos"];
var db = require("mongojs").connect(databaseUrl, collections);
module.exports = db;