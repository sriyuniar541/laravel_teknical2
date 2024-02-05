@extends('index') @section('title', 'COA') @section('content')

{{-- modal tambah Coa --}}
<div class="d-flex justify-content-end mt-5">
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Tambah COA
    </button>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ url('/coa') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">COA</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    {{-- kode --}}
                    <div class="mb-3 row">
                        <label for="kode" class="col-form-label">Kode</label>
                        <div>
                            <input
                                type="text"
                                class="form-control"
                                name="kode"
                                id="kode"
                                value="{{ old('kode') }}"
                            />
                        </div>
                    </div>

                    {{-- nama --}}
                    <div class="mb-3 row">
                        <label for="nama" class="col-form-label">Nama</label>
                        <div>
                            <input
                                type="text"
                                class="form-control"
                                name="nama"
                                id="nama"
                                value="{{ old('nama') }}"
                            />
                        </div>
                    </div>

                    {{-- kategori_id --}}
                    <div class="mb-3 row">
                        <label for="kategori_id" class="col-form-label">kategori</label>
                        <div>
                            <select 
                                class="form-select" 
                                aria-label="Default select example" 
                                name="kategori_id"
                                id="kategori_id">
                                @forelse ($kategori as $var)
                                    <option selected value={{$var->id}}>{{$var->nama}}</option>
                                @empty
                                    <option selected value="">Kategori tidak ada, silahkan input Kategori</option>
                                @endforelse
                            </select>
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
{{-- akhir modal tambah Coa --}}

<table class="table mt-5">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Kode</th>
            <th scope="col">Nama</th>
            <th scope="col">Kategori</th>
            <th scope="col">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($coa as $item)
            <tr>
                <th scope="row"> 
                    <i class="bi bi-check2"></i>
                </th>
                <td>{{$item->kode}}</td>
                <td>{{$item->nama}}</td>
                <td>{{$item->kategori->nama}}</td>
                <td>
                    <div class="d-flex">

                        {{-- modal update Coa --}}
                        <div class="d-flex justify-content-end">
                            <button type="button" class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#exampleModal-{{$item->id}}">
                                Update COA
                            </button>
                        </div>

                        <div class="modal fade" id="exampleModal-{{$item->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form action="{{ url('/coa/'.$item->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Coa</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">

                                            {{-- kode --}}
                                            <div class="mb-3 row">
                                                <label for="kode" class="col-form-label">Kode</label>
                                                <div>
                                                    <input
                                                        type="text"
                                                        class="form-control"
                                                        name="kode"
                                                        id="kode"
                                                        value="{{$item->kode}}"
                                                    />
                                                </div>
                                            </div>

                                             {{-- nama --}}
                                            <div class="mb-3 row">
                                                <label for="nama" class="col-form-label">Nama</label>
                                                <div>
                                                    <input
                                                        type="text"
                                                        class="form-control"
                                                        name="nama"
                                                        id="nama"
                                                        value="{{$item->nama}}"
                                                    />
                                                </div>
                                            </div>

                                            {{-- kategori_id --}}
                                            <div class="mb-3 row">
                                                <label for="kategori_id" class="col-form-label">kategori</label>
                                                <div>
                                                    <select 
                                                        class="form-select" 
                                                        aria-label="Default select example" 
                                                        name="kategori_id"
                                                        id="kategori_id">
                                                        @forelse ($kategori as $var)
                                                            <option selected value={{$var->id}}>{{$var->nama}}</option>
                                                        @empty
                                                            <option selected value="">Kategori tidak ada, silahkan input Kategori</option>
                                                        @endforelse
                                                    </select>
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
                        {{-- akhir modal update status --}}
                       

                        {{-- hapus --}}
                        <form action="{{'/coa/'.$item->id.'/delete' }}" method="POST" onsubmit="return confirm('Apakah anda yakin akan menghapus data ini ?')">
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