<?php

namespace App\Http\Controllers;

use App\AddOn;
use Illuminate\Http\Request;

use File;
use DataTables;
class ManageAddOnController extends Controller
{
    public function index(Request $request)
    {   

        if ($request->ajax()) {

            $data = AddOn::all();

            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){

                            $btn='
                            <div class="dropdown">
                            <button type="button" class="btn btn-sm dropdown-toggle hide-arrow waves-effect waves-float waves-light" data-toggle="dropdown" aria-expanded="false">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-vertical"><circle cx="12" cy="12" r="1"></circle><circle cx="12" cy="5" r="1"></circle><circle cx="12" cy="19" r="1"></circle></svg>
                            </button>
                            <div class="dropdown-menu" style="">
                                <a class="dropdown-item editData" data-id="'.$row->id_add_on.'"  href="javascript:void(0);">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2 mr-50"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg>
                                    <span>Edit</span>
                                </a>
                                <a class="dropdown-item deleteData"  data-id="'.$row->id_add_on.'"  href="javascript:void(0);">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash mr-50"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
                                    <span>Delete</span>
                                </a>
                            </div>
                            </div>
                            ';
                            return $btn;
                    })
                    ->addColumn('foto', function($row){
    
                        $foto = '<img src="foto/'.$row->file_add_on.'" alt="" width="50" height="50"> ';
    
                            return $foto;
                    })
                    ->rawColumns(['action','foto'])
                    ->make(true);
            
        }

        return view('dashboard/content/admin/manageMenu/addon');

    }


    public function store(Request $request)
    {
        if( $request->data_id){
            if($request->image){
                $foto = $request->file('image');
                $nama  = time()."_".$foto->getClientOriginalName();
                $lokasi = public_path('/foto');
                $foto->move($lokasi,$nama);
        
    
                AddOn::where('id_add_on', $request->data_id)->update([
                    'nama' => $request->nama,
                    'harga' => $request->harga,
                    'file_add_on' => $nama
                ]);
            }else{
                AddOn::where('id_add_on', $request->data_id)->update([
                    'nama' => $request->nama,
                    'harga' => $request->harga
                ]);
            }
            return response()->json([
                'status' => 'sukses',
                'pesan'=>'Data berhasil Di ubah'
            ]);
        }else{
            
            // file 
            $foto = $request->file('image');
            $nama  = time()."_".$foto->getClientOriginalName();
            $lokasi = public_path('/foto');
            $foto->move($lokasi,$nama);
    

            AddOn::create([
                'nama' => $request->nama,
                'harga' => $request->harga,
                'file_add_on' => $nama
            ]);
    
            return response()->json([
                'status' => 'sukses',
                'pesan'=>'Data berhasil Ditambahkan'
            ]);
        }
    
    }

    
    public function edit($id)
    {
        $data = AddOn::where('id_add_on',$id)->first();
        return response()->json($data);

    }
    public function destroy( $id)
    {
        $gambar = AddOn::where('id_add_on',$id)->first();
        File::delete('foto/'.$gambar['file_add_on']);    
        AddOn::where('id_add_on',$id)->delete();

        return response()->json([
            'status' => 'sukses',
            'pesan'=>'Data berhasil Di Hapus'
        ]);
    }
}
