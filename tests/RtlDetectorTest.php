<?php
namespace Nikapps\RtlMarkDown\Tests;

use Nikapps\RtlMarkDown\RtlDetector;

class RtlDetectorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var RtlDetector
     */
    protected $rtlDetector;

    protected function setUp()
    {
        parent::setUp();

        $this->rtlDetector = new RtlDetector();
    }


    public function test_should_detect_rtl_text_when_all_of_them_are_rtl()
    {
        $text = 'متن راست به چپ';

        $this->assertTrue($this->rtlDetector->isRtl($text));
    }

    public function test_should_detect_ltr_text_when_all_of_them_are_ltr()
    {
        $text = 'left to right text';

        $this->assertFalse($this->rtlDetector->isRtl($text));
    }

    public function test_ignore_not_letter_characters()
    {
        $text = 'یک + یک = دو';

        $this->assertTrue($this->rtlDetector->isRtl($text));
    }

    public function test_should_detect_rtl_when_at_least_30_percent_of_characters_are_rtl()
    {
        $text = 'Hello به فارسی می‌شود سلام یا درود!';

        $this->assertTrue($this->rtlDetector->isRtl($text));
    }
}
