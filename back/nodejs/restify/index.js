var restify = require('restify');

var Todos = require('../todos.js');

var server = restify.createServer();
server.use(restify.bodyParser({ mapParams: false }));

server.get('/todos', function (req, res, next) {
  Todos.all(function (result) {
    res.json(result);
  });
});

server.post('/todos', function (req, res, next) {
  Todos.insert(req.body, function (result) {
    res.json(result);
  });
});

server.put('/todos/:id', function (req, res, next) {
  Todos.update(req.params.id, req.body, function (result) {
    res.json(result);
  });
});

server.del('/todos/:id', function (req, res, next) {
  Todos.delete(req.params.id, function (result) {
    res.json(result);
  });
});

server.get(/\/front\/?.*/, restify.serveStatic({
  directory: '/var/www/todo'
}));

server.listen(8001, function() {
  console.log('%s listening at %s', server.name, server.url);
});