@extends('layouts.master')

@section('title', 'Hasil')

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Hasil Perhitungan</h1>
        {{-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> --}}
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="accordion accordion-flush" id="accordionFlushExample">
            <div class="accordion-item">
              <h2 class="accordion-header" id="flush-headingOne">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="true" aria-controls="flush-collapseOne">
                  Hasil Cluster
                </button>
              </h2>
              <div id="flush-collapseOne" class="accordion-collapse collapse show" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                <div class="accordion-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Kode Siswa</th>
                                    <th>JK</th>
                                    @for ($i=0; $i < $atribut; $i++)
                                    <th>a{{$i+1}}</th>
                                    @endfor
                                    <th>Cluster</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Kode Siswa</th>
                                    <th>JK</th>
                                    @for ($i=0; $i < $atribut; $i++)
                                    <th>a{{$i+1}}</th>
                                    @endfor
                                    <th>Cluster</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @for ($i=0; $i < $jumlah_data; $i++)
                                <tr>
                                    <td>{{$data[$i]['kode_siswa']}}</td>
                                    <td>{{$data[$i]['jk']}}</td>
                                    @if ($atribut==9)
                                    <td>{{$data[$i]['a1']}}</td>
                                    <td>{{$data[$i]['a2']}}</td>
                                    <td>{{$data[$i]['a3']}}</td>
                                    <td>{{$data[$i]['a4']}}</td>
                                    <td>{{$data[$i]['a5']}}</td>
                                    <td>{{$data[$i]['a6']}}</td>
                                    <td>{{$data[$i]['a7']}}</td>
                                    <td>{{$data[$i]['a8']}}</td>
                                    <td>{{$data[$i]['a9']}}</td>
                                    @endif
                                    @if ($atribut==6)
                                    <td>{{$data[$i]['a1']}}</td>
                                    <td>{{$data[$i]['a2']}}</td>
                                    <td>{{$data[$i]['a3']}}</td>
                                    <td>{{$data[$i]['a4']}}</td>
                                    <td>{{$data[$i]['a5']}}</td>
                                    <td>{{$data[$i]['a6']}}</td>
                                    @endif
                                    @if ($atribut==3)
                                    <td>{{$data[$i]['a7']}}</td>
                                    <td>{{$data[$i]['a8']}}</td>
                                    <td>{{$data[$i]['a9']}}</td>
                                    @endif
                                    <td style="color:black"><b>{{$cluster[$i]+1}}</b></td>
                                    </tr>
                                @endfor
                            </tbody>
                        </table>
                    </div>
                    <div class="table-responsive mt-5">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Cluster</th>
                                    <th>Jumlah Data</th>
                                </tr>
                            </thead>
                            <tbody>
                                @for ($i=0; $i < $jumlah_cluster; $i++)
                                <tr>
                                    <td>{{$i+1}}</td>
                                    <td>{{$jumlah_isicluster[$i]}}</td>
                                </tr>
                                @endfor
                            </tbody>
                        </table>
                    </div>
                </div>
              </div>
            </div>
            <div class="accordion-item">
              <h2 class="accordion-header" id="flush-headingTwo">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="true" aria-controls="flush-collapseTwo">
                  Hasil Perhitungan Jarak Data Iterasi Terakhir
                </button>
              </h2>
              <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                <div class="accordion-body">
                    <div class="table-responsive">
                        <table class="table table-bordered display" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Kode Siswa</th>
                                    @for ($j=0; $j < $jumlah_cluster; $j++)
                                    <th>d(c{{$j+1}})</th>
                                    @endfor
                                    <th>Cluster</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Kode Siswa</th>
                                    @for ($j=0; $j < $jumlah_cluster; $j++)
                                    <th>d(c{{$j+1}})</th>
                                    @endfor
                                    <th>Cluster</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @for ($i=0; $i < $jumlah_data; $i++)
                                <tr>
                                    <td>{{$data[$i]['kode_siswa']}}</th>
                                    @for ($j=0; $j < $jumlah_cluster; $j++)
                                    <td>{{$d[$i][$j]}}</th>
                                    @endfor
                                    <td>{{$cluster[$i]+1}}</th>
                                </tr>
                                @endfor
                            </tbody>
                        </table>
                    </div>
                </div>
              </div>
            </div>
            <div class="accordion-item">
              <h2 class="accordion-header" id="flush-headingThree">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                  Hasil Centroid Akhir
                </button>
              </h2>
              <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                <div class="accordion-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Centroid</th>
                                    @for ($i=0; $i < $atribut; $i++)
                                    <th>a{{$i+1}}</th>
                                    @endfor
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Centroid</th>
                                    @for ($i=0; $i < $atribut; $i++)
                                    <th>a{{$i+1}}</th>
                                    @endfor
                                </tr>
                            </tfoot>
                            <tbody>
                                @for ($i=0; $i < $jumlah_cluster; $i++)
                                <tr>
                                    <th>{{$i+1}}</th>
                                    @if ($atribut==9)
                                    <td>{{$centroid[$i]['a1']}}</td>
                                    <td>{{$centroid[$i]['a2']}}</td>
                                    <td>{{$centroid[$i]['a3']}}</td>
                                    <td>{{$centroid[$i]['a4']}}</td>
                                    <td>{{$centroid[$i]['a5']}}</td>
                                    <td>{{$centroid[$i]['a6']}}</td>
                                    <td>{{$centroid[$i]['a7']}}</td>
                                    <td>{{$centroid[$i]['a8']}}</td>
                                    <td>{{$centroid[$i]['a9']}}</td>
                                    @endif
                                    @if ($atribut==6)
                                    <td>{{$centroid[$i]['a1']}}</td>
                                    <td>{{$centroid[$i]['a2']}}</td>
                                    <td>{{$centroid[$i]['a3']}}</td>
                                    <td>{{$centroid[$i]['a4']}}</td>
                                    <td>{{$centroid[$i]['a5']}}</td>
                                    <td>{{$centroid[$i]['a6']}}</td>
                                    @endif
                                    @if ($atribut==3)
                                    <td>{{$centroid[$i]['a7']}}</td>
                                    <td>{{$centroid[$i]['a8']}}</td>
                                    <td>{{$centroid[$i]['a9']}}</td>
                                    @endif
                                </tr>
                                @endfor
                            </tbody>
                        </table>
                    </div>
                </div>
              </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="flush-headingFour">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFour" aria-expanded="false" aria-controls="flush-collapseFour">
                    Hasil Pengujian Silhouette Coefficient
                  </button>
                </h2>
                <div id="flush-collapseFour" class="accordion-collapse collapse" aria-labelledby="flush-headingFour" data-bs-parent="#accordionFlushExample">
                  <div class="accordion-body">
                    <div class="table-responsive">
                        <table class="table table-bordered display" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Kode Siswa</th>
                                    <th>Cluster</th>
                                    <th>a(i)</th>
                                    <th>b(i)</th>
                                    <th>SI(i)</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Kode Siswa</th>
                                    <th>Cluster</th>
                                    <th>a(i)</th>
                                    <th>b(i)</th>
                                    <th>SI(i)</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                    {{-- @dd($ai, $isi_cluster, $array_tampil) --}}
                                @for ($i=0; $i < $jumlah_data; $i++)
                                <tr>
                                    <td>{{$data[$i]['kode_siswa']}}</td>
                                    <td>{{$cluster[$i]+1}}</td>
                                    <td>{{$tampil_ai[$i]}}</td>
                                    <td>{{$tampil_bi[$i]}}</td>
                                    <td>{{$tampil_si[$i]}}</td>
                                </tr>
                                @endfor
                            </tbody>
                        </table>
                    </div>
                    <div class="table-responsive mt-5">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    @for ($i=0; $i< $jumlah_cluster; $i++)
                                    <th>SI({{$i+1}})</th>
                                    @endfor
                                    <th>SC</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    @for ($i=0; $i < $jumlah_cluster; $i++)
                                    <td style="color:blue;"><b>{{$si_cluster[$i]}}</b></td>
                                    @endfor
                                    <td style="color:green;"><b>{{$sc}}</b></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                  </div>
                </div>
              </div>
        </div>
    </div>
</div>
@endsection
