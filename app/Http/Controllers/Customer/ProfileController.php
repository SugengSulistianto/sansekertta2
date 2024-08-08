<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Order;
use App\Models\UserDetail;
use Illuminate\Support\Facades\Hash;
use File;

class ProfileController extends Controller
{
    public function __construct(){
        $this->middleware(['auth','verified']);
    }

    public function profile(){
        if(Auth::user()->hasRole('admin') || Auth::user()->hasRole('store')){
            return redirect()->route('dashboard');
        }
        // return $province;
        $user = Auth::user()->id;
        $user = User::findOrFail($user);
        $payment = Order::where('user_id', $user->id)->where('isVerified', 1)->get();

        return view('customerprofile', compact(['user', 'payment']));
    }

    public function updateprofile(Request $req){
        $user = User::findOrFail($req->id);
        $user->name = $req->name;

        if(!empty($req->email)){
            $user->email = $req->email;
        }
        
        if(!empty($req->password)){
            $user->password = Hash::make($req->password);
        }
        $user->save();

        $detail = UserDetail::where('user_id', $user->id)->first();

        if(!$detail){
            $detail = new UserDetail;
            $detail->user_id = $user->id;
        }
        if($req->file('photo')){
            if(File::exists('image/photo-customer/' . $detail->photo)) {
                File::delete('image/photo-customer/' . $detail->photo);
            }

            $validatedData = $req->validate([
                'photo' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            ]);

            $foto = $req->file('photo')->getClientOriginalName();
            $path = $req->file('photo')->move('image/photo-customer/' , $foto);
            $detail->photo = $foto;
        }

        $detail->province = $req->province_name;
        $detail->province_code = $req->province;
        $detail->city = $req->city_name;
        $detail->city_code = $req->city;
        $detail->phone = $req->phone;
        $detail->postal_code = $req->postal_code;
        $detail->detail_address = $req->detail_address;
        $detail->gender = $req->gender;
        $detail->save();
        
        return redirect()->route('profile.customer');
    }
}
