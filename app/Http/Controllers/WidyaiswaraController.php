<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\View\View;

class WidyaiswaraController extends Controller
{
    // Pindahkan array $profiles sebagai properti kelas agar dapat diakses oleh semua fungsi
    protected $profiles = [
        [
            'photo' => 'images/Dra. MUKAROMAH SYAKOER, M.M.jpg',
            'name' => 'Dra. MUKAROMAH SYAKOER, M.M.',
            'nip' => '196102171985032008',
            'jabatan_singkat' => 'WIDYAISWARA AHLI UTAMA',
            'rank' => 'Pembina Utama Madya (IV/d) (TMT 01-04-2016)',
            'jabatan_lengkap' => 'WIDYAISWARA AHLI UTAMA (TMT 18-08-2020)',
            'penempatan' => 'BPSDMD Prov.Jateng',
            'kompetensi' => [
                ['materi' => 'Advokasi Penyampaian ke Lokus', 'jenis_diklat' => 'Diklat Kepemimpinan Tingkat II'],
                ['materi' => 'Agenda 1: Sikap Perilaku Bela Negara', 'jenis_diklat' => 'Diklat Prajabatan'],
                ['materi' => 'Agenda 2: Kepemimpinan Pelayanan', 'jenis_diklat' => 'Diklat Kepemimpinan Tingkat IV'],
                ['materi' => 'Agenda 2: Kepemimpinan Pelayanan', 'jenis_diklat' => 'Diklat Kepemimpinan Tingkat IV'],
                ['materi' => 'Agenda 2: Nilai-nilai Dasar PNS', 'jenis_diklat' => 'Diklat Prajabatan'],
                ['materi' => 'Agenda 3: Kedudukan dan Peran PNS Menuju Smart Governance', 'jenis_diklat' => 'Diklat Prajabatan'],
                ['materi' => 'Akuntabilitas Kinerja', 'jenis_diklat' => 'Diklat Kepemimpinan Tingkat III']
            ]
        ],
        [
            'photo' => 'images/HENDRI SANTOSA, SE, Ak, M.Si. CA.jpg',
            'name' => 'HENDRI SANTOSA, SE, Ak, M.Si. CA',
            'nip' => '196112261983031001',
            'jabatan_singkat' => 'WIDYAISWARA AHLI UTAMA',
            'rank' => 'Pembina Utama Madya (IV/d) (TMT 2015-04-01)',
            'jabatan_lengkap' => 'WIDYAISWARA AHLI UTAMA (TMT 2021-11-19)',
            'penempatan' => 'BPSDMD Prov.Jateng',
            'kompetensi' => [
                ['materi' => 'Advokasi Penyampaian ke Lokus', 'jenis_diklat' => 'Diklat Kepemimpinan Tingkat II'],
                ['materi' => 'Agenda 1: Kepemimpinan Pancasila dan Bela Negara', 'jenis_diklat' => 'Diklat Kepemimpinan Tingkat IV'],
                ['materi' => 'Agenda 1: Sikap Perilaku Bela Negara', 'jenis_diklat' => 'Diklat Prajabatan'],
                ['materi' => 'Agenda 2: Nilai-nilai Dasar PNS', 'jenis_diklat' => 'Diklat Prajabatan'],
                ['materi' => 'Agenda 3: Kedudukan dan Peran PNS Menuju Smart Governance', 'jenis_diklat' => 'Diklat Prajabatan'],
                ['materi' => 'Agenda 3: Pengendalian Pekerjaan', 'jenis_diklat' => 'Diklat Kepemimpinan Tingkat IV'],
                ['materi' => 'Aktualisasi/ Habituasi (80 Hari Kalender)', 'jenis_diklat' => 'Diklat Prajabatan'],
                ['materi' => 'Akuntabilitas PNS', 'jenis_diklat' => 'Diklat Prajabatan'],
                ['materi' => 'Analisis dan Evaluasi Resiko', 'jenis_diklat' => 'Diklat Teknis'],
                ['materi' => 'Analisis Isu Kontemporer', 'jenis_diklat' => 'Diklat Prajabatan'],
                ['materi' => 'Anti Korupsi', 'jenis_diklat' => 'Diklat Prajabatan'],
                ['materi' => 'Anti Korupsi', 'jenis_diklat' => 'Diklat Teknis'],
                ['materi' => 'ASN Ber-AKHLAK', 'jenis_diklat' => 'Diklat Teknis'],
                ['materi' => 'ASN Ber-AKHLAK', 'jenis_diklat' => 'Diklat Teknis'],
                ['materi' => 'Asta Cita Ketujuh (Memperkuat Pencegahan dan Pemberantasan Korupsi dan Narkoba)', 'jenis_diklat' => 'Diklat Kepemimpinan'],
                ['materi' => 'Berbagi Pengalaman Hasil VKN', 'jenis_diklat' => 'Diklat Kepemimpinan Tingkat II'],
                ['materi' => 'Bimbingan 1 Penyusun KK', 'jenis_diklat' => 'Diklat Teknis'],
                ['materi' => 'Bimbingan 1 penyusunan KK', 'jenis_diklat' => 'Diklat Teknis'],
                ['materi' => 'Bimbingan 2 penyusunan KK', 'jenis_diklat' => 'Diklat Teknis'],
                ['materi' => 'Bimbingan 2 penyusunan KK', 'jenis_diklat' => 'Diklat Teknis'],
                ['materi' => 'Bimbingan Penyusunan Karya Tulis Ilmiah', 'jenis_diklat' => 'Diklat Teknis'],
                ['materi' => 'Bimbingan penyusunan KK', 'jenis_diklat' => 'Diklat Teknis'],
                ['materi' => 'Bimbingan Penyusunan Rencana Aksi', 'jenis_diklat' => 'Diklat Teknis'],
                ['materi' => 'Bimbingan Penyusunan Tugas Akhir', 'jenis_diklat' => 'Diklat Teknis'],
                ['materi' => 'BLC', 'jenis_diklat' => 'Diklat Teknis'],
                ['materi' => 'Building Learning Commitment (BLC)', 'jenis_diklat' => 'Diklat Teknis'],
                ['materi' => 'Ceramah Core Values dan Employee Branding ASN', 'jenis_diklat' => 'Diklat Prajabatan'],
                ['materi' => 'Ceramah Energi Kepemimpinan', 'jenis_diklat' => 'Diklat Kepemimpinan Tingkat II'],
                ['materi' => 'Ceramah Etika dan Integritas ASN', 'jenis_diklat' => 'Diklat Prajabatan'],
                ['materi' => 'Ceramah Integritas Kepemimpinan', 'jenis_diklat' => 'Diklat Kepemimpinan Tingkat II'],
                ['materi' => 'Ceramah Isu Aktual dalam Kepemimpinan Strategis', 'jenis_diklat' => 'Diklat Kepemimpinan Tingkat II'],
                ['materi' => 'Ceramah Isu Strategis: Integritas Kepemimpinan', 'jenis_diklat' => 'Diklat Kepemimpinan Tingkat II'],
                ['materi' => 'Ceramah Isu Strategis: Tema PKN Tingkat II', 'jenis_diklat' => 'Diklat Kepemimpinan Tingkat II'],
                ['materi' => 'Ceramah Isu Tema: Visitasi Kepemimpinan Nasional', 'jenis_diklat' => 'Diklat Kepemimpinan Tingkat II'],
                ['materi' => 'Ceramah Kebijakan dan Tidak Lanjut Hasil Pelatihan', 'jenis_diklat' => 'Diklat Kepemimpinan Tingkat III'],
                ['materi' => 'Ceramah Kebijakan dan Tindak Lanjut Hasil Pelatihan', 'jenis_diklat' => 'Diklat Kepemimpinan Tingkat II'],
                ['materi' => 'Ceramah Kebijakan Pengembangan SDA dan Nilai-nilai ASN', 'jenis_diklat' => 'Diklat Prajabatan'],
                ['materi' => 'Ceramah MTSL', 'jenis_diklat' => 'Diklat Prajabatan'],
                ['materi' => 'Ceramah Visitasi', 'jenis_diklat' => 'Diklat Kepemimpinan Tingkat II'],
                ['materi' => 'Coaching Virtual ( Pembimbingan )', 'jenis_diklat' => 'Diklat Prajabatan'],
                ['materi' => 'Core Value ASN', 'jenis_diklat' => 'Diklat Teknis'],
                ['materi' => 'Core Value ASN BerAKHLAK', 'jenis_diklat' => 'Diklat Teknis'],
                ['materi' => 'Core Value ASN BerAKHLAK', 'jenis_diklat' => 'Diklat Teknis'],
                ['materi' => 'Core Values ASN berAKHLAK', 'jenis_diklat' => 'Diklat Fungsional'],
                ['materi' => 'Desain', 'jenis_diklat' => 'Diklat Kepemimpinan Tingkat II'],
            ]
        ],
        [
            'photo' => 'images/Dr. Ir. SUPRIYANTO, M.Si.jpeg',
            'name' => 'Dr. Ir. SUPRIYANTO, M.Si.',
            'nip' => '196205171991031004',
            'jabatan_singkat' => 'WIDYAISWARA AHLI UTAMA',
            'rank' => 'Pembina Utama (IV/e) (TMT 01-12-2024)',
            'jabatan_lengkap' => 'WIDYAISWARA AHLI UTAMA (TMT 10-12-2021)',
            'penempatan' => 'BPSDMD Prov.Jateng',
            'kompetensi' => [
                ['materi' => 'Advokasi Penyampaian ke Lokus', 'jenis_diklat' => 'Diklat Kepemimpinan Tingkat II'],
            ]
        ],
        [
            'photo' => 'images/SUDIRMAN MUSTAFA, SH, M.Hum.jpg',
            'name' => 'SUDIRMAN MUSTAFA, SH, M.Hum',
            'nip' => '196209161995011001',
            'jabatan_singkat' => 'WIDYAISWARA AHLI UTAMA',
            'rank' => 'Pembina Utama Madya (IV/d) (TMT 01-10-2020)',
            'jabatan_lengkap' => 'WIDYAISWARA AHLI UTAMA (TMT 23-04-2020)',
            'penempatan' => 'BPSDMD Prov. Jateng',
            'kompetensi' => [
                ['materi' => 'Advokasi Penyampaian ke Lokus', 'jenis_diklat' => 'Diklat Kepemimpinan Tingkat II'],
            ]
        ],
        [
            'photo' => 'images/Drs. SISWANTA JAKA PURNAMA, Apt., M.Kes.jpg',
            'name' => 'Drs. SISWANTA JAKA PURNAMA, Apt., M.Kes.',
            'nip' => '196310281989111001',
            'jabatan_singkat' => 'WIDYAISWARA AHLI UTAMA',
            'rank' => 'Pembina Utama (IV/e) (TMT 01-10-2020)',
            'jabatan_lengkap' => 'WIDYAISWARA AHLI UTAMA (TMT 01-04-2017)',
            'penempatan' => 'BPSDMD Prov. Jateng',
            'kompetensi' => [
                ['materi' => 'Advokasi Penyampaian ke Lokus', 'jenis_diklat' => 'Diklat Kepemimpinan Tingkat II'],
            ]
        ],
        [
            'photo' => 'images/Ir. YATNO ISWORO,MP.jpg',
            'name' => 'Ir. YATNO ISWORO,MP',
            'nip' => '196410101999031002',
            'jabatan_singkat' => 'WIDYAISWARA AHLI UTAMA',
            'rank' => 'Pembina Utama (IV/e) (TMT 01-10-2023))',
            'jabatan_lengkap' => 'WIDYAISWARA AHLI UTAMA (TMT 13-02-2020)',
            'penempatan' => 'BPSDMD Prov. Jateng',
            'kompetensi' => [
                ['materi' => 'Advokasi Penyampaian ke Lokus', 'jenis_diklat' => 'Diklat Kepemimpinan Tingkat II'],
            ]
        ],
        [
            'photo' => 'images/DWI TITI SUNDARI, SKM, M.Kes.jpg',
            'name' => 'DWI TITI SUNDARI, SKM, M.Kes',
            'nip' => '196512131988032004',
            'jabatan_singkat' => 'WIDYAISWARA AHLI MADYA',
            'rank' => 'Pembina (IV/a) (TMT 01-04-2013)',
            'jabatan_lengkap' => 'WIDYAISWARA AHLI MADYA (TMT 14-03-2013)',
            'penempatan' => 'BPTK Gombong',
            'kompetensi' => [
                ['materi' => 'Advokasi', 'jenis_diklat' => 'Diklat Kepemimpinan Tingkat IV'],
            ]
        ],
        [
            'photo' => 'images/Ir. YOYON INDRAYANA, M.T.jpeg',
            'name' => 'Ir. YOYON INDRAYANA, M.T',
            'nip' => '196607221993011001',
            'jabatan_singkat' => 'WIDYAISWARA AHLI MADYA',
            'rank' => 'Pembina Utama Muda (IV/c) (TMT 01-04-2015)',
            'jabatan_lengkap' => 'WIDYAISWARA AHLI MADYA (TMT 11-02-2021)',
            'penempatan' => 'BPSDMD Prov. Jateng',
            'kompetensi' => [
                ['materi' => 'Mengelola Perubahan', 'jenis_diklat' => 'Diklat Kepemimpinan'],
            ]
        ],
        [
            'photo' => 'images/Ir. WARDI ASTUTI, MPD.jpg',
            'name' => 'Ir. WARDI ASTUTI, MPD',
            'nip' => '196608181992032015',
            'jabatan_singkat' => 'WIDYAISWARA AHLI UTAMA',
            'rank' => 'Pembina Utama (IV/e) (TMT 01-04-2022)',
            'jabatan_lengkap' => 'WIDYAISWARA AHLI UTAMA (TMT 19-03-2019)',
            'penempatan' => 'BPSDM Soropadan',
            'kompetensi' => [
                ['materi' => 'Agenda 1: Kepemimpinan Pancasila dan Bela Negara', 'jenis_diklat' => 'Diklat Kepemimpinan Tingkat IV'],
            ]
        ],
        [
            'photo' => 'images/IKBAL KHAFID, S.IP, MSi.jpeg',
            'name' => 'IKBAL KHAFID, S.IP, MSi',
            'nip' => '196705041986031002',
            'jabatan_singkat' => 'WIDYAISWARA AHLI MADYA',
            'rank' => 'Pembina Utama Muda (IV/c) (TMT 01-04-2022)',
            'jabatan_lengkap' => 'WIDYAISWARA AHLI MADYA (TMT 29-03-2016)',
            'penempatan' => 'BPSDMD Prov. Jateng',
            'kompetensi' => [
                ['materi' => 'Advokasi', 'jenis_diklat' => 'Diklat Kepemimpinan Tingkat IV'],
            ]
        ],
        [
            'photo' => 'images/GIGUS NURYATNO, A.Pi., M.A.P.jpg',
            'name' => 'GIGUS NURYATNO, A.Pi., M.A.P.',
            'nip' => '196708221991031011',
            'jabatan_singkat' => 'WIDYAISWARA AHLI MADYA',
            'rank' => 'Pembina Utama Muda (IV/c) (TMT 01-10-2015)',
            'jabatan_lengkap' => 'WIDYAISWARA AHLI MADYA (TMT 29-02-2012)',
            'penempatan' => 'BPSDM Peternakan',
            'kompetensi' => [
                ['materi' => 'Advokasi', 'jenis_diklat' => 'Diklat Kepemimpinan Tingkat IV'],
            ]
        ],
        [
            'photo' => 'images/Drs. EKO SUPRAYITNO, MM.jpeg',
            'name' => 'Drs. EKO SUPRAYITNO, MM',
            'nip' => '196709251993031004',
            'jabatan_singkat' => 'WIDYAISWARA AHLI MADYA',
            'rank' => 'Pembina Utama Muda (IV/c) (TMT 01-10-2019)',
            'jabatan_lengkap' => 'WIDYAISWARA AHLI MADYA (TMT 04-04-2022)',
            'penempatan' => 'BPSDMD Prov. Jateng',
            'kompetensi' => [
                ['materi' => 'Advokasi', 'jenis_diklat' => 'Diklat Kepemimpinan Tingkat IV'],
            ]
        ],
        [
            'photo' => 'images/Drs. SUMARNO, M.Si.jpeg',
            'name' => 'Drs. SUMARNO, M.Si',
            'nip' => '196807041988031003',
            'jabatan_singkat' => 'WIDYAISWARA AHLI MADYA',
            'rank' => 'Pembina Utama Muda (IV/c) (TMT 01-04-2025)',
            'jabatan_lengkap' => 'WIDYAISWARA AHLI MADYA (TMT 12-03-2018)',
            'penempatan' => 'BPSDMD Prov. Jateng',
            'kompetensi' => [
                ['materi' => 'Advokasi', 'jenis_diklat' => 'Diklat Kepemimpinan Tingkat IV'],
            ]
        ],
        [
            'photo' => 'images/HARINI SETIJOWATI, SKM, M.HSc.png',
            'name' => 'HARINI SETIJOWATI, SKM, M.HSc.',
            'nip' => '196811091993032005',
            'jabatan_singkat' => 'WIDYAISWARA AHLI MADYA',
            'rank' => 'Pembina Utama Muda (IV/c) (TMT 01-04-2023)',
            'jabatan_lengkap' => 'WIDYAISWARA AHLI MADYA (TMT 18-03-2019)',
            'penempatan' => 'BPSDMD Prov. Jateng',
            'kompetensi' => [
                ['materi' => 'Advokasi', 'jenis_diklat' => 'Diklat Kepemimpinan Tingkat IV'],
            ]
        ],
        [
            'photo' => 'images/DIYAH MUBAROKAH AKHADIYATI, S.Pi, M.Pi.jpeg',
            'name' => 'DIYAH MUBAROKAH AKHADIYATI, S.Pi, M.Pi.',
            'nip' => '196901091997032002',
            'jabatan_singkat' => 'WIDYAISWARA AHLI MADYA',
            'rank' => 'Pembina Utama Muda (IV/c) (TMT 01-10-2023)',
            'jabatan_lengkap' => 'WIDYAISWARA AHLI MADYA (TMT 06-11-2020)',
            'penempatan' => 'BPSDMD Prov. Jateng',
            'kompetensi' => [
                ['materi' => 'Agenda 1: Sikap Perilaku Bela Negara', 'jenis_diklat' => 'Diklat Prajabatan'],
            ]
        ],
        [
            'photo' => 'images/SRIYATUN, S.Kep, MM.jpeg',
            'name' => 'SRIYATUN, S.Kep, MM.',
            'nip' => '196901121989032005',
            'jabatan_singkat' => 'WIDYAISWARA AHLI MADYA',
            'rank' => 'Pembina Utama Muda (IV/c) (TMT 01-04-2024)',
            'jabatan_lengkap' => 'WIDYAISWARA AHLI MADYA (TMT 18-03-2021)',
            'penempatan' => 'BPSDMD Prov. Jateng',
            'kompetensi' => [
                ['materi' => 'Agenda 1: Sikap Perilaku Bela Negara', 'jenis_diklat' => 'Diklat Prajabatan'],
            ]
        ],
        [
            'photo' => 'images/ARIF EFENDY, SH, MM..jpg',
            'name' => 'ARIF EFENDY, SH, MM.',
            'nip' => '196911021990031003',
            'jabatan_singkat' => 'WIDYAISWARA AHLI MADYA',
            'rank' => 'Pembina Utama Muda (IV/c) (TMT 01-04-2024)',
            'jabatan_lengkap' => 'WIDYAISWARA AHLI MADYA (TMT 18-03-2021)',
            'penempatan' => 'BPSDMD Prov. Jateng',
            'kompetensi' => [
                ['materi' => 'Agenda 1: Sikap Perilaku Bela Negara', 'jenis_diklat' => 'Diklat Prajabatan'],
            ]
        ],
        [
            'photo' => 'images/Dra. ENDANG SUPIATI, M.Si.jpeg',
            'name' => 'Dra. ENDANG SUPIATI, M.Si.',
            'nip' => '197003011995032002',
            'jabatan_singkat' => 'WIDYAISWARA AHLI MADYA',
            'rank' => 'Pembina Utama Muda (IV/c) (TMT 01-04-2024)',
            'jabatan_lengkap' => 'WIDYAISWARA AHLI MADYA (TMT 18-03-2021)',
            'penempatan' => 'BPSDMD Prov. Jateng',
            'kompetensi' => [
                ['materi' => 'Agenda 1: Sikap Perilaku Bela Negara', 'jenis_diklat' => 'Diklat Prajabatan'],
            ]
        ],
        [
            'photo' => 'images/Dr. Ir. SRI MULYANI, M.Pd.jpeg',
            'name' => 'Dr. Ir. SRI MULYANI, M.Pd.',
            'nip' => '197003011995032002',
            'jabatan_singkat' => 'WIDYAISWARA AHLI MADYA',
            'rank' => 'Pembina Utama Muda (IV/c) (TMT 01-04-2024)',
            'jabatan_lengkap' => 'WIDYAISWARA AHLI MADYA (TMT 18-03-2021)',
            'penempatan' => 'BPSDMD Prov. Jateng',
            'kompetensi' => [
                ['materi' => 'Agenda 1: Sikap Perilaku Bela Negara', 'jenis_diklat' => 'Diklat Prajabatan'],
            ]
        ],
        [
            'photo' => 'images/Dra. SRI WAHYUNI, M.Si.jpeg',
            'name' => 'Dra. SRI WAHYUNI, M.Si.',
            'nip' => '197003011995032002',
            'jabatan_singkat' => 'WIDYAISWARA AHLI MADYA',
            'rank' => 'Pembina Utama Muda (IV/c) (TMT 01-04-2024)',
            'jabatan_lengkap' => 'WIDYAISWARA AHLI MADYA (TMT 18-03-2021)',
            'penempatan' => 'BPSDMD Prov. Jateng',
            'kompetensi' => [
                ['materi' => 'Agenda 1: Sikap Perilaku Bela Negara', 'jenis_diklat' => 'Diklat Prajabatan'],
            ]
        ],
        [
            'photo' => 'images/Dra. SRI WAHYUNI, M.Si.jpeg',
            'name' => 'Dra. SRI WAHYUNI, M.Si.',
            'nip' => '197003011995032002',
            'jabatan_singkat' => 'WIDYAISWARA AHLI MADYA',
            'rank' => 'Pembina Utama Muda (IV/c) (TMT 01-04-2024)',
            'jabatan_lengkap' => 'WIDYAISWARA AHLI MADYA (TMT 18-03-2021)',
            'penempatan' => 'BPSDMD Prov. Jateng',
            'kompetensi' => [
                ['materi' => 'Agenda 1: Sikap Perilaku Bela Negara', 'jenis_diklat' => 'Diklat Prajabatan'],
            ]
        ],
        [
            'photo' => 'images/Dr. Ir. SRI MULYANI, M.Pd.jpeg',
            'name' => 'Dr. Ir. SRI MULYANI, M.Pd.',
            'nip' => '197003011995032002',
            'jabatan_singkat' => 'WIDYAISWARA AHLI MADYA',
            'rank' => 'Pembina Utama Muda (IV/c) (TMT 01-04-2024)',
            'jabatan_lengkap' => 'WIDYAISWARA AHLI MADYA (TMT 18-03-2021)',
            'penempatan' => 'BPSDMD Prov. Jateng',
            'kompetensi' => [
                ['materi' => 'Agenda 1: Sikap Perilaku Bela Negara', 'jenis_diklat' => 'Diklat Prajabatan'],
            ]
        ],
        [
            'photo' => 'images/Dra. ENDANG SUPIATI, M.Si.jpeg',
            'name' => 'Dra. ENDANG SUPIATI, M.Si.',
            'nip' => '197003011995032002',
            'jabatan_singkat' => 'WIDYAISWARA AHLI MADYA',
            'rank' => 'Pembina Utama Muda (IV/c) (TMT 01-04-2024)',
            'jabatan_lengkap' => 'WIDYAISWARA AHLI MADYA (TMT 18-03-2021)',
            'penempatan' => 'BPSDMD Prov. Jateng',
            'kompetensi' => [
                ['materi' => 'Agenda 1: Sikap Perilaku Bela Negara', 'jenis_diklat' => 'Diklat Prajabatan'],
            ]
        ],
        [
            'photo' => 'images/ARIF EFENDY, SH, MM..jpg',
            'name' => 'ARIF EFENDY, SH, MM.',
            'nip' => '196911021990031003',
            'jabatan_singkat' => 'WIDYAISWARA AHLI MADYA',
            'rank' => 'Pembina Utama Muda (IV/c) (TMT 01-04-2024)',
            'jabatan_lengkap' => 'WIDYAISWARA AHLI MADYA (TMT 18-03-2021)',
            'penempatan' => 'BPSDMD Prov. Jateng',
            'kompetensi' => [
                ['materi' => 'Agenda 1: Sikap Perilaku Bela Negara', 'jenis_diklat' => 'Diklat Prajabatan'],
            ]
        ],
        [
            'photo' => 'images/SRIYATUN, S.Kep, MM.jpeg',
            'name' => 'SRIYATUN, S.Kep, MM.',
            'nip' => '196901121989032005',
            'jabatan_singkat' => 'WIDYAISWARA AHLI MADYA',
            'rank' => 'Pembina Utama Muda (IV/c) (TMT 01-04-2024)',
            'jabatan_lengkap' => 'WIDYAISWARA AHLI MADYA (TMT 18-03-2021)',
            'penempatan' => 'BPSDMD Prov. Jateng',
            'kompetensi' => [
                ['materi' => 'Agenda 1: Sikap Perilaku Bela Negara', 'jenis_diklat' => 'Diklat Prajabatan'],
            ]
        ],
        [
            'photo' => 'images/DIYAH MUBAROKAH AKHADIYATI, S.Pi, M.Pi.jpeg',
            'name' => 'DIYAH MUBAROKAH AKHADIYATI, S.Pi, M.Pi.',
            'nip' => '196901091997032002',
            'jabatan_singkat' => 'WIDYAISWARA AHLI MADYA',
            'rank' => 'Pembina Utama Muda (IV/c) (TMT 01-10-2023)',
            'jabatan_lengkap' => 'WIDYAISWARA AHLI MADYA (TMT 06-11-2020)',
            'penempatan' => 'BPSDMD Prov. Jateng',
            'kompetensi' => [
                ['materi' => 'Agenda 1: Sikap Perilaku Bela Negara', 'jenis_diklat' => 'Diklat Prajabatan'],
            ]
        ],
        [
            'photo' => 'images/HARINI SETIJOWATI, SKM, M.HSc.png',
            'name' => 'HARINI SETIJOWATI, SKM, M.HSc.',
            'nip' => '196811091993032005',
            'jabatan_singkat' => 'WIDYAISWARA AHLI MADYA',
            'rank' => 'Pembina Utama Muda (IV/c) (TMT 01-04-2023)',
            'jabatan_lengkap' => 'WIDYAISWARA AHLI MADYA (TMT 18-03-2019)',
            'penempatan' => 'BPSDMD Prov. Jateng',
            'kompetensi' => [
                ['materi' => 'Advokasi', 'jenis_diklat' => 'Diklat Kepemimpinan Tingkat IV'],
            ]
        ],
        [
            'photo' => 'images/Drs. SUMARNO, M.Si.jpeg',
            'name' => 'Drs. SUMARNO, M.Si',
            'nip' => '196807041988031003',
            'jabatan_singkat' => 'WIDYAISWARA AHLI MADYA',
            'rank' => 'Pembina Utama Muda (IV/c) (TMT 01-04-2025)',
            'jabatan_lengkap' => 'WIDYAISWARA AHLI MADYA (TMT 12-03-2018)',
            'penempatan' => 'BPSDMD Prov. Jateng',
            'kompetensi' => [
                ['materi' => 'Advokasi', 'jenis_diklat' => 'Diklat Kepemimpinan Tingkat IV'],
            ]
        ],
        [
            'photo' => 'images/Drs. EKO SUPRAYITNO, MM.jpeg',
            'name' => 'Drs. EKO SUPRAYITNO, MM',
            'nip' => '196709251993031004',
            'jabatan_singkat' => 'WIDYAISWARA AHLI MADYA',
            'rank' => 'Pembina Utama Muda (IV/c) (TMT 01-10-2019)',
            'jabatan_lengkap' => 'WIDYAISWARA AHLI MADYA (TMT 04-04-2022)',
            'penempatan' => 'BPSDMD Prov. Jateng',
            'kompetensi' => [
                ['materi' => 'Advokasi', 'jenis_diklat' => 'Diklat Kepemimpinan Tingkat IV'],
            ]
        ],
        [
            'photo' => 'images/GIGUS NURYATNO, A.Pi., M.A.P.jpg',
            'name' => 'GIGUS NURYATNO, A.Pi., M.A.P.',
            'nip' => '196708221991031011',
            'jabatan_singkat' => 'WIDYAISWARA AHLI MADYA',
            'rank' => 'Pembina Utama Muda (IV/c) (TMT 01-10-2015)',
            'jabatan_lengkap' => 'WIDYAISWARA AHLI MADYA (TMT 29-02-2012)',
            'penempatan' => 'BPSDM Peternakan',
            'kompetensi' => [
                ['materi' => 'Advokasi', 'jenis_diklat' => 'Diklat Kepemimpinan Tingkat IV'],
            ]
        ],
        [
            'photo' => 'images/IKBAL KHAFID, S.IP, MSi.jpeg',
            'name' => 'IKBAL KHAFID, S.IP, MSi',
            'nip' => '196705041986031002',
            'jabatan_singkat' => 'WIDYAISWARA AHLI MADYA',
            'rank' => 'Pembina Utama Muda (IV/c) (TMT 01-04-2022)',
            'jabatan_lengkap' => 'WIDYAISWARA AHLI MADYA (TMT 29-03-2016)',
            'penempatan' => 'BPSDMD Prov. Jateng',
            'kompetensi' => [
                ['materi' => 'Advokasi', 'jenis_diklat' => 'Diklat Kepemimpinan Tingkat IV'],
            ]
        ],
        [
            'photo' => 'images/Ir. WARDI ASTUTI, MPD.jpg',
            'name' => 'Ir. WARDI ASTUTI, MPD',
            'nip' => '196608181992032015',
            'jabatan_singkat' => 'WIDYAISWARA AHLI UTAMA',
            'rank' => 'Pembina Utama (IV/e) (TMT 01-04-2022)',
            'jabatan_lengkap' => 'WIDYAISWARA AHLI UTAMA (TMT 19-03-2019)',
            'penempatan' => 'BPSDM Soropadan',
            'kompetensi' => [
                ['materi' => 'Agenda 1: Kepemimpinan Pancasila dan Bela Negara', 'jenis_diklat' => 'Diklat Kepemimpinan Tingkat IV'],
            ]
        ],
        [
            'photo' => 'images/Ir. YOYON INDRAYANA, M.T.jpeg',
            'name' => 'Ir. YOYON INDRAYANA, M.T',
            'nip' => '196607221993011001',
            'jabatan_singkat' => 'WIDYAISWARA AHLI MADYA',
            'rank' => 'Pembina Utama Muda (IV/c) (TMT 01-04-2015)',
            'jabatan_lengkap' => 'WIDYAISWARA AHLI MADYA (TMT 11-02-2021)',
            'penempatan' => 'BPSDMD Prov. Jateng',
            'kompetensi' => [
                ['materi' => 'Mengelola Perubahan', 'jenis_diklat' => 'Diklat Kepemimpinan'],
            ]
        ],
        [
            'photo' => 'images/DWI TITI SUNDARI, SKM, M.Kes.jpg',
            'name' => 'DWI TITI SUNDARI, SKM, M.Kes',
            'nip' => '196512131988032004',
            'jabatan_singkat' => 'WIDYAISWARA AHLI MADYA',
            'rank' => 'Pembina (IV/a) (TMT 01-04-2013)',
            'jabatan_lengkap' => 'WIDYAISWARA AHLI MADYA (TMT 14-03-2013)',
            'penempatan' => 'BPTK Gombong',
            'kompetensi' => [
                ['materi' => 'Advokasi', 'jenis_diklat' => 'Diklat Kepemimpinan Tingkat IV'],
            ]
        ],
        [
            'photo' => 'images/Ir. YATNO ISWORO,MP.jpg',
            'name' => 'Ir. YATNO ISWORO,MP',
            'nip' => '196410101999031002',
            'jabatan_singkat' => 'WIDYAISWARA AHLI UTAMA',
            'rank' => 'Pembina Utama (IV/e) (TMT 01-10-2023))',
            'jabatan_lengkap' => 'WIDYAISWARA AHLI UTAMA (TMT 13-02-2020)',
            'penempatan' => 'BPSDMD Prov. Jateng',
            'kompetensi' => [
                ['materi' => 'Advokasi Penyampaian ke Lokus', 'jenis_diklat' => 'Diklat Kepemimpinan Tingkat II'],
            ]
        ],
        [
            'photo' => 'images/Drs. SISWANTA JAKA PURNAMA, Apt., M.Kes.jpg',
            'name' => 'Drs. SISWANTA JAKA PURNAMA, Apt., M.Kes.',
            'nip' => '196310281989111001',
            'jabatan_singkat' => 'WIDYAISWARA AHLI UTAMA',
            'rank' => 'Pembina Utama (IV/e) (TMT 01-10-2020)',
            'jabatan_lengkap' => 'WIDYAISWARA AHLI UTAMA (TMT 01-04-2017)',
            'penempatan' => 'BPSDMD Prov. Jateng',
            'kompetensi' => [
                ['materi' => 'Advokasi Penyampaian ke Lokus', 'jenis_diklat' => 'Diklat Kepemimpinan Tingkat II'],
            ]
        ],
        [
            'photo' => 'images/SUDIRMAN MUSTAFA, SH, M.Hum.jpg',
            'name' => 'SUDIRMAN MUSTAFA, SH, M.Hum',
            'nip' => '196209161995011001',
            'jabatan_singkat' => 'WIDYAISWARA AHLI UTAMA',
            'rank' => 'Pembina Utama Madya (IV/d) (TMT 01-10-2020)',
            'jabatan_lengkap' => 'WIDYAISWARA AHLI UTAMA (TMT 23-04-2020)',
            'penempatan' => 'BPSDMD Prov. Jateng',
            'kompetensi' => [
                ['materi' => 'Advokasi Penyampaian ke Lokus', 'jenis_diklat' => 'Diklat Kepemimpinan Tingkat II'],
            ]
        ],
        [
            'photo' => 'images/Dr. Ir. SUPRIYANTO, M.Si.jpeg',
            'name' => 'Dr. Ir. SUPRIYANTO, M.Si.',
            'nip' => '196205171991031004',
            'jabatan_singkat' => 'WIDYAISWARA AHLI UTAMA',
            'rank' => 'Pembina Utama (IV/e) (TMT 01-12-2024)',
            'jabatan_lengkap' => 'WIDYAISWARA AHLI UTAMA (TMT 10-12-2021)',
            'penempatan' => 'BPSDMD Prov.Jateng',
            'kompetensi' => [
                ['materi' => 'Advokasi Penyampaian ke Lokus', 'jenis_diklat' => 'Diklat Kepemimpinan Tingkat II'],
            ]
        ],
    ];

