<?php
namespace Nikapps\RtlMarkDown;

use League\CommonMark\Block\Element\Heading;
use League\CommonMark\CommonMarkConverter;
use League\CommonMark\Environment;
use Nikapps\RtlMarkDown\Renderer\HeadingRenderer;

class RtlMarkDown
{
    /**
     * @var RtlDetector
     */
    private $rtlDetector;
    /**
     * @var CommonMarkConverter
     */
    private $commonMark;

    /**
     * RtlMarkDown constructor.
     * @param CommonMarkConverter $commonMark
     * @param RtlDetector $rtlDetector
     */
    public function __construct(CommonMarkConverter $commonMark = null, RtlDetector $rtlDetector = null)
    {
        if (is_null($rtlDetector)) {
            $this->rtlDetector = new RtlDetector();
        }

        if (is_null($commonMark)) {
            $commonMark = new CommonMarkConverter([], $this->configureEnvironment());
        }

        $this->commonMark = $commonMark;
    }

    public function html($markdown)
    {
        return $this->commonMark->convertToHtml($markdown);
    }

    protected function configureEnvironment()
    {
        $environment = Environment::createCommonMarkEnvironment();
        $environment->addBlockRenderer(
            Heading::class, new HeadingRenderer($this->rtlDetector)
        );

        return $environment;
    }


}