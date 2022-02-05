<?php
namespace Aura\Accept;

use PHPUnit\Framework\TestCase;

class AcceptTest extends TestCase
{
    protected function setup(): void
    {
        $factory = new AcceptFactory(array(
            'HTTP_ACCEPT' => 'application/json, application/xml, text/*, */*',
            'HTTP_ACCEPT_CHARSET' => 'iso-8859-5, unicode-1-1;q=0.8',
            'HTTP_ACCEPT_ENCODING' => 'compress;q=0.5, gzip;q=1.0',
            'HTTP_ACCEPT_LANGUAGE' => 'en-US, en-GB, en, *',
        ));
        $this->accept = $factory->newInstance();
    }

    public function testNegotiateCharset()
    {
        $actual = $this->accept->negotiateCharset(array('unicode-1-1'));
        $expect = 'unicode-1-1';
        $this->assertSame($expect, $actual->getValue());
    }

    public function testNegotiateEncoding()
    {
        $actual = $this->accept->negotiateEncoding(array());
        $this->assertFalse($actual);
    }

    public function testNegotiateLanguage()
    {
        $actual = $this->accept->negotiateLanguage(array('pt-BR', 'fr-FR'));
        $expect = 'pt-BR';
        $this->assertSame($expect, $actual->getValue());
    }

    public function testNegotiateMedia()
    {
        $actual = $this->accept->negotiateMedia(array(
            'application/xml',
            'application/json',
        ));
        $expect = 'application/json';
        $this->assertSame($expect, $actual->getValue());
    }

    public function testIssue8()
    {
        $factory = new AcceptFactory(array(
            'HTTP_ACCEPT' => 'application/xml;q=1.0,text/csv;q=0.5,*;q=0.1',
        ));
        $accept = $factory->newInstance();
        $actual = $accept->negotiateMedia(array(
            'application/json',
            'text/csv',
        ));
        $expect = 'text/csv';
        $this->assertSame($expect, $actual->getValue());
    }
}
