var Hapi = require('hapi');

var Todos = require('../todos.js');

// Create a server with a host and port
var server = Hapi.createServer('localhost', 8000);

// Add the route
server.route({
  method: 'GET',
  path: '/todos',
  handler: function (req) {
    Todos.all(function (result) {
      req.reply(result);
    });
  }
});

server.route({
  method: 'POST',
  path: '/todos',
  handler: function (req) {
    Todos.insert(req.payload, function (result) {
      req.reply(result);
    });
  }
});

server.route({
  method: 'PUT',
  path: '/todos/{id}',
  handler: function (req) {
    Todos.update(req.params.id, req.payload, function (result) {
      req.reply(result);
    });
  }
});

server.route({
  method: 'DELETE',
  path: '/todos/{id}',
  handler: function (req) {
    Todos.delete(req.params.id, function (result) {
      req.reply(result);
    });
  }
});

// front end
server.route({
  method: 'GET',
  path: '/front/{path*}',
  handler: {
    directory: {path: '/var/www/todo/front', listing: true, index: true}
  }
});

// Start the server
server.start();