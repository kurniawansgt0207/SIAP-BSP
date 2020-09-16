<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    ini_set('memory_limit','4096M'); 
    class Transaksi extends CI_Controller {
        
        function __construct()
        {
            parent::__construct();

            $this->load->model('Model_transaksi');
            $this->load->library('pdf');
        }
        
        function index(){
            $result['provinsi'] = $this->Model_transaksi->getProvinsi()->result();
            $result['menu'] = "transaksi";
            
            $this->load->view('transaksi/data_ganda', $result);
        }
        
        function list_of_kab(){
            $postData = $this->input->post();

            $prov = isset($postData['prov'])?$postData['prov']:'';
            $result['kab_kota'] = $this->Model_transaksi->getKabKota($prov)->result();
            $this->load->view('transaksi/v_kab_list', $result);
        }
        
        function list_of_kec(){
            $postData = $this->input->post();

            $kab = isset($postData['kab'])?$postData['kab']:'';
            $result['kecamatan'] = $this->Model_transaksi->getKecamatan($kab)->result();
            $this->load->view('transaksi/v_kec_list', $result);
        }
        
        function list_of_kel(){
            $postData = $this->input->post();

            $kec = isset($postData['kec'])?$postData['kec']:'';
            $result['kelurahan'] = $this->Model_transaksi->getKelDesa($kec)->result();
            $this->load->view('transaksi/v_kel_list', $result);
        }
        
        function update_status(){
            $postData = $this->input->post();
            
            $this->Model_transaksi->update_status($postData['id'],$postData['status']);
            $hasil = $this->Model_transaksi->rekap_data_prop_kab($postData['prop'],$postData['kab'])->result();
            $jmlClean = $hasil[0]->jml_clean;
            $jmlUnClean = $hasil[0]->jml_unclean;
            $jmlNonAktif = $hasil[0]->jml_nonaktif;
            echo "Data berhasil di update~Propinsi: ".$postData['prop']."\nKabupate/Kota: ".$postData['kab']."\nClean: ".$jmlClean."\nUnclean: ".$jmlUnClean."\nNon Aktif: ".$jmlNonAktif;
        }
                        
        function rubah_data_ganda($id){
            $data['menu'] = "transaksi";
            $where = array('IDARTBDT' => $id);
            $data['user'] = $this->Model_transaksi->edit_data($where,'data_ganda')->result();
            $data['provinsi'] = $this->Model_transaksi->getProvinsi()->result();            
            $prov = $data['user'][0]->NMPROP;
            $data['kab_kota'] = $this->Model_transaksi->getKabKota($prov)->result();
            $kab = $data['user'][0]->NMKAB;
            $data['kecamatan'] = $this->Model_transaksi->getKecamatan($kab)->result();
            $kec = $data['user'][0]->NMKEC;
            $data['kelurahan'] = $this->Model_transaksi->getKelDesa($kec)->result();
            
            $this->load->view('transaksi/edit_data',$data);
	}
        
        function list_data(){
            $postData = $this->input->post();

            $prov = isset($postData['prov'])?$postData['prov']:'';
            $kab = isset($postData['kab'])?$postData['kab']:'';
            $kec = isset($postData['kec'])?$postData['kec']:'';
            $kel = isset($postData['kel'])?$postData['kel']:'';
            $ket_tambahan = isset($postData['ket'])?$postData['ket']:'';
            $nik = isset($postData['nik'])?$postData['nik']:'';
            $nama = isset($postData['nama'])?$postData['nama']:'';

            $result['data'] = $this->Model_transaksi->showData($prov,$kab,$kec,$kel,$ket_tambahan,$nik,$nama)->result();      
            $this->load->view('transaksi/data_ganda_list', $result);
        }
        
        function update(){
            $nama_penerima = $this->input->post('nm_penerima');
            $no_kartu = $this->input->post('no_kartu');
            $nik_ktp = $this->input->post('nik_ktp');
            $id_pengurus = $this->input->post('id_pengurus');
            $alamat = $this->input->post('alamat');
            $provinsi = $this->input->post('provinsi');
            $kab_kota = $this->input->post('kab_kota');
            $kecamatan = $this->input->post('kecamatan');
            $kel_desa = $this->input->post('kel_desa');
            $idbdt = $this->input->post('idbdt');
            $idartbdt = $this->input->post('idartbdt');
            $nmdtks = $this->input->post('nmdtks');
            $idkeluarga = $this->input->post('idkeluarga');
            $ket_tambahan = $this->input->post('ket_tambahan');

            $data = array(
                'NAMA_PENERIMA' => $nama_penerima,
                'NOMOR_KARTU' => $no_kartu,
                'NIK_KTP' => $nik_ktp,
                'ID_PENGURUS' => $id_pengurus,
                'NMPROP' => $provinsi,
                'NMKAB' => $kab_kota,
                'NMKEC' => $kecamatan,
                'NMKEL' => $kel_desa,
                'ALAMAT' => $alamat,
                'IDBDT' => $idbdt,
                'IDARTBDT' => $idartbdt,
                'IDPENGURUS' => $id_pengurus,
                'NAMA_DTKS' => $nmdtks,
                'IDKELUARGA' => $idkeluarga,
                'KET_TAMBAHAN' => $ket_tambahan
            );

            $where = array(
                'IDARTBDT' => $idartbdt
            );

            $this->Model_transaksi->update_data($where,$data,'data_ganda');
            redirect('transaksi/index');
        }
        
        function export_pdf(){
            $postData = $this->input->post();

            $prov = isset($postData['provinsi'])?$postData['provinsi']:'';
            $kab = isset($postData['kab_kotax'])?$postData['kab_kotax']:'';
            $kec = isset($postData['kecamatanx'])?$postData['kecamatanx']:'';
            $kel = isset($postData['kel_desax'])?$postData['kel_desax']:'';
            $ket_tambahan = isset($postData['ket_tambahan'])?$postData['ket_tambahan']:'';
            $nik = isset($postData['nik'])?$postData['nik']:'';
            $nama = isset($postData['nama'])?$postData['nama']:'';
            
            $pdf = new FPDF('L','mm','Legal');
            // membuat halaman baru
            $pdf->AddPage();
            $pdf->SetLeftMargin(5);       
            $pdf->SetAutoPageBreak(20, 4);
            // setting jenis font yang akan digunakan
            $pdf->SetFont('Arial','B',16);
            // mencetak string 
            $pdf->Cell(330,7,'DATA GANDA PENDUDUK',0,1,'C');         
            // Memberikan space kebawah agar tidak terlalu rapat
            $pdf->Cell(10,7,'',0,1);            
            
            $pdf->SetFont('Arial','B',10);
            $pdf->Cell(35,8,'NO KARTU',1,0);
            $pdf->Cell(35,8,'NIK KTP',1,0);
            $pdf->Cell(63,8,'NAMA PENERIMA',1,0);            
            $pdf->Cell(45,8,'PROPINSI',1,0);
            $pdf->Cell(45,8,'KABUPATEN',1,0);
            $pdf->Cell(45,8,'KECAMATAN',1,0);
            $pdf->Cell(50,8,'KELURAHAN',1,0);
            $pdf->Cell(27,8,'KETERANGAN',1,1);
            $pdf->SetFont('Arial','',10);
           
            $result = $this->Model_transaksi->showData($prov,$kab,$kec,$kel,$ket_tambahan,$nik,$nama)->result(); 
            foreach ($result as $row){
                $pdf->Cell(35,7,$row->NOMOR_KARTU,1,0);
                $pdf->Cell(35,7,$row->NIK_KTP,1,0);
                $pdf->Cell(63,7,$row->NAMA_PENERIMA,1,0);  
                $pdf->Cell(45,7,$row->NMPROP,1,0); 
                $pdf->Cell(45,7,$row->NMKAB,1,0); 
                $pdf->Cell(45,7,$row->NMKEC,1,0); 
                $pdf->Cell(50,7,$row->NMKEL,1,0); 
                $pdf->Cell(27,7,$row->KET_TAMBAHAN,1,1); 
            }
            $pdf->Output();
        }
        
        function surat_permohonan(){
            $data['menu'] = "surat_permohonan";
            $data['provinsi'] = $this->Model_transaksi->getProvinsi()->result();
            $this->load->view('transaksi/template_surat_permohonan',$data);
        }
        
        function submit_surat_permohonan(){
            $tgl_permohonan = $this->input->post('tgl_permohonan');
            $nama_pemohon = $this->input->post('nama_pemohon');
            $nip_pemohon = $this->input->post('nip_pemohon');
            $provinsi = $this->input->post('provinsi');
            $kab_kota = $this->input->post('kab_kota');
            $kecamatan = $this->input->post('kecamatan');
            $kel_desa = $this->input->post('kel_desa');
            $jml_clean = $this->input->post('jml_clean');
            $jml_unclean = $this->input->post('jml_unclean');
            $jml_nonaktif = $this->input->post('jml_nonaktif');
            
            $data = array(
                'tgl_permohonan' => $tgl_permohonan,
                'nama_pemohon' => $nama_pemohon,
                'nip_pemohon' => $nip_pemohon,
                'nm_provinsi' => $provinsi,
                'nm_kabupaten' => $kab_kota,
                'nm_kecamatan' => $kecamatan,
                'nm_kelurahan' => $kel_desa,
                'jml_clean' => $jml_clean,
                'jml_unclean' => $jml_unclean,
                'jml_nonaktif' => $jml_nonaktif,
            );

            $insertID = $this->Model_transaksi->submit_surat_permohonan($data);
            
            $this->view_surat_permohonan($insertID);
        }
        
        function view_surat_permohonan($idData){            
            $this->load->view('transaksi/surat_permohonan_view',$idData);
        }
        
        function download_surat(){
            $data['menu'] = "download";
            $this->load->view('transaksi/surat_permohonan_view', $data);
        }
        
        function upload_surat(){
            $data['menu'] = "upload";
            $data['provinsi'] = $this->Model_transaksi->getProvinsi()->result();
            $this->load->view('transaksi/surat_permohonan_upload', $data);
        }
        
        function submit_upload_surat(){
            $tgl_permohonan = date("Y-m-d");
            $provinsi = $this->input->post('provinsi');
            $kab_kota = $this->input->post('kab_kotax');
            $nm_surat_permohonan = $this->input->post('surat_permohonan');
            $nm_lampiran_dokumen = $this->input->post('lampiran_dokumen');
            
            
            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'pdf';
            
            $this->load->library('upload', $config);
            
            $this->upload->do_upload('surat_permohonan');
            $result1 = $this->upload->data();
            
            $this->upload->do_upload('lampiran_dokumen');
            $result2 = $this->upload->data();
            
            
            $result = array('surat_permohonan'=>$result1,'lampiran_dokumen'=>$result2);
            
            $data = array(
                'tgl_permohonan' => $tgl_permohonan,
                'nm_pemohon' => 'Sigit Kurniawan',
                'nm_propinsi' => $provinsi,
                'nm_kabupaten' => $kab_kota,
                'nm_surat_permohonan' => $result['surat_permohonan']['file_name'],
                'nm_lampiran_dokumen' => $result['lampiran_dokumen']['file_name'],
                'status_permohonan' => 'Open',
                'nm_pengecek' => '',
                'alasan_tolak' => '',
            );
        
            $insert = $this->Model_transaksi->submit_unggah_surat($data);
            if($insert > 0){
                $this->session->set_flashdata('pesan', 'Dokumen Berhasil Terikirim');
            } else {
                $this->session->set_flashdata('pesan', 'Dokumen Tidak Berhasil Terikirim');
            }
            redirect('transaksi/upload_surat');
        }
        
        function daftar_surat(){
            $data['menu'] = "upload";
            $data['provinsi'] = $this->Model_transaksi->getProvinsi()->result();
            $this->load->view('transaksi/surat_permohonan_list', $data);
        }
        
        function daftar_surat_list(){
            $provinsi = $this->input->post('prov');
            $kab_kota = $this->input->post('kab');
            $data['list_data'] = $this->Model_transaksi->show_list_surat_permohonan($provinsi,$kab_kota)->result();
            $this->load->view('transaksi/surat_permohonan_list_daftar', $data);
        }
        
        function rubah_status_permohonan($id_surat){
            $where = array('id' => $id_surat);
            $data['data_surat'] = $this->Model_transaksi->showPermohonanById($where,"surat_permohonan_data_ganda")->result();
            $data['provinsi'] = $this->Model_transaksi->getProvinsi()->result();            
            $prov = $data['data_surat'][0]->nm_propinsi;
            $data['kab_kota'] = $this->Model_transaksi->getKabKota($prov)->result();
            $kab = $data['data_surat'][0]->nm_kabupaten;
            $this->load->view('transaksi/rubah_status_surat_permohonan_form', $data);
        }
        
        function update_status_surat(){
            $id_surat = $this->input->post('id_surat');
            $status_opt = $this->input->post('status_surat');
            $status_surat = ($status_opt==1) ? "Accepted" : "Rejected";
            $alasan_tolak = $this->input->post('alasan_tolak');
            $nm_pengcek = $this->input->post('nm_pengecek');
            
            $data = array(
                'nm_pengecek' => $nm_pengcek,
                'alasan_tolak' => $alasan_tolak,
                'status_permohonan' => $status_surat
            );

            $where = array(
                'id' => $id_surat
            );

            $this->Model_transaksi->update_data($where,$data,'surat_permohonan_data_ganda');
            redirect('transaksi/daftar_surat');
        }
        
        function cek_data_permohonan($id_surat,$ket){
            $data['menu'] = "upload";
            $where = array(
                        'id' => $id_surat
                    );
            $data_surat = $this->Model_transaksi->showPermohonanById($where,"surat_permohonan_data_ganda")->result();
            $nmProp = $data_surat[0]->nm_propinsi;
            $nmKab = $data_surat[0]->nm_kabupaten;
            $ketTambahan = ($ket != "0" || $ket != 0) ? $ket : "CLEAN";
            $where2 = array (
                        'NMPROP' => $nmProp,
                        'NMKAB' => $nmKab,
                        'KET_TAMBAHAN' => $ketTambahan
                    );
            $data['data_surat'] = $this->Model_transaksi->showPermohonanById($where2,"data_ganda")->result();
            $data['id_surat'] = $id_surat;
            $data['nm_propinsi'] = $nmProp;
            $data['nm_kabupaten'] = $nmKab;
            $data['keterangan'] = $ketTambahan;
            $this->load->view('transaksi/list_cek_data_permohonan', $data);
        }
        
        function download_data($idSurat,$keterangan){ 
            $where = array(
                        'id' => $idSurat
                    );
            $data_surat = $this->Model_transaksi->showPermohonanById($where,"surat_permohonan_data_ganda")->result();
            $nmProp = $data_surat[0]->nm_propinsi;
            $nmKab = $data_surat[0]->nm_kabupaten;            
            $where2 = array (
                        'NMPROP' => $nmProp,
                        'NMKAB' => $nmKab,
                        'KET_TAMBAHAN' => $keterangan
                    );
            $result = $this->Model_transaksi->showPermohonanById($where2,"data_ganda")->result(); 
            $ketStatus = $result[0]->KET_TAMBAHAN;
            
            $pdf = new FPDF('L','mm','Legal');
            // membuat halaman baru
            $pdf->AddPage();
            $pdf->SetLeftMargin(5);       
            $pdf->SetAutoPageBreak(20, 4);
            // setting jenis font yang akan digunakan
            $pdf->SetFont('Courier','B',16);
            // mencetak string 
            $pdf->Cell(330,7,'CEK PERMOHONAN VALIDASI DATA GANDA PENERIMA BANTUAN',0,1,'C');         
            $pdf->Cell(10,7,'',0,1);
            $pdf->SetFont('Courier','B',12);
            $pdf->Cell(110,7,'PROPINSI: '.$nmProp,0,0,'C');         
            $pdf->Cell(110,7,'KABUPATEN: '.$nmKab,0,0,'C');         
            $pdf->Cell(110,7,'KET STATUS: '.$ketStatus,0,0,'C');         
            // Memberikan space kebawah agar tidak terlalu rapat
            $pdf->Cell(10,7,'',0,1);            
            
            $pdf->SetFont('Helvetica','B',11);
            $pdf->Cell(36,8,'NO KARTU',1,0,'C');
            $pdf->Cell(36,8,'NIK KTP',1,0,'C');
            $pdf->Cell(36,8,'NO KK',1,0,'C');
            $pdf->Cell(40,8,'IDARTBDT',1,0,'C');
            $pdf->Cell(83,8,'NAMA PENERIMA',1,0,'C');            
            $pdf->Cell(55,8,'KECAMATAN',1,0,'C');
            $pdf->Cell(55,8,'KELURAHAN',1,1,'C');
            
            $pdf->SetFont('Helvetica','',10);                                   
            foreach ($result as $row){
                $pdf->Cell(36,7,$row->NOMOR_KARTU,1,0,'C');
                $pdf->Cell(36,7,$row->NIK_KTP,1,0,'C');
                $pdf->Cell(36,7,$row->NOKK_DTKS,1,0,'C');
                $pdf->Cell(40,7,$row->IDARTBDT,1,0,'C');
                $pdf->Cell(83,7,$row->NAMA_PENERIMA,1,0,'L');  
                $pdf->Cell(55,7,$row->NMKEC,1,0,'C'); 
                $pdf->Cell(55,7,$row->NMKEL,1,1,'C'); 
            }
            $pdf->Output();
        }
    }
    
?>