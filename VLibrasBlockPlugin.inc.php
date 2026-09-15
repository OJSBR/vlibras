<?php

/**
 * @file VLibrasBlockPlugin.inc.php
 *
 * Copyright (c) 2026 OJSBR (https://ojsbr.com)
 * Distributed under the GNU GPL v3. For full terms see the file docs/COPYING.
 *
 * @class VLibrasBlockPlugin
 * @ingroup plugins_blocks_vlibras
 *
 * @brief Sidebar block that embeds the VLibras widget (Brazilian Sign Language
 *  translator by the Brazilian federal government).
 */

import('lib.pkp.classes.plugins.BlockPlugin');

class VLibrasBlockPlugin extends BlockPlugin {
	/**
	 * @copydoc BlockPlugin::getContents()
	 *
	 * Blocks are loaded while the sidebar is rendered, after the page head, so
	 * the widget loader is queued here (scripts are printed at the end of the page).
	 */
	function getContents($templateMgr, $request = null) {
		if (!$request) {
			$request = Application::get()->getRequest();
		}
		$templateMgr->addJavaScript(
			'vlibrasBlock',
			$request->getBaseUrl() . '/' . $this->getPluginPath() . '/js/vlibras.js',
			['contexts' => 'frontend']
		);

		return parent::getContents($templateMgr, $request);
	}

	/**
	 * Install default settings on journal creation.
	 * @return string
	 */
	function getContextSpecificPluginSettingsFile() {
		return $this->getPluginPath() . '/settings.xml';
	}

	/**
	 * Get the display name of this plugin.
	 * @return string
	 */
	function getDisplayName() {
		return __('plugins.block.vlibras.displayName');
	}

	/**
	 * Get a description of the plugin.
	 * @return string
	 */
	function getDescription() {
		return __('plugins.block.vlibras.description');
	}
}
