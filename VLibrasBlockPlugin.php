<?php

/**
 * @file VLibrasBlockPlugin.php
 *
 * Copyright (c) 2026 OJSBR (https://ojsbr.com.br)
 * Distributed under the GNU GPL v3. For full terms see the file docs/COPYING.
 *
 * @class VLibrasBlockPlugin
 *
 * @brief Sidebar block that embeds the VLibras widget (Brazilian Sign Language
 *  translator by the Brazilian federal government).
 */

namespace APP\plugins\blocks\vlibras;

use PKP\plugins\BlockPlugin;

class VLibrasBlockPlugin extends BlockPlugin
{
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
