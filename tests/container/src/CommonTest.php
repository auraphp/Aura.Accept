<?php
namespace Aura\Accept\_Config;

use Aura\Di\ContainerAssertionsTrait;

class CommonTest extends \PHPUnit_Framework_TestCase
{
    use ContainerAssertionsTrait;

    public function setUp()
    {
        $this->setUpContainer(array(
            'Aura\Accept\_Config\Common',
        ));
    }

    public function test()
    {
        $this->assertNewInstance('Aura\Accept\Accept');
    }
}
