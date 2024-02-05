@extends('index') @section('title', 'Transaksi') @section('content')

{{-- modal tambah Transaksi --}}
<div class="d-flex justify-content-end mt-5">
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Tambah Transaksi
    </button>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ url('/transaksi') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Transaksi</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">                    

                    {{-- coa --}}
                    <div class="mb-3 row">
                        <label for="coa_id" class="col-form-label">COA kode/Nama</label>
                        <div>
                            <select 
                                class="form-select" 
                                aria-label="Default select example" 
                                name="coa_id"
                                id="coa_id">
                                @forelse ($coa as $var)
                                    <option selected value={{$var->id}}>{{$var->kode}}-{{$var->nama}}</option>
                                @empty
                                    <option selected value="">Coa tidak ada, silahkan input COA</option>
                                @endforelse
                            </select>
                        </div>
                    </div>

                    {{-- desc --}}
                    <div class="mb-3 row">
                        <label for="desc" class="col-form-label">Desc</label>
                        <div>
                            <input
                                type="text"
                                class="form-control"
                                name="desc"
                                id="desc"
                                value="{{ old('desc') }}"
                            />
                        </div>
                    </div>

                    {{-- debit --}}
                    <div class="mb-3 row">
                        <label for="debit" class="col-form-label">debit</label>
                        <div>
                            <input
                                type="number"
                                class="form-control"
                                name="debit"
                                id="debit"
                                value="{{ old('debit') }}"
                            />
                        </div>
                    </div>

                     {{-- credit --}}
                     <div class="mb-3 row">
                        <label for="credit" class="col-form-label">credit</label>
                        <div>
                            <input
                                type="number"
                                class="form-control"
                                name="credit"
                                id="credit"
                                value="{{ old('credit') }}"
                            />
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- akhir modal tambah Transaksi --}}

<table class="table mt-5">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Tanggal</th>
            <th scope="col">COA kode</th>
            <th scope="col">COA Nama</th>
            <th scope="col">Desc</th>
            <th scope="col">Debit</th>
            <th scope="col">Kredit</th>
            <th scope="col">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($transaksi as $item)
            <tr>
                <th scope="row"> 
                    <i class="bi bi-check2"></i>
                </th>
                <td>{{$item->created_at}}</td>
                <td>{{$item->coa->kode}}</td>
                <td>{{$item->coa->nama}}</td>
                <td>{{$item->desc}}</td>
                <td>{{$item->debit}}</td>
                <td>{{$item->credit}}</td>

                <td>
                    <div class="d-flex">

                        {{-- modal update Transaksi --}}
                        <div class="d-flex justify-content-end">
                            <button type="button" class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#exampleModal-{{$item->id}}">
                                Update Transaksi
                            </button>
                        </div>

                        <div class="modal fade" id="exampleModal-{{$item->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form action="{{ url('/transaksi/'.$item->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Transaksi</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">                    

                                            {{-- coa --}}
                                            <div class="mb-3 row">
                                                <label for="coa_id" class="col-form-label">COA kode/Nama</label>
                                                <div>
                                                    <select 
                                                        class="form-select" 
                                                        aria-label="Default select example" 
                                                        name="coa_id"
                                                        id="coa_id">
                                                        @forelse ($coa as $var)
                                                            <option selected value={{$var->id}}>{{$var->kode}}-{{$var->nama}}</option>
                                                        @empty
                                                            <option selected value="">Coa tidak ada, silahkan input COA</option>
                                                        @endforelse
                                                    </select>
                                                </div>
                                            </div>
                        
                                            {{-- desc --}}
                                            <div class="mb-3 row">
                                                <label for="desc" class="col-form-label">Desc</label>
                                                <div>
                                                    <input
                                                        type="text"
                                                        class="form-control"
                                                        name="desc"
                                                        id="desc"
                                                        value={{$item->desc}}
                                                    />
                                                </div>
                                            </div>
                        
                                            {{-- debit --}}
                                            <div class="mb-3 row">
                                                <label for="debit" class="col-form-label">debit</label>
                                                <div>
                                                    <input
                                                        type="number"
                                                        class="form-control"
                                                        name="debit"
                                                        id="debit"
                                                        value={{$item->debit}}
                                                    />
                                                </div>
                                            </div>
                        
                                             {{-- credit --}}
                                             <div class="mb-3 row">
                                                <label for="credit" class="col-form-label">credit</label>
                                                <div>
                                                    <input
                                                        type="number"
                                                        class="form-control"
                                                        name="credit"
                                                        id="credit"
                                                        value={{$item->credit}}
                                                    />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Update</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        {{-- akhir modal update Transaksi --}}
                       

                        {{-- hapus --}}
                        <form action="{{'/transaksi/'.$item->id.'/delete' }}" method="POST" onsubmit="return confirm('Apakah anda yakin akan menghapus data ini ?')">
                            @csrf
                            @method('delete')
                            <button class="btn btn-outline-danger">
                                <i class="bi bi-trash3"></i>
                                Hapus
                            </button>
                        </form>                                             
                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td scope="row" colspan="3">Data tidak ada </td>                
            </tr>            
        @endforelse
    </tbody>
</table>

@endsection