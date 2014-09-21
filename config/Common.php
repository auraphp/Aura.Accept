<?php
namespace Aura\Accept\_Config;

use Aura\Di\Config;
use Aura\Di\Container;

class Common extends Config
{
    public function define(Container $di)
    {
        /**
         * Aura\Accept
         */
        $di->params['Aura\Accept\Accept'] = array(
            'charset'  => $di->lazyNew('Aura\Accept\Charset'),
            'encoding' => $di->lazyNew('Aura\Accept\Encoding'),
            'language' => $di->lazyNew('Aura\Accept\Language'),
            'media'    => $di->lazyNew('Aura\Accept\Media'),
        );

        /**
         * Aura\Accept\AbstractValues
         */
        $di->params['Aura\Accept\AbstractValues'] = array(
            'value_factory' => $di->lazyNew('Aura\Accept\Value\ValueFactory'),
            'server' => $_SERVER,
        );
    }
}
