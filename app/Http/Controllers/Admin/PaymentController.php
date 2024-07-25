<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class PaymentController extends Controller
{
    public function index(){
        $payment = Order::all();

        return view('admin.payment.index', compact(['payment']));
    }
}
