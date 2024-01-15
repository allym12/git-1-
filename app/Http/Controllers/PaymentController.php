<?php

namespace App\Http\Controllers;

use App\Helpers\Kpay;
use App\Models\MomoTransaction;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class PaymentController extends Controller
{

    public string $amount;

    public function __construct()
    {
        $this->amount = 100;
    }

    
    public function initiate_permit_payment(Request $request){

        $rules = [
            'phone' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
    
        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 400);
        }

        $phone_number =  '25' . $request->get('phone');

        $data = json_decode(Kpay::initiatePayment($phone_number,  $this->amount), true);
        
        info($data);

        if(isset($data) && array_key_exists('refid', $data) && array_key_exists('success', $data) && $data['success']){
            info('Payment initialization successful');
            return response()->json(['success' => true, 'refid' => $data['refid'], 'tid' => $data['tid']]);
        }

        return response()->json(['success' => false]) ;
    }

    private function getTransactionByRefId(?string $refid = ''){
        return MomoTransaction::where('description->refid', '=', $refid)
                ->first();
    }

    public function kpay_call_back(Request $request){

        $data = $request->all();
        
        info('Kpay call back hit');
        info($data);
    
        // Check if the refid exists
        if (!$data || !is_array($data) || !array_key_exists('refid', $data)) {
            info('Kpay call back doesnt have refid');
            return response()->json(['message' => 'Failed', 'success' => false], 403);
        }
    
        // Convert the JSON payload to a JSON string
        $jsonData = json_encode($data);
    
        $refid = $data['refid'];
    
        // Check if the transaction already exists with the provided request_id
        if (!$this->getTransactionByRefId($refid)) {
            // Create a new MomoTransaction record
            MomoTransaction::create(['description' => $jsonData, 'created_by' => 'Response from Aggregator']);
        }
    
        return response()->json(['message' => 'Success', 'success' => true, 'refid' => $refid]);
    }


    public function check_transaction(Request $request){

        $rules = [
            'refid'                 => 'required',
            'phone'                 => 'required',
            'tid'                   => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);
    
        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 400);
        }

        $refid = $request->get('refid');
        $phone = $request->get('phone');
        $tid = $request->get('tid');
        
        if($this->getTransaction('01', $refid)){

            $this->addSuccessUser($phone, $refid);

            return response()->json(['status' => 'success', 'location' => url()->current()]);

        }
        else if($this->getTransaction('02', $refid)) {

            return response()->json(['status' => 'failed']);
        }

        $data = json_decode(Kpay::checkPaymentFromEsiciaServer($refid, $tid), true);

        if(isset($data) && array_key_exists('refid', $data) && array_key_exists('statusid', $data)){
            if($data['statusid'] == '01'){
                $this->addSuccessUser($phone, $refid);
                return response()->json(['status' => 'success', 'location' => url()->current()]);
            }
            else if($data['statusid'] == '03'){
                return response()->json(['status' => 'pending']);
            }
            else{
                return response()->json(['status' => 'failed']);
            }
        }
        else{
            return response()->json(['status' => 'failed']);
        }
            
        return response()->json(['status' => 'pending']);
    }

    private function addSuccessUser($phone, $refid){
        info('User has successfully paid');

        $user = User::firstOrCreate([
            'phone' => $phone,
        ], [
            'password' => Hash::make('password'),
            'name' =>  $phone
        ]);

        event(new Registered($user));

        Auth::login($user);

        $data['transaction_id'] = $refid;
        $data['ref'] = 'response';
        $data['payment_phone'] = $phone;
        $data['total_amount'] = $this->amount;
        $user->paymentTransactions()->create($data);

        info('User has been authenticated as ' . auth()->user()->name);

        Kpay::paymentSuccess();
    }

    private function getTransaction(string $status, ?string $refid = ''){
        return MomoTransaction::where('description->statusid', '=', $status)
                ->where('description->refid', '=', $refid)
                ->first();
    }
    
    public function test_status($refid){
        return Kpay::checkPaymentFromEsiciaServer($refid);
    }

}
