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
    public __construct(array $server = array(), array $types = array())
    {
        $this->server = $server;
        $this->types = $types;
    }

    /**
     *
     * Returns an Accept object.
     *
     * @return Request\Accept
     *
     */
    public function newInstance()
    {
        $value_factory = new Request\Accept\Value\ValueFactory;
        $charset = new Request\Accept\Charset($value_factory, $this->server);
        $encoding = new Request\Accept\Encoding($value_factory, $this->server);
        $language = new Request\Accept\Language($value_factory, $this->server);
        $media = new Request\Accept\Media($value_factory, $this->server, $this->types);

        return new Request\Accept(
            $charset,
            $encoding,
            $language,
            $media
        );
    }
}
