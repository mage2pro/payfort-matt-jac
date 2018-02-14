<?php

namespace Payfort\Fort\Controller\Payment;

class MerchantPageResponse extends \Payfort\Fort\Controller\Checkout
{
    public function execute()
    {
        $orderId = $this->getRequest()->getParam('merchant_reference');
        $order = $this->getOrderById($orderId);
        $responseParams = $this->getRequest()->getParams();
        $helper = $this->getHelper();
        $integrationType = $helper->getConfig('payment/payfort_fort_cc/integration_type');
        $success = $helper->handleFortResponse($responseParams, 'online', $integrationType);
        if ($success) {
            $returnUrl = $helper->getUrl('checkout/onepage/success');
        }
        else {
            $returnUrl = $this->getHelper()->getUrl('checkout/cart');
        }
        $this->orderRedirect($order, $returnUrl);
    }

}
