<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Payroll;
use App\Models\StatusPtkp;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PayrollController extends Controller
{
    public function index(Request $request)
    {
        $data = Payroll::orderBy('id', 'DESC');

        if($request['tahun'] !== null && $request['bulan'] == null){
            $data = Payroll::orderBy('id', 'DESC')->where('tahun', $request['tahun']);
        } else if ($request['tahun'] !== null && $request['bulan'] !== null) {
            $data = Payroll::orderBy('id', 'DESC')->where('tahun', $request['tahun'])->where('bulan', $request['bulan']);
        } else {
            $data = Payroll::orderBy('id', 'DESC');
        }
        return view('payroll.index', [
            'title' => 'Data Penggajian Karyawan',
            'data' => $data->paginate(10)->withQueryString()
        ]);
    }

    public function tambah()
    {
        return view('payroll.tambah', [
            'title' => 'Tambah Data Penggajian Karyawan',
            'data_user' => User::select('id', 'name')->orderBy('name', 'ASC')->get(),
            'data_status' => StatusPtkp::select('id', 'name')->orderBy('name', 'ASC')->get()
        ]);
    }

    public function tambahProses(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required',
            'status_id' => 'required',
            'bulan' => 'required',
            'tahun' => 'required',
            'gaji' => 'required',
            'setoran_bpjs_kes' => 'nullable',
            'tunjangan_bpjs_kes' => 'nullable',
            'setoran_bpjs_tk' => 'nullable',
            'tunjangan_bpjs_tk' => 'nullable',
            'tunjangan_pensiun' => 'nullable',
            'tunjangan_komunikasi' => 'nullable',
            'tunjangan_pph_21' => 'nullable',
            'pot_lainnya' => 'nullable',
            'lembur' => 'nullable'
        ]);

        if(!$validated['gaji']){
            $validated['gaji'] = 0;
        }

        if(!$validated['setoran_bpjs_kes']){
            $validated['setoran_bpjs_kes'] = 0;
        }

        if(!$validated['tunjangan_bpjs_kes']){
            $validated['tunjangan_bpjs_kes'] = 0;
        }

        if(!$validated['setoran_bpjs_tk']){
            $validated['setoran_bpjs_tk'] = 0;
        }
        
        if(!$validated['tunjangan_bpjs_tk']){
            $validated['tunjangan_bpjs_tk'] = 0;
        }

        if(!$validated['tunjangan_pensiun']){
            $validated['tunjangan_pensiun'] = 0;
        }

        if(!$validated['tunjangan_komunikasi']){
            $validated['tunjangan_komunikasi'] = 0;
        }

        if(!$validated['tunjangan_pph_21']){
            $validated['tunjangan_pph_21'] = 0;
        }

        if(!$validated['pot_lainnya']){
            $validated['pot_lainnya'] = 0;
        }

        if(!$validated['lembur']){
            $validated['lembur'] = 0;
        }

        $validated['gaji'] = str_replace(',', '', $validated['gaji']);
        $validated['setoran_bpjs_kes'] = str_replace(',', '', $validated['setoran_bpjs_kes']);
        $validated['tunjangan_bpjs_kes'] = str_replace(',', '', $validated['tunjangan_bpjs_kes']);
        $validated['setoran_bpjs_tk'] = str_replace(',', '', $validated['setoran_bpjs_tk']);
        $validated['tunjangan_bpjs_tk'] = str_replace(',', '', $validated['tunjangan_bpjs_tk']);
        $validated['tunjangan_pensiun'] = str_replace(',', '', $validated['tunjangan_pensiun']);
        $validated['tunjangan_komunikasi'] = str_replace(',', '', $validated['tunjangan_komunikasi']);
        $validated['tunjangan_pph_21'] = str_replace(',', '', $validated['tunjangan_pph_21']);
        $validated['pot_lainnya'] = str_replace(',', '', $validated['pot_lainnya']);
        $validated['lembur'] = str_replace(',', '', $validated['lembur']);

        Payroll::create($validated);
        return redirect('/payroll')->with('success', 'Data Berhasil di Tambahkan');
    }

    public function edit($id)
    {
        return view('payroll.edit', [
            'title' => 'Edit Data Penggajian Karyawan',
            'data' => Payroll::find($id),
            'data_user' => User::select('id', 'name')->orderBy('name', 'ASC')->get(),
            'data_status' => StatusPtkp::select('id', 'name')->orderBy('name', 'ASC')->get(),
        ]);
    }
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'user_id' => 'required',
            'status_id' => 'required',
            'bulan' => 'required',
            'tahun' => 'required',
            'gaji' => 'required',
            'setoran_bpjs_kes' => 'nullable',
            'tunjangan_bpjs_kes' => 'nullable',
            'setoran_bpjs_tk' => 'nullable',
            'tunjangan_bpjs_tk' => 'nullable',
            'tunjangan_pensiun' => 'nullable',
            'tunjangan_komunikasi' => 'nullable',
            'tunjangan_pph_21' => 'nullable',
            'pot_lainnya' => 'nullable',
            'lembur' => 'nullable'
        ]);

        if(!$validated['gaji']){
            $validated['gaji'] = 0;
        }

        if(!$validated['setoran_bpjs_kes']){
            $validated['setoran_bpjs_kes'] = 0;
        }

        if(!$validated['tunjangan_bpjs_kes']){
            $validated['tunjangan_bpjs_kes'] = 0;
        }

        if(!$validated['setoran_bpjs_tk']){
            $validated['setoran_bpjs_tk'] = 0;
        }
        
        if(!$validated['tunjangan_bpjs_tk']){
            $validated['tunjangan_bpjs_tk'] = 0;
        }

        if(!$validated['tunjangan_pensiun']){
            $validated['tunjangan_pensiun'] = 0;
        }

        if(!$validated['tunjangan_komunikasi']){
            $validated['tunjangan_komunikasi'] = 0;
        }

        if(!$validated['tunjangan_pph_21']){
            $validated['tunjangan_pph_21'] = 0;
        }

        if(!$validated['pot_lainnya']){
            $validated['pot_lainnya'] = 0;
        }

        if(!$validated['lembur']){
            $validated['lembur'] = 0;
        }

        $validated['gaji'] = str_replace(',', '', $validated['gaji']);
        $validated['setoran_bpjs_kes'] = str_replace(',', '', $validated['setoran_bpjs_kes']);
        $validated['tunjangan_bpjs_kes'] = str_replace(',', '', $validated['tunjangan_bpjs_kes']);
        $validated['setoran_bpjs_tk'] = str_replace(',', '', $validated['setoran_bpjs_tk']);
        $validated['tunjangan_bpjs_tk'] = str_replace(',', '', $validated['tunjangan_bpjs_tk']);
        $validated['tunjangan_pensiun'] = str_replace(',', '', $validated['tunjangan_pensiun']);
        $validated['tunjangan_komunikasi'] = str_replace(',', '', $validated['tunjangan_komunikasi']);
        $validated['tunjangan_pph_21'] = str_replace(',', '', $validated['tunjangan_pph_21']);
        $validated['pot_lainnya'] = str_replace(',', '', $validated['pot_lainnya']);
        $validated['lembur'] = str_replace(',', '', $validated['lembur']);

        Payroll::where('id', $id)->update($validated);
        return redirect('/payroll')->with('success', 'Data Berhasil di Update');
    }
    
    public function delete($id)
    {
        Payroll::where('id', $id)->delete();
        return redirect('/payroll')->with('success', 'Data Berhasil di Hapus');
    }
    
    public function download($id)
    {
        $pdf = Pdf::loadView('payroll.download', [
            'title' => 'Kartu Pasien',
            'data' => Payroll::find($id)
        ]);

        return $pdf->stream();
    }
}
