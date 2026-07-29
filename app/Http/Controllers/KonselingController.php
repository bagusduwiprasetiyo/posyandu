<?php

namespace App\Http\Controllers;

class KonselingController extends Controller
{
    private function topic($title, $pdf, $page, $summary)
    {
        return compact('title', 'pdf', 'page', 'summary');
    }

    private function menus()
    {
        return [
            'ibu-hamil' => [
                'title' => 'Ibu Hamil',
                'icon' => 'mdi-human-pregnant',
                'topics' => [
                    $this->topic('Kehamilan', 'Buku_KIA_2024.pdf', 4, 'Panduan umum masa kehamilan, pemeriksaan rutin, nutrisi, dan pemantauan kondisi ibu serta janin.'),
                    $this->topic('Tanda Bahaya Trimester 1', 'Buku_KIA_2024.pdf', 6, 'Jika muncul tanda bahaya pada trimester awal, ibu perlu segera periksa ke fasilitas kesehatan.'),
                    $this->topic('Tanda Bahaya Trimester 2', 'Buku_KIA_2024.pdf', 10, 'Tanda bahaya trimester 2 perlu dikenali agar masalah ibu dan janin cepat ditangani.'),
                    $this->topic('Tanda Bahaya Trimester 3', 'Buku_KIA_2024.pdf', 12, 'Trimester akhir perlu pemantauan ketat, termasuk tanda bahaya dan persiapan proses melahirkan.'),
                    $this->topic('Tanda Bahaya Kehamilan 2020', 'Buku KIA-2020-Bagian-Ibu.pdf', 25, 'Materi Buku KIA 2020 tentang tanda bahaya kehamilan seperti perdarahan, kejang, demam tinggi, dan janin kurang bergerak.'),
                ],
            ],
            'ibu-bersalin' => [
                'title' => 'Ibu Bersalin',
                'icon' => 'mdi-hospital-building',
                'topics' => [
                    $this->topic('Melahirkan', 'Buku_KIA_2024.pdf', 12, 'Materi 2024 tentang proses melahirkan aman, dukungan keluarga, IMD, dan perawatan segera setelah lahir.'),
                    $this->topic('Tanda Bahaya Melahirkan', 'Buku_KIA_2024.pdf', 13, 'Tanda bahaya proses melahirkan perlu rujukan cepat ke rumah sakit oleh tenaga kesehatan.'),
                    $this->topic('Persiapan Melahirkan', 'Buku KIA-2020-Bagian-Ibu.pdf', 26, 'Persiapan dana, transportasi, pendonor, dokumen, pendamping, dan rencana melahirkan di fasilitas kesehatan.'),
                    $this->topic('Tanda Awal Persalinan', 'Buku KIA-2020-Bagian-Ibu.pdf', 27, 'Mulas teratur, keluar lendir darah, atau ketuban keluar adalah tanda ibu perlu segera ke fasilitas kesehatan.'),
                    $this->topic('Tanda Bahaya Persalinan 2020', 'Buku KIA-2020-Bagian-Ibu.pdf', 29, 'Perdarahan, kejang, ketuban hijau berbau, tali pusat/tangan bayi keluar, nyeri hebat, atau tidak kuat mengejan.'),
                ],
            ],
            'ibu-nifas' => [
                'title' => 'Ibu Nifas',
                'icon' => 'mdi-heart-pulse',
                'topics' => [
                    $this->topic('Setelah Melahirkan', 'Buku_KIA_2024.pdf', 15, 'Masa pemulihan ibu setelah melahirkan, pemeriksaan nifas, kebutuhan gizi, emosi, dan dukungan keluarga.'),
                    $this->topic('Tanda Bahaya Nifas', 'Buku_KIA_2024.pdf', 15, 'Kematian ibu banyak terjadi setelah melahirkan, sehingga tanda bahaya nifas harus cepat dikenali.'),
                    $this->topic('Perawatan Ibu Nifas 2020', 'Buku KIA-2020-Bagian-Ibu.pdf', 31, 'Perawatan nifas 6 jam sampai 42 hari setelah persalinan, minimal 4 kali kunjungan tenaga kesehatan.'),
                    $this->topic('Tanda Bahaya Ibu Nifas 2020', 'Buku KIA-2020-Bagian-Ibu.pdf', 32, 'Demam, perdarahan, cairan berbau, depresi, bengkak/kejang, dan payudara nyeri perlu segera diperiksa.'),
                ],
            ],
            'ibu-menyusui' => [
                'title' => 'Ibu Menyusui',
                'icon' => 'mdi-baby',
                'topics' => [
                    $this->topic('Menyusui', 'Buku_KIA_2024.pdf', 19, 'Menyusui bermanfaat untuk pemulihan rahim, kesehatan payudara, dan ASI adalah gizi terbaik bayi.'),
                    $this->topic('Cara Menyusui yang Benar', 'Buku_KIA_2024.pdf', 19, 'Menyusui sesering mungkin, posisi dan pelekatan benar, serta mencari konseling jika ada masalah.'),
                    $this->topic('Menyusui Bayi 2020', 'Buku KIA-2020-Bagian-Ibu.pdf', 33, 'Panduan menyusui bayi, posisi pelekatan, dan manfaat ASI bagi ibu serta bayi.'),
                ],
            ],
            'keluarga-berencana' => [
                'title' => 'Keluarga Berencana',
                'icon' => 'mdi-human-male-female',
                'topics' => [
                    $this->topic('KB Pasca Melahirkan', 'Buku_KIA_2024.pdf', 18, 'Pemilihan kontrasepsi setelah melahirkan sampai 42 hari, dengan prinsip tidak mengganggu produksi ASI.'),
                    $this->topic('Metode Kontrasepsi', 'Buku_KIA_2024.pdf', 18, 'Pilihan metode jangka panjang dan non-jangka panjang sesuai kondisi ibu dan kebutuhan keluarga.'),
                    $this->topic('Keluarga Berencana 2020', 'Buku KIA-2020-Bagian-Ibu.pdf', 37, 'KB membantu mengatur jarak kehamilan, jumlah anak, kesehatan ibu, bayi, balita, dan keluarga.'),
                ],
            ],
            'kelas-ibu-hamil' => [
                'title' => 'Kelas Ibu Hamil',
                'icon' => 'mdi-school',
                'topics' => [
                    $this->topic('Kelas Ibu Hamil', 'Buku_KIA_2024.pdf', 9, 'Kelas ibu hamil membantu ibu mempersiapkan tubuh dan mental untuk proses melahirkan.'),
                    $this->topic('Kelas Ibu Hamil 2020', 'Buku KIA-2020-Bagian-Ibu.pdf', 21, 'Kelas ibu hamil memuat informasi kehamilan, persalinan, nifas, bayi baru lahir, gizi, dan layanan kesehatan.'),
                ],
            ],
            'bayi-0-6-bulan' => [
                'title' => 'Bayi 0 - 6 Bulan',
                'icon' => 'mdi-baby',
                'topics' => [
                    $this->topic('Bayi 0 - 6 Bulan', 'Buku_KIA_2024.pdf', 21, 'Perawatan bayi baru lahir sampai usia 6 bulan, termasuk ASI eksklusif, kehangatan, kebersihan, dan pemantauan kesehatan.'),
                    $this->topic('Tanda Bahaya Bayi 0 - 28 Hari', 'Buku_KIA_2024.pdf', 22, 'Tanda bahaya bayi baru lahir harus segera diperiksa oleh bidan, dokter, atau perawat.'),
                    $this->topic('ASI Eksklusif', 'Buku_KIA_2024.pdf', 21, 'Beri hanya ASI sampai usia 6 bulan, susui semau bayi, dan hindari botol/dot bila tidak diperlukan.'),
                ],
            ],
            'bayi-6-12-bulan' => [
                'title' => 'Bayi 6 - 12 Bulan',
                'icon' => 'mdi-food-apple',
                'topics' => [
                    $this->topic('Bayi 6 - 12 Bulan', 'Buku_KIA_2024.pdf', 30, 'Materi perkembangan bayi 6-12 bulan, pemantauan pertumbuhan, stimulasi, dan pemberian makanan pendamping ASI.'),
                    $this->topic('MPASI dan Menyusui Lanjutan', 'Buku_KIA_2024.pdf', 30, 'Lanjutkan menyusui, mulai MPASI sesuai usia, tekstur, frekuensi, dan kebutuhan gizi bayi.'),
                    $this->topic('Tanda Bahaya Balita', 'Buku_KIA_2024.pdf', 27, 'Tanda bahaya pada bayi dan balita perlu dikenali agar anak segera mendapat pelayanan kesehatan.'),
                ],
            ],
            'anak-12-24-bulan' => [
                'title' => 'Anak 12 - 24 Bulan',
                'icon' => 'mdi-teddy-bear',
                'topics' => [
                    $this->topic('Anak 12 - 24 Bulan', 'Buku_KIA_2024.pdf', 34, 'Panduan kesehatan, gizi, stimulasi, perkembangan, dan pemantauan anak usia 1-2 tahun.'),
                    $this->topic('Stimulasi Anak 12 - 24 Bulan', 'Buku_KIA_2024.pdf', 34, 'Ajak anak bergerak, bicara, bermain, membaca, dan melakukan aktivitas sederhana sesuai usia.'),
                    $this->topic('Tanda Bahaya Balita', 'Buku_KIA_2024.pdf', 27, 'Segera periksa ke tenaga kesehatan bila anak sakit atau mengalami tanda bahaya.'),
                ],
            ],
            'anak-2-6-tahun' => [
                'title' => 'Anak 2 - 6 Tahun',
                'icon' => 'mdi-human-child',
                'topics' => [
                    $this->topic('Anak 2 - 6 Tahun', 'Buku_KIA_2024.pdf', 37, 'Panduan kesehatan dan perkembangan anak usia 2-6 tahun, termasuk gizi, stimulasi, keselamatan, dan kebiasaan sehat.'),
                    $this->topic('Stimulasi dan Perkembangan', 'Buku_KIA_2024.pdf', 37, 'Dukung perkembangan anak dengan bermain, membaca, bernyanyi, bergerak, dan berinteraksi dengan lingkungan.'),
                    $this->topic('Imunisasi Anak', 'Buku_KIA_2024.pdf', 64, 'Materi imunisasi anak dan perlindungan dari penyakit yang dapat dicegah dengan imunisasi.'),
                    $this->topic('Tanda Bahaya Balita', 'Buku_KIA_2024.pdf', 27, 'Kenali tanda bahaya pada balita agar anak segera mendapat penanganan di fasilitas kesehatan.'),
                ],
            ],
        ];
    }

    public function index()
    {
        $title = 'Konseling';
        $sidebarKonseling = 'active';
        return view('konseling.index', compact('title', 'sidebarKonseling'));
    }

    public function show($kategori)
    {
        $menus = $this->menus();

        abort_unless(isset($menus[$kategori]), 404);

        $title = 'Konseling ' . $menus[$kategori]['title'];
        $sidebarKonseling = 'active';
        $menu = $menus[$kategori];
        return view('konseling.show', compact('title', 'sidebarKonseling', 'menu'));
    }
}
