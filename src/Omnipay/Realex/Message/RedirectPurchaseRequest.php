<?php

namespace Omnipay\Realex\Message;

/**
 * Realex Redirect Purchase Request
 */
class RedirectPurchaseRequest extends AbstractRequest
{
    public function getData()
    {
        return null;
    }

    public function getRedirectData()
    {
        return $this->getBaseData();
    }

    public function sendData($data)
    {
        return $this->createResponse($data);
    }

    protected function createResponse($data)
    {
        return $this->response = new RedirectPurchaseResponse($this, $data);
    }
}
