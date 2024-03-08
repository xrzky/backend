<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        return OrderDetails::all();
    }

    public function showUserOrder()
    {    
        $userId = \auth()->user()->id;        
        
        $order = Order::where('user_id', $userId)->where('status', 'pending')->first();
        $orderDetail = OrderDetails::where('order_id', $order->id)->get();                        
        
        $detailedOrder = [];
        foreach ($orderDetail as $item) {
            $detailedOrder[$item->id] = [
                'id' => $item->id,
                'order_id' => $item->order_id,
                'product_id' => Product::find($item->product_id),
                'qty' => $item->qty,

            ];
        }
        $data = \collect(array_values($detailedOrder));
        return $data;

    }

    public function store(OrderRequest $request)
    {
        $data = $request->validated();
        $ids = explode('_', $data['product_id']);
        $qtys = explode('_', $data['qty']);
        
        // return \response($data);
        $order = Order::where('user_id', $data['user_id'])->where('status', 'pending')->first();
        if (isset($order)) {
            
            $isPendingOrder = $order->status === 'pending' ? true : false;
            if($isPendingOrder) {
                
                $order->orderDetails()->delete();
                foreach ($ids as $key => $id) {
                    $qty = isset($qtys[$key]) ? $qtys[$key] : 1;
                    $order->orderDetails()->create([
                        'product_id' => $id,
                        'qty' => $qty
                    ]);                                
                };   
    
                return $order->id;
            }
        }

        //bikin entry baru kalau order user sebelumnya sudah masuk ke pembayaran
        $order = Order::create([
            'user_id' => $data['user_id'],
            'total_amount' => $data['total_amount'],
            'status' => 'pending'
        ]);

        foreach ($ids as $key => $id) {
            $qty = isset($qtys[$key]) ? $qtys[$key] : 1;
            $order->orderDetails()->create([
                'product_id' => $id,
                'qty' => $qty
            ]);                                
        };                     
        return $order->id;
    }

    public function storeOrder(OrderDetailsRequest $request)
    {
        $data = $request->validated();
        OrderDetails::create($data);
    }

       
}
