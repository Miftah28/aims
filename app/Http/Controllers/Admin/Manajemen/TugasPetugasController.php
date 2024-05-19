<?php

namespace App\Http\Controllers\Admin\Manajemen;

use App\Http\Controllers\Controller;
use App\Models\JadwalTugas;
use App\Models\Petugas;
use App\Models\PetugasJemput;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class TugasPetugasController extends Controller
{
    public function index()
    {
        $jadwal = JadwalTugas::where('admin_id', Auth::user()->admin->id)->get();
        $petugas = Petugas::where('admin_id', Auth::user()->admin->id)->get();
        $data = [
            'jadwal' => $jadwal,
            'petugas' => $petugas,
        ];
        return view('admin.manajemen sampah.kelola petugas penjemputan.index', $data);
    }
    public function store(Request $request, $id)
    {
        $petugasId = $request->input('petugas_id');
        // dd($petugasId);

        if (is_array($petugasId) && count($petugasId) > 0) {
            foreach ($petugasId as $tugasId) {
                $jadwaltugas = Petugas::find($tugasId);
                if ($jadwaltugas) {
                    $petugasjemput = PetugasJemput::create([
                        'jadwal_tugas_id' => Crypt::decrypt($id),
                        'petugas_id' => $tugasId,
                        // 'email' => $perusahaan->email_perusahaan,
                    ]);
                    // $this->sendNotificationEmail($pengumumanPerusahaan);
                }
            }
            if ($petugasjemput) {
                alert()->success('Success', 'Data Berhasil Disimpan');
                return redirect()->route('Admin.manajemen-sampah.kelola-tugas.index');
            } else {
                alert()->error('Error', 'Data Gagal Disimpan');
                return redirect()->route('Admin.manajemen-sampah.kelola-tugas.index');
            }
        } else {
            // Jika hanya satu pilihan yang dipilih
            $petugas = Petugas::find($request->petugas_id);

            if ($petugas) {
                $petugasjemput = PetugasJemput::create([
                    'jadwal_tugas_id' => Crypt::decrypt($id),
                    'petugas_id' => $request->petugas_id,
                    // 'email' => $petugas->email_perusahaan,
                ]);
                if ($petugasjemput) {
                    alert()->success('Success', 'Data Berhasil Disimpan');
                    return redirect()->route('Admin.manajemen-sampah.kelola-tugas.index');
                } else {
                    alert()->error('Error', 'Data Gagal Disimpan');
                    return redirect()->route('Admin.manajemen-sampah.kelola-tugas.index');
                }

                // $this->sendNotificationEmail($pengumumanPerusahaan);
            }
        }
    }
    public function update(Request $request, $id)
    {
        // Hapus entri terkait di tabel PetugasPejemput
        $existingPetugasIds = PetugasJemput::where('jadwal_tugas_id', Crypt::decrypt($id))->pluck('petugas_id')->toArray();
        $requestPetugasIds = $request->input('petugas_id', []);

        // Menemukan petugas_id yang perlu dihapus
        $petugasIdsToDelete = array_diff($existingPetugasIds, $requestPetugasIds);

        // Menemukan petugas_id yang perlu ditambahkan
        $petugasIdsToAdd = array_diff($requestPetugasIds, $existingPetugasIds);

        // Menghapus entri yang tidak ada dalam $requestPetugasIds
        PetugasJemput::where('jadwal_tugas_id', Crypt::decrypt($id))->whereIn('petugas_id', $petugasIdsToDelete)->delete();

        // Menambahkan entri baru untuk $requestPetugasIds yang tidak ada dalam database
        foreach ($petugasIdsToAdd as $petugasId) {
            $params1 = [
                'jadwal_tugas_id' =>  Crypt::decrypt($id),
                'petugas_id' => $petugasId,
                // 'email' => PerusahaanModel::find($petugasId)->email_perusahaan,
            ];

            // Menyimpan entri baru ke database
            PetugasJemput::create($params1);
        }

        // Cek apakah data berhasil disimpan atau tidak
        // if (isset($tambahpetugas)) {
        alert()->success('Success', 'Data Berhasil Disimpan');
        // } else {
        //     alert()->error('Error', 'Data Gagal Disimpan');
        // }

        // Kembali ke halaman yang sesuai tergantung dari hasil penyimpanan data
        return redirect()->route('Admin.manajemen-sampah.kelola-tugas.index');
    }
    public function destroy($id)
    {
        // dd(Crypt::decrypt($id));
        $petugas = PetugasJemput::where('jadwal_tugas_id', Crypt::decrypt($id));
        if ($petugas->delete()) {
            alert()->success('Success', 'Data Berhasil Dihapus');
        } else {
            alert()->error('Error', 'Data Gagal Dihapus');
        }
        return redirect()->route('Admin.manajemen-sampah.kelola-tugas.index');
    }
}
