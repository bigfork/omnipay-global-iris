<?php

namespace Omnipay\Realex;

use Omnipay\Common\Exception\InvalidRequestException;

/**
 * Realex Hosted Class
 */
class HostedGateway extends AbstractGateway
{
    public function getName()
    {
        return 'Realex Hosted';
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

    public function authorize(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Realex\Message\HostedAuthorizeRequest', $parameters);
    }

    public function completeAuthorize(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Realex\Message\HostedCompleteAuthorizeRequest', $parameters);
    }

    public function purchase(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Realex\Message\HostedPurchaseRequest', $parameters);
    }

    public function completePurchase(array $parameters = array())
    {
        return $this->completeAuthorize($parameters);
    }

}