    public function index(): View
    {
        // Data profil Widyaiswara yang akan ditampilkan
    public function index(): View
    {
        // Menggunakan properti kelas $this->profiles
        $profiles = $this->profiles;

        // Mengambil daftar jabatan singkat yang unik
        $jabatans = array_column($profiles, 'jabatan_singkat');
        $uniqueJabatans = array_unique($jabatans);

        // Mengembalikan view dengan data profil
        return view('ProfilWidyaiswara', [
            'profiles' => $profiles,
            'jabatans' => $uniqueJabatans
        ]);
    }
            'jabatans' => $uniqueJabatans
        ]);
    }
<<<<<<< HEAD
=======

    public function createJamMengajar(): View
    {
        // Mengambil data pelatihan dari tabel calendar
        // Hanya mengambil kolom id dan title yang diperlukan untuk dropdown
        $daftar_pelatihan = DB::table('calendar')
            ->select('id', 'title')
            ->get();
        
        // Memproses array $profiles yang sudah ada untuk membuat array widyaiswara yang lebih sederhana
        // Hanya mengambil nip dan name untuk keperluan dropdown
        $widyaiswara = collect($this->profiles)->map(function ($profile) {
            return [
                'nip' => $profile['nip'],
                'name' => $profile['name']
            ];
        });
        
        // Mengirim kedua data ke view formulir.blade.php
        return view('formulir', compact('daftar_pelatihan', 'widyaiswara'));
    }

    public function storeJamMengajar(Request $request)
    {
        // 1. Validasi Data
        $validatedData = $request->validate([
            'lokasi' => 'required|string',
            'metode' => 'required|string',
            'tempat' => 'required|string',
            'kabupaten_kota' => 'required|string',
            'tanggal' => 'required|date',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
            'jp' => 'required|integer|min:1',
            'tugas' => 'required|string',
            'jenis_diklat' => 'required|string',
            'id_pelatihan' => 'required|integer',
            'materi' => 'required|string',
            'nip_widyaiswara_1' => 'required|string',
            'nip_widyaiswara_2' => 'nullable|string',
            'nip_widyaiswara_3' => 'nullable|string',
            'nip_widyaiswara_4' => 'nullable|string',
        ]);

        // 2. Simpan Data ke Database
        // Penting: Pastikan tabel `jam_mengajar` Anda memiliki semua kolom yang diperlukan
        // sesuai dengan data yang ingin Anda simpan dari formulir.
        // Jika tidak, Anda perlu menambahkan kolom-kolom tersebut ke skema tabel Anda.
        // Contoh: ALTER TABLE jam_mengajar ADD COLUMN lokasi VARCHAR(255), ADD COLUMN metode VARCHAR(255), dst.;
        try {
            DB::table('jam_mengajar')->insert([
                'id_pelatihan' => $validatedData['id_pelatihan'],
                'nip_widyaiswara' => $validatedData['nip_widyaiswara_1'], // Menyimpan Widyaiswara 1 sebagai primary
                'tanggal' => $validatedData['tanggal'],
                'jam_mulai' => $validatedData['jam_mulai'],
                'jam_selesai' => $validatedData['jam_selesai'],
                'jp' => $validatedData['jp'],
                // Tambahkan kolom-kolom lain di sini jika Anda sudah memperbarui skema tabel jam_mengajar
                'lokasi' => $validatedData['lokasi'] ?? null,
                'metode' => $validatedData['metode'] ?? null,
                'tempat' => $validatedData['tempat'] ?? null,
                'kabupaten_kota' => $validatedData['kabupaten_kota'] ?? null,
                'tugas' => $validatedData['tugas'] ?? null,
                'jenis_diklat' => $validatedData['jenis_diklat'] ?? null,
                'materi' => $validatedData['materi'] ?? null,
                'nip_widyaiswara_2' => $validatedData['nip_widyaiswara_2'] ?? null,
                'nip_widyaiswara_3' => $validatedData['nip_widyaiswara_3'] ?? null,
                'nip_widyaiswara_4' => $validatedData['nip_widyaiswara_4'] ?? null,
            ]);

            // 3. Redirect setelah berhasil
            return redirect()->route('jam-mengajar.create')->with('success', 'Jadwal mengajar berhasil disimpan!');

        } catch (\Exception $e) {
            // Tangani error jika ada masalah saat menyimpan ke database
            return redirect()->back()->withInput()->with('error', 'Gagal menyimpan jadwal mengajar: ' . $e->getMessage());
        }
    }
