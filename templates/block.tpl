{**
 * templates/block.tpl
 *
 * Copyright (c) 2026 OJSBR (https://ojsbr.com.br)
 * Distributed under the GNU GPL v3. For full terms see the file docs/COPYING.
 *
 * VLibras sidebar block: injects the official VLibras widget markup as a direct
 * child of <body> and loads the widget script, so the floating avatar works
 * regardless of the sidebar's CSS context.
 *
 *}
<div class="pkp_block block_vlibras" role="complementary" aria-label="{translate key="plugins.block.vlibras.title"|escape}">
	<h2 class="title">{translate key="plugins.block.vlibras.title"}</h2>
	<div class="content">
		<p class="vlibras-block-text">{translate key="plugins.block.vlibras.text"}</p>
	</div>
</div>

{literal}
<script>
(function () {
	"use strict";
	// Load the VLibras widget only once per page, even if the block is rendered twice.
	if (window.__ojsbrVLibrasLoaded) { return; }
	window.__ojsbrVLibrasLoaded = true;

	var APP_URL = "https://vlibras.gov.br/app";
	var SCRIPT_URL = APP_URL + "/vlibras-plugin.js";

	// Create the official widget markup as a direct child of <body> (mirrors the
	// documented placement before </body>), avoiding sidebar CSS side effects on
	// the fixed-positioned avatar.
	function ensureMarkup() {
		if (document.querySelector("[vw]")) { return; }
		var vw = document.createElement("div");
		vw.setAttribute("vw", "");
		vw.className = "enabled";

		var accessButton = document.createElement("div");
		accessButton.setAttribute("vw-access-button", "");
		accessButton.className = "active";

		var wrapper = document.createElement("div");
		wrapper.setAttribute("vw-plugin-wrapper", "");

		var top = document.createElement("div");
		top.className = "vw-plugin-top-wrapper";

		wrapper.appendChild(top);
		vw.appendChild(accessButton);
		vw.appendChild(wrapper);
		document.body.appendChild(vw);
	}

	function startWidget() {
		try {
			if (window.VLibras && window.VLibras.Widget) {
				new window.VLibras.Widget(APP_URL);
			}
		} catch (e) { /* silent */ }
	}

	function loadScript() {
		if (window.VLibras && window.VLibras.Widget) { startWidget(); return; }
		var s = document.createElement("script");
		s.src = SCRIPT_URL;
		s.async = true;
		s.onload = startWidget;
		s.onerror = function () { window.__ojsbrVLibrasLoaded = false; };
		document.body.appendChild(s);
	}

	function init() {
		ensureMarkup();
		loadScript();
	}

	if (document.readyState === "loading") {
		document.addEventListener("DOMContentLoaded", init, false);
	} else {
		init();
	}
})();
</script>
{/literal}
