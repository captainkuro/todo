var db = require('./config-sqlite.js');

function TodosSqlite() {

}

function get(id, callback) {
  db.get('SELECT * FROM todos WHERE id = ?', id, function (err, row) {
    callback(row);
  });
}

TodosSqlite.prototype.all = function (callback) {
  db.all('SELECT * FROM todos ORDER BY id ASC', function (err, rows) {
    callback(rows);
  });
};

TodosSqlite.prototype.insert = function (obj, callback) {
  db.run('INSERT INTO todos (`complete`, `text`) VALUES (0, ?)', [obj.text], function (err) {
    if (err === null) {
      get(this.lastID, callback);
    }
  });
};

TodosSqlite.prototype.update = function (id, obj, callback) {
  db.run('UPDATE todos SET complete = ?, `text` = ? WHERE id = ?', [obj.complete, obj.text, id], function (err) {
    if (err === null) {
      get(id, callback);
    }
  });
};

TodosSqlite.prototype.delete = function (id, callback) {
  db.run('DELETE FROM todos WHERE id = ?', [id], function (err) {
    if (err === null) {
      callback({});
    }
  });
};

module.exports = new TodosSqlite();