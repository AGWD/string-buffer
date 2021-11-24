<?php declare(strict_types=1);

namespace AdrianGreen\String\Extensions;

use AdrianGreen\String\StringBuffer;
use function base64_decode;
use function base64_encode;
use function urldecode;
use function urlencode;

class Url extends AbstractExtension
{
    /**
     * @return StringBuffer
     */
    public function urlEncode(): StringBuffer
    {
        return $this->string->setString(urlencode($this->string->toString()));
    }

    /**
     * @return StringBuffer
     */
    public function urlDecode(): StringBuffer
    {
        return $this->string->setString(urldecode($this->string->toString()));
    }

    /**
     * @return StringBuffer
     */
    public function base64Encode(): StringBuffer
    {
        return $this->string->setString(base64_encode($this->string->toString()));
    }

    /**
     * @return StringBuffer
     */
    public function base64Decode(): StringBuffer
    {
        return $this->string->setString(base64_decode($this->string->toString()));
    }
}
