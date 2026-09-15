<?php

/**
 * @file plugins/blocks/vlibras/tests/VLibrasBlockTest.php
 *
 * Copyright (c) 2026 OJSBR (https://ojsbr.com)
 * Distributed under the GNU GPL v3. For full terms see the file docs/COPYING.
 *
 * @class VLibrasBlockTest
 *
 * @brief The block queues the widget loader and keeps scripts out of its markup.
 */

namespace APP\plugins\blocks\vlibras\tests;

use APP\plugins\blocks\vlibras\VLibrasBlockPlugin;

class VLibrasBlockTest extends TestCase
{
    public function testTheLoaderIsQueuedForReaderPagesOnly(): void
    {
        $plugin = new class () extends VLibrasBlockPlugin {
            public function getPluginPath()
            {
                return 'plugins/blocks/vlibras';
            }

            public function getTemplateResource($template = null, $inCore = false)
            {
                return $template;
            }
        };
        $templateMgr = new class () {
            public array $scripts = [];

            public function addJavaScript($name, $url, $args = [])
            {
                $this->scripts[$name] = [$url, $args];
            }

            public function fetch($resource)
            {
                return $resource;
            }
        };
        $request = new class () {
            public function getBaseUrl()
            {
                return 'https://journal.example.org';
            }
        };

        $this->assertSame('block.tpl', $plugin->getContents($templateMgr, $request));
        $this->assertSame(
            ['vlibrasBlock' => ['https://journal.example.org/plugins/blocks/vlibras/js/vlibras.js', ['contexts' => 'frontend']]],
            $templateMgr->scripts
        );
    }

    public function testTheTemplateHasNoInlineScriptAndEscapesItsText(): void
    {
        $template = (string) file_get_contents(dirname(__DIR__) . '/templates/block.tpl');
        $this->assertFalse(stripos($template, '<script') !== false, 'The template prints a script.');
        $this->assertFalse(strpos($template, '{translate key=') !== false, 'A translation is printed without escaping.');
        $this->assertSame(3, substr_count($template, '|translate|escape}'));
    }

    public function testTheLoaderOnlyTalksToTheOfficialWidget(): void
    {
        $script = (string) preg_replace('#/\*.*?\*/#s', '', (string) file_get_contents(dirname(__DIR__) . '/js/vlibras.js'));
        preg_match_all('#https?://[^\'"\s]+#', $script, $m);
        $this->assertSame(['https://vlibras.gov.br/app'], array_values(array_unique($m[0])));
        $this->assertTrue(strpos($script, 'window.ojsbrVLibrasLoaded') !== false, 'The loader has no once-per-page guard.');
    }
}
