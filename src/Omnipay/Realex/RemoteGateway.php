<?php

namespace Omnipay\Realex;

use Omnipay\Common\AbstractGateway;

/**
 * Realex Direct Class
 */
class RemoteGateway extends RedirectGateway
{
    public function getName()
    {
        return 'Realex Direct';
    }

    public function authorize(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Realex\Message\DirectAuthorizeRequest', $parameters);
    }

    public function completeAuthorize(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Realex\Message\DirectCompleteAuthorizeResponse', $parameters);
    }

    public function purchase(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Realex\Message\DirectPurchaseRequest', $parameters);
    }

    public function completePurchase(array $parameters = array())
    {
        return $this->completeAuthorize($parameters);
    }
}
