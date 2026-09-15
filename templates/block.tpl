{**
 * templates/block.tpl
 *
 * Copyright (c) 2026 OJSBR (https://ojsbr.com)
 * Distributed under the GNU GPL v3. For full terms see the file docs/COPYING.
 *
 * VLibras sidebar block. The widget itself is loaded by js/vlibras.js, queued
 * by the plugin and printed at the end of the page.
 *}
<div class="pkp_block block_vlibras" role="complementary" aria-label="{"plugins.block.vlibras.title"|translate|escape}">
	<h2 class="title">{"plugins.block.vlibras.title"|translate|escape}</h2>
	<div class="content">
		<p class="vlibras-block-text">{"plugins.block.vlibras.text"|translate|escape}</p>
	</div>
</div>
