(function () {
	'use strict';

	var byId = function (id) { return document.getElementById(id); },

	loadScripts = function (desc, callback) {
		var deps = [], key, idx = 0;

		for (key in desc) {
			deps.push(key);
		}

		(function _next() {
			var pid,
				name = deps[idx],
				script = document.createElement('script');

			script.type = 'text/javascript';
			script.src = desc[deps[idx]];

			pid = setInterval(function () {
				if (window[name]) {
					clearTimeout(pid);

					deps[idx++] = window[name];

					if (deps[idx]) {
						_next();
					} else {
						callback.apply(null, deps);
					}
				}
			}, 30);

			document.getElementsByTagName('head')[0].appendChild(script);
		})()
	},
	console = window.console;
})();