<?php

/**
 * @file VLibrasBlockPlugin.php
 *
 * Copyright (c) 2026 OJSBR (https://ojsbr.com)
 * Distributed under the GNU GPL v3. For full terms see the file docs/COPYING.
 *
 * @class VLibrasBlockPlugin
 *
 * @brief Sidebar block that embeds the VLibras widget (Brazilian Sign Language
 *  translator by the Brazilian federal government).
 */

namespace APP\plugins\blocks\vlibras;

use APP\core\Application;
use PKP\plugins\BlockPlugin;

class VLibrasBlockPlugin extends BlockPlugin
{
    /**
     * @copydoc BlockPlugin::getContents()
     *
     * Blocks are loaded while the sidebar is rendered, after the page head, so
     * the widget loader is queued here (scripts are printed at the end of the page).
     *
     * @param null|mixed $request
     */
    public function getContents($templateMgr, $request = null)
    {
        $request ??= Application::get()->getRequest();
        $templateMgr->addJavaScript(
            'vlibrasBlock',
            $request->getBaseUrl() . '/' . $this->getPluginPath() . '/js/vlibras.js',
            ['contexts' => 'frontend']
        );

        return parent::getContents($templateMgr, $request);
    }

    /**
     * Install default settings on journal creation.
     *
     * @return string
     */
    public function getContextSpecificPluginSettingsFile()
    {
        return $this->getPluginPath() . '/settings.xml';
    }

    /**
     * Get the display name of this plugin.
     *
     * @return string
     */
    public function getDisplayName()
    {
        return __('plugins.block.vlibras.displayName');
    }

    /**
     * Get a description of the plugin.
     *
     * @return string
     */
    public function getDescription()
    {
        return __('plugins.block.vlibras.description');
    }
}

if (!PKP_STRICT_MODE) {
    class_alias('\APP\plugins\blocks\vlibras\VLibrasBlockPlugin', '\VLibrasBlockPlugin');
}
