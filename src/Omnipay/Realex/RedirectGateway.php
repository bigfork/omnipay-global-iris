<?php

namespace Omnipay\Realex;

use Omnipay\Common\AbstractGateway;

/**
 * Realex Redirect Class
 */
class RedirectGateway extends AbstractGateway
{
    public function getName()
    {
        return 'Realex Redirect';
    }

    public function getDefaultParameters()
    {
        return array(
            'merchantId' => '',
            'secret'     => '',
            'testMode'   => false
        );
    }

    public function getMerchantId()
    {
        return $this->getParameter('merchantId');
    }

    public function setMerchantId($value)
    {
        return $this->setParameter('merchantId', $value);
    }

    public function getSecret()
    {
        return $this->getParameter('secret');
    }

    public function setSecret($value)
    {
        return $this->setParameter('secret', $value);
    }

    public function authorize(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Realex\Message\RedirectAuthorizeRequest', $parameters);
    }

    public function completeAuthorize(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Realex\Message\RedirectCompleteAuthorizeResponse', $parameters);
    }

    public function purchase(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Realex\Message\RedirectPurchaseRequest', $parameters);
    }

    public function completePurchase(array $parameters = array())
    {
        return $this->completeAuthorize($parameters);
    }
}
