<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cart;
use App\AlamatOrder;


class CheckoutController extends Controller
{
   
    public function index(){

        $subtotal = Cart::getSubTotal();
        $cart =   Cart::getContent();
        return view('custompage/shop/checkout',compact('cart','subtotal'));
    }

    
    public function alamatbaru(Request $request)
    {
        $cart =   Cart::getContent();
        $subtotal = Cart::getSubTotal();
        $alamat = AlamatOrder::create([
            'name' => $request->nama,
            'alamat' => $request->alamat,
            'email' => $request->email,
            'nomor_hp' => $request->nomor_hp,
            'kode_pos' => $request->kode_pos,
            'jenis_klamin' => $request->jenis_klamin
        ]);
           
        $transaksi =  \App\Transaksi::create([
            'alamat_order_id' => $alamat->id,
            'users_id' => 0,
            'total' => $subtotal,
            'kode_transaksi' => 'KD'.date('ymds'),
            'status' => 'proses',
        ]);

        foreach($cart as $c){
            if($c->attributes->option == "menu")
            {
                \App\OrderMenu::create([
                    'transaksi_id' =>  $transaksi->id,
                    'menu_id' =>  $c->attributes->id_items
                ]);
            }else if($c->attributes->option == "addon")
            {
                \App\OrderAddOn::create([
                    'transaksi_id' =>$transaksi->id,
                    'add_on_id' =>  $c->attributes->id_items
                ]);
            }else{
                \App\OrderIngredients::create([
                    'transaksi_id' =>  $transaksi->id,
                    'ingredients_id' =>  $c->attributes->id_items
                ]);
            }
        }
        Cart::clear();
        return redirect()->back()->with('sukses','data berhasil di Registrasi lakukan login');
    }

}
