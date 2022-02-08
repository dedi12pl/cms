<?php

namespace App\Http\Controllers;

use App\Models\PenyelenggaraModel;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Hash;

class PenyelenggaraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = [
            'title' => 'Penyelenggara',
            'menu' => 'Penyelenggara',
            'submenu' => '',
        ];

        if ($request->ajax()) {
            $data = PenyelenggaraModel::join('users', 'penyelenggara.kd_penyelenggara', '=', 'users.kd_penyelenggara')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->kd_penyelenggara . '" data-original-title="Edit" class="edit"><i class="far fa-edit fs-2 text-info"></i></a>';

                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->kd_penyelenggara . '" data-original-title="Delete" class="delete"><i class="far fa-trash-alt fs-2 text-danger"></i></a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('penyelenggara.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    private function _generateKodePenyelenggara()
    {
        $kd = 'U';
        $tanggal = date('dmy');
        $tahun = date('Y');
        $no_urut = (int) 1;

        // hitung jumlah permohonan
        $penyelenggara = PenyelenggaraModel::select('kd_penyelenggara')->whereYear('created_at', $tahun)->orderBy('created_at', 'desc')->first();

        if ($penyelenggara !== NULL) {

            $no_urut = (int) substr($penyelenggara->kd_penyelenggara, -4) + 1;
        }

        $no_urut = str_pad($no_urut, 4, '0', STR_PAD_LEFT);

        $kd_penyelenggara = $kd . $tanggal . $no_urut;

        return $kd_penyelenggara;
    }

    public function store(Request $request)
    {
        $kd = $this->_generateKodePenyelenggara();

        $validate = $request->validate([
            'nama_penyelenggara' => 'required',
            'alamat_penyelenggara' => 'required',
            // 'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8'
        ]);

        $save = PenyelenggaraModel::create([
            'kd_penyelenggara'         => $kd,
            'nama_penyelenggara'       => ucwords($request->nama_penyelenggara),
            'alamat_penyelenggara'     => ucwords($request->alamat_penyelenggara),
        ]);

        $save_user = User::create([
            'kd_penyelenggara' => $kd,
            'name'             => ucwords($request->nama_penyelenggara),
            'email'            => $request->email,
            'password'         => Hash::make($request->password),
            'level'            => 2
        ]);

        if ($save) {
            return response()->json($response = [
                'status' => 'success',
            ]);
        } else {
            return response()->json($response = [
                'status' => 'error',
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($kd_penyelenggara)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($kd_penyelenggara)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($kd_penyelenggara)
    {
        PenyelenggaraModel::where('kd_penyelenggara', '=', $kd_penyelenggara)->delete();
        User::where('kd_penyelenggara', '=', $kd_penyelenggara)->delete();

        return response()->json(['success' => 'Book deleted successfully.']);
    }
}
