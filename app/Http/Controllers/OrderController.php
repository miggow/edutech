<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Course;
use App\Order;
use Str;
use App\ClassRoom;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::where('user_id', auth()->user()->id)->get();
        return view('panel.order.index', compact('orders'));
    }
    public function store(Request $request, $id)
    {
        $course = Course::find($id);
        $user = Auth::user();
        if($request->payment_method == 0){
            $this->vnpay_payment($course, $user,$request->payment_method);
        }
        if($request->payment_method == 1){
            $this->momo_payment($course, $user,$request->payment_method);
        }
    }
    public function thanks(Request $request)
    {
        // dd($request);
        if(Auth::check() && Auth::id() == $request->user_id ){
            if(($request->vnp_TransactionStatus == '00' && !empty($request->vnp_TransactionStatus) || (!empty($request->message) && $request->message == 'Success')) ){
                $order = new Order();
                $order->user_id = Auth::id();
                $order->course_id = $request->course_id;
                $order->price = $request->price;
                $order->payment_method = $request->payment_method;
                $order->save();
                
                // dd('haha');
                $classRoom = ClassRoom::where('course_id', $request->course_id)->first();

                if ($classRoom) {
                    $user = auth()->user();
                    $user->classRooms()->attach($classRoom->id);
                }

            }
        }
        return view('frontend.thanks');

    }
    public function vnpay_payment($course, $user, $method){
        // dd('&course_id='.$course->id.'&user_id='.$user->id.'&payment_method='.$method);
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = "http://my.edutech.local/thanks?course_id=".$course->id."&user_id=".$user->id."&payment_method=$method&price=$course->price";
        // dd($vnp_Returnurl);
        $vnp_TmnCode = "N605ZFQV";//Mã website tại VNPAY 
        $vnp_HashSecret = "UVXWCKPQOJGKMDQKIGVAHSXHADNFIWDC"; //Chuỗi bí mật

        $vnp_TxnRef = Str::random(10); //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
        $vnp_OrderInfo = 'Thanh toán khóa học';
        $vnp_OrderType = 'billpayment';
        $vnp_Amount = $course->price * 100;
        $vnp_Locale = 'vn';
        $vnp_BankCode = 'NCB';
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
        //Add Params of 2.0.1 Version
        // $vnp_ExpireDate = $_POST['txtexpire'];
        //Billing
        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
            
        );

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
            $inputData['vnp_Bill_State'] = $vnp_Bill_State;
        }

        //var_dump($inputData);
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }
            // "course_id" => $course->id,
//             "user_id" => $user->id,
//             "payment_method" => $method,
        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret);//  
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        
        $returnData = array('code' => '00'
            , 'message' => 'success'
            , 'data' => $vnp_Url);
            if (isset($_POST['redirect'])) {
                header('Location: ' . $vnp_Url);
                die();
            } else {
                echo json_encode($returnData);
            }
            // vui lòng tham khảo thêm tại code demo
    }
    public function momo_payment($course, $user, $payment){
        $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";


        $partnerCode = 'MOMOBKUN20180529';
        $accessKey = 'klm05TvNBzhg7h7j';
        $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';
        $orderInfo = "Thanh toán qua Atm MoMo";
        $amount = $course->price;
        $orderId = time() . "";
        $redirectUrl = "http://my.edutech.local/thanks?course_id=".$course->id."&user_id=".$user->id."&payment_method=$payment&price=$course->price";
        $ipnUrl = "http://my.edutech.local/thanks?course_id=".$course->id."&user_id=".$user->id."&payment_method=$payment&price=$course->price";
        $extraData = "";


        
        $requestId = time() . "";
        $requestType = "payWithATM";
        //before sign HMAC SHA256 signature
        $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
        $signature = hash_hmac("sha256", $rawHash, $secretKey);
        // dd($signature);
        $data = array('partnerCode' => $partnerCode,
            'partnerName' => "Edutech",
            "storeId" => "MomoTestStore",
            'requestId' => $requestId,
            'amount' => $amount,
            'orderId' => $orderId,
            'orderInfo' => $orderInfo,
            'redirectUrl' => $redirectUrl,
            'ipnUrl' => $ipnUrl,
            'lang' => 'vi',
            'extraData' => $extraData,
            'requestType' => $requestType,
            'signature' => $signature);
        $result = $this->execPostRequest($endpoint, json_encode($data));
        $jsonResult = json_decode($result, true);  // decode json
        // dd($jsonResult['payUrl']);

        //Just a example, please check more in there
        if (isset($_POST['redirect'])) {
                header('Location: ' . $jsonResult['payUrl']);
                die();
            }
    }
    function execPostRequest($url, $data)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data))
        );
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        //execute post
        $result = curl_exec($ch);
        //close connection
        curl_close($ch);
        return $result;
    }
}