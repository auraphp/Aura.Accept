<?php
namespace Aura\Accept;

class AcceptTest extends \PHPUnit_Framework_TestCase
{
    public function test()
    {
        $factory = new AcceptFactory(array());
        $accept = $factory->newInstance();
        $this->assertInstanceOf('Aura\Accept\Charset\CharsetNegotiator', $accept->charset);
        $this->assertInstanceOf('Aura\Accept\Encoding\EncodingNegotiator', $accept->encoding);
        $this->assertInstanceOf('Aura\Accept\Language\LanguageNegotiator', $accept->language);
        $this->assertInstanceOf('Aura\Accept\Media\MediaNegotiator', $accept->media);
    }
}
