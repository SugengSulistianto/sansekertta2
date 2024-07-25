<?php
 
namespace App\Services\Midtrans;
 
use Midtrans\Snap;
use App\Models\Order;
 
class CreateSnapTokenService extends Midtrans
{
    protected $order;
 
    public function __construct($order)
    {
        parent::__construct();
 
        $this->order = Order::find($order->id);
    }
 
    public function getSnapToken()
    {
        
        $item_details = array();
        foreach($this->order->details as $d){
            array_push($item_details, array(
                'id' => $d->id,
                'price' => $d->product->price,
                'quantity' => $d->amount,
                'name' => substr($d->product->name, 0, 10),
            ));
        }
        array_push($item_details, array(
            'id' => "SHP-" . $this->order->shipment->id,
            'price' => $this->order->shipment->price,
            'quantity' => 1,
            'name' => $this->order->shipment->courier . "-" . $this->order->shipment->service,
        ));
        foreach($this->order->discounts as $d){
            array_push($item_details, array(
                'id' => "Discount",
                'price' => 0-intval($d->discount),
                'quantity' => 1,
                'name' => $d->discount_origin,
            ));
        }
        
        $params = [
            'transaction_details' => [
                'order_id' => $this->order->id,
                'gross_amount' => intval($this->order->total) + intval($this->order->shipment->price),
            ],
            'item_details' => $item_details,
            'customer_details' => [
                'first_name' => $this->order->user->name,
                'email' => $this->order->user->email,
                'phone' => $this->order->user->details->phone,
            ]
        ];
        // return $params;
 
        $snapToken = Snap::getSnapToken($params);
 
        return $snapToken;
    }
}