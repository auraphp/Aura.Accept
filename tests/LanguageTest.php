<?php
namespace Aura\Accept;

class LanguageTest extends AcceptTestCase
{
    protected function newLanguage($server = array())
    {
        return new Language\LanguageNegotiator(new ValueFactory, $server);
    }

    /**
     * @dataProvider languageProvider
     * @param $accept
     * @param $expect
     * @param $negotiator_class
     * @param $value_class
     */
    public function testGetLanguage($server, $expect, $negotiator_class, $value_class)
    {
        $language = $this->newLanguage($server);
        $this->assertAcceptValues($language, $expect, $negotiator_class, $value_class);
    }

    /**
     * @dataProvider languageNegotiateProvider
     * @param $accept
     * @param $available
     * @param $expected
     */
    public function testGetLanguage_negotiate($server, $available, $expected)
    {
        $language = $this->newLanguage($server);
        $actual = $language->negotiate($available);

        if ($expected === false) {
            $this->assertFalse($actual);
        } else {
            $this->assertInstanceOf('Aura\Accept\Language\LanguageValue', $actual->available);
            $this->assertSame($expected, $actual->available->getValue());
        }
    }

    public function languageProvider()
    {
        return array(
            array(
                'server' => array(),
                'expect' => array(),
                'negotiator_class' => 'Aura\Accept\Language\LanguageNegotiator',
                'value_class' => 'Aura\Accept\Language\LanguageValue',
            ),
            array(
                'server' => array(
                    'HTTP_ACCEPT_LANGUAGE' => '*',
                ),
                'expect' => array(
                    array('type' => '*', 'subtype' => false, 'value' => '*',  'quality' => 1.0, 'parameters' => array())
                ),
                'negotiator_class' => 'Aura\Accept\Language\LanguageNegotiator',
                'value_class' => 'Aura\Accept\Language\LanguageValue',
            ),
            array(
                'server' => array(
                    'HTTP_ACCEPT_LANGUAGE' => 'en-US, en-GB, en, *',
                ),
                'expect' => array(
                    array('type' => 'en', 'subtype' => 'US', 'value' => 'en-US', 'quality' => 1.0, 'parameters' => array()),
                    array('type' => 'en', 'subtype' => 'GB', 'value' => 'en-GB', 'quality' => 1.0, 'parameters' => array()),
                    array('type' => 'en', 'subtype' => false, 'value' => 'en', 'quality' => 1.0, 'parameters' => array()),
                    array('type' => '*', 'subtype' => false, 'value' => '*',  'quality' => 1.0, 'parameters' => array())
                ),
                'negotiator_class' => 'Aura\Accept\Language\LanguageNegotiator',
                'value_class' => 'Aura\Accept\Language\LanguageValue',
            ),
        );
    }

    public function languageNegotiateProvider()
    {
        return array(
            array(
                'server' => array('HTTP_ACCEPT_LANGUAGE' => 'en-US, en-GB, en, *'),
                'available' => array(),
                'expected' => false,
            ),
            array(
                'server' => array('HTTP_ACCEPT_LANGUAGE' => 'en-US, en-GB, en, *'),
                'available' => array('foo-bar' , 'baz-dib'),
                'expected' => 'foo-bar',
            ),
            array(
                'server' => array('HTTP_ACCEPT_LANGUAGE' => 'en-US, en-GB, en, *'),
                'available' => array('en-gb', 'fr-FR'),
                'expected' => 'en-gb',
            ),
            array(
                'server' => array('HTTP_ACCEPT_LANGUAGE' => 'en-US, en-GB, en, *'),
                'available' => array('foo-bar', 'en-zo', 'baz-qux'),
                'expected' => 'en-zo',
            ),
            array(
                'server' => array(),
                'available' => array('en-us', 'en-gb'),
                'expected' => 'en-us',
            ),
            array(
                'server' => array('HTTP_ACCEPT_LANGUAGE' => 'en-us, en-gb, en, foo-bar;q=0'),
                'available' => array('foo-bar'),
                'expected' => false
            ),
            array(
                'server' => array('HTTP_ACCEPT_LANGUAGE' => 'en-us, en-gb, en, foo-bar;q=0'),
                'available' => array('*'),
                'expected' => '*'
            ),
            array(
                'server' => array('HTTP_ACCEPT_LANGUAGE' => '[{"type":"m","data":{"useragent":"Mozilla/5.0 (Linux; U; Android 4.2.1; ru-ru; KENEKSI-SIGMA Build/KENEKSISIGMA) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Mobile Safari/534.30","width":"540","height":"960","appversion":"5.0 (Linux; U; Android 4.2.1; ru-ru; KENEKSI-SIGMA Build/KENEKSISIGMA) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Mobile Safari/534.30","platform":"Linux armv7l","oscpu":""}},{"type":"t","data":{"useragent":"Mozilla/5.0 (Linux; Android 4.2.2; ru-ru; SAMSUNG SCH-I545 Build/JDQ39) AppleWebKit/535.19 (KHTML, like Gecko) Version/1.0 Chrome/18.0.1025.308 Mobile Safari/535.19","width":"1080","height":"1920","appversion":"5.0 (Linux; Android 4.2.2; ru-ru; SAMSUNG SCH-I545 Build/JDQ39) AppleWebKit/535.19 (KHTML, like Gecko) Version/1.0 Chrome/18.0.1025.308 Mobile Safari/535.19","platform":"Linux armv7l","oscpu":""}}]'),
                'available' => array('*'),
                'expected' => '*'
            ),
        );
    }
}
