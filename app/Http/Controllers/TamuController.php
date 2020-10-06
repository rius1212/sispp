<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Tamu;


class TamuController extends Controller
{
    public function index()
    {
        $tamus = Tamu::latest()->get();
        return response([
            'success' => true,
            'message' => 'List Semua Tamu',
            'data' => $tamus
        ], 200);
    }

    public function store(Request $request)
    {
        //validate data
        $validator = Validator::make($request->all(), [
            'nama'     => 'required',
            'asal'   => 'required',
            'nohp'   => 'required',
        ],
            [
                'nama.required' => 'Masukkan nama Tamu !',
                'asal.required' => 'Masukkan asal Tamu !',
                'nohp.required' => 'Masukkan nohp Tamu !',
            ]
        );

        if($validator->fails()) {

            return response()->json([
                'success' => false,
                'message' => 'Silahkan Isi Bidang Yang Kosong',
                'data'    => $validator->errors()
            ],400);

        } else {

            $tamus = Tamu::create([
                'nama'     => $request->input('nama'),
                'asal'   => $request->input('asal'),
                'nohp'   => $request->input('nohp')
            ]);


            if ($tamus) {
                return response()->json([
                    'success' => true,
                    'message' => 'Tamu Berhasil Disimpan!',
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Tamu Gagal Disimpan!',
                ], 400);
            }
        }
    }


    public function show($id)
    {
        $tamus = Tamu::whereId($id)->first();

        if ($tamus) {
            return response()->json([
                'success' => true,
                'message' => 'Detail tamu!',
                'data'    => $tamus
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Tamu Tidak Ditemukan!',
                'data'    => ''
            ], 404);
        }
    }

    public function update(Request $request)
    {
        //validate data
        $validator = Validator::make($request->all(), [
            'nama'     => 'required',
            'asal'   => 'required',
            'nohp'   => 'required',
        ],
            [
                'nama.required' => 'Masukkan nama Tamu !',
                'asal.required' => 'Masukkan asal Tamu !',
                'nohp.required' => 'Masukkan nohp Tamu !',
            ]
        );

        if($validator->fails()) {

            return response()->json([
                'success' => false,
                'message' => 'Silahkan Isi Bidang Yang Kosong',
                'data'    => $validator->errors()
            ],400);

        } else {

            $tamus = Tamu::whereId($request->input('id'))->update([
                'nama'   => $request->input('nama'),
                'asal'   => $request->input('asal'),
                'nohp'   => $request->input('nohp')
            ]);


            if ($tamus) {
                return response()->json([
                    'success' => true,
                    'message' => 'Tamu Berhasil Diupdate!',
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Tamu Gagal Diupdate!',
                ], 500);
            }

        }

    }

    public function destroy($id)
    {
        $tamus = Tamu::findOrFail($id);
        $tamus->delete();

        if ($tamus) {
            return response()->json([
                'success' => true,
                'message' => 'Tamu Berhasil Dihapus!',
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Tamu Gagal Dihapus!',
            ], 500);
        }

    }
}
