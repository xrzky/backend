<?php

namespace App\Http\Controllers;

use App\Events\InvoiceCreated;
use App\Events\UserCheckingOut;
use App\Models\Invoice;
use App\Models\Order;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function checkout(Request $request)
    {   
        event(new UserCheckingOut($request)); //make new invoice entry in db

        $invoiceId = Invoice::latest()->first()->id;
        
        $userData = User::find($request->input('customer_id'));
        $userProfileData = $userData->profile()->first();
        $userAddressData = $userData->address()->find($request->input('address_id'));        

        $frontendUrl = config('sanctum.stateful');        

        $paymentMethod      = strtoupper($request->input('paymentMethod')); // PaymentMethod list => https://docs.duitku.com/pop/id/#payment-method
        $paymentAmount      = $request->input('paymentAmount'); // Amount
        $email              = $userData->email; // your customer email
        $phoneNumber        = $userProfileData->phone_number; // your customer phone number (optional)
        $productDetails     = "Pembayaran untuk Toko Rendstore";
        $merchantOrderId    = $invoiceId; // from merchant, unique   
        $additionalParam    = ''; // optional
        $merchantUserInfo   = ''; // optional
        $customerVaName     = $request->input('customerVaName'); // display name on bank confirmation display
        $callbackUrl        = 'http://localhost:8000/api/callback'; // url  for callback
        $returnUrl          =  'http://' . strval($frontendUrl[0]);// url for redirect
        $expiryPeriod       = 60; // set the expired time in minutes
        $signature = md5(\config('duitku.merchant_code') . $merchantOrderId . $paymentAmount . \config('duitku.merchant_code'));

        // Customer Detail
        $firstName          = $userProfileData->firstName;
        $lastName           = $userProfileData->lastName;

        // Address
        $address            =$userAddressData->streetbuilding;
        $city               =$userAddressData->city;
        $postalCode         =$userAddressData->postalCode;
        $province           =$userAddressData->province;
        $countryCode        = "ID";

        $userAddress = array(
            'firstName'     => $firstName,
            'lastName'      => $lastName,
            'address'       => $address,
            'city'          => $city,
            'postalCode'    => $postalCode,
            'province'      => $province,
            'phone'         => $phoneNumber,
            'countryCode'   => $countryCode
        );

        $customerDetail = array(
            'firstName'         => $firstName,
            'lastName'          => $lastName,
            'email'             => $email,
            'phoneNumber'       => $phoneNumber,
            'billingAddress'    => $userAddress,
            'shippingAddress'   => $userAddress
        );

        // Item Details
        $item1 = array(
            'name'      => $productDetails,
            'price'     => $paymentAmount,
            'quantity'  => 1
        );

        $itemDetails = array(
            $item1
        );

        $params = array(
            'paymentMethod'     => $paymentMethod,
            'paymentAmount'     => $paymentAmount,
            'merchantOrderId'   => $merchantOrderId,
            'productDetails'    => $productDetails,
            'additionalParam'   => $additionalParam,
            'merchantUserInfo'  => $merchantUserInfo,
            'customerVaName'    => $customerVaName,
            'email'             => $email,
            'phoneNumber'       => $phoneNumber,
            'itemDetails'       => $itemDetails,
            'customerDetail'    => $customerDetail,
            'callbackUrl'       => $callbackUrl,
            'returnUrl'         => $returnUrl,
            'expiryPeriod'      => $expiryPeriod
        );
    
        try {
            // createInvoice Request
            $responseDuitkuPop = \Duitku\Pop::createInvoice($params, $this->duitkuConfig());

            header('Content-Type: application/json');

            // change order status
            $currentOrder = Order::find($request->input('orderId'));
            $currentOrder->status = 'completed';
            $currentOrder->save();

            \event(new InvoiceCreated());
            
            return $responseDuitkuPop;
        } catch (Exception $e) {
            return $e->getMessage()->errors;
        }
    } 

    public function checkStatus()
    {           
        try {
            $merchantOrderId = 'INV-240200018';
            $transactionList = \Duitku\Pop::transactionStatus($merchantOrderId, $this->duitkuConfig());
        
            header('Content-Type: application/json');
            $transaction = json_decode($transactionList);
        
        
            if ($transaction->statusCode == "00") {
                // Action Success
                return 'delivered';
            } else if ($transaction->statusCode == "01") {
                // Action Pending
                
                return 'pending';
            } else {
                // Action Failed Or Expired
                return 'cancelled';
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function callback()
    {
        // try {
        //     $callback = \Duitku\Pop::callback($this->duitkuConfig());
        
        //     header('Content-Type: application/json');
        //     $notif = json_decode($callback);
        
        //     var_dump($callback);
        
        //     if ($notif->resultCode == "00") {
        //         // Action Success
        //     } else if ($notif->resultCode == "01") {
        //         // Action Failed
        //     }
        // } catch (Exception $e) {
        //     http_response_code(400);
        //     echo $e->getMessage();
        // }
        $apiKey = '1debd660005cc17500511e8925cc07f4'; // API key anda
        $merchantCode = isset($_POST['merchantCode']) ? $_POST['merchantCode'] : null; 
        $amount = isset($_POST['amount']) ? $_POST['amount'] : null; 
        $merchantOrderId = isset($_POST['merchantOrderId']) ? $_POST['merchantOrderId'] : null; 
        $productDetail = isset($_POST['productDetail']) ? $_POST['productDetail'] : null; 
        $additionalParam = isset($_POST['additionalParam']) ? $_POST['additionalParam'] : null; 
        $paymentCode = isset($_POST['paymentCode']) ? $_POST['paymentCode'] : null; 
        $resultCode = isset($_POST['resultCode']) ? $_POST['resultCode'] : null; 
        $merchantUserId = isset($_POST['merchantUserId']) ? $_POST['merchantUserId'] : null; 
        $reference = isset($_POST['reference']) ? $_POST['reference'] : null; 
        $signature = isset($_POST['signature']) ? $_POST['signature'] : null; 
        $publisherOrderId = isset($_POST['publisherOrderId']) ? $_POST['publisherOrderId'] : null; 
        $spUserHash = isset($_POST['spUserHash']) ? $_POST['spUserHash'] : null; 
        $settlementDate = isset($_POST['settlementDate']) ? $_POST['settlementDate'] : null; 
        $issuerCode = isset($_POST['issuerCode']) ? $_POST['issuerCode'] : null; 

        //log callback untuk debug 
        // file_put_contents('callback.txt', "* Callback *\r\n", FILE_APPEND | LOCK_EX);

        if(!empty($merchantCode) && !empty($amount) && !empty($merchantOrderId) && !empty($signature))
        {
            $params = $merchantCode . $amount . $merchantOrderId . $apiKey;
            $calcSignature = md5($params);

            if($signature == $calcSignature)
            {
                //Callback tervalidasi
                //Silahkan rubah status transaksi anda disini
                file_put_contents('callback.txt', "* Berhasil *\r\n\r\n", FILE_APPEND | LOCK_EX);

            }
            else
            {
                file_put_contents('callback.txt', "* Bad Signature *\r\n\r\n", FILE_APPEND | LOCK_EX);
                throw new Exception('Bad Signature');
            }
        }
        else
        {
            file_put_contents('callback.txt', "* Bad Parameter *\r\n\r\n", FILE_APPEND | LOCK_EX);
            throw new Exception('Bad Parameter');;
        }

    }

    public function getPaymentMethod()
    {        
        try {
            $paymentAmount = "10000"; //"YOUR_AMOUNT";
            $paymentMethodList = \Duitku\Pop::getPaymentMethod($paymentAmount, $this->duitkuConfig());
        
            header('Content-Type: application/json');
            $json = \json_encode($paymentMethodList);
            return $paymentMethodList;
        } catch (Exception $e) {
            return \response($e->getMessage());
        }
    }

    private function duitkuConfig()
    {
        $duitkuConfig = new \Duitku\Config(\config('duitku.merchant_key'), \config('duitku.merchant_code'));
        
        // false for production mode
        // true for sandbox mode
        $duitkuConfig->setSandboxMode(true);
        // set sanitizer (default : true)
        $duitkuConfig->setSanitizedMode(false);
        // set log parameter (default : true)
        $duitkuConfig->setDuitkuLogs(false);

        return $duitkuConfig;
    }
    
}

