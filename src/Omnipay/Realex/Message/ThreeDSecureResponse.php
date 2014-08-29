<?php

namespace Omnipay\Realex\Message;

use Omnipay\Common\Message\RedirectResponseInterface;

/**
 * Realex Redirect Authorize Response
 */
class ThreeDSecureResponse extends Response implements RedirectResponseInterface
{
    protected $liveCheckoutEndpoint = 'https://hpp.realexpayments.com/pay';
    protected $testCheckoutEndpoint = 'https://hpp.sandbox.realexpayments.com/pay';
    protected $successful = false;

    public function isSuccessful()
    {
        return $this->successful;
    }

    public function isRedirect()
    {
        return true;
    }

    public function getRedirectUrl()
    {
        return $this->data['url'];
    }

    public function getTransactionReference()
    {
        return $this->data['data']['transactionid'];
    }

    public function getNotifyUrl() 
    {
        return "NURL";
    }

    public function getRedirectMethod()
    {
        return 'POST';
    }

    public function getRedirectData()
    {
        return $this->data['data'];
    }
}
