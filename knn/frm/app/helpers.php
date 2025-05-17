<?php
if (!function_exists('yesno')) {
    function yesno($int)
    {
        if ($int != 0) {
            return 'Ya';
        }
        return 'Tidak';
    }
}

use App\Models\Kehamilan;
use App\Models\Kunjungan;
use App\Models\Pasien;


if (!function_exists('resikoKSPR')) {
    function resikoKSPR($skor)
    {
        if ($skor < 6) {
            $kspr = 'KRR';
        } elseif ($skor >= 6 and $skor <= 10) {
            $kspr = 'KRT';
        } else {
            $kspr = 'KRST';
        }
        return $kspr;
    }
}
if (!function_exists('hitungSkorKSPR')) {
    function hitungSkorKSPR($idkehamilan, $idkunjungan)
    {
        $kehamilan = Kehamilan::where('id', $idkehamilan)->first();
        $kunjungan = Kunjungan::where('id', $idkunjungan)->first();
        $skor = $kehamilan->skor_awal +
            $kehamilan->terlalu_muda_hamil +
            $kehamilan->terlalu_tua_hamil +
            $kehamilan->lambat_hamil_pertama +
            $kehamilan->lama_hamil_lagi +
            $kehamilan->cepat_hamil_lagi +
            $kehamilan->banyak_anak +
            $kehamilan->umur_terlalu_tua +
            $kehamilan->terlalu_pendek +
            $kehamilan->gagal_hamil +
            $kehamilan->lahir_vakum +
            $kehamilan->lahir_dirogoh +
            $kehamilan->lahir_transfusi +
            $kehamilan->pernah_sesar +
            $kehamilan->penyakit_kurang_darah +
            $kehamilan->penyakit_malaria +
            $kehamilan->penyakit_tbc +
            $kehamilan->penyakit_jantung +
            $kehamilan->penyakit_kencing_manis +
            $kehamilan->penyakit_pms +
            $kehamilan->hamil_kembar +
            $kunjungan->bengkak_muka +
            $kunjungan->hidraniom +
            $kunjungan->bayi_mati +
            $kunjungan->lebih_bulan +
            $kunjungan->sungsang +
            $kunjungan->lintang +
            $kunjungan->pendarahan +
            $kunjungan->peb;
        return $skor;
    }
}
