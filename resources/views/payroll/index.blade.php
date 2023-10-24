@extends('layouts.dashboard')
@section('isi')
    <div class="container-fluid">
        <div class="card" style="border-radius: 20px">
            <div class="card-header">
                <a href="{{ url('/payroll/tambah') }}" class="btn btn-sm btn-primary" style="border-radius: 10px">+ Tambah Data Payroll</a>
            </div>
            <div class="card-body">
                <form action="{{ url('/payroll') }}">
                    @php
                        $bulan = array(
                        [
                            "id" => "1",
                            "bulan" => "Januari"
                        ],
                        [
                            "id" => "2",
                            "bulan" => "Februari"
                        ],
                        [
                            "id" => "3",
                            "bulan" => "Maret"
                        ],
                        [
                            "id" => "4",
                            "bulan" => "April"
                        ],
                        [
                            "id" => "5",
                            "bulan" => "Mei"
                        ],
                        [
                            "id" => "6",
                            "bulan" => "Juni"
                        ],
                        [
                            "id" => "7",
                            "bulan" => "Juli"
                        ],
                        [
                            "id" => "8",
                            "bulan" => "Agustus"
                        ],
                        [
                            "id" => "9",
                            "bulan" => "September"
                        ],
                        [
                            "id" => "10",
                            "bulan" => "Oktober"
                        ],
                        [
                            "id" => "11",
                            "bulan" => "November"
                        ],
                        [
                            "id" => "12",
                            "bulan" => "Desember"
                        ]);

                        $last = date('Y')-10;
                        $now = date('Y');
                    @endphp
                    <div class="form-row mb-2">
                        <div class="col-2">
                            <select name="tahun" id="tahun" class="form-control selectpicker" data-live-search="true">
                                @for ($i = $now; $i >= $last; $i--)
                                    @if(old('tahun', $now) == $i)
                                        <option value="{{ $i }}" selected>{{ $i }}</option>
                                    @else
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endif
                                @endfor
                            </select>
                        </div>
                        <div class="col-2">
                            <select name="bulan" id="bulan" class="form-control selectpicker" data-live-search="true">
                                <option value=""selected>Bulan</option>
                                @foreach($bulan as $bul)
                                    @if(request('bulan') == $bul['id'])
                                        <option value="{{ $bul['id'] }}"selected>{{ $bul['bulan'] }}</option>
                                    @else
                                        <option value="{{ $bul['id'] }}">{{ $bul['bulan'] }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <button type="submit" id="search" class="form-control btn btn-secondary" style="border-radius: 10px"><i class="fas fa-search"></i></button>
                        </div>
                    </div>
                </form>
                <table id="tablePayroll" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama</th>
                            <th>Jabatan</th>
                            <th>Golongan</th>
                            <th>Bulan</th>
                            <th>Tahun</th>
                            <th>Masa Kerja</th>
                            <th>Gaji</th>
                            <th>Hadir</th>
                            <th>Telat</th>
                            <th>Tunjangan Makan</th>
                            <th>Tunjangan Transport</th>
                            <th>Potongan Tunjangan Makan</th>
                            <th>Potongan Tunjangan Transport</th>
                            <th>Total Potongan</th>
                            <th>Tunjangan NET</th>
                            <th>Tunjangan BPJS Kesehatan</th>
                            <th>Setoran BPJS Kesehatan</th>
                            <th>Potongan BPJS Kesehatan</th>
                            <th>Tunjangan BPJS Tenaga Kerja</th>
                            <th>Setoran BPJS Tenaga Kerja</th>
                            <th>Potongan BPJS Tenaga Kerja</th>
                            <th>Tunjangan Pensiun</th>
                            <th>Tunjangan Komunikasi</th>
                            <th>Tunjangan PPH 21</th>
                            <th>Potongan Lainnya</th>
                            <th>Lembur</th>
                            <th>Gaji NET</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $d)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $d->User->name  }}</td>
                                <td>{{ $d->User->Jabatan->nama_jabatan  }}</td>
                                <td>{{ $d->User->Golongan->name  }}</td>
                                <td>
                                    @php
                                        if ($d->bulan == 1){
                                            $nama_bulan = 'Januari';
                                        } else if($d->bulan == 2) {
                                            $nama_bulan = 'Februari';
                                        } else if($d->bulan == 3) {
                                            $nama_bulan = 'Maret';
                                        } else if($d->bulan == 4) {
                                            $nama_bulan = 'April';
                                        } else if($d->bulan == 5) {
                                            $nama_bulan = 'Mei';
                                        } else if($d->bulan == 6) {
                                            $nama_bulan = 'Juni';
                                        } else if($d->bulan == 7) {
                                            $nama_bulan = 'Juli';
                                        } else if($d->bulan == 8) {
                                            $nama_bulan = 'Agustus';
                                        } else if($d->bulan == 9) {
                                            $nama_bulan = 'September';
                                        } else if($d->bulan == 10) {
                                            $nama_bulan = 'Oktober';
                                        } else if($d->bulan == 11) {
                                            $nama_bulan = 'November';
                                        } else if($d->bulan == 12) {
                                            $nama_bulan = 'Desember';
                                        } else {
                                            $nama_bulan = '-';
                                        }
                                    @endphp
                                    {{ $nama_bulan  }}
                                </td>
                                <td>{{ $d->tahun }}</td>
                                <td>
                                    @php
                                        $tgl_join = strtotime($d->User->tgl_join);
                                        $today = strtotime(date('Y-m-d'));
                                        
                                        $selisih_detik = $today - $tgl_join;

                                        $tahun = floor($selisih_detik / (365.25 * 24 * 60 * 60));
                                        $sisa_detik = $selisih_detik - ($tahun * 365.25 * 24 * 60 * 60);
                                        $bulan = floor($sisa_detik / (30.44 * 24 * 60 * 60));
                                    @endphp
                                    {{ $tahun . ' Tahun ' . $bulan . ' Bulan' }}
                                </td>
                                <td>Rp {{ number_format($d->gaji, 2, ".", ",") }}</td>
                                <td>
                                    @php
                                        $jumlah_hadir = $d->jumlahHadir($d->user_id, $d->bulan, $d->tahun, 'Masuk') + $d->jumlahHadir($d->user_id, $d->bulan, $d->tahun, 'Izin Pulang Cepat') + $d->jumlahHadir($d->user_id, $d->bulan, $d->tahun, 'Izin Telat');
                                    @endphp
                                    {{ $jumlah_hadir }}
                                </td>
                                <td>
                                    @php
                                        $jumlah_telat = $d->jumlahTelat($d->user_id, $d->bulan, $d->tahun);
                                    @endphp
                                    {{ $jumlah_telat }}
                                </td>
                                <td>
                                    @php
                                        $tunjangan_makan = $d->User->Golongan->Tunjangan->first()->tunjangan_makan * $jumlah_hadir;
                                    @endphp
                                    Rp {{ number_format($tunjangan_makan, 2, ".", ",") }}
                                </td>
                                <td>
                                    @php
                                        $tunjangan_transport = $d->User->Golongan->Tunjangan->first()->tunjangan_transport * $jumlah_hadir;
                                    @endphp
                                    Rp {{ number_format($tunjangan_transport, 2, ".", ",") }}
                                </td>
                                <td>
                                    @php
                                        $pot_tunjangan_makan = ($d->User->Golongan->Tunjangan->first()->tunjangan_makan * (25/100)) * $jumlah_telat;
                                    @endphp
                                    Rp {{ number_format($pot_tunjangan_makan, 2, ".", ",") }}
                                </td>
                                <td>
                                    @php
                                        $pot_tunjangan_transport = ($d->User->Golongan->Tunjangan->first()->tunjangan_transport * (25/100)) * $jumlah_telat;
                                    @endphp
                                    Rp {{ number_format($pot_tunjangan_transport, 2, ".", ",") }}
                                </td>
                                <td>Rp {{ number_format($pot_tunjangan_transport + $pot_tunjangan_makan, 2, ".", ",") }}</td>
                                <td>Rp {{ number_format(($tunjangan_makan + $tunjangan_transport) - ($pot_tunjangan_transport + $pot_tunjangan_makan), 2, ".", ",") }}</td>
                                <td>Rp {{ number_format($d->tunjangan_bpjs_kes, 2, ".", ",") }}</td>
                                <td>Rp {{ number_format($d->setoran_bpjs_kes, 2, ".", ",") }}</td>
                                <td>Rp {{ number_format($d->setoran_bpjs_kes - $d->tunjangan_bpjs_kes, 2, ".", ",") }}</td>
                                <td>Rp {{ number_format($d->tunjangan_bpjs_tk, 2, ".", ",") }}</td>
                                <td>Rp {{ number_format($d->setoran_bpjs_tk, 2, ".", ",") }}</td>
                                <td>Rp {{ number_format($d->setoran_bpjs_tk - $d->tunjangan_bpjs_tk, 2, ".", ",") }}</td>
                                <td>Rp {{ number_format($d->tunjangan_pensiun, 2, ".", ",") }}</td>
                                <td>Rp {{ number_format($d->tunjangan_komunikasi, 2, ".", ",") }}</td>
                                <td>Rp {{ number_format($d->tunjangan_pph_21, 2, ".", ",") }}</td>
                                <td>Rp {{ number_format($d->pot_lainnya, 2, ".", ",") }}</td>
                                <td>Rp {{ number_format($d->lembur, 2, ".", ",") }}</td>
                                <td>Rp {{ number_format($d->gaji + ($tunjangan_makan + $tunjangan_transport) - ($pot_tunjangan_transport + $pot_tunjangan_makan) - ($d->setoran_bpjs_kes - $d->tunjangan_bpjs_kes) - ($d->setoran_bpjs_tk - $d->tunjangan_bpjs_tk) + $d->tunjangan_komunikasi + $d->tunjangan_pensiun + $d->tunjangan_pph_21 - $d->pot_lainnya + $d->lembur, 2, ".", ",") }}</td>
                                <td>
                                    <a href="{{ url('/payroll/'.$d->id.'/download') }}" target="_blank" class="btn btn-sm btn-info"><i class="fa fa-solid fa-download"></i></a>
                                    <a href="{{ url('/payroll/'.$d->id.'/edit') }}" class="btn btn-sm btn-warning"><i class="fa fa-solid fa-edit"></i></a>
                                    <form action="{{ url('/payroll/'.$d->id.'/delete') }}" method="post" class="d-inline">
                                        @method('delete')
                                        @csrf
                                        <button class="btn btn-danger btn-sm btn-circle" onClick="return confirm('Are You Sure')"><i class="fa fa-solid fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-end mr-4">
                {{ $data->links() }}
            </div>
        </div>
    </div>
    <br>
@endsection
