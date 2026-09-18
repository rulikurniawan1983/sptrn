<?php

namespace App\Imports;

use App\Models\Perikanan;
use App\Models\StatusVerifikasi;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PerikananImport implements ToCollection, WithHeadingRow, WithCalculatedFormulas
{
    /**
    * @param Collection $collection
    */
    protected $request;
    
    public function __construct($request=[])
    {
        $this->request = $request;
    }

    public function collection(Collection $rows)
    {
        $statusVerifikasiDefault = StatusVerifikasi::where("is_default", true)->first();

        foreach ($rows as $key => $row) 
        {
            $nama = $row['nama'];

            $jenis_kelamin = $row['lp'] ? ($row['lp'] == "L" ? "Laki-laki" : "Perempuan") : null;

            // $check = Perikanan::where("nama", $nama)->where("nib", $row['nib_nomor'])->first();
            $check = null;
            if ($check == null) {
                $data = [
                    "nama" => $nama,
                    "id_kbli" => $row['kode_kbli'],
                    "id_jenis_usaha" => $row['kode_jenis_badan_usaha'],
                    "id_jenis_perikanan" => $row['kode_jenis_perikanan'],
                    "id_kecamatan" => $this->checkNumeric($row['kode_kecamatan']),
                    "id_kelurahan" => $this->checkNumeric($row['kode_kelurahan']),

                    "alamat" => $row['alamat'],
                    "kode_pos" => $row['kode_pos'],
                    "no_tlp_1" => $row['no_telp_1'],
                    "no_tlp_2" => $row['no_telp_2'],
                    "fax" => $row['fax'],
                    "email" => $row['email'],
                    "website" => $row['website'],

                    "jenis_kelamin" => $jenis_kelamin,
                    "id_tingkat_resiko" => $row['kode_tingkat_resiko'],
                    "id_skala_usaha" => $row['kode_skala_usaha'],
                    "komoditas" => $row['komoditas'],

                    "nik" => $row['nik'],
                    "no_badan_hukum" => $row['no_badan_hukum'],
                    "tanggal_badan_hukum" => $row['tanggal_badan_hukum'],
                    "id_pengesahan_badan_hukum" => $row['kode_pengesahan_badan_hukum'],
                    "tahun_ind_usaha" => $row['tahun_usaha'],
                    "nama_notaris" => $row['nama_notaris'],
                    "npwp" => $row['npwp'],

                    "nib" => $row['nib_nomor'],
                    "nib_tanggal_terbit" => $row['nib_tanggal_terbit'],
                    "nib_dikeluarkan_oleh" => $row['nib_dikeluarkan_oleh'],
                    "nib_penanggungjawab" => $row['nib_penanggungjawab'],

                    "surat_izin_tempat_usaha" => $row['situ_nomor'],
                    "surat_izin_tempat_usaha_tanggal_terbit" => $row['situ_tanggal_terbit'],
                    "surat_izin_tempat_usaha_masa_berlaku" => $row['situ_masa_berlaku'],
                    "surat_izin_tempat_usaha_dikeluarkan_oleh" => $row['situ_dikeluarkan_oleh'],
                    "surat_izin_tempat_usaha_penanggungjawab" => $row['situ_penanggungjawab'],

                    "nilai_investasi" => $row['nilai_investasi'],
                    "id_status_permodalan" => $row['kode_status_permodalan'],
                    "luas_tanah" => $row['luas_tanah'],
                    "luas_bangunan" => $row['luas_bangunan'],

                    "tki_pria"   => $row['tki_pria'],
                    "tki_wanita" => $row['tki_wanita'],
                    "tka_pria"   => $row['tka_pria'],
                    "tka_wanita" => $row['tka_wanita'],
                ];
                $data['id_status_verifikasi'] = $statusVerifikasiDefault->id;
                $create = Perikanan::create($data);
            }
        }
    }

    public function checkNumeric($value)
    {
        return is_numeric($value) ? $value : null;
    }
}
