<?php

namespace Omnipay\Realex\Message;

/**
 * Realex Remote Authorize Request
 */
class RemoteAuthorizeRequest extends AbstractRequest
{
    protected $liveEndpoint = 'https://epage.payandshop.com/epage-remote.cgi';
    protected $testEndpoint = 'https://epage.payandshop.com/epage-remote.cgi';

    public function getData()
    {
        $this->validate('amount', 'card');
        $this->getCard()->validate();

        $data = $this->getBaseData(false);

        return $this->buildXML($data, $this->getCard());
    }
}
