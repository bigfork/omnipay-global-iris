<?php

namespace Omnipay\GlobalIris\Message;

use Omnipay\Common\Message\RedirectResponseInterface;

/**
 * Global Iris Redirect Authorize Response
 */
class RedirectAuthorizeResponse extends Response implements RedirectResponseInterface
{
	protected $liveEndpoint = 'https://hpp.globaliris.com/pay';
	protected $testEndpoint = 'https://hpp.sandbox.globaliris.com/pay';

	public function isSuccessful()
	{
		return false;
	}

	public function isRedirect()
	{
		return true;
	}

	public function getRedirectUrl()
	{
		return $this->getCheckoutEndpoint();
	}

	public function getTransactionReference()
	{
		return $this->getRequest()->getTransactionId();
	}

	public function getRedirectMethod()
	{
		return 'POST';
	}

	public function getRedirectData()
	{
		return $this->getRequest()->getBaseData(false);
	}

	protected function getCheckoutEndpoint()
	{
		if ($this->getRequest()->getTestMode()) {
			return $this->testEndpoint;
		}

		return $this->liveEndpoint;
	}
}
