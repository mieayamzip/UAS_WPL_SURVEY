<?php

namespace App\Http\Controllers;

use App\Models\Skor;
use App\Models\Survey;
use App\Models\DataRumah;
use App\Models\DataKendaraan;
use App\Models\DataPekerjaanPendapatan;
use App\Models\DataKeluarga;
use Illuminate\Http\Request;

class SkorController extends Controller
{
    public function store(Request $request)
    {
        $survey_id = $request->survey_id;
        $survey = Survey::findOrFail($survey_id);

        // ====== DATA PEKERJAAN & PENDAPATAN ======
        $dataPekerjaan = DataPekerjaanPendapatan::where('survey_id', $survey_id)->first();
        $skor_pendapatan = 0;

        // Skor pendapatan, semakin rendah maka semakin LAYAK (skor kecil)
        switch ($dataPekerjaan->pendapatan_id) {
            case 1:
                $skor_pendapatan = 5;
                break; // <=500k
            case 2:
                $skor_pendapatan = 10;
                break; // 500k-1jt
            case 3:
                $skor_pendapatan = 20;
                break; // 1jt-2jt
            case 4:
                $skor_pendapatan = 30;
                break; // 2jt-3.5jt
            case 5:
                $skor_pendapatan = 40;
                break; // 3.5jt-5jt
            case 6:
                $skor_pendapatan = 50;
                break; // 5jt-7.5jt
            case 7:
                $skor_pendapatan = 70;
                break; // 7.5jt-10jt
            case 8:
                $skor_pendapatan = 80;
                break; // 10jt-15jt
            case 9:
                $skor_pendapatan = 90;
                break; // 15jt-20jt
            case 10:
                $skor_pendapatan = 100;
                break; // >20jt
        }

        // ====== DATA KELUARGA ======
        $dataKeluarga = DataKeluarga::where('survey_id', $survey_id)->first();
        $skor_keluarga = 0;

        // Skor jumlah tanggungan, semakin banyak tanggungan maka skor semakin RENDAH (lebih layak)
        if ($dataKeluarga->jumlah_tanggungan >= 5) {
            $skor_keluarga = 5;
        } elseif ($dataKeluarga->jumlah_tanggungan >= 3) {
            $skor_keluarga = 15;
        } else {
            $skor_keluarga = 30;
        }

        // Status pernikahan tambahan poin (cerai mati lebih layak daripada cerai hidup)
        if ($dataKeluarga->status_pernikahan_id == 3) { // Cerai Mati
            $skor_keluarga -= 5; // lebih layak
        } elseif ($dataKeluarga->status_pernikahan_id == 4) { // Cerai Hidup
            $skor_keluarga += 5; // agak kurang layak dibanding cerai mati
        }

        if ($skor_keluarga < 0) $skor_keluarga = 0;

        // ====== DATA RUMAH ======
        $dataRumah = DataRumah::where('survey_id', $survey_id)->first();
        $skor_rumah = 0;

        // Status rumah
        if ($dataRumah->status_rumah_id == 1) { // milik sendiri
            $skor_rumah += 30;
        } elseif ($dataRumah->status_rumah_id == 2 || $dataRumah->status_rumah_id == 3) { // menumpang ortu / saudara
            $skor_rumah += 10;
        } else { // kontrak / sewa / lain
            $skor_rumah += 20;
        }

        // Jenis rumah
        if ($dataRumah->jenis_rumah_id == 1) { // permanen
            $skor_rumah += 20;
        } else {
            $skor_rumah += 10;
        }

        // Kondisi rumah
        if ($dataRumah->kondisi_rumah_id == 1) { // baik
            $skor_rumah += 20;
        } elseif ($dataRumah->kondisi_rumah_id == 2) { // rusak sebagian
            $skor_rumah += 10;
        } else { // rusak parah
            $skor_rumah += 5;
        }

        // Luas rumah
        if ($dataRumah->luas_rumah < 50) {
            $skor_rumah += 5;
        } elseif ($dataRumah->luas_rumah <= 100) {
            $skor_rumah += 10;
        } else {
            $skor_rumah += 20;
        }

        if ($skor_rumah > 100) $skor_rumah = 100;

        // ====== DATA KENDARAAN ======
        $dataKendaraan = DataKendaraan::where('survey_id', $survey_id)->get();
        $skor_kendaraan = 0;

        foreach ($dataKendaraan as $dk) {
            if ($dk->jenis_kendaraan_id == 3) { // sepeda motor
                $skor_kendaraan += 10 * $dk->jumlah_kendaraan;
            } elseif ($dk->jenis_kendaraan_id == 2) { // sepeda
                $skor_kendaraan += 5 * $dk->jumlah_kendaraan;
            } elseif ($dk->jenis_kendaraan_id == 4) { // mobil
                $skor_kendaraan += 50 * $dk->jumlah_kendaraan;
            }
        }

        // Jika total motor+sepeda lebih dari 4 dianggap tidak layak (tambah skor tinggi)
        $total_kendaraan_ringan = $dataKendaraan->whereIn('jenis_kendaraan_id', [2, 3])->sum('jumlah_kendaraan');
        if ($total_kendaraan_ringan > 4) {
            $skor_kendaraan += 30;
        }

        if ($skor_kendaraan > 100) $skor_kendaraan = 100;

        // ====== TOTAL SKOR ======
        // Bobot: pendapatan(40%), keluarga(20%), rumah(20%), kendaraan(20%)
        $total_skor = ($skor_pendapatan * 0.4) + ($skor_keluarga * 0.2) + ($skor_rumah * 0.2) + ($skor_kendaraan * 0.2);

        // HASIL
        $hasil_skor = number_format($total_skor, 2);
        $kelayakan = ($total_skor <= 50) ? 'Layak' : 'Tidak Layak';

        Skor::create([
            'survey_id' => $survey_id,
            'skor_rumah' => $skor_rumah,
            'skor_kendaraan' => $skor_kendaraan,
            'skor_pendapatan' => $skor_pendapatan,
            'skor_anak_tanggungan' => $skor_keluarga,
            'total_skor' => $total_skor,
            'hasil_skor' => $hasil_skor,
            'kelayakan' => $kelayakan,
        ]);

        return redirect()->route('dashboard.index')->with('success', 'Data survey berhasil disimpan');
    }
}
