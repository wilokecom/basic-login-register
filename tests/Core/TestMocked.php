<?php

namespace WilokeTest\Core;

use PHPUnit\Framework\TestCase;
use Wiloke\Controllers\HomeController;
use Wiloke\Controllers\PaymentController;

class TestMocked extends TestCase
{
    public function testGetMockedBuilder()
    {
        //        $homeControllers = $this->getMockBuilder('Wiloke\Controllers\PaymentController')
        //                                ->setConstructorArgs([1, 2])->getMock();
        //
        //        $homeControllers->expects($this->once())
        //                        ->method('getAccessToken')
        //                        ->will($this->returnValue(1));
        //
        //        $this->assertEquals(1, $homeControllers->getAccessToken());
        $oPayment     = new PaymentController();
        $authorizeNet = $this->getMockBuilder('\AuthorizeNetAIM')
                             ->setConstructorArgs([$oPayment::API_ID, $oPayment::TRANS_KEY])
                             ->getMock()
        ;
        
        //        $response                 = new \stdClass();
        //        $response->approved       = true;
        //        $response->transaction_id = 123;
        //
        $response = [
            'approved'       => true,
            'transaction_id' => 123
        ];
        
        $authorizeNet->expects($this->once())
                     ->method('authorizeAndCapture')
                     ->will($this->returnValue((object)$response))
        ;
        
        $paymentDetails = [
            'amount'   => 123.99,
            'card_num' => '4111-1111-1111-1111',
            'exp_date' => '03/2013',
        ];
        
        $this->assertTrue($oPayment->processPayment($authorizeNet, $paymentDetails));
    }
}
