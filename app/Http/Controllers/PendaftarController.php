<?php

namespace App\Http\Controllers;

use App\Models\PendaftarModel;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class PendaftarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = [
            'title' => 'Pendaftar',
            'menu' => 'Pendaftar',
            'submenu' => '',
        ];

        if ($request->ajax()) {
            $data = PendaftarModel::all();
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PendaftarModel  $pendaftarModel
     * @return \Illuminate\Http\Response
     */
    public function show(PendaftarModel $pendaftarModel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PendaftarModel  $pendaftarModel
     * @return \Illuminate\Http\Response
     */
    public function edit(PendaftarModel $pendaftarModel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PendaftarModel  $pendaftarModel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PendaftarModel $pendaftarModel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PendaftarModel  $pendaftarModel
     * @return \Illuminate\Http\Response
     */
    public function destroy(PendaftarModel $pendaftarModel)
    {
        //
    }
}
