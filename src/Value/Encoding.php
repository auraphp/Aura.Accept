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
namespace Aura\Accept\Value;

/**
 *
 * Represents an encoding value.
 *
 * @package Aura.Accept
 *
 */
class Encoding extends AbstractValue
{
    /**
     *
     * Checks if an available encoding value matches this acceptable value.
     *
     * @param Encoding $avail An available encoding value.
     *
     * @return True on a match, false if not.
     *
     */
    public function match(Encoding $avail)
    {
        return strtolower($this->value) == strtolower($avail->getValue())
            && $this->matchParameters($avail);
    }
}
