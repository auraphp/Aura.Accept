<?php
/**
 *
 * This file is part of Aura for PHP.
 *
 * @package Aura.Accept
 *
 * @license http://opensource.org/licenses/bsd-license.php BSD
 *
 */
namespace Aura\Accept;

/**
 *
 * A factory to create an Accept objects.
 *
 * @package Aura.Accept
 *
 */
class AcceptFactory
{
    public function __construct(array $server = array(), array $types = array())
    {
        $this->server = $server;
        $this->types = $types;
        $this->value_factory = new ValueFactory;
    }

    /**
     *
     * Returns an Accept object with all negotiators.
     *
     * @return Request\Accept
     *
     */
    public function newInstance()
    {
        return new Accept(
            $this->newCharset(),
            $this->newEncoding(),
            $this->newLanguage(),
            $this->newMedia()
        );
    }

    public function newCharset()
    {
        return new Charset\CharsetNegotiator($this->value_factory, $this->server);
    }

    public function newEncoding()
    {
        return new Encoding\EncodingNegotiator($this->value_factory, $this->server);
    }

    public function newLanguage()
    {
        return new Language\LanguageNegotiator($this->value_factory, $this->server);
    }

    public function newMedia()
    {
        return new Media\MediaNegotiator($this->value_factory, $this->server, $this->types);
    }
}
