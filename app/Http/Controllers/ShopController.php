<?php

namespace App\Http\Controllers;


use App\Menu;
use Illuminate\Http\Request;

use Cart;
use File;
use DataTables;

class ShopController extends Controller
{
    
    public function shop(){
        $menu = Menu::all();
        return view('custompage/shop/index',compact('menu'));
    }

    public function ingredientes(){
        $ingredientes = \App\Ingredients::all();
        return view('custompage/shop/ingredientes',compact('ingredientes'));
    }

    public function addOn(){

        $addOn = \App\AddOn::all();
        return view('custompage/shop/addOn',compact('addOn'));
    }

    

    public function add($id){
        
        $menu = Menu::where('id_menu', $id)->first();
        $harga = $menu->harga;
        if(Auth::user()){
            $harga = $harga - ($harga * (10/100));
        }
        Cart::add(array(
            'id' => uniqid(), 
            'name' =>  $menu->nama,
            'price' => $harga,
            'quantity' => 1,
            'attributes' => array(
                'id_items' => $menu->id_menu,
                'option'  => 'menu',
                'file'  =>  $menu->file_menu

            )
        ));
        return redirect('ingredientes');
    }

    
    public function delete($id){
        
        Cart::remove($id);
        return redirect('checkout')->with('sukses','data berhasil di hapus');
    }

    public function addIngredientes($id){
        
        $ingredientes =  \App\Ingredients::where('id_ingredients', $id)->first();
        $harga = $ingredientes->harga;
        if(Auth::user()){
            $harga = $harga - ($harga * (10/100));
        }

        Cart::add(array(
            'id' => uniqid(), 
            'name' =>  $ingredientes->nama,
            'price' => $harga,
            'quantity' => 1,
            'attributes' => array(
                'id_items' => $ingredientes->id_ingredients,
                'option'  => 'ingredientes',
                'file'  =>  $ingredientes->file_ingredients

            )
        ));
        return response()->json([
            'status' => 'sukses',
            'pesan'=>'ingredientes berhasil Di Tambahkan'
        ]);
    }

    public function createAddOn($id){
        
        $addOn =  \App\AddOn::where('id_add_on', $id)->first();
        $harga = $addOn->harga;
        if(Auth::user()){
            $harga = $harga - ($harga * (10/100));
        }

        Cart::add(array(
            'id' => uniqid(), 
            'name' =>  $addOn->nama,
            'price' => $harga,
            'quantity' => 1,
            'attributes' => array(
                'id_items' => $addOn->id_add_on,
                'option'  => 'addon',
                'file'  =>  $addOn->file_add_on

            )
        ));
        return response()->json([
            'status' => 'sukses',
            'pesan'=>'ingredientes berhasil Di Tambahkan'
        ]);
    }
}
