<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Transaksi;

class TransaksiController extends Controller
{
    public function index(){

        // $addOn = DB::table('tb_transaksi')
        // ->join('tb_order_addon', 'tb_transaksi.id_transaksi', '=', 'tb_order_addon.transaksi_id')
        // ->join('tb_add_on', 'tb_order_addon.add_on_id', '=', 'tb_add_on.id_add_on')

        // $menu = DB::table('tb_transaksi')
        // ->join('tb_order_ingredients', 'tb_transaksi.id_transaksi', '=', 'tb_order_ingredients.transaksi_id')
        // ->join('tb_order_menu', 'tb_transaksi.id_transaksi', '=', 'tb_order_menu.transaksi_id')
        // ->join('tb_alamat_order', 'tb_transaksi.alamat_order_id', '=', 'tb_alamat_order.id_alamat')
        // ->join('tb_ingredients', 'tb_order_ingredients.ingredients_id', '=', 'tb_ingredients.id_ingredients')
        // ->join('tb_menu', 'tb_order_menu.id_order_menu', '=', 'tb_menu.id_menu')
        // ->select(
        //     'tb_alamat_order.name as nama_user',
        //     'tb_alamat_order.email',
        //     'tb_alamat_order.nomor_hp',
        //     'tb_alamat_order.kode_pos',
        //     'tb_alamat_order.jenis_klamin',
        //     'tb_menu.nama as nama_menu',
        //     'tb_menu.nama as nama_menu',
        //     'tb_menu.nama as nama_menu',


        //         )
        // ->get();
        // dd($menu);
        $transaksi = DB::table('tb_transaksi')
                 ->join('tb_alamat_order', 'tb_transaksi.alamat_order_id', '=', 'tb_alamat_order.id_alamat')
                ->get();
        return view('custompage/shop/transaksi',compact('transaksi'));
    }

    public function kirim($id){
        Transaksi::where('id_transaksi', $id)->update([
            'status'=>'kirim'
        ]);
        return redirect()->back()->with('sukses','Status berhasil di kirim');
    }

}
