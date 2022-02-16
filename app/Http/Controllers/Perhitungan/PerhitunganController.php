<?php

namespace App\Http\Controllers\Perhitungan;

use App\Centroid;
use App\Cluster;
use App\Dataset;
use App\Http\Controllers\Controller;
use App\Scoefficient;
use App\Sindex;
use Illuminate\Http\Request;

class PerhitunganController extends Controller
{
    public function index() {
        return view('perhitungan.inisialisasi');
    }

    public function hasil() {
        return view('perhitungan.hasil');
    }

    public function proses(Request $request) {
        $this->validate($request, [
            'atribut' => ['required'],
            'jumlah_cluster' => ['required'],
        ]);

        //cek apakah tabel database kosong ?
        $cluster_row = Cluster::count();
        if ($cluster_row != 0) {
            Cluster::truncate();
            Centroid::truncate();
            Sindex::truncate();
            Scoefficient::truncate();
        }

        $cek_data = Dataset::count();
        if ($cek_data == 0) {
            return view('perhitungan.kosong');
        }

        //ambil dan cek jumlah atribut
        $atribut = $request->atribut;
        $jumlah_cluster = $request->jumlah_cluster;
        //$centroid = Dataset::whereIn('kode_siswa', ['A0020','A0021','A0022','A0023','A0024'])->get();
        $centroid = Dataset::whereIn('kode_siswa', ['A0020','A0021','A0022','A0076','A0167'])->get();
        //$centroid = Dataset::all()->random($jumlah_cluster);

        if ($atribut == 9) {
            $data = Dataset::all()->toArray();
            //$centroid = Dataset::all()->random($jumlah_cluster);
            $jumlah_data = Dataset::count();


            // for ($i=0; $i < $jumlah_cluster; $i++) {
            //     $centroid_baru[$i]['a1'] = 0;
            //     $centroid_baru[$i]['a2'] = 0;
            //     $centroid_baru[$i]['a3'] = 0;
            //     $centroid_baru[$i]['a4'] = 0;
            //     $centroid_baru[$i]['a5'] = 0;
            //     $centroid_baru[$i]['a6'] = 0;
            //     $centroid_baru[$i]['a7'] = 0;
            //     $centroid_baru[$i]['a8'] = 0;
            //     $centroid_baru[$i]['a9'] = 0;
            // }

            // for ($i=0; $i < $jumlah_cluster; $i++) {
            //     if ($centroid[$i]['a1']==$centroid_baru[$i]['a1'] && $centroid[$i]['a2']==$centroid_baru[$i]['a2']
            //     && $centroid[$i]['a3']==$centroid_baru[$i]['a3'] && $centroid[$i]['a4']==$centroid_baru[$i]['a4']
            //     && $centroid[$i]['a5']==$centroid_baru[$i]['a5'] && $centroid[$i]['a6']==$centroid_baru[$i]['a6']
            //     && $centroid[$i]['a7']==$centroid_baru[$i]['a7'] && $centroid[$i]['a8']==$centroid_baru[$i]['a8']
            //     && $centroid[$i]['a9']==$centroid_baru[$i]['a9']) {

            //     } else {
            //         dd('salah');
            //     }
            // }

            // start kmeans
            for ($iterasi=0; $iterasi < 50; $iterasi++) {
                for ($i=0; $i < $jumlah_data; $i++) {
                    for ($j=0; $j < $jumlah_cluster; $j++) {
                        $d[$i][$j] = sqrt(pow(($data[$i]['a1']-$centroid[$j]['a1']),2)+pow(($data[$i]['a2']-$centroid[$j]['a2']),2)+
                pow(($data[$i]['a3']-$centroid[$j]['a3']),2)+pow(($data[$i]['a4']-$centroid[$j]['a4']),2)+
                pow(($data[$i]['a5']-$centroid[$j]['a5']),2)+pow(($data[$i]['a6']-$centroid[$j]['a6']),2)+
                pow(($data[$i]['a7']-$centroid[$j]['a7']),2)+pow(($data[$i]['a8']-$centroid[$j]['a8']),2)+
                pow(($data[$i]['a9']-$centroid[$j]['a9']),2));
                    }
                    $min_d[$i] = min($d[$i]);
                    if (in_array($min_d[$i], $d[$i])) {
                        $cluster[$i] = array_search($min_d[$i], $d[$i]);
                    }
                    //$data9[$i]['cluster'] = $cluster[$i];
                }

                for ($k=0; $k < $jumlah_cluster; $k++) {
                    $isi_cluster[$k] = [];
                    for ($l=0; $l < $jumlah_data; $l++) {
                        if ($cluster[$l] == $k) {
                            array_push($isi_cluster[$k], $l);
                        }
                    }
                }

                for ($i=0; $i < $jumlah_cluster; $i++) {
                    $jumlah_isicluster[$i] = count($isi_cluster[$i]);
                }

                for ($k=0; $k < $jumlah_cluster; $k++) {
                    $total[$k]['a1'] = 0;
                    $total[$k]['a2'] = 0;
                    $total[$k]['a3'] = 0;
                    $total[$k]['a4'] = 0;
                    $total[$k]['a5'] = 0;
                    $total[$k]['a6'] = 0;
                    $total[$k]['a7'] = 0;
                    $total[$k]['a8'] = 0;
                    $total[$k]['a9'] = 0;
                    for ($i=0; $i < $jumlah_isicluster[$k]; $i++) {
                        $index = $isi_cluster[$k][$i];
                        $total[$k]['a1'] = $total[$k]['a1'] + $data[$index]['a1'];
                        $total[$k]['a2'] = $total[$k]['a2'] + $data[$index]['a2'];
                        $total[$k]['a3'] = $total[$k]['a3'] + $data[$index]['a3'];
                        $total[$k]['a4'] = $total[$k]['a4'] + $data[$index]['a4'];
                        $total[$k]['a5'] = $total[$k]['a5'] + $data[$index]['a5'];
                        $total[$k]['a6'] = $total[$k]['a6'] + $data[$index]['a6'];
                        $total[$k]['a7'] = $total[$k]['a7'] + $data[$index]['a7'];
                        $total[$k]['a8'] = $total[$k]['a8'] + $data[$index]['a8'];
                        $total[$k]['a9'] = $total[$k]['a9'] + $data[$index]['a9'];
                    }
                    if ($jumlah_isicluster[$k] == 0) {
                        $centroid_baru[$k]['a1'] = $centroid[$i]['a1'];
                        $centroid_baru[$k]['a2'] = $centroid[$i]['a2'];
                        $centroid_baru[$k]['a3'] = $centroid[$i]['a3'];
                        $centroid_baru[$k]['a4'] = $centroid[$i]['a4'];
                        $centroid_baru[$k]['a5'] = $centroid[$i]['a5'];
                        $centroid_baru[$k]['a6'] = $centroid[$i]['a6'];
                        $centroid_baru[$k]['a7'] = $centroid[$i]['a7'];
                        $centroid_baru[$k]['a8'] = $centroid[$i]['a8'];
                        $centroid_baru[$k]['a9'] = $centroid[$i]['a9'];
                    } else {
                        $centroid_baru[$k]['a1'] = $total[$k]['a1']/$jumlah_isicluster[$k];
                        $centroid_baru[$k]['a2'] = $total[$k]['a2']/$jumlah_isicluster[$k];
                        $centroid_baru[$k]['a3'] = $total[$k]['a3']/$jumlah_isicluster[$k];
                        $centroid_baru[$k]['a4'] = $total[$k]['a4']/$jumlah_isicluster[$k];
                        $centroid_baru[$k]['a5'] = $total[$k]['a5']/$jumlah_isicluster[$k];
                        $centroid_baru[$k]['a6'] = $total[$k]['a6']/$jumlah_isicluster[$k];
                        $centroid_baru[$k]['a7'] = $total[$k]['a7']/$jumlah_isicluster[$k];
                        $centroid_baru[$k]['a8'] = $total[$k]['a8']/$jumlah_isicluster[$k];
                        $centroid_baru[$k]['a9'] = $total[$k]['a9']/$jumlah_isicluster[$k];
                    }
                }
                //dd($iterasi,$isi_cluster,$centroid, $centroid_baru);

                for ($i=0; $i < $jumlah_cluster; $i++) {
                    $centroid[$i]['a1'] = $centroid_baru[$i]['a1'];
                    $centroid[$i]['a2'] = $centroid_baru[$i]['a2'];
                    $centroid[$i]['a3'] = $centroid_baru[$i]['a3'];
                    $centroid[$i]['a4'] = $centroid_baru[$i]['a4'];
                    $centroid[$i]['a5'] = $centroid_baru[$i]['a5'];
                    $centroid[$i]['a6'] = $centroid_baru[$i]['a6'];
                    $centroid[$i]['a7'] = $centroid_baru[$i]['a7'];
                    $centroid[$i]['a8'] = $centroid_baru[$i]['a8'];
                    $centroid[$i]['a9'] = $centroid_baru[$i]['a9'];
                }

            }
            //end kmeans

            //Dari Kak Amany
            // $isi_cluster[0] = [];
            // $isi_cluster[1] = [];
            // $isi_cluster[2] = [];
            // $isi_cluster[3] = [];
            // $isi_cluster[4] = [];
            // for ($l=0; $l < $jumlah_data; $l++) {
            //     if ($cluster[$l] == 0) {
            //         array_push($isi_cluster[0], $l);
            //     } elseif ($cluster[$l] == 1) {
            //         array_push($isi_cluster[1], $l);
            //     } elseif ($cluster[$l] == 2) {
            //         array_push($isi_cluster[2], $l);
            //     } elseif ($cluster[$l] == 3) {
            //         array_push($isi_cluster[3], $l);
            //     } elseif ($cluster[$l] == 4) {
            //         array_push($isi_cluster[4], $l);
            //     }
            // }


            //start silhouette coefficient
            //ai
            for ($k=0; $k < $jumlah_cluster; $k++) {
                for ($i=0; $i < $jumlah_isicluster[$k]; $i++) {
                    $total_a[$i] = 0;
                    for ($j=0; $j < $jumlah_isicluster[$k]; $j++) {
                        $index_i= $isi_cluster[$k][$i];
                        $index_j= $isi_cluster[$k][$j];
                        $a[$index_i][$index_j] = sqrt(pow(($data[$index_i]['a1']-$data[$index_j]['a1']),2)+pow(($data[$index_i]['a2']-$data[$index_j]['a2']),2)+
                        pow(($data[$index_i]['a3']-$data[$index_j]['a3']),2)+pow(($data[$index_i]['a4']-$data[$index_j]['a4']),2)+
                        pow(($data[$index_i]['a5']-$data[$index_j]['a5']),2)+pow(($data[$index_i]['a6']-$data[$index_j]['a6']),2)+
                        pow(($data[$index_i]['a7']-$data[$index_j]['a7']),2)+pow(($data[$index_i]['a8']-$data[$index_j]['a8']),2)+
                        pow(($data[$index_i]['a9']-$data[$index_j]['a9']),2));

                        $total_a[$i] = $total_a[$i] + $a[$index_i][$index_j];
                    }
                    $ai[$k][$i]= $total_a[$i]/($jumlah_isicluster[$k]-1);
                }
            }

            //bi
            for ($k=0; $k < $jumlah_cluster; $k++) {
                for ($i=0; $i < $jumlah_isicluster[$k]; $i++) {
                    for ($l=0; $l < $jumlah_cluster; $l++) {
                        $total_b[$k][$i][$l] = 0;
                        for ($j=0; $j < $jumlah_isicluster[$l]; $j++) {
                            if ($k == $l) {
                                $total_b[$k][$i][$l] = PHP_FLOAT_MAX;
                            }
                            elseif ($k != $l) {
                                $index_i= $isi_cluster[$k][$i];
                                $index_j= $isi_cluster[$l][$j];
                                $b[$index_i][$index_j] = sqrt(pow(($data[$index_i]['a1']-$data[$index_j]['a1']),2)+pow(($data[$index_i]['a2']-$data[$index_j]['a2']),2)+
                                pow(($data[$index_i]['a3']-$data[$index_j]['a3']),2)+pow(($data[$index_i]['a4']-$data[$index_j]['a4']),2)+
                                pow(($data[$index_i]['a5']-$data[$index_j]['a5']),2)+pow(($data[$index_i]['a6']-$data[$index_j]['a6']),2)+
                                pow(($data[$index_i]['a7']-$data[$index_j]['a7']),2)+pow(($data[$index_i]['a8']-$data[$index_j]['a8']),2)+
                                pow(($data[$index_i]['a9']-$data[$index_j]['a9']),2));

                                $total_b[$k][$i][$l] = $total_b[$k][$i][$l] + $b[$index_i][$index_j];
                            }
                        }
                        $b_cluster[$k][$i][$l] = $total_b[$k][$i][$l]/$jumlah_isicluster[$l];
                    }
                    $bi[$k][$i]= min($b_cluster[$k][$i]);
                }
            }

            //si(i)
            for ($k=0; $k < $jumlah_cluster; $k++) {
                for ($i=0; $i < $jumlah_isicluster[$k]; $i++) {
                    $total_si = $bi[$k][$i]-$ai[$k][$i];
                    $max_si = max($ai[$k][$i], $bi[$k][$i]);
                    $si[$k][$i] = $total_si/$max_si;
                }
            }

            //si setiap cluster
            for ($k=0; $k < $jumlah_cluster; $k++) {
                $si_cluster[$k]= array_sum($si[$k])/$jumlah_isicluster[$k];
            }

            //sc
            $sc = array_sum($si_cluster)/$jumlah_cluster;

            $a=0;

            for ($i=0; $i < $jumlah_cluster; $i++) {
                Centroid::insert([
                    'centroid' => $i,
                    'a1' => $centroid[$i]['a1'],
                    'a2' => $centroid[$i]['a2'],
                    'a3' => $centroid[$i]['a3'],
                    'a4' => $centroid[$i]['a4'],
                    'a5' => $centroid[$i]['a5'],
                    'a6' => $centroid[$i]['a6'],
                    'a7' => $centroid[$i]['a7'],
                    'a8' => $centroid[$i]['a8'],
                    'a9' => $centroid[$i]['a9'],
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ]);
            }

            // for ($i=0; $i < $jumlah_data; $i++) {
            //     if ($cluster[$i] == 0) {
            //         $cluster[$i] = 1;
            //     } elseif ($cluster[$i] == 1) {
            //         $cluster[$i] = 2;
            //     } elseif ($centroid[$i] == 2) {
            //         $cluster[$i] = 3;
            //     }
            // }

            // return view('perhitungan.hasil', compact('cluster','data9','data6','jumlah_isicluster','centroid','a','jumlah_data','jumlah_cluster','d',
            // 'atribut','ai','bi','si','si_cluster','sc','index_i','index_j'));

            //dd($centroid, $d, $min_d, $cluster, $isi_cluster, $jumlah_isicluster, $total, $centroid_baru, $ai, $bi, $si, $si_cluster, $sc);
        } elseif ($atribut == 6) {
            $data = Dataset::all()->toArray();
            //$centroid = Dataset::all()->random($jumlah_cluster);
            $jumlah_data = Dataset::count();

            // start kmeans
            for ($iterasi=0; $iterasi < 50; $iterasi++) {
                for ($i=0; $i < $jumlah_data; $i++) {
                    for ($j=0; $j < $jumlah_cluster; $j++) {
                        $d[$i][$j] = sqrt(pow(($data[$i]['a1']-$centroid[$j]['a1']),2)+pow(($data[$i]['a2']-$centroid[$j]['a2']),2)+
                pow(($data[$i]['a3']-$centroid[$j]['a3']),2)+pow(($data[$i]['a4']-$centroid[$j]['a4']),2)+
                pow(($data[$i]['a5']-$centroid[$j]['a5']),2)+pow(($data[$i]['a6']-$centroid[$j]['a6']),2));
                    }
                    $min_d[$i] = min($d[$i]);
                    if (in_array($min_d[$i], $d[$i])) {
                        $cluster[$i] = array_search($min_d[$i], $d[$i]);
                    }
                    //$data9[$i]['cluster'] = $cluster[$i];
                }

                for ($k=0; $k < $jumlah_cluster; $k++) {
                    $isi_cluster[$k] = [];
                    for ($l=0; $l < $jumlah_data; $l++) {
                        if ($cluster[$l] == $k) {
                            array_push($isi_cluster[$k], $l);
                        }
                    }
                }

                for ($i=0; $i < $jumlah_cluster; $i++) {
                    $jumlah_isicluster[$i] = count($isi_cluster[$i]);
                }

                for ($k=0; $k < $jumlah_cluster; $k++) {
                    $total[$k]['a1'] = 0;
                    $total[$k]['a2'] = 0;
                    $total[$k]['a3'] = 0;
                    $total[$k]['a4'] = 0;
                    $total[$k]['a5'] = 0;
                    $total[$k]['a6'] = 0;
                    for ($i=0; $i < $jumlah_isicluster[$k]; $i++) {
                        $index = $isi_cluster[$k][$i];
                        $total[$k]['a1'] = $total[$k]['a1'] + $data[$index]['a1'];
                        $total[$k]['a2'] = $total[$k]['a2'] + $data[$index]['a2'];
                        $total[$k]['a3'] = $total[$k]['a3'] + $data[$index]['a3'];
                        $total[$k]['a4'] = $total[$k]['a4'] + $data[$index]['a4'];
                        $total[$k]['a5'] = $total[$k]['a5'] + $data[$index]['a5'];
                        $total[$k]['a6'] = $total[$k]['a6'] + $data[$index]['a6'];
                    }
                    if ($jumlah_isicluster[$k] == 0) {
                        $centroid_baru[$k]['a1'] = $centroid[$i]['a1'];
                        $centroid_baru[$k]['a2'] = $centroid[$i]['a2'];
                        $centroid_baru[$k]['a3'] = $centroid[$i]['a3'];
                        $centroid_baru[$k]['a4'] = $centroid[$i]['a4'];
                        $centroid_baru[$k]['a5'] = $centroid[$i]['a5'];
                        $centroid_baru[$k]['a6'] = $centroid[$i]['a6'];
                    } else {
                        $centroid_baru[$k]['a1'] = $total[$k]['a1']/$jumlah_isicluster[$k];
                        $centroid_baru[$k]['a2'] = $total[$k]['a2']/$jumlah_isicluster[$k];
                        $centroid_baru[$k]['a3'] = $total[$k]['a3']/$jumlah_isicluster[$k];
                        $centroid_baru[$k]['a4'] = $total[$k]['a4']/$jumlah_isicluster[$k];
                        $centroid_baru[$k]['a5'] = $total[$k]['a5']/$jumlah_isicluster[$k];
                        $centroid_baru[$k]['a6'] = $total[$k]['a6']/$jumlah_isicluster[$k];
                    }
                }

                for ($i=0; $i < $jumlah_cluster; $i++) {
                    $centroid[$i]['a1'] = $centroid_baru[$i]['a1'];
                    $centroid[$i]['a2'] = $centroid_baru[$i]['a2'];
                    $centroid[$i]['a3'] = $centroid_baru[$i]['a3'];
                    $centroid[$i]['a4'] = $centroid_baru[$i]['a4'];
                    $centroid[$i]['a5'] = $centroid_baru[$i]['a5'];
                    $centroid[$i]['a6'] = $centroid_baru[$i]['a6'];
                }
            }
            //end kmeans

            //start silhouette coefficient
            //ai
            for ($k=0; $k < $jumlah_cluster; $k++) {
                for ($i=0; $i < $jumlah_isicluster[$k]; $i++) {
                    $total_a[$i] = 0;
                    for ($j=0; $j < $jumlah_isicluster[$k]; $j++) {
                        $index_i= $isi_cluster[$k][$i];
                        $index_j= $isi_cluster[$k][$j];
                        $a[$index_i][$index_j] = sqrt(pow(($data[$index_i]['a1']-$data[$index_j]['a1']),2)+pow(($data[$index_i]['a2']-$data[$index_j]['a2']),2)+
                        pow(($data[$index_i]['a3']-$data[$index_j]['a3']),2)+pow(($data[$index_i]['a4']-$data[$index_j]['a4']),2)+
                        pow(($data[$index_i]['a5']-$data[$index_j]['a5']),2)+pow(($data[$index_i]['a6']-$data[$index_j]['a6']),2));

                        $total_a[$i] = $total_a[$i] + $a[$index_i][$index_j];
                    }
                    $ai[$k][$i]= $total_a[$i]/($jumlah_isicluster[$k]-1);
                }
            }

            //bi
            for ($k=0; $k < $jumlah_cluster; $k++) {
                for ($i=0; $i < $jumlah_isicluster[$k]; $i++) {
                    for ($l=0; $l < $jumlah_cluster; $l++) {
                        $total_b[$k][$i][$l] = 0;
                        for ($j=0; $j < $jumlah_isicluster[$l]; $j++) {
                            if ($k == $l) {
                                $total_b[$k][$i][$l] = PHP_FLOAT_MAX;
                            }
                            elseif ($k != $l) {
                                $index_i= $isi_cluster[$k][$i];
                                $index_j= $isi_cluster[$l][$j];
                                $b[$index_i][$index_j] = sqrt(pow(($data[$index_i]['a1']-$data[$index_j]['a1']),2)+pow(($data[$index_i]['a2']-$data[$index_j]['a2']),2)+
                                pow(($data[$index_i]['a3']-$data[$index_j]['a3']),2)+pow(($data[$index_i]['a4']-$data[$index_j]['a4']),2)+
                                pow(($data[$index_i]['a5']-$data[$index_j]['a5']),2)+pow(($data[$index_i]['a6']-$data[$index_j]['a6']),2));

                                $total_b[$k][$i][$l] = $total_b[$k][$i][$l] + $b[$index_i][$index_j];
                            }
                        }
                        $b_cluster[$k][$i][$l] = $total_b[$k][$i][$l]/$jumlah_isicluster[$l];
                    }
                    $bi[$k][$i]= min($b_cluster[$k][$i]);
                }
            }

            //si(i)
            for ($k=0; $k < $jumlah_cluster; $k++) {
                for ($i=0; $i < $jumlah_isicluster[$k]; $i++) {
                    $total_si = $bi[$k][$i]-$ai[$k][$i];
                    $max_si = max($ai[$k][$i], $bi[$k][$i]);
                    $si[$k][$i] = $total_si/$max_si;
                }
            }

            //si setiap cluster
            for ($k=0; $k < $jumlah_cluster; $k++) {
                $si_cluster[$k]= array_sum($si[$k])/$jumlah_isicluster[$k];
            }

            //sc
            $sc = array_sum($si_cluster)/$jumlah_cluster;

            for ($i=0; $i < $jumlah_cluster; $i++) {
                Centroid::insert([
                    'centroid' => $i,
                    'a1' => $centroid[$i]['a1'],
                    'a2' => $centroid[$i]['a2'],
                    'a3' => $centroid[$i]['a3'],
                    'a4' => $centroid[$i]['a4'],
                    'a5' => $centroid[$i]['a5'],
                    'a6' => $centroid[$i]['a6'],
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ]);
            }

            // return view('perhitungan.hasil', compact('cluster','data9','data6','jumlah_isicluster','centroid','a','jumlah_data','jumlah_cluster','d',
            // 'atribut','ai','bi','si','si_cluster','sc','index_i','index_j'));

        } elseif ($atribut == 3) {
            $data = Dataset::all()->toArray();
            //$centroid = Dataset::all()->random($jumlah_cluster);
            $jumlah_data = Dataset::count();

            // start kmeans
            for ($iterasi=0; $iterasi < 50; $iterasi++) {
                //hitung distance, cari distance terpendek
                for ($i=0; $i < $jumlah_data; $i++) {
                    for ($j=0; $j < $jumlah_cluster; $j++) {
                        $d[$i][$j] = sqrt(pow(($data[$i]['a7']-$centroid[$j]['a7']),2)+pow(($data[$i]['a8']-$centroid[$j]['a8']),2)+
                        pow(($data[$i]['a9']-$centroid[$j]['a9']),2));
                    }
                    $min_d[$i] = min($d[$i]);
                    if (in_array($min_d[$i], $d[$i])) {
                        $cluster[$i] = array_search($min_d[$i], $d[$i]);
                    }
                    //$data9[$i]['cluster'] = $cluster[$i];
                }

                for ($k=0; $k < $jumlah_cluster; $k++) {
                    $isi_cluster[$k] = [];
                    for ($l=0; $l < $jumlah_data; $l++) {
                        if ($cluster[$l] == $k) {
                            array_push($isi_cluster[$k], $l);
                        }
                    }
                }

                for ($i=0; $i < $jumlah_cluster; $i++) {
                    $jumlah_isicluster[$i] = count($isi_cluster[$i]);
                }

                //hitung centroid baru
                for ($k=0; $k < $jumlah_cluster; $k++) {
                    $total[$k]['a7'] = 0;
                    $total[$k]['a8'] = 0;
                    $total[$k]['a9'] = 0;
                    for ($i=0; $i < $jumlah_isicluster[$k]; $i++) {
                        $index = $isi_cluster[$k][$i];
                        $total[$k]['a7'] = $total[$k]['a7'] + $data[$index]['a7'];
                        $total[$k]['a8'] = $total[$k]['a8'] + $data[$index]['a8'];
                        $total[$k]['a9'] = $total[$k]['a9'] + $data[$index]['a9'];
                    }
                    if ($jumlah_isicluster[$k] == 0) {
                        $centroid_baru[$k]['a7'] = $centroid[$i]['a7'];
                        $centroid_baru[$k]['a8'] = $centroid[$i]['a8'];
                        $centroid_baru[$k]['a9'] = $centroid[$i]['a9'];
                    } else {
                        $centroid_baru[$k]['a7'] = $total[$k]['a7']/$jumlah_isicluster[$k];
                        $centroid_baru[$k]['a8'] = $total[$k]['a8']/$jumlah_isicluster[$k];
                        $centroid_baru[$k]['a9'] = $total[$k]['a9']/$jumlah_isicluster[$k];
                    }
                }

                for ($i=0; $i < $jumlah_cluster; $i++) {
                    $centroid[$i]['a7'] = $centroid_baru[$i]['a7'];
                    $centroid[$i]['a8'] = $centroid_baru[$i]['a8'];
                    $centroid[$i]['a9'] = $centroid_baru[$i]['a9'];
                }
            }
            //dd($d, $centroid,$isi_cluster,$jumlah_isicluster);
            //end kmeans

            //start silhouette coefficient
            //ai
            for ($k=0; $k < $jumlah_cluster; $k++) {
                for ($i=0; $i < $jumlah_isicluster[$k]; $i++) {
                    $total_a[$i] = 0;
                    for ($j=0; $j < $jumlah_isicluster[$k]; $j++) {
                        $index_i= $isi_cluster[$k][$i];
                        $index_j= $isi_cluster[$k][$j];
                        $a[$index_i][$index_j] = sqrt(pow(($data[$index_i]['a7']-$data[$index_j]['a7']),2)+pow(($data[$index_i]['a8']-$data[$index_j]['a8']),2)+
                        pow(($data[$index_i]['a9']-$data[$index_j]['a9']),2));

                        $total_a[$i] = $total_a[$i] + $a[$index_i][$index_j];
                    }
                    $ai[$k][$i]= $total_a[$i]/($jumlah_isicluster[$k]-1);
                }
            }

            //bi
            for ($k=0; $k < $jumlah_cluster; $k++) {
                for ($i=0; $i < $jumlah_isicluster[$k]; $i++) {
                    for ($l=0; $l < $jumlah_cluster; $l++) {
                        $total_b[$k][$i][$l] = 0;
                        for ($j=0; $j < $jumlah_isicluster[$l]; $j++) {
                            if ($k == $l) {
                                $total_b[$k][$i][$l] = PHP_FLOAT_MAX;
                            }
                            elseif ($k != $l) {
                                $index_i= $isi_cluster[$k][$i];
                                $index_j= $isi_cluster[$l][$j];
                                $b[$index_i][$index_j] = sqrt(pow(($data[$index_i]['a7']-$data[$index_j]['a7']),2)+pow(($data[$index_i]['a8']-$data[$index_j]['a8']),2)+
                                pow(($data[$index_i]['a9']-$data[$index_j]['a9']),2));

                                $total_b[$k][$i][$l] = $total_b[$k][$i][$l] + $b[$index_i][$index_j];
                            }
                        }
                        if ($jumlah_isicluster[$l] == 0) {
                            $b_cluster[$k][$i][$l] =0;
                        } else {
                            $b_cluster[$k][$i][$l] = $total_b[$k][$i][$l]/$jumlah_isicluster[$l];
                        }

                    }
                    $bi[$k][$i]= min($b_cluster[$k][$i]);
                }
            }

            //si(i)
            for ($k=0; $k < $jumlah_cluster; $k++) {
                for ($i=0; $i < $jumlah_isicluster[$k]; $i++) {
                    $total_si = $bi[$k][$i]-$ai[$k][$i];
                    $max_si = max($ai[$k][$i], $bi[$k][$i]);
                    $si[$k][$i] = $total_si/$max_si;
                }
            }
            //dd($si, $jumlah_cluster,$jumlah_isicluster, $centroid);
            //si setiap cluster
            for ($k=0; $k < $jumlah_cluster; $k++) {
                $si_cluster[$k]= array_sum($si[$k])/$jumlah_isicluster[$k];
            }


            //sc
            $sc = array_sum($si_cluster)/$jumlah_cluster;

            for ($i=0; $i < $jumlah_cluster; $i++) {
                Centroid::insert([
                    'centroid' => $i,
                    'a7' => $centroid[$i]['a7'],
                    'a8' => $centroid[$i]['a8'],
                    'a9' => $centroid[$i]['a9'],
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ]);
            }
        }


        for ($i=0; $i < $jumlah_data; $i++) {
            $tampil_ai[$i]=0;
            $tampil_bi[$i]=0;
            $tampil_si[$i]=0;
        }
        for ($k=0; $k < $jumlah_cluster; $k++) {
            for ($i=0; $i < $jumlah_isicluster[$k]; $i++) {
                $id_tujuan = $isi_cluster[$k][$i];
                $tampil_ai[$id_tujuan] = $ai[$k][$i];
                $tampil_bi[$id_tujuan] = $bi[$k][$i];
                $tampil_si[$id_tujuan] = $si[$k][$i];
            }
        }

        for ($i=0; $i < $jumlah_data; $i++) {
            Cluster::insert([
                'datasets_id' => $data[$i]['kode_siswa'],
                'cluster' => $cluster[$i],
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
        }

        return view('perhitungan.hasil', compact('cluster','data','jumlah_isicluster','centroid','a','jumlah_data','jumlah_cluster','d',
            'atribut','ai','bi','si','si_cluster','sc','index_i','index_j','isi_cluster','tampil_ai','tampil_bi','tampil_si'));
    }

}
