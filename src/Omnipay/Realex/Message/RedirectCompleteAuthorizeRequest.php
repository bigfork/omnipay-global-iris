<?php

namespace Omnipay\Realex\Message;

use Omnipay\Common\Message\RequestInterface;

/**
 * Realex Redirect Complete Authorize Request
 */
class RedirectCompleteAuthorizeResponse extends Response
{
    public function __construct(RequestInterface $request, $data)
    {
        $this->request = $request;
        $this->data = $data;
    }

    public function getTransactionReference()
    {
        echo '<pre>';
            print_r($this->data);
        echo '</pre>';
    }
}
