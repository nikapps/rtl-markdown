<?php
namespace Nikapps\RtlMarkDown\Renderer;

use League\CommonMark\Block\Element\AbstractBlock;
use League\CommonMark\Block\Renderer\HeadingRenderer as LeagueHeadingRenderer;
use League\CommonMark\ElementRendererInterface;
use Nikapps\RtlMarkDown\RtlDetector;

class HeadingRenderer extends LeagueHeadingRenderer
{
    /**
     * @var RtlDetector
     */
    private $rtlDetector;

    /**
     * HeadingRenderer constructor.
     * @param RtlDetector $rtlDetector
     */
    public function __construct(RtlDetector $rtlDetector)
    {
        $this->rtlDetector = $rtlDetector;
    }

    public function render(AbstractBlock $block, ElementRendererInterface $htmlRenderer, $inTightList = false)
    {
        $html = parent::render($block, $htmlRenderer, $inTightList);
        $direction = $this->rtlDetector->isRtl($html->getContents(true)) ? 'rtl' : 'ltr';

        return $html->setAttribute('dir', $direction);
    }
}