/**
 * @file js/vlibras.js
 *
 * Copyright (c) 2026 OJSBR (https://ojsbr.com)
 * Distributed under the GNU GPL v3. For full terms see the file docs/COPYING.
 *
 * Loads the official VLibras widget once per page. The widget markup is created
 * as a direct child of <body>, as the VLibras documentation places it, so the
 * sidebar's CSS never affects the floating avatar.
 */
(function () {
	'use strict';

	if (window.ojsbrVLibrasLoaded) {
		return;
	}
	window.ojsbrVLibrasLoaded = true;

	var APP_URL = 'https://vlibras.gov.br/app';

	function ensureMarkup() {
		if (document.querySelector('[vw]')) {
			return;
		}
		var vw = document.createElement('div');
		vw.setAttribute('vw', '');
		vw.className = 'enabled';

		var accessButton = document.createElement('div');
		accessButton.setAttribute('vw-access-button', '');
		accessButton.className = 'active';

		var wrapper = document.createElement('div');
		wrapper.setAttribute('vw-plugin-wrapper', '');
		var top = document.createElement('div');
		top.className = 'vw-plugin-top-wrapper';
		wrapper.appendChild(top);

		vw.appendChild(accessButton);
		vw.appendChild(wrapper);
		document.body.appendChild(vw);
	}

	function startWidget() {
		if (window.VLibras && window.VLibras.Widget) {
			new window.VLibras.Widget(APP_URL);
		}
	}

	function init() {
		ensureMarkup();
		if (window.VLibras && window.VLibras.Widget) {
			startWidget();
			return;
		}
		var script = document.createElement('script');
		script.src = APP_URL + '/vlibras-plugin.js';
		script.async = true;
		script.onload = startWidget;
		script.onerror = function () {
			window.ojsbrVLibrasLoaded = false;
		};
		document.body.appendChild(script);
	}

	if (document.readyState === 'loading') {
		document.addEventListener('DOMContentLoaded', init);
	} else {
		init();
	}
})();
