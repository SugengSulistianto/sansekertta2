<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Shipment;
use App\Services\Midtrans\CreateSnapTokenService;
use App\Services\Midtrans\CallbackService;
use App\Models\StoreInfo;

class OrderController extends Controller
{
    public function index(){
        $order = Order::all();

        return view('admin.order.index', compact(['order']));
    }

    public function detail($id){
        $order = Order::findOrFail($id);
        $storeinfo = StoreInfo::find(1);

        return view('admin.order.detail', compact(['order', 'storeinfo']));
    }

    public function verif(Request $req){
        $order = Order::findOrFail($req->order_id);
        $order->isVerified = true;
        
        if(!is_null($req->resi)){
            $shipment = Shipment::find($order->shipment->id);
            $shipment->resi = $req->resi;
            $shipment->shipment_status = 'ONDELIVERY';

            $shipment->save();
        }        
        $order->save();

        $snapToken = $order->snap_token;
        if (is_null($snapToken)) {    
            $midtrans = new CreateSnapTokenService($order);
            $snapToken = $midtrans->getSnapToken();
            $order->snap_token = $snapToken;
        }
        $order->save();
        
        return redirect()->route('admin.order.index');
    }

    public function delete($id){
        $order = Order::findOrFail($id);
        if($order){
            Order::destroy($id);
        }
        
        return redirect()->route('admin.order.index');
    }
}
