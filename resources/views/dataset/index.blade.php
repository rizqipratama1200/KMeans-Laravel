@extends('layouts.master')

@section('title', 'Dataset')

@section('content')
 <!-- Begin Page Content -->
 <div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Dataset
        <button type="button" class="btn btn-circle btn-sm btn-outline-info" data-bs-toggle="modal" data-bs-target="#infoData">
            <i class="fas fa-info fa-fw"></i>
        </button>
    </h1>
    {{-- <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Holy guacamole!</strong> You should check in on some of those fields below.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div> --}}
    {{-- <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
        For more information about DataTables, please visit the <a target="_blank"
            href="https://datatables.net">official DataTables documentation</a>.</p> --}}
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#importData">
                        <i class="fas fa-file-excel fa-fw"></i>Import Data Excel
                   </button>
                    <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#tambahData">
                        <i class="fas fa-plus fa-fw"></i>Tambah Data
                   </button>
                    <button type="button" class="btn btn-danger btn-sm " data-bs-toggle="modal" data-bs-target="#hapusDataset">
                        <i class="fas fa-exclamation-triangle fa-fw"></i>Hapus Semua Data
                    </button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Kode Siswa</th>
                            <th>JK</th>
                            <th>a1</th>
                            <th>a2</th>
                            <th>a3</th>
                            <th>a4</th>
                            <th>a5</th>
                            <th>a6</th>
                            <th>a7</th>
                            <th>a8</th>
                            <th>a9</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Kode Siswa</th>
                            <th>JK</th>
                            <th>a1</th>
                            <th>a2</th>
                            <th>a3</th>
                            <th>a4</th>
                            <th>a5</th>
                            <th>a6</th>
                            <th>a7</th>
                            <th>a8</th>
                            <th>a9</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($data as $data)
                        <tr>
                            <td>{{$data->kode_siswa}}</td>
                            <td>{{$data->jk}}</td>
                            <td>{{$data->a1}}</td>
                            <td>{{$data->a2}}</td>
                            <td>{{$data->a3}}</td>
                            <td>{{$data->a4}}</td>
                            <td>{{$data->a5}}</td>
                            <td>{{$data->a6}}</td>
                            <td>{{$data->a7}}</td>
                            <td>{{$data->a8}}</td>
                            <td>{{$data->a9}}</td>
                            <td>
                                <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editData{{$data->id}}">
                                    <i class="fas fa-edit fa-fw"></i>
                                </button>
                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#hapusData{{$data->id}}">
                                    <i class="fas fa-trash fa-fw"></i>
                                </button>
                            </td>
                        </tr>
                        <!-- Modal Ubah-->
                        <div class="modal fade" id="editData{{$data->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="staticBackdropLabel" style="color: black">Edit Data</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="/ubahdataset/{{$data->id}}" method="post" enctype="multipart/form-data">
                                    <div class="modal-body">
                                        @csrf
                                        {{-- <label for="formFile" class="form-label"></label> --}}
                                        <div class="row g-3 mb-3">
                                            <div class="col-sm">
                                            <input type="text" class="@error('kode_siswa') is-invalid @enderror form-control" name="kode_siswa" value="{{$data->kode_siswa}}" placeholder="Kode Siswa" aria-label="kode_siswa">
                                            @error('kode_siswa')
                                            <div id="kode_siswa" class="invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                            @enderror
                                        </div>

                                        <div class="col-sm">
                                                <select id="inputState" class="form-select" name="jk">
                                                    <option selected disabled>Jenis Kelamin</option>
                                                    <option value="LK">Laki-Laki</option>
                                                    <option value="PR">Perempuan</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row g-3 mb-3">
                                            <div class="col-sm">
                                            <input type="number" class="form-control" name="a1" value="{{$data->a1}}" placeholder="a1" aria-label="a1">
                                            </div>
                                            <div class="col-sm">
                                            <input type="number" class="form-control" name="a2" value="{{$data->a2}}" placeholder="a2" aria-label="a2">
                                            </div>
                                            <div class="col-sm">
                                                <input type="number" class="form-control" name="a3" value="{{$data->a3}}" placeholder="a3" aria-label="a3">
                                            </div>
                                        </div>
                                        <div class="row g-3 mb-3">
                                            <div class="col-sm">
                                            <input type="number" class="form-control" name="a4" value="{{$data->a4}}" placeholder="a4" aria-label="a4">
                                            </div>
                                            <div class="col-sm">
                                            <input type="number" class="form-control" name="a5" value="{{$data->a5}}" placeholder="a5" aria-label="a5">
                                            </div>
                                            <div class="col-sm">
                                                <input type="number" class="form-control" name="a6" value="{{$data->a6}}" placeholder="a6" aria-label="a6">
                                            </div>
                                        </div>
                                        <div class="row g-3">
                                            <div class="col-sm">
                                            <input type="number" class="form-control" name="a7" value="{{$data->a7}}" placeholder="a7" aria-label="a7">
                                            </div>
                                            <div class="col-sm">
                                            <input type="number" class="form-control" name="a8" value="{{$data->a8}}" placeholder="a8" aria-label="a8">
                                            </div>
                                            <div class="col-sm">
                                                <input type="number" class="form-control" name="a9" value="{{$data->a9}}" placeholder="a9" aria-label="a9">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-success" >Ubah</button>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- Modal Hapus-->
                        <div class="modal fade" id="hapusData{{$data->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="staticBackdropLabel" style="color: black">Anda yakin ingin menghapus data {{$data->kode_siswa}} ?</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="/hapusdata/{{$data->id}}" method="get" enctype="multipart/form-data">
                                        @csrf
                                        {{-- <label for="formFile" class="form-label"></label> --}}
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-warning" >Hapus</button>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!-- Button trigger modal -->
    </div>
    <!-- Modal Import-->
    <div class="modal fade" id="importData" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel" style="color: black">Import Data Excel</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/importdataset" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    @csrf
                    <div class="mb-3">
                        <label for="formFile" class="form-label">Masukkan File Excel.xlsx</label>
                        <input class="form-control" type="file" id="formFile" name="file" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success" >Import</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Tambah-->
    <div class="modal fade" id="tambahData" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel" style="color: black">Tambah Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/tambahdataset" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    @csrf
                    <label for="formFile" class="form-label">Data yang ditambahkan sudah ditransformasi</label>
                    <div class="row g-3 mb-3">
                        <div class="col-sm">
                          <input type="text" class="@error('kode_siswa') is-invalid @enderror form-control" name="kode_siswa" placeholder="Kode Siswa" aria-label="kode_siswa">
                            @error('kode_siswa')
                            <div id="kode_siswa" class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </div>
                            @enderror
                        </div>
                        <div class="col-sm">
                            <select id="inputState" class="form-select" name="jk">
                                <option selected disabled>Jenis Kelamin</option>
                                <option value="LK">Laki-Laki</option>
                                <option value="PR">Perempuan</option>
                            </select>
                        </div>
                    </div>
                    <div class="row g-3 mb-3">
                        <div class="col-sm">
                          <input type="number" class=" @error('a1') is-invalid @enderror form-control" name="a1" placeholder="a1" aria-label="a1">
                          @error('a1')
                          <div id="a1" class="invalid-feedback">
                              <strong>{{ $message }}</strong>
                          </div>
                          @enderror
                        </div>
                        <div class="col-sm">
                          <input type="number" class="@error('a2') is-invalid @enderror form-control" name="a2" placeholder="a2" aria-label="a2">
                          @error('a2')
                          <div id="a2" class="invalid-feedback">
                              <strong>{{ $message }}</strong>
                          </div>
                          @enderror
                        </div>
                        <div class="col-sm">
                            <input type="number" class="@error('a3') is-invalid @enderror form-control" name="a3" placeholder="a3" aria-label="a3">
                            @error('a3')
                          <div id="a3" class="invalid-feedback">
                              <strong>{{ $message }}</strong>
                          </div>
                          @enderror
                        </div>
                    </div>
                    <div class="row g-3 mb-3">
                        <div class="col-sm">
                          <input type="number" class="@error('a4') is-invalid @enderror form-control" name="a4" placeholder="a4" aria-label="a4">
                          @error('a4')
                          <div id="a4" class="invalid-feedback">
                              <strong>{{ $message }}</strong>
                          </div>
                          @enderror
                        </div>
                        <div class="col-sm">
                          <input type="number" class="@error('a5') is-invalid @enderror form-control" name="a5" placeholder="a5" aria-label="a5">
                          @error('a5')
                          <div id="a5" class="invalid-feedback">
                              <strong>{{ $message }}</strong>
                          </div>
                          @enderror
                        </div>
                        <div class="col-sm">
                            <input type="number" class="@error('a6') is-invalid @enderror form-control" name="a6" placeholder="a6" aria-label="a6">
                            @error('a6')
                            <div id="a6" class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row g-3">
                        <div class="col-sm">
                          <input type="number" class="@error('a7') is-invalid @enderror form-control" name="a7" placeholder="a7" aria-label="a7">
                          @error('a7')
                          <div id="a7" class="invalid-feedback">
                              <strong>{{ $message }}</strong>
                          </div>
                          @enderror
                        </div>
                        <div class="col-sm">
                          <input type="number" class="@error('a8') is-invalid @enderror form-control" name="a8" placeholder="a8" aria-label="a8">
                          @error('a8')
                          <div id="a8" class="invalid-feedback">
                              <strong>{{ $message }}</strong>
                          </div>
                          @enderror
                        </div>
                        <div class="col-sm">
                            <input type="number" class="@error('a9') is-invalid @enderror form-control" name="a9" placeholder="a9" aria-label="a9">
                            @error('a9')
                            <div id="a9" class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success" >Tambah</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Info-->
    <div class="modal fade" id="infoData" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel" style="color: black">Info Dataset</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="color: black">
                    <p class="mb-4">Dataset terdiri dari 9 atribut:<br>
                        1. a1 = P3 - Siswa disuruh orangtua atau tidak membaca Al-qur'an oleh orangtua
                        <br>2. a2 = P4 - Siswa diajarkan atau tidak membaca Al-qur'an oleh orangtua
                        <br>3. a3 = P6 - Lama waktu siswa belajar membaca Al-qur'an di sekolah
                        <br>4. a4 = P7 - Siswa mengikuti Tahsin di luar sekolah atau tidak
                        <br>5. a5 = P8 - Siswa mengikuti kegiatan TPA/MDA atau tidak
                        <br>6. a6 = P11 - Orangtua memanggil guru mengaji ke rumah atau tidak
                        <br>7. a7 = Makhroj
                        <br>8. a8 = Panjang Pendek
                        <br>9. a9 = Tajwid
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Hapus Dataset-->
    <div class="modal fade" id="hapusDataset" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel" style="color: black">Anda yakin ingin menghapus seluruh data ?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/hapusdataset" method="get" enctype="multipart/form-data">
                    @csrf
                    {{-- <label for="formFile" class="form-label"></label> --}}
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-warning" >Hapus</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

@endsection
