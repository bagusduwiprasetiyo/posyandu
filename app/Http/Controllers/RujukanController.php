<?php

namespace App\Http\Controllers;

class RujukanController extends Controller
{
    private function topic($title, $pdf, $page, $summary)
    {
        return compact('title', 'pdf', 'page', 'summary');
    }

    public function index()
    {
        $title = 'Rujukan';
        $sidebarRujukan = 'active';
        $topics = [
            $this->topic('Rujukan Proses Melahirkan', 'Buku_KIA_2024.pdf', 13, 'Jika muncul tanda bahaya pada proses melahirkan, petugas kesehatan segera merujuk ibu ke Rumah Sakit.'),
            $this->topic('Tanda Bahaya Kehamilan Trimester 1', 'Buku_KIA_2024.pdf', 6, 'Tanda bahaya pada masa kehamilan perlu segera diperiksa di Puskesmas atau Rumah Sakit.'),
            $this->topic('Tanda Bahaya Kehamilan Trimester 2', 'Buku_KIA_2024.pdf', 10, 'Tanda bahaya trimester 2 perlu ditangani cepat agar kondisi ibu dan janin tidak memburuk.'),
            $this->topic('Tanda Bahaya Kehamilan Trimester 3', 'Buku_KIA_2024.pdf', 12, 'Trimester akhir perlu pemantauan ketat dan persiapan rujukan bila ada tanda bahaya.'),
            $this->topic('Rujukan Setelah Melahirkan/Nifas', 'Buku_KIA_2024.pdf', 15, 'Jika ada tanda bahaya setelah melahirkan, ibu perlu segera diperiksa di Puskesmas atau Rumah Sakit.'),
            $this->topic('Rujukan Persalinan 2020', 'Buku KIA-2020-Bagian-Ibu.pdf', 29, 'Buku KIA 2020 menegaskan persalinan dengan tanda bahaya harus segera dirujuk ke Rumah Sakit.'),
        ];

        return view('rujukan.index', compact('title', 'sidebarRujukan', 'topics'));
    }
}
