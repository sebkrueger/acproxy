<?php

/**
 * This file is part of secra/CachingProxy.
 *
 * (c) Sebastian Krüger <krueger@secra.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace secra\CachingProxy\Tests;

// include Testclass
require_once 'JsCachingProxyTestClass.php';

use \secra\CachingProxy\JsCachingProxyTestClass;
/**
 * CachingProxyTest
 *
 * @category test
 * @package de.secra.cachingproxy
 * @author Sebastian Krüger <krueger@secra.de>
 * @copyright 2014 Sebastian Krüger
 * @license http://www.opensource.org/licenses/MIT The MIT License
 */
class JsCachingProxyTest extends \PHPUnit_Framework_TestCase
{
    private $cachingproxy;

    public function setUp()
    {
        // instanciate testclass
        $this->cachingproxy = new JsCachingProxyTestClass();
    }

    /**
     * @test
     * @covers secra\Cachingproxy\JsCachingProxy::__construct()
     */
    public function checkConstructor()
    {
        // See if we get the right Caching Path
        $this->assertEquals("/demo/js/cache/", $this->cachingproxy->getCachepath());

        // See if the extension match
        $this->assertEquals(".js", $this->cachingproxy->getCachefileExtension());
    }

    /**
     * @test
     * @covers secra\Cachingproxy\JsCachingProxy::getIncludeHtml()
     */
    public function getIncludeHtml()
    {
        // See if we get html file
        $testHtml = $this->cachingproxy->getIncludeHtml();

        // First Test nothing to get out
        $this->assertEquals("", $testHtml);

        // Extern Test URL
        $externUrl = "http://www.example.com/test.js";

        //  Style Tag html
        $scriptTagHtml = '<script type="text/javascript" src="'.$externUrl.'"></script>'."\n";

        // Add the extern File to List
        $this->cachingproxy->addFile($externUrl);

        // get the extended scripttag
        $testHtml = $this->cachingproxy->getIncludeHtml();

        $this->assertStringEndsWith("\n", $testHtml);
        $this->assertEquals($scriptTagHtml, $testHtml);
    }
}