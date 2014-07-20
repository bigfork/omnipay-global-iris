<?php

namespace Omnipay\Realex\Message;

/**
 * Realex Abstract Request
 */
abstract class AbstractRequest extends \Omnipay\Common\Message\AbstractRequest
{
    protected $liveEndpoint = 'https://hpp.realexpayments.com/pay';
    protected $testEndpoint = 'https://hpp.sandbox.realexpayments.com/pay';

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

    public function getBaseData($autoSettle = true)
    {
        $this->validate('amount', 'card');

        $this->getCard()->validate();

        $data = array(
            'MERCHANT_ID'      => $this->getMerchantId(),
            'ORDER_ID'         => $this->getTransactionId(),
            'CURRENCY'         => $this->getCurrency(),
            'AMOUNT'           => round( $this->getAmount() * 100 ),
            'TIMESTAMP'        => gmdate('YmdHis'),
            'AUTO_SETTLE_FLAG' => $autoSettle
        );

        $data['SHA1HASH'] = $this->createSignature($data);

        return $data;
    }

    public function createSignature($data)
    {
        $hash = sha1(implode('.', array(
            gmdate('YmdHis'),
            $data['MERCHANT_ID'],
            $data['ORDER_ID'],
            $data['AMOUNT'],
            $data['CURRENCY']
        )));

        return sha1("{$hash}.".$this->getSecret());
    }

    protected function getEndpoint()
    {
        return $this->getTestMode() ? $this->testEndpoint : $this->liveEndpoint;
    }

}
