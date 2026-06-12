<?php
/**
 * Default configuration for the DokuWiki Vega-Lite plugin.
 *
 * @package DokuWiki\Plugin\VegaLite
 */

declare(strict_types=1);

if (!defined('DOKU_INC')) {
    die();
}

require_once __DIR__ . '/config_keys.php';

$conf = [
    CONFIG_LOCATION  => 'latest'
];