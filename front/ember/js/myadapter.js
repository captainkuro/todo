/*
Minimal implementation of an Ember Data Adapter to support my backend
*/

DS.MyAdapter = DS.RESTAdapter.extend({

  // called once when app start
  init: function () {
    // TODO
    console.log('init('+Array.prototype.join.call(arguments)+')');
  },

  // called once when app start
  findAll: function (store, type) {
    // TODO
    console.log('findAll('+Array.prototype.join.call(arguments)+')');
    return this.ajax(this.buildURL(type), 'GET');
  },

  // when creating new todo
  createRecord: function (store, type, record) {
    // createRecord(<DS.Store:ember246>,Todos.Todo,<Todos.Todo:ember405:baq58>)
    var data = this.serializerFor(type.typeKey).serialize(record, { includeId: true });

    return this.ajax(this.buildURL(type), "POST", { data: data });
  },

  // when change isCompleted or rename
  updateRecord: function (store, type, record) {
    // updateRecord(<DS.Store:ember246>,Todos.Todo,<Todos.Todo:ember267:hs2e6>) 
    var data = this.serializerFor(type.typeKey).serialize(record);
    var id = get(record, 'id');

    return this.ajax(this.buildURL(type, id), "PUT", { data: data });
  },

  // when delete
  deleteRecord: function (store, type, record) {
    // deleteRecord(<DS.Store:ember246>,Todos.Todo,<Todos.Todo:ember267:hs2e6>)
    var id = get(record, 'id');

    return this.ajax(this.buildURL(type, id), "DELETE");
  },

  buildURL: function(type, id) {
    var url = this.baseUrl + "/" + this.pluralize(type.typeKey);
    if (id) { url += "/" + id; }
    console.log(url);
    return url;
  },
});