<?php
namespace Nikapps\RtlMarkDown\Tests;

use Nikapps\RtlMarkDown\RtlMarkDown;

class HeadingTest extends \PHPUnit_Framework_TestCase
{
    public function test_heading_should_be_rtl_for_rtl_languages()
    {
        $markdown = new RtlMarkDown();

        $actual = $markdown->html("### عنوان");
        $expected = '<h3 dir="rtl">عنوان</h3>' . "\n";

        $this->assertEquals($expected, $actual);
    }

    public function test_heading_should_be_ltr_for_ltr_languages() {
        $markdown = new RtlMarkDown();

        $actual = $markdown->html("### subject");
        $expected = '<h3 dir="ltr">subject</h3>' . "\n";

        $this->assertEquals($expected, $actual);
    }

    public function test_heading_should_be_rtl_when_at_least_30_percent_of_all_characters_are_rtl() {
        $markdown = new RtlMarkDown();

        $actual = $markdown->html("#### سلام Laravel!");
        $expected = '<h4 dir="rtl">سلام Laravel!</h4>' . "\n";

        $this->assertEquals($expected, $actual);
    }
}
