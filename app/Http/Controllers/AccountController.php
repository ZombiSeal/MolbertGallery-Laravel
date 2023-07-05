<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmailRequest;
use App\Http\Requests\FirstNameRequest;
use App\Http\Requests\LastNameRequest;
use App\Http\Requests\PasswordRepeatRequest;
use App\Http\Requests\PasswordRequest;
use App\Models\Order;
use App\Models\OrderInfo;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Testing\Fluent\Concerns\Has;

class AccountController extends Controller
{
    public function index()
    {
        return view('/account/account');
    }

    public function showData(Request $request)
    {
            return response(view('/account/data'));
    }
    public function getUserData(Request $request)
    {
        return response()->json(["user" => Auth::user()]);
    }

    public function editUser(Request $request) {
        $firstNameRules = new FirstNameRequest();
        $lastNameRules = new LastNameRequest();
        $emailRules = new EmailRequest();

        $firstnameErr = Validator::make($request->all(), $firstNameRules->rules(), $firstNameRules->messages())->errors()->toArray();
        $lastnameErr = Validator::make($request->all(), $lastNameRules->rules(), $lastNameRules->messages())->errors()->toArray();
        $emailErr = ($request->email !== Auth::user()->email) ? Validator::make($request->all(), $emailRules->rules(), $emailRules->messages())->errors()->toArray() : [];

        $errors = $firstnameErr + $lastnameErr + $emailErr;
        if(count($errors) == 0) {
            User::where("email", Auth::user()->email)->update([
                'firstname' => $request->firstName,
                'lastName' => $request->lastName,
                'email' => $request->email
                ]);
            $res = 1;
        } else {
            $res = 0;
        }

        return response()->json(["res" => $res, "errors" =>$errors]);
    }

    public function editPassword(Request $request) {
        $passRule = new PasswordRequest();
        $rassRepeatRule = new PasswordRepeatRequest();

        $passwordErr = Validator::make($request->all(), $passRule->rules(), $passRule->messages())->errors()->toArray();
        $repeatPassErr = Validator::make($request->all(), $rassRepeatRule->rules(), $rassRepeatRule->messages())->errors()->toArray();

        $userPasswordErr = (!Hash::check($request->userPassword, Auth::user()->password)) ? ["userPassword" => ["Неверный пароль"]] : [];

        $errors =  $passwordErr + $repeatPassErr + $userPasswordErr;

        if(count($errors) == 0) {
            User::where("email", Auth::user()->email)->update([
                'password' => Hash::make($request->password),
            ]);
            $res = 1;
        } else {
            $res = 0;
        }

        return response()->json(["res" => $res, "errors" =>$errors]);

    }
    public function showOrder(Request $request)
    {
        $orderNumbers = Order::where("id_user", Auth::user()->id_user)->select('order_number')->distinct()->get()->toArray();

        $mergeOrdersNum = [];
        foreach ($orderNumbers as $num) {
           array_push($mergeOrdersNum, $num['order_number']);
        }

        $orders = [];
        $products = [];
        foreach ($mergeOrdersNum as $key=>$num) {

            $orderInfo = Order::with([
                "info"=> function($query){$query->select('id_info','order_data');},
                "product" => function($query){$query->select('id_product', 'title', 'img_path', 'price');},
                "status" => function($query){$query->select('_status');} ,
                "sale",
                "author"
            ])->where("order_number", $num)->get()->groupBy("order_number")->toArray();

            $orders[$num]["status"] = $orderInfo[$num][0]['status'];
            $orders[$num]["date"] = $orderInfo[$num][0]['info']["order_data"];
            $orders[$num]["sale"] = $orderInfo[$num][0]['sale']["sale"] ?? 0;

            array_push($products,  $orderInfo[$num][$key]['product'] + $orderInfo[$num][$key]['author']);

            $orders[$num]["products"] = $products;

        }

       return response(view('/account/order', ["orders"=>$orders]));
    }




}
