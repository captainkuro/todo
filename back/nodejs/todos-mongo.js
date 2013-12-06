var db = require('./config-mongo.js');
var collection = db.todos;
var ObjectID = require('mongodb').ObjectID;

function docToObj(doc) {
  return {
    id: ''+doc._id,
    text: doc.text,
    complete: doc.complete ? 1 : 0
  };
}

function TodosMongo() {

}

TodosMongo.prototype.all = function (callback) {
  collection.find().toArray(function(err, docs) {
    var result = [];
    for (var i=0,n=docs.length; i<n; ++i) {
      result.push(docToObj(docs[i]));
    }
    callback(result);
  });
};

TodosMongo.prototype.insert = function (obj, callback) {
  var newTodo = {
    complete: false,
    text: obj.text
  };
  collection.insert(newTodo, function(err, docs) {
    callback(docToObj(newTodo));
  });
};

TodosMongo.prototype.update = function (id, obj, callback) {
  collection.findOne({_id: new ObjectID(id)}, function (err, doc) {
    var todo = doc;
    todo.complete = !!obj.complete;
    todo.text = obj.text;
    collection.save(todo, function(err, docs) {
      callback(docToObj(todo));
    });
  });
};

TodosMongo.prototype.delete = function (id, callback) {
  collection.remove({_id: new ObjectID(id)}, function(err, docs) {
    callback({});
  });
};

module.exports = new TodosMongo();