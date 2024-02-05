<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Kategori;
use App\Models\Laporan;

class KategoriController extends Controller
{
    public function index()
    {
        $kategori = Kategori::all();
        return view('kategori.index', compact('kategori'));
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|max:255',
        ], 
        [
            'nama.required' => 'Nama kategori wajib diisi',
            'nama.max' => 'Nama maksimal 255 karakter'
        ]); 

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $validatedData = $validator->validated();

        $kategori = Kategori::create($validatedData);

        if($kategori) {
            Laporan::create(['kategori_id' => $kategori->id]);
            
        }

        return redirect('/kategori')->with('success', 'Tambah kategori berhasil...!');

    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|max:255',
        ], 
        [
            'nama.required' => 'Nama kategori wajib diisi',
            'nama.max' => 'Nama maksimal 255 karakter'
        ]); 

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $validatedData = $validator->validated();

        Kategori::whereId($id)->update($validatedData);

        return redirect('/kategori')->with('success', 'Update kategori berhasil...!');
    }

    public function destroy($id)
    {
        $kategori = Kategori::findOrFail($id);
        $kategori->delete();

        // menghapus data laporan
        if($kategori) {
            
            Laporan::where('kategori_id', $id)->delete();
            
        }

        return redirect('/kategori')->with('success', 'Delete kategori berhasil...!');
    }
}
