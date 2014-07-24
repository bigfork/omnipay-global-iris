<?php

namespace Omnipay\Realex\Message;

/**
 * Realex Remote Purchase Request
 */
class RemotePurchaseRequest extends RemoteAuthorizeRequest
{
    public function getData()
    {
        $this->validate('amount', 'card');
        $this->getCard()->validate();

        return $this->getRequestXML($this->getCard());
    }
}
