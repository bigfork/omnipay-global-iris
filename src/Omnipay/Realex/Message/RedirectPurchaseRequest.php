<?php

namespace Omnipay\Realex\Message;

use Omnipay\Common\Message\RedirectResponseInterface;

/**
 * Realex Redirect Purchase Request
 */
class RedirectPurchaseRequest extends RedirectAuthorizeRequest
{
    public function getRedirectData()
    {
        return $this->getRequest()->getBaseData();
    }
}
