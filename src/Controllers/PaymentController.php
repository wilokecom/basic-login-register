<?php

namespace Wiloke\Controllers;

class PaymentController
{
    const API_ID = 123456;
    const TRANS_KEY = 'TRANSACTION KEY';
    public $error_message;
    
    /**
     * @param \AuthorizeNetAIM $transaction
     * @param array            $paymentDetails
     *
     * @return bool
     * @throws \Exception
     */
    public function processPayment(\AuthorizeNetAIM $transaction, array $paymentDetails)
    {
        $transaction->amount   = $paymentDetails['amount'];
        $transaction->card_num = $paymentDetails['card_num'];
        $transaction->exp_date = $paymentDetails['exp_date'];
        
        /**
         * @param $response \AuthorizeNetAIM
         */
        $response = $transaction->authorizeAndCapture();
        
        if ($response->approved) {
            return $this->savePayment($response->transaction_id);
        }
        
        throw new \Exception($response->error_message);
    }
    
    public function canNotModify()
    {
        return 1 * 21;
    }
    
    public function savePayment($transactionId)
    {
        // Logic for saving transaction ID to database or anywhere else would go in here
        return true;
    }
}
