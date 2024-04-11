<?php

namespace App\Repositories;

use PayPal\Api\Item;
use PayPal\Api\Payer;
use PayPal\Api\Amount;
use PayPal\Api\Payment;
use PayPal\Api\ItemList;
use PayPal\Api\Transaction;
use PayPal\Rest\ApiContext;
use PayPal\Api\RedirectUrls;
use PayPal\Api\PaymentExecution;
use PayPal\Auth\OAuthTokenCredential;
use Illuminate\Support\Facades\Config;
use PayPal\Exception\PayPalConnectionException;


class PaypalIntegration
{
    private $apiContext;

    function __construct()
    {
        $paypalConfig = Config::get('services.paypal');

        $this->apiContext = new ApiContext(
            new OAuthTokenCredential(
                $paypalConfig['client_id'],
                $paypalConfig['secret']
            )
        );

        $this->apiContext->setConfig($paypalConfig['settings']);
    }

    public function makePayment($data)
    {
        //dd($data);
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

        $total = 0;
        $itemList = new ItemList();
        foreach ($data->itemList as $el) {
            $item = new Item();
            $item->setName($el->itemName)
                ->setCurrency('USD')
                ->setSku($el->sku)
                ->setQuantity($el->itemQuantity)
                ->setPrice($el->itemPrice);
            $itemList->addItem($item);
            $total += $el->itemPrice;
        }

        $amount = new Amount();
        $amount->setTotal($total);
        $amount->setCurrency('USD');
  
        $transaction = new Transaction();
        $transaction->setAmount($amount)
                    ->setItemList($itemList)
                    ->setDescription($data->description);

        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl($data->returnUrl)
                     ->setCancelUrl($data->returnUrl);

        $payment = new Payment();
        $payment->setIntent('sale')
            ->setPayer($payer)
            ->setTransactions(array($transaction))
            ->setRedirectUrls($redirectUrls);


        try {
            $payment->create($this->apiContext);

            return redirect()->away($payment->getApprovalLink());
        }
        catch (PayPalConnectionException $ex) {
            // This will print the detailed information on the exception.
            //REALLY HELPFUL FOR DEBUGGING
            dd($ex);
            echo $ex->getData();
        }
    }

    public function executePayment($paymentId, $payerId)
    {
        $payment = Payment::get($paymentId, $this->apiContext);

        $execution = new PaymentExecution();
        $execution->setPayerId($payerId);

        /** Execute the payment **/
        $result = $payment->execute($execution, $this->apiContext);

        return $result;
    }

    /**
     * Get the payment info
     *
     * @param string $paymentId
     * @return Payment
     */
    public function getPayment(string $paymentId) : Payment 
    {
        return Payment::get($paymentId, $this->apiContext);
    }

}