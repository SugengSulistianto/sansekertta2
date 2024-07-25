<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Shipment;

class ShipmentController extends Controller
{
    public function index(){
        $shipment = Shipment::all();

        return view('admin.shipment.index', compact(['shipment']));
    }
}
