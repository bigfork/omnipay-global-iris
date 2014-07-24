<?php

namespace Omnipay\Realex\Message;

/**
 * Realex Abstract Request
 */
abstract class AbstractRequest extends \Omnipay\Common\Message\AbstractRequest
{
    public function getMerchantId()
    {
        return $this->getParameter('merchantId');
    }

    public function setMerchantId($value)
    {
        return $this->setParameter('merchantId', $value);
    }

    public function getAccount()
    {
        return $this->getParameter('account');
    }

    public function setAccount($value)
    {
        return $this->setParameter('account', $value);
    }

    public function getSecret()
    {
        return $this->getParameter('secret');
    }

    public function setSecret($value)
    {
        return $this->setParameter('secret', $value);
    }

    public function getBaseData($autoSettle = true, $card = null)
    {
        $data = array(
            'MERCHANT_ID'           => $this->getMerchantId(),
            'ORDER_ID'              => $this->getTransactionId(),
            'CURRENCY'              => $this->getCurrency(),
            'MERCHANT_RESPONSE_URL' => $this->getReturnUrl(),
            'AMOUNT'                => round( $this->getAmount() * 100 ),
            'TIMESTAMP'             => gmdate('YmdHis'),
            'AUTO_SETTLE_FLAG'      => $autoSettle
        );

        $data['SHA1HASH'] = $this->createSignature($data, 'sha1', $card);

        return $data;
    }

    public function createSignature($data, $method = 'sha1', $card = null)
    {
        $hash = $method(rtrim(implode('.', array(
            $data['TIMESTAMP'],
            $data['MERCHANT_ID'],
            $data['ORDER_ID'],
            $data['AMOUNT'],
            $data['CURRENCY'],
            $card !== null ? $card->getNumber() : null
        )), '.'));

        return $method($hash.'.'.$this->getSecret());
    }

    public function getRequestXML($card, $autoSettle = true)
    {
        $data    = $this->getBaseData($autoSettle, $card);
        $request = new \SimpleXMLElement('<request />');

        $request['timestamp']        = $data['TIMESTAMP'];
        $request['type']             = 'auth';

        $request->merchantid         = $this->getMerchantId();
        $request->account            = $this->getAccount();
        $request->orderid            = $data['ORDER_ID'];
        $request->sha1hash           = $data['SHA1HASH'];
        $request->md5hash            = $this->createSignature($data, 'md5', $card);
        $request->custipaddress      = $_SERVER['REMOTE_ADDR'];

        $request->amount             = $data['AMOUNT'];
        $request->amount['currency'] = $data['CURRENCY'];

        $request->autosettle['flag'] = (int)$data['AUTO_SETTLE_FLAG'];

        $request->card->number       = $card->getNumber();
        $request->card->expdate      = $card->getExpiryDate('my');
        $request->card->chname       = $card->getFirstName().' '.$card->getLastName();
        $request->card->type         = strtoupper($card->getBrand());
        $request->card->issueno      = $card->getIssueNumber();
        $request->card->cvn->number  = $card->getCvv();
        $request->card->cvn->presind = '1';

        $request->address['type']    = 'billing';
        $request->address->code      = $card->getBillingPostcode();
        $request->address->country   = strtoupper($card->getBillingCountry());

        return $request->asXML();
    }

}
