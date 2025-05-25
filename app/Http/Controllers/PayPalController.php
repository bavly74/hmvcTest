<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\PayPal\PayPalService;
use Illuminate\Http\Request;

class PayPalController extends Controller
{
    private $payPal_service ;
    public function __construct(PayPalService $payPal_service)
    {
        $this->payPal_service = $payPal_service ;
    }
public function pay()
{
    $response = $this->payPal_service->createOrder(100, 'USD');

    if (isset($response['links'])) {
        foreach ($response['links'] as $link) {
            if ($link['rel'] === 'approve') {
                return redirect()->away($link['href']); // redirect to PayPal payment page
            }
        }
    }

    return response()->json(['error' => 'Payment link not found', 'response' => $response], 500);
}

}
