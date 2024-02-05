<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Coa;
use App\Models\Kategori;

class CoaController extends Controller
{
    public function index()
    {
        $coa = Coa::all();
        $kategori = Kategori::all();
        return view('Coa.index')
            ->with('coa', $coa)
            ->with('kategori', $kategori);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kode' => 'required|unique:coa,kode',
            'nama' => 'required|max:255',
            'kategori_id' => 'required',
        ], [
            'kode.required' => 'Kode Coa wajib diisi',
            'kode.unique' => 'Kode Coa sudah pernah digunakan',
            'nama.required' => 'Nama Coa wajib diisi',
            'nama.max' => 'Nama maksimal 255 karakter',           
            'kategori_id.required' => 'Kategori Coa wajib diisi',
        ]);
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        $validatedData = $validator->validated();

        Coa::create($validatedData);

        return redirect('/coa')->with('success', 'Tambah Coa berhasil...!');

    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'kode' => 'required',
            'nama' => 'required|max:255',
            'kategori_id' => 'required',
        ], [
            'kode.required' => 'Kode Coa wajib diisi',           
            'nama.required' => 'Nama Coa wajib diisi',
            'nama.max' => 'Nama maksimal 255 karakter',           
            'kategori_id.required' => 'Kategori Coa wajib diisi',
        ]);
        
       
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $validatedData = $validator->validated();

        Coa::whereId($id)->update($validatedData);

        return redirect('/coa')->with('success', 'Update Coa berhasil...!');
    }

    public function destroy($id)
    {
        $coa = Coa::findOrFail($id);
        $coa->delete();
    
        return redirect('/coa')->with('success', 'Delete Coa berhasil...!');
    }
    
}
