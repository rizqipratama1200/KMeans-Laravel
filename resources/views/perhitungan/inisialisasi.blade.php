@extends('layouts.master')

@section('title', 'Inisialisasi')

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    {{-- <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Inisialisasi Awal</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    </div> --}}

    <div class="container-md">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h3 style="color: black" class="text-center">Inisialisasi Awal
                            <button type="button" class="btn btn-circle btn-sm btn-outline-info" data-bs-toggle="modal" data-bs-target="#infoData">
                                <i class="fas fa-info fa-fw"></i>
                            </button>
                        </h3>
                    </div>
                    <div class="card-body">
                        <form action="/proses" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Data yang Digunakan (baca info)</label>
                                <select id="inputState" class="form-select @error('atribut') is-invalid @enderror" name="atribut">
                                    <option selected disabled>Pilih Data</option>
                                    <option value="9">Data 9 Atribut</option>
                                    <option value="6">Data 6 Atribut</option>
                                    <option value="3">Data 3 Atribut</option>
                                </select>
                                @error('atribut')
                                <div id="atribut" class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                            </div>

                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Jumlah Cluster</label>
                                <select id="inputState" class="form-select @error('jumlah_cluster') is-invalid @enderror" name="jumlah_cluster">
                                    <option selected disabled>Pilih Jumlah Cluster</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                                @error('jumlah_cluster')
                                <div id="jumlah_cluster" class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                            </div>

                            <div class="mb-3 d-grid gap-2">
                                <button type="submit" class="btn btn-success" >Proses</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Info-->
    <div class="modal fade" id="infoData" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel" style="color: black">Info Dataset yang Digunakan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="color: black">
                    <p class="mb-4">Dataset yang dapat digunakan berasal dari dataset yang sama,
                        yang membedakan hanya jumlah atribut yang digunakan, adapun jumlah atribut
                        yang dapat digunakan, yaitu :
                    </p>
                    <p>1. Data 9 Atribut : Atribut dari data yang digunakan terdiri dari a1, a2, a3,
                        a4, a5, a6, a7, a8, dan a9
                    </p>
                    <p>2. Data 6 Atribut : Atribut dari data yang digunakan terdiri dari a1, a2, a3,
                        a4, a5, dan a6
                    </p>
                    <p>3. Data 3 Atribut : Atribut dari data yang digunakan terdiri dari a7, a8, dan a9
                    </p>
                    <p>*untuk penjelas atribut dapat dilihat pada info di menu dataset</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
