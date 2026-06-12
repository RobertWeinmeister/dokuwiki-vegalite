<?php
/**
 * Language settings for the DokuWiki Vega-Lite plugin.
*
* @package DokuWiki\Plugin\VegaLite
*/

declare(strict_types=1);

if (!defined('DOKU_INC')) {
    die();
}

require_once __DIR__ . '/../../conf/config_keys.php';

$lang = [
    // Location settings
    CONFIG_LOCATION => 'Use locally or remotely hosted files?',
    CONFIG_LOCATION . '_o_local' => 'locally hosted',
    CONFIG_LOCATION . '_o_latest' => 'remotely hosted',
];