<?php

namespace Omnipay\Realex;

use Omnipay\Common\AbstractGateway;
use Omnipay\Common\Exception\InvalidRequestException;

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
            'secret' => '',
            'testMode' => false
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

    public function purchase(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Realex\Message\RedirectPurchaseRequest', $parameters);
    }

    public function completePurchase(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Realex\Message\RedirectCompletePurchaseRequest', $parameters);
    }

}