>>>>>>> 7aa5bd2 (feat: Menambahkan data materi dan jenis diklat pada WidyaiswaraController)
    public function createJamMengajar(): View
    {
        // Mengambil data pelatihan dari tabel calendar
        // Hanya mengambil kolom id dan title yang diperlukan untuk dropdown
        $daftar_pelatihan = DB::table('calendar')
            ->select('id', 'title')
            ->get();
        
        // Memproses array $profiles yang sudah ada untuk membuat array widyaiswara yang lebih sederhana
        // Hanya mengambil nip dan name untuk keperluan dropdown
        $widyaiswara = collect($this->profiles)->map(function ($profile) {
            return [
                'nip' => $profile['nip'],
                'name' => $profile['name']
            ];
        });
        
        // Mengirim kedua data ke view formulir.blade.php
        return view('formulir', compact('daftar_pelatihan', 'widyaiswara'));
    }

    public function storeJamMengajar(Request $request)
    {
        // 1. Validasi Data
        $validatedData = $request->validate([
            'lokasi' => 'required|string',
            'metode' => 'required|string',
            'tempat' => 'required|string',
            'kabupaten_kota' => 'required|string',
            'tanggal' => 'required|date',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
            'jp' => 'required|integer|min:1',
            'tugas' => 'required|string',
            'jenis_diklat' => 'required|string',
            'id_pelatihan' => 'required|integer',
            'materi' => 'required|string',
            'nip_widyaiswara_1' => 'required|string',
            'nip_widyaiswara_2' => 'nullable|string',
            'nip_widyaiswara_3' => 'nullable|string',
            'nip_widyaiswara_4' => 'nullable|string',
        ]);

        // 2. Simpan Data ke Database
        // Penting: Pastikan tabel `jam_mengajar` Anda memiliki semua kolom yang diperlukan
        // sesuai dengan data yang ingin Anda simpan dari formulir.
        // Jika tidak, Anda perlu menambahkan kolom-kolom tersebut ke skema tabel Anda.
        // Contoh: ALTER TABLE jam_mengajar ADD COLUMN lokasi VARCHAR(255), ADD COLUMN metode VARCHAR(255), dst.;
        try {
            DB::table('jam_mengajar')->insert([
                'id_pelatihan' => $validatedData['id_pelatihan'],
                'nip_widyaiswara' => $validatedData['nip_widyaiswara_1'], // Menyimpan Widyaiswara 1 sebagai primary
                'tanggal' => $validatedData['tanggal'],
                'jam_mulai' => $validatedData['jam_mulai'],
                'jam_selesai' => $validatedData['jam_selesai'],
                'jp' => $validatedData['jp'],
                // Tambahkan kolom-kolom lain di sini jika Anda sudah memperbarui skema tabel jam_mengajar
                'lokasi' => $validatedData['lokasi'] ?? null,
                'metode' => $validatedData['metode'] ?? null,
                'tempat' => $validatedData['tempat'] ?? null,
                'kabupaten_kota' => $validatedData['kabupaten_kota'] ?? null,
                'tugas' => $validatedData['tugas'] ?? null,
                'jenis_diklat' => $validatedData['jenis_diklat'] ?? null,
                'materi' => $validatedData['materi'] ?? null,
                'nip_widyaiswara_2' => $validatedData['nip_widyaiswara_2'] ?? null,
                'nip_widyaiswara_3' => $validatedData['nip_widyaiswara_3'] ?? null,
                'nip_widyaiswara_4' => $validatedData['nip_widyaiswara_4'] ?? null,
            ]);

            // 3. Redirect setelah berhasil
            return redirect()->route('jam-mengajar.create')->with('success', 'Jadwal mengajar berhasil disimpan!');

        } catch (Exception $e) {
            // Tangani error jika ada masalah saat menyimpan ke database
            return redirect()->back()->withInput()->with('error', 'Gagal menyimpan jadwal mengajar: ' . $e->getMessage());
        }
    }
}
}