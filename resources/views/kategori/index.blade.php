@extends('index') @section('title', 'kategori') @section('content')

{{-- modal tambah kategori --}}
<div class="d-flex justify-content-end mt-5">
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Tambah Kategori
    </button>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ url('/kategori') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Kategori</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3 row">
                        <label for="nama" class="col-form-label">Kategori</label>
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
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- akhir modal tambah kategori --}}

<table class="table mt-5">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nama</th>
            <th scope="col">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($kategori as $item)
            <tr>
                <th scope="row"> 
                    <i class="bi bi-check2"></i>
                </th>
                <td>{{$item->nama}}</td>
                <td>
                    <div class="d-flex">

                        {{-- modal update kategori --}}
                        <div class="d-flex justify-content-end">
                            <button type="button" class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#exampleModal-{{$item->id}}">
                                Update kategori
                            </button>
                        </div>

                        <div class="modal fade" id="exampleModal-{{$item->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form action="{{ url('/kategori/'.$item->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">kategori</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3 row">
                                                <label for="nama" class="col-form-label">Kategori</label>
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
                        <form action='/kategori/{{$item->id}}/delete' method="POST"  onsubmit="return confirm('Apakah anda yakin akan menghapus data ini ?')">
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