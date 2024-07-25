<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\UserDetail;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\Discount;
use Illuminate\Support\Str;
use App\Services\Midtrans\CreateSnapTokenService;
use App\Services\Midtrans\CallbackService;

class OrderController extends Controller
{
    public function addtocart(Request $req){
        $req->validate([
            'product_code' => 'required|string',
            'amount' => 'required|integer|min:1'
        ]);

        $productCode = $req->product_code;
        $amount = $req->amount;
        $user = Auth::user();

        // Cek apakah produk ada
        $product = Product::find($productCode);

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        // Cek stok produk
        if ($product->stock < $amount) {
            return response()->json(['message' => 'Insufficient stock'], 400);
        }

        // Cek apakah produk sudah ada di keranjang
        $cartItem = Cart::where('user_id', $user->id)
            ->where('product_code', $productCode)
            ->first();

        if ($cartItem) {
            // Update jumlah produk di keranjang
            $cartItem->amount += $amount;
            $cartItem->save();
        } else {
            // Tambahkan produk baru ke keranjang
            Cart::create([
                'user_id' => $user->id,
                'product_code' => $productCode,
                'amount' => $amount
            ]);
        }

        // Kurangi stok produk
        // $product->stock -= $amount;
        // $product->save();

        return response()->json(['message' => 'Product added to cart successfully'], 200);
    }

    public function deletefromcart(Request $request){
        $cartId = $request->input('id');
        $cartItem = Cart::find($cartId);

        if ($cartItem && $cartItem->user_id == Auth::id()) {
            $cartItem->delete();
            return response()->json(['success' => true, 'message' => 'Item removed from cart']);
        }

        return response()->json(['success' => false, 'message' => 'Item not found or not authorized'], 404);
    }

    public function makeorder(Request $request){
        $cartIds = $request->input('cart_ids');
        $user = Auth::user();
        $orderId = Str::uuid();
        // $discount = $user->details->point;
        // return [$request->usePoint, $discount];

        if (!empty($cartIds)) {
            // Create new order
            $order = new Order();
            $order->id = $orderId;
            $order->user_id = $user->id;
            $order->status = 'On Process';
            $order->total = 0; // Initialize total
            // $order->payment_status = 'unpaid';
            $order->save();

            $total = 0;

            foreach ($cartIds as $cartId) {
                $cartItem = Cart::find($cartId);
                if ($cartItem && $cartItem->user_id == $user->id) {
                    // Add cart item to order items
                    $orderDetail = new OrderDetail();
                    $orderDetail->order_id = $order->id;
                    $orderDetail->product_code = $cartItem->product_code;
                    $orderDetail->amount = $cartItem->amount;
                    $orderDetail->subtotal = $cartItem->amount * $cartItem->product->price;
                    $orderDetail->save();

                    // Update total order amount
                    $total += $orderDetail->subtotal;

                    // Remove item from cart
                    $cartItem->delete();
                }
            }

            // Update order total
            $order->total = $total;
            $order->save();

            $discount = new Discount;
            $discount->order_id = $order->id;
            $discount->discount = $user->details->point == 0 ? 0 : $user->details->point;
            $discount->discount_origin = "From User Point";
            $discount->save();

            $udetail = UserDetail::where('user_id',$user->id)->first();
            $udetail->point = 0;
            $udetail->save();


            return response()->json(['success' => true, 'message' => 'Order placed successfully']);
        }

        return response()->json(['success' => false, 'message' => 'No items selected'], 400);
    }

    public function payorder(Request $req){
        $order = Order::findOrFail($req->order_id);
        $snapToken = $order->snap_token;
        if (is_null($snapToken)) {    
            $midtrans = new CreateSnapTokenService($order);
            $snapToken = $midtrans->getSnapToken();
            $order->snap_token = $snapToken;
            $order->save();
        }
        return response()->json(['order' => $order,'snapToken' => $snapToken]);
    }
}
