<?php
namespace phpjs\tests\url;

use phpjs\urls\URLSearchParams;
use PHPUnit_Framework_TestCase;

/**
 * @see https://github.com/w3c/web-platform-tests/blob/master/url/urlsearchparams-has.html
 */
class URLSearchParamsHasTest extends PHPUnit_Framework_TestCase
{
    public function testHasBasics()
    {
        $params = new URLSearchParams('a=b&c=d');
        $this->assertTrue($params->has('a'));
        $this->assertTrue($params->has('c'));
        $this->assertFalse($params->has('e'));
        $params = new URLSearchParams('a=b&c=d&a=e');
        $this->assertTrue($params->has('a'));
        $params = new URLSearchParams('=b&c=d');
        $this->assertTrue($params->has(''));
        $params = new URLSearchParams('null=a');
        $this->assertTrue($params->has(null));
    }

    public function testHasFollowingDelete()
    {
        $params = new URLSearchParams('a=b&c=d&&');
        $params->append('first', 1);
        $params->append('first', 2);
        $this->assertTrue($params->has('a'));
        $this->assertTrue($params->has('c'));
        $this->assertTrue($params->has('first'));
        $this->assertFalse($params->has('d'));
        $params->delete('first');
        $this->assertFalse($params->has('first'));
    }
}
