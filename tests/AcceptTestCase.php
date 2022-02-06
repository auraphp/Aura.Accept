<?php
namespace Aura\Accept;

use Yoast\PHPUnitPolyfills\TestCases\TestCase;

class AcceptTestCase extends TestCase
{
    protected function assertAcceptValues($actual, $expect, $negotiator_class, $value_class)
    {
        $this->assertInstanceOf($negotiator_class, $actual);
        $this->assertSameSize($expect, $actual->get());

        foreach ($actual as $key => $item) {
            $this->assertInstanceOf($value_class, $item);
            foreach ($expect[$key] as $func => $value) {
                $func = 'get' . $func;
                $this->assertEquals($value, $item->$func());
            }
        }
    }
}
