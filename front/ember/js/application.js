window.Todos = Ember.Application.create();

// Todos.ApplicationAdapter = DS.FixtureAdapter.extend();
// Todos.ApplicationAdapter = DS.LSAdapter.extend({
// 	namespace: 'todos-emberjs'
// });
Todos.ApplicationAdapter = DS.MyAdapter.extend({
	baseUrl: '/todo/back/php'
});
