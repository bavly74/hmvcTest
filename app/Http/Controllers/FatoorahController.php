<?php

namespace App\Http\Controllers;

use App\Fatoorah\FatoorahService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FatoorahController extends Controller
{
    private $fatoorah_service ;
    public function __construct(FatoorahService $fatoorah_service)
    {
        $this->fatoorah_service = $fatoorah_service ;
    }

    public function pay(){

        $data=[
            'CustomerName'=>'bavly' ,
            'InvoiceValue'=>100 ,
            'NotificationOption'=>'ALL' ,
            'CustomerMobile'=>'1212486377' ,
            'CustomerEmail'=>'bavlyeskander74@gmail.com',
            'CallBackUrl'=>'http://127.0.0.1:8000/api/callback' ,
            'ErrorUrl' =>'http://127.0.0.1:8000/api/error' ,
            'Language' =>'ar' ,
            'MobileCountryCode'=>'+20'
        ];

        return $this->fatoorah_service->sendPayment($data);
    }

    public function callback(Request $request){
        dd($request );
    }

    public function error(Request $request){
        dd($request );
    }

}
