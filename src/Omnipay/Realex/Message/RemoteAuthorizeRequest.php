<?php

namespace Omnipay\Realex\Message;

/**
 * Realex Remote Authorize Request
 */
class RemoteAuthorizeRequest extends AbstractRequest
{
    protected $liveCheckoutEndpoint = 'https://epage.payandshop.com/epage-remote.cgi';
    protected $testCheckoutEndpoint = 'https://epage.payandshop.com/epage-remote.cgi';

    public function getData()
    {
        $this->validate('amount', 'billingPostcode', 'billingCountry', 'card');
        $this->getCard()->validate();

        return $this->getRequestXML($this->getCard(), false);
    }

    public function sendData($data)
    {
        $httpResponse = $this->httpClient->post($this->getCheckoutEndpoint(), null, $data)->send();

        return $this->createResponse((string)$httpResponse->getBody());
    }

    protected function createResponse($data)
    {
        return $this->response = new RemoteAuthorizeResponse($this, $data);
    }

    protected function getCheckoutEndpoint()
    {
        return $this->getTestMode() ? $this->testCheckoutEndpoint : $this->liveCheckoutEndpoint;
    }
}
