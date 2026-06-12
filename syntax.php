<?php

/**
 * DokuWiki Plugin VegaLite (Syntax Component)
 *
 * @license GPL 2 http://www.gnu.org/licenses/gpl-2.0.html
 * @author  Robert Weinmeister <develop@weinmeister.org>
 */

declare(strict_types=1);

if (!defined('DOKU_INC'))
{
    die();
}

use dokuwiki\Parsing\Parser;

class syntax_plugin_vegalite extends \dokuwiki\Extension\SyntaxPlugin
{
    /** @inheritDoc */
    function getType(): string {
        return 'container';
    }

    /** @inheritDoc */
    function getSort(): int {
        return 150;
    }

    /**
    * Entry pattern for Vega-Lite
    *
    * @param string $mode Parser mode
    * @return void
    */
    public function connectTo($mode): void {
        $this->Lexer->addEntryPattern(
            '<vegalite.*?>(?=.*?</vegalite>)',
            $mode,
            'plugin_vegalite');
    }

    /**
     * Exit pattern for Vega-Lite
     *
     * @return void
     */
    function postConnect(): void {
        $this->Lexer->addExitPattern(
            '</vegalite>',
            'plugin_vegalite'
        );
    }

    /**
     * Handles the matched text based on the lexer state
     *
     * @param string $match Matched text from the lexer
     * @param int $state Current lexer state (DOKU_LEXER_ENTER, DOKU_LEXER_UNMATCHED, DOKU_LEXER_EXIT)
     * @param Doku_Handler $handler DokuWiki handler instance
     * @return array Array with the state and processed match
     */
    function handle($match, $state, $pos, Doku_Handler $handler): array {
        return [$state, $match];
    }

    /**
    * Render xhtml output or metadata
    */
    function render($mode, Doku_Renderer $renderer, $indata)
    {
        if($mode == 'xhtml'){
            list($state, $match) = $indata;
            switch ($state) {
                case DOKU_LEXER_ENTER:
                    $values = explode(" ", $match);
                    $divwidth = count($values) < 2 ? 'auto' : $values[1];
                    $divheight = count($values) < 3 ? 'auto' : substr($values[2], 0, -1);

                    $this->vegaliteContent .= '<div id="vegalite" class="vegalite" style="position: relative; width:'.$divwidth.'; height:'.$divheight.'"></div>' . "\r\n";
                break;
                case DOKU_LEXER_UNMATCHED:
                    $this->vegaliteContent .=
'<script type="text/javascript">
    var yourVlSpec = ' . $match . ";
    vegaEmbed('#vegalite', yourVlSpec);
</script>";
                break;
                case DOKU_LEXER_EXIT:
                    $this->vegaliteContent .= "";
                    
                    $renderer->doc .= $this->vegaliteContent;
                    $this->vegaliteContent = '';
                break;
            }
            return true;
        }
        return false;
    }
}