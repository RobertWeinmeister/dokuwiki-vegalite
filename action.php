<?php
/**
 * DokuWiki Plugin VegaLite (Action Component)
 *
 * @license GPL 2 http://www.gnu.org/licenses/gpl-2.0.html
 * @author  Robert Weinmeister <develop@weinmeister.org>
 */

declare(strict_types=1);

if (!defined('DOKU_INC')) {
    die();
}

class action_plugin_vegalite extends \dokuwiki\Extension\ActionPlugin
{
    /** @inheritDoc */
    public function register(Doku_Event_Handler $controller): void {
        $controller->register_hook('TPL_METAHEADER_OUTPUT', 'BEFORE', $this, 'load');
        $controller->register_hook('AJAX_CALL_UNKNOWN', 'BEFORE', $this, 'handleAjaxRequest');
    }

    private function addLocalScript(Doku_Event $event): void {
        $event->data['script'][] = [
            'type'    => 'text/javascript',
            'charset' => 'utf-8',
            'src'     => DOKU_BASE . 'lib/plugins/vegalite/vega.min.js',
        ];

        $event->data['script'][] = [
            'type'    => 'text/javascript',
            'charset' => 'utf-8',
            'src'     => DOKU_BASE . 'lib/plugins/vegalite/vega-lite.min.js',
        ];

        $event->data['script'][] = [
            'type'    => 'text/javascript',
            'charset' => 'utf-8',
            'src'     => DOKU_BASE . 'lib/plugins/vegalite/vega-embed.min.js',
        ];
    }

    private function addScript(Doku_Event $event): void {
        $event->data['script'][] = [
            'type'    => 'text/javascript',
            'charset' => 'utf-8',
            'src'     => "https://cdn.jsdelivr.net/npm/vega/build/vega.min.js",
        ];

        $event->data['script'][] = [
            'type'    => 'text/javascript',
            'charset' => 'utf-8',
            'src'     => "https://cdn.jsdelivr.net/npm/vega-lite/build/vega-lite.min.js",
        ];

        $event->data['script'][] = [
            'type'    => 'text/javascript',
            'charset' => 'utf-8',
            'src'     => "https://cdn.jsdelivr.net/npm/vega-embed/build/vega-embed.min.js",
        ];
    }

    private function pageIncludesVegaLite(): bool {
        // true if the vegalite tag is used
        // the include plugin can hide this fact, so we need a separate check for it
        global $ACT;
        global $TEXT;
        if ('preview'==$ACT) {
            $wikiText = $TEXT;
        } else {
            $wikiText = rawWiki(getID());
        }

        if ('edit'==$ACT) {
            return false;
        }
        if (str_contains($wikiText, '<vegalite') || str_contains($wikiText, '{{page>') || str_contains($wikiText, '{{section>') || str_contains($wikiText, '{{namespace>') || str_contains($wikiText, '{{tagtopic>')) {
            return true;
        }

        return false;
    }

    /**
     * Load the Vega-Lite library and configuration into the page.
     *
     * @param Doku_Event $event DokuWiki event object
     * @param mixed $param Unused parameter.
     */
    public function load(Doku_Event $event, $param): void {
         // only load Vega-Lite if it is needed
        if (!$this->pageIncludesVegaLite()) {
            return;
        }

        $location = $this->getConf('location');
        // add the appropriate Vega-Lite script based on the location configuration
        match ($location) {
            'local' => $this->addLocalScript($event),
            default => $this->addScript($event)
        };

        $event->data['link'][] = [
            'rel'     => 'stylesheet',
            'type'    => 'text/css',
            'href'    => DOKU_BASE . "lib/plugins/vegalite/vegalite.css",
        ];
    }
}
