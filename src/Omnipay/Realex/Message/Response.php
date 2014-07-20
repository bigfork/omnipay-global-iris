<?php

namespace Omnipay\Realex\Message;

use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RequestInterface;

/**
 * Realex Response
 */
class Response extends AbstractResponse
{
    public function __construct(RequestInterface $request, $data = array())
    {
        $this->request = $request;
    }

    public function isSuccessful()
    {
        return false;
    }
}
