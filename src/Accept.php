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

use Aura\Accept\Charset\CharsetNegotiator;
use Aura\Accept\Encoding\EncodingNegotiator;
use Aura\Accept\Language\LanguageNegotiator;
use Aura\Accept\Media\MediaNegotiator;

/**
 *
 * A collection of negotiator objects.
 *
 * @package Aura.Accept
 *
 * @property-read MediaNegotiator $media The `Accept` values object.
 *
 * @property-read CharsetNegotiator $charset The `Accept-Charset` values object.
 *
 * @property-read EncodingNegotiator $encoding The `Accept-Encoding` values object.
 *
 * @property-read LanguageNegotiator $language The `Accept-Language` values object.
 *
 */
class Accept
{
    /**
     *
     * The media-type negotiator.
     *
     * @var MediaNegotiator
     *
     */
    protected $media;

    /**
     *
     * The charset negotiator.
     *
     * @var CharsetNegotiator
     *
     */
    protected $charset;

    /**
     *
     * The encoding negotiator.
     *
     * @var EncodingNegotiator
     *
     */
    protected $encoding;

    /**
     *
     * The language negotiator.
     *
     * @var LanguageNegotiator
     *
     */
    protected $language;

	/**
	 *
	 * Constructor.
	 *
	 * @param CharsetNegotiator $charset A charset negotiator.
	 *
	 * @param EncodingNegotiator $encoding An encoding negotiator.
	 *
	 * @param LanguageNegotiator $language A language negotiator.
	 *
	 * @param MediaNegotiator $media A media-type negotiator.
	 *
	 */
    public function __construct(
        CharsetNegotiator $charset,
        EncodingNegotiator $encoding,
        LanguageNegotiator $language,
        MediaNegotiator $media
    ) {
        $this->media    = $media;
        $this->charset  = $charset;
        $this->encoding = $encoding;
        $this->language = $language;
    }

    /**
     *
     * Returns a negotiator object by name.
     *
     * @param string $key The negotiator object name.
     *
     * @return object The negotiator object.
     *
     */
    public function __get($key)
    {
        return $this->$key;
    }
}
