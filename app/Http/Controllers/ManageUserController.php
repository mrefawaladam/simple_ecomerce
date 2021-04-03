<?php

namespace App\Http\Controllers;

use App\User;
use App\UserDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use DataTables;

class ManageUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   

        if ($request->ajax()) {

            $data = DB::table('users')
                    ->join('tb_users_detail', 'users.id', '=', 'tb_users_detail.users_id')
                    ->where('users.role',1)
                    ->get();

            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){

                            $btn='
                            <div class="dropdown">
                            <button type="button" class="btn btn-sm dropdown-toggle hide-arrow waves-effect waves-float waves-light" data-toggle="dropdown" aria-expanded="false">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-vertical"><circle cx="12" cy="12" r="1"></circle><circle cx="12" cy="5" r="1"></circle><circle cx="12" cy="19" r="1"></circle></svg>
                            </button>
                            <div class="dropdown-menu" style="">
                                <a class="dropdown-item editData" data-id="'.$row->id.'"  href="javascript:void(0);">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2 mr-50"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg>
                                    <span>Edit</span>
                                </a>
                                <a class="dropdown-item deleteData"  data-id="'.$row->id.'"  href="javascript:void(0);">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash mr-50"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
                                    <span>Delete</span>
                                </a>
                            </div>
                            </div>
                            ';
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            
        }

        return view('dashboard/content/admin/manageUser/index');

    }


    public function store(Request $request)
    {
        if( $request->data_id){

            if($request->password){
                User::where('id',$request->data_id)->update([
                    'name' => $request->nama,
                    'password' => bcrypt('PW'.$request->password),
                    'email' => $request->email,
                ]);
                UserDetail::where('users_id',$request->data_id)->update([
                    'alamat' => $request->alamat,
                    'nomor_hp' => $request->nomor_hp,
                    'kode_pos' => $request->kode_pos,
                    'jenis_klamin' => $request->jenis_klamin
                ]);
            }else{
                User::where('id',$request->data_id)->update([
                    'name' => $request->nama,
                    'email' => $request->email,
                ]);
                UserDetail::where('users_id',$request->data_id)->update([
                    'alamat' => $request->alamat,
                    'nomor_hp' => $request->nomor_hp,
                    'kode_pos' => $request->kode_pos,
                    'jenis_klamin' => $request->jenis_klamin
                ]);
            }
            return response()->json([
                'status' => 'sukses',
                'pesan'=>'Data berhasil Di ubah'
            ]);
        }else{
    
            $users =  User::create([
                'name' => $request->nama,
                'email' => $request->email,
                'password' => bcrypt('PW'.$request->email),
                'role' => 1
            ]);
    
            UserDetail::create([
                'users_id' => $users->id,
                'alamat' => $request->alamat,
                'nomor_hp' => $request->nomor_hp,
                'kode_pos' => $request->kode_pos,
                'jenis_klamin' => $request->jenis_klamin
            ]);
    
            return response()->json([
                'status' => 'sukses',
                'pesan'=>'Data berhasil Ditambahkan'
            ]);
        }
    
    }





    public function edit($id)
    {
        $data = DB::table('users')
        ->join('tb_users_detail', 'users.id', '=', 'tb_users_detail.users_id')
        ->where('users.id',$id)
        ->first();

        return response()->json($data);
    }

  
    public function destroy($id)
    {
        User::where('id',$id)->delete();
        UserDetail::where('users_id',$id)->delete();
        
        return response()->json([
            'status' => 'sukses',
            'pesan'=>'Data berhasil Di Hapus'
        ]);

    }
}
