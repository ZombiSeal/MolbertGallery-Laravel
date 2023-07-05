<?php

namespace App\Http\Controllers;

use App\Models\Adress;
use App\Models\Delivery;
use App\Models\Order;
use App\Models\OrderInfo;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Sale;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $products = Product::with(['author', 'size'])->whereIn('id_product', session()->get('basket'))->get();
        $deliveries = Delivery::all();
        $payments = Payment::all();
        $totalPrice = $products->sum('price');
        return view('order', ["products" => $products, "deliveries" => $deliveries,"payments" => $payments, "totalPrice" => $totalPrice]);
    }

    public function sale(Request $request) {
        $sale = ($request->sale) ? (Sale::where('code', $request->sale)->first() ?? ["error" => 1, "sale"=> 0]) : ["sale" => 0];
        return response()->json($sale);
    }

    private function validateAdress(array $data) {

        $validator = Validator::make($data, [
           "street" => 'required',
            "city" => 'required',
            "country" => 'required',
            "house" => 'required|integer'
        ]);
        return $validator->errors()->toArray();
    }

    private function validateInfo(array $data) {
        $validator = Validator::make($data, [
            "delivery" => 'required',
            "payment" => 'required',
        ]);

        return $validator->errors()->toArray();
    }

    private function createAdress(array $request) {
        $adress = Adress::create([
            "country" => $request["country"],
            "city" => $request["city"],
            "street" => $request["street"],
            "house" => $request["house"],
        ]);
        return $adress->id_adress;
    }

    private function createInfo(array $request) {
        $info = OrderInfo::create([
            "id_delivery" => $request["delivery"],
            "id_payment" => $request["payment"],
            "order_data" => date("Y-m-d")
        ]);

        return $info->id_info;
    }

    private function generateOrderNumber() {
        $orderNum = "";
        $flag = false;
        while (!$flag) {
            for ($i = 0; $i < 10; $i++) {
                $num = mt_rand(0, 9);
                $orderNum .= $num;
            }

            $checkNum = Order::where("order_number", $orderNum)->first();
            if(!$checkNum){
                $flag = true;
            }
        }

        return $orderNum;
    }

    public function create(Request $request) {
        $adressErrors = [];
        $infoErrors = $this->validateInfo($request->all());
        if($request->delivery && $request->delivery != 1) {
            $adressErrors = $this->validateAdress($request->adress);
        }

        $erros = $infoErrors + $adressErrors;
        if(count($erros) == 0) {
            $orderNumber =$this->generateOrderNumber();
            $idSale = Sale::where("code", $request->sale)->first()->id_sale ?? null;
            $idAdress = ($request->delivery != 1) ? $this->createAdress($request->adress) : 1;
            $idInfo = $this->createInfo($request->all());
            $idProducts = session()->get("basket");

            foreach ($idProducts as $idProduct) {
                $order = Order::create([
                    'order_number' => "$orderNumber",
                    'id_user' => Auth::id(),
                    'id_product' => $idProduct,
                    'id_info' =>$idInfo,
                    'id_adress' =>$idAdress,
                    'id_sale' =>$idSale,
            ]);
                Product::where("id_product", $idProduct)->update(['amount' => 0]);
            }

            session()->forget("basket");


            return response()->json(["res" => 1]);
        }

        return response()->json(["res"=> 0,"errors" => $erros]);
    }

}
