<?php
namespace Nikapps\RtlMarkDown\Renderer;

use League\CommonMark\Block\Element\AbstractBlock;
use League\CommonMark\Block\Renderer\HeadingRenderer;
use League\CommonMark\ElementRendererInterface;

class Heading extends HeadingRenderer
{
    public function render(AbstractBlock $block, ElementRendererInterface $htmlRenderer, $inTightList = false)
    {
        $html = parent::render($block, $htmlRenderer, $inTightList);

        return $html->setAttribute('dir', 'rtl');
    }

}