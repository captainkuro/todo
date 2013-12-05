/*
Minimal implementation of an Ember Data Adapter to support my backend
*/

DS.MyAdapter = DS.RESTAdapter.extend({

  // called once when app start
  init: function () {
    // TODO
    console.log('init('+Array.prototype.join.call(arguments)+')');
  },

  encode: function (todo) {
    var item = {
      text: todo.get('title'),
      complete: todo.get('isCompleted')
    };
    return item;
  },

  decode: function (raw) {
    if (!raw.id) return;
    return {
      id: raw.id,
      title: raw.text,
      isCompleted: !!parseInt(raw.complete)
    };
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
    var data = this.encode(record);
    return this.ajax(this.buildURL(type), "POST", { data: data });
  },

  // when change isCompleted or rename
  updateRecord: function (store, type, record) {
    // updateRecord(<DS.Store:ember246>,Todos.Todo,<Todos.Todo:ember267:hs2e6>) 
    var data = this.encode(record);
    var id = Ember.get(record, 'id');
    return this.ajax(this.buildURL(type, id), "PUT", { data: data });
  },

  // when delete
  deleteRecord: function (store, type, record) {
    // deleteRecord(<DS.Store:ember246>,Todos.Todo,<Todos.Todo:ember267:hs2e6>)
    var id = Ember.get(record, 'id');

    return this.ajax(this.buildURL(type, id), "DELETE");
  },

  buildURL: function(type, id) {
    var url = this.baseUrl + "/" + this.pluralize(type.typeKey);
    if (id) { url += "/" + id; }
    return url;
  },

  // when findAll reply comes, this method called
  // hardcoded for this Todo
  extractArray: function(store, primaryType, payload) {
    // extractArray(<DS.Store:ember250>,Todos.Todo,[object Object],[object Object],[object Object],,findAll)
    console.log('extractArray('+Array.prototype.join.call(arguments)+')');
    
    var result = [],
      item;
    for (var i in payload) if (payload.hasOwnProperty(i)) {
      item = this.decode(payload[i]);
      result.push(item);
    }
    return result;
  },

  // after 
  extractSingle: function(store, primaryType, payload, recordId, requestType) {
    console.log('extractSingle('+Array.prototype.join.call(arguments)+')');
   
    var item = this.decode(payload);
    return item;
  }
});