<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\Transaksi;
use App\Models\Coa;
use App\Models\Laporan;

class TransaksiController extends Controller
{
    public function index()
    {
        $transaksi = Transaksi::all();
        $coa = Coa::all();
        return view('transaksi.index')
                ->with('transaksi', $transaksi)
                ->with('coa', $coa);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'coa_id' => 'required',
            'desc'=> 'required|max:255',
            'debit' => 'required',
            'credit' => 'required',
        ], 
        [
            'coa_id.required' => 'coa_id wajib diisi',
            'desc.required' => 'desc wajib diisi',
            'debit.required' => 'Debit wajib diisi',
            'credit.required' => 'Credit wajib diisi',
            
        ]); 

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // get data kategory id dari coa_id
        $coa = Coa::find($request->coa_id);
        $kategoriCoaId = $coa->kategori->id;

        if($kategoriCoaId) {
            // mengupdate data laporan
            Laporan::where('kategori_id', $kategoriCoaId)->increment('total', $request->debit - $request->credit);
        }       

        $validatedData = $validator->validated();

        Transaksi::create($validatedData);

        return redirect('/transaksi')->with('success', 'Tambah transaksi berhasil...!');

    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'coa_id' => 'required',
            'desc'=> 'required|max:255',
            'debit' => 'required',
            'credit' => 'required',
        ], 
        [
            'coa_id.required' => 'coa_id wajib diisi',
            'desc.required' => 'desc wajib diisi',
            'debit.required' => 'Debit wajib diisi',
            'credit.required' => 'Credit wajib diisi',
            
        ]); 

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

         // get data kategory id dari coa_id
         $coa = Coa::find($request->coa_id);
         $kategoriCoaId = $coa->kategori->id;
 
         if($kategoriCoaId) {
            
            Laporan::where('kategori_id', $kategoriCoaId)->update(['total' => $request->debit - $request->credit]);
           
         }     

        $validatedData = $validator->validated();

        Transaksi::whereId($id)->update($validatedData);

        return redirect('/transaksi')->with('success', 'Update transaksi berhasil...!');
    }

    public function destroy($id)
    {
        $transaksi = Transaksi::findOrFail($id);

        // get data coa dari id
        $coa = Coa::find($transaksi->coa_id);
        $kategoriCoaId = $coa->kategori->id;


        if($transaksi) {

            $transaksi->delete();

            Laporan::where('kategori_id', $kategoriCoaId)->decrement('total', $transaksi->debit - $transaksi->credit);
        }
          

        return redirect('/transaksi')->with('success', 'Delete transaksi berhasil...!');
    }

    // laporan
    public function laporan()
    {
        $laporan = Laporan::all();
        $totalPerBulanPerKategori = Laporan::selectRaw('kategori_id,
            SUM(CASE WHEN EXTRACT(MONTH FROM created_at) = 1 THEN total ELSE 0 END) AS jan,
            SUM(CASE WHEN EXTRACT(MONTH FROM created_at) = 2 THEN total ELSE 0 END) AS feb,
            SUM(CASE WHEN EXTRACT(MONTH FROM created_at) = 3 THEN total ELSE 0 END) AS mar,
            SUM(CASE WHEN EXTRACT(MONTH FROM created_at) = 4 THEN total ELSE 0 END) AS apr,
            SUM(CASE WHEN EXTRACT(MONTH FROM created_at) = 5 THEN total ELSE 0 END) AS mei,
            SUM(CASE WHEN EXTRACT(MONTH FROM created_at) = 6 THEN total ELSE 0 END) AS juni,
            SUM(CASE WHEN EXTRACT(MONTH FROM created_at) = 7 THEN total ELSE 0 END) AS juli,
            SUM(CASE WHEN EXTRACT(MONTH FROM created_at) = 8 THEN total ELSE 0 END) AS agus,
            SUM(CASE WHEN EXTRACT(MONTH FROM created_at) = 9 THEN total ELSE 0 END) AS sep,
            SUM(CASE WHEN EXTRACT(MONTH FROM created_at) = 10 THEN total ELSE 0 END) AS okt,
            SUM(CASE WHEN EXTRACT(MONTH FROM created_at) = 11 THEN total ELSE 0 END) AS nov,
            SUM(CASE WHEN EXTRACT(MONTH FROM created_at) = 12 THEN total ELSE 0 END) AS des')
        ->groupBy('kategori_id')
        ->orderBy('kategori_id')
        ->get();

        $totalIncome = Laporan::whereIn('kategori_id', [1, 2])
        ->selectRaw('
            SUM(CASE WHEN EXTRACT(MONTH FROM created_at) = 1 THEN total ELSE 0 END) AS jan_income,
            SUM(CASE WHEN EXTRACT(MONTH FROM created_at) = 2 THEN total ELSE 0 END) AS feb_income,
            SUM(CASE WHEN EXTRACT(MONTH FROM created_at) = 3 THEN total ELSE 0 END) AS mar_income,
            SUM(CASE WHEN EXTRACT(MONTH FROM created_at) = 4 THEN total ELSE 0 END) AS apr_income,
            SUM(CASE WHEN EXTRACT(MONTH FROM created_at) = 5 THEN total ELSE 0 END) AS mei_income,
            SUM(CASE WHEN EXTRACT(MONTH FROM created_at) = 6 THEN total ELSE 0 END) AS jun_income,
            SUM(CASE WHEN EXTRACT(MONTH FROM created_at) = 7 THEN total ELSE 0 END) AS jul_income,
            SUM(CASE WHEN EXTRACT(MONTH FROM created_at) = 8 THEN total ELSE 0 END) AS agu_income,
            SUM(CASE WHEN EXTRACT(MONTH FROM created_at) = 9 THEN total ELSE 0 END) AS sep_income,
            SUM(CASE WHEN EXTRACT(MONTH FROM created_at) = 10 THEN total ELSE 0 END) AS okt_income,
            SUM(CASE WHEN EXTRACT(MONTH FROM created_at) = 11 THEN total ELSE 0 END) AS nov_income,
            SUM(CASE WHEN EXTRACT(MONTH FROM created_at) = 12 THEN total ELSE 0 END) AS des_income')
        ->first();

        $totalExpense = Laporan::whereIn('kategori_id', [3, 4, 5])
            ->selectRaw('
                SUM(CASE WHEN EXTRACT(MONTH FROM created_at) = 1 THEN total ELSE 0 END) AS jan_expense,
                SUM(CASE WHEN EXTRACT(MONTH FROM created_at) = 2 THEN total ELSE 0 END) AS feb_expense,
                SUM(CASE WHEN EXTRACT(MONTH FROM created_at) = 3 THEN total ELSE 0 END) AS mar_expense,
                SUM(CASE WHEN EXTRACT(MONTH FROM created_at) = 4 THEN total ELSE 0 END) AS apr_expense,
                SUM(CASE WHEN EXTRACT(MONTH FROM created_at) = 5 THEN total ELSE 0 END) AS mei_expense,
                SUM(CASE WHEN EXTRACT(MONTH FROM created_at) = 6 THEN total ELSE 0 END) AS jun_expense,
                SUM(CASE WHEN EXTRACT(MONTH FROM created_at) = 7 THEN total ELSE 0 END) AS jul_expense,
                SUM(CASE WHEN EXTRACT(MONTH FROM created_at) = 8 THEN total ELSE 0 END) AS agu_expense,
                SUM(CASE WHEN EXTRACT(MONTH FROM created_at) = 9 THEN total ELSE 0 END) AS sep_expense,
                SUM(CASE WHEN EXTRACT(MONTH FROM created_at) = 10 THEN total ELSE 0 END) AS okt_expense,
                SUM(CASE WHEN EXTRACT(MONTH FROM created_at) = 11 THEN total ELSE 0 END) AS nov_expense,
                SUM(CASE WHEN EXTRACT(MONTH FROM created_at) = 12 THEN total ELSE 0 END) AS des_expense')
            ->first();

        $netIncome = [
            'jan' => $totalIncome->jan_income - $totalExpense->jan_expense,
            'feb' => $totalIncome->feb_income - $totalExpense->feb_expense,
            'mar' => $totalIncome->mar_income - $totalExpense->mar_expense,
            'apr' => $totalIncome->apr_income - $totalExpense->apr_expense,
            'mei' => $totalIncome->mei_income - $totalExpense->mei_expense,
            'jun' => $totalIncome->jun_income - $totalExpense->jun_expense,
            'jul' => $totalIncome->jul_income - $totalExpense->jul_expense,
            'agu' => $totalIncome->agu_income - $totalExpense->agu_expense,
            'sep' => $totalIncome->sep_income - $totalExpense->sep_expense,
            'okt' => $totalIncome->okt_income - $totalExpense->okt_expense,
            'nov' => $totalIncome->nov_income - $totalExpense->nov_expense,
            'des' => $totalIncome->des_income - $totalExpense->des_expense,
        ];

        return view('laporan.index')
            ->with('totalPerBulanPerKategori', $totalPerBulanPerKategori)
            ->with('totalIncome', $totalIncome)
            ->with('totalExpense', $totalExpense)
            ->with('netIncome', $netIncome);
    }
    
    
}

