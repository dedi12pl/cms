<?php

namespace App\Http\Controllers;

use App\Models\LayananModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;

class LayananController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = [
            'title' => 'Layanan',
            'menu' => 'Layanan',
            'submenu' => '',
        ];

        if ($request->ajax()) {
            if (auth()->user()->level == 1) {
                $data = LayananModel::join('penyelenggara', 'penyelenggara.kd_penyelenggara', '=', 'layanan.kd_penyelenggara')->get();
            } elseif (auth()->user()->level == 2) {
                $data = LayananModel::where('kd_penyelenggara', auth()->user()->kd_penyelenggara)->get();
            } else {
                $data = null;
            }

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

        return view('layanan.index', $data);
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
        $kd = auth()->user()->kd_penyelenggara;

        $request->validate([
            'nama_layanan' => 'required|string|max:255',
        ]);

        $save = LayananModel::updateOrCreate(
            [
                'id' => $request->id,
            ],
            [
                'kd_penyelenggara'   => $kd,
                'nama_layanan'       => ucwords($request->nama_layanan),
            ]
        );

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
     * @param  \App\Models\LayananModel  $layananModel
     * @return \Illuminate\Http\Response
     */
    public function show(LayananModel $layananModel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\LayananModel  $layananModel
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $row = LayananModel::find($id);
        return response()->json($row);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\LayananModel  $layananModel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LayananModel $layananModel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LayananModel  $layananModel
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        LayananModel::where('id', '=', $id)->delete();

        return response()->json(['success' => 'Book deleted successfully.']);
    }
}
