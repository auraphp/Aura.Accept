<?php
/**
 *
 * This file is part of Aura for PHP.
 *
 * @license http://opensource.org/licenses/mit-license.php MIT
 *
 */
namespace Aura\Accept\Media;

use Aura\Accept\AbstractValue;

/**
 *
 * Represents an acceptable media type value.
 *
 * @package Aura.Accept
 *
 */
class MediaValue extends AbstractValue
{
    /**
     *
     * The media type.
     *
     * @var string
     *
     */
    protected $type = '*';

    /**
     *
     * The media subtype.
     *
     * @var string
     *
     */
    protected $subtype = '*';

    /**
     *
     * Finishes construction of the value object.
     *
     * @return null
     *
     */
    protected function init()
    {
        $values = explode('/', $this->value);
        $this->type = $values[0];
        $this->subtype = isset($values[1]) ? $values[1] : '*';
    }

    /**
     *
     * Returns the media type.
     *
     * @return string
     *
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     *
     * Returns the media subtype.
     *
     * @return string
     *
     */
    public function getSubtype()
    {
        return $this->subtype;
    }

    /**
     *
     * Is the acceptable value a wildcard?
     *
     * @return bool
     *
     */
    public function isWildcard()
    {
        return $this->value == '*/*';
    }

    /**
     *
     * Checks if an available media type value matches this acceptable value.
     *
     * @param Media $avail An available media type value.
     *
     * @return True on a match, false if not.
     *
     */
    public function match(MediaValue $avail)
    {
        if ($avail->getValue() == '*/*') {
            return true;
        }

        // is it a full match?
        if (strtolower($this->value) == strtolower($avail->getValue())) {
            return $this->matchParameters($avail);
        }

        // is it a type match?
        return $this->subtype == '*'
            && strtolower($this->type) == strtolower($avail->getType())
            && $this->matchParameters($avail);
    }
}
