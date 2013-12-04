var express = require('express');
var app = express();

var Todos = require('../todos.js');

app.use(express.bodyParser());

app.get('/todos', function(req, res) {
  Todos.all(function (result) {
    res.json(result);
  });
});

app.post('/todos', function(req, res) {
  Todos.insert(req.body, function (result) {
    res.json(result);
  });
});

app.put('/todos/:id', function(req, res) {
  Todos.update(req.params.id, req.body, function (result) {
    res.json(result);
  });
});

app.delete('/todos/:id', function(req, res) {
  Todos.delete(req.params.id, function (result) {
    res.json(result);
  });
});

// app.configure(function () {
  app.use('/front/', express.static(__dirname + '/../../../front'));
  app.use('/front/', express.directory(__dirname + '/../../../front'));
// });

app.listen(process.env.PORT || 8002);