<?php

namespace App\Http\Controllers;

use App\Models\LayananModel;
use App\Models\PersyaratanModel;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class PersyaratanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $layanan = LayananModel::where('layanan.kd_penyelenggara', auth()->user()->kd_penyelenggara)->get();
        $data = [
            'title' => 'Persyaratan',
            'menu' => 'Persyaratan',
            'layanan' => $layanan,
            'submenu' => '',
        ];

        if ($request->ajax()) {
            $data = PersyaratanModel::join('penyelenggara', 'penyelenggara.kd_penyelenggara', '=', 'persyaratan.kd_penyelenggara')
                ->join('layanan', 'layanan.id', '=', 'persyaratan.id_layanan')
                ->where('persyaratan.kd_penyelenggara', auth()->user()->kd_penyelenggara)->get();

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit"><i class="far fa-edit fs-2 text-info"></i></a>';

                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="delete"><i class="far fa-trash-alt fs-2 text-danger"></i></a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('persyaratan.index', $data);
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PersyaratanModel  $persyaratanModel
     * @return \Illuminate\Http\Response
     */
    public function show(PersyaratanModel $persyaratanModel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PersyaratanModel  $persyaratanModel
     * @return \Illuminate\Http\Response
     */
    public function edit(PersyaratanModel $persyaratanModel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PersyaratanModel  $persyaratanModel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PersyaratanModel $persyaratanModel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PersyaratanModel  $persyaratanModel
     * @return \Illuminate\Http\Response
     */
    public function destroy(PersyaratanModel $persyaratanModel)
    {
        //
    }
}
