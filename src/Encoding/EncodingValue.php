<?php
/**
 *
 * This file is part of Aura for PHP.
 *
 * @license http://opensource.org/licenses/mit-license.php MIT
 *
 */
namespace Aura\Accept\Encoding;

use Aura\Accept\AbstractValue;

/**
 *
 * Represents an encoding value.
 *
 * @package Aura.Accept
 *
 */
class EncodingValue extends AbstractValue
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
    public function match(EncodingValue $avail)
    {
        if ($avail->getValue() == '*') {
            return true;
        }

        return strtolower($this->value) == strtolower($avail->getValue())
            && $this->matchParameters($avail);
    }
}
