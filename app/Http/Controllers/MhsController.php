<?php

namespace App\Http\Controllers;

use App\Exports\MhsExport;
use App\Imports\MhsImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

use Barryvdh\DomPDF\Facade as PDF;

class MhsController extends Controller
{
    public function mhsexport()
    {
        return Excel::download(new MhsExport, 'data-mhs.xlsx');
    }

    public function mhsimport(Request $request)
    {
        $file = $request->file('file');
        $filename = $file->getClientOriginalName();
        $file->move('datamhs', $filename);
        
        Excel::import(new MhsImport, public_path('/datamhs/'.$filename));
        return redirect()->route('index')->with('success', 'Data mahasiswa telah diimport!');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Ini adalah scrip untuk melakukan request data dari Rekweb API yang telah kita buat
        $username = 'user';
        $password = 'user';
        $credentials = base64_encode("$username:$password");

        $headers = [];
        $headers[] = "Authorization: Basic {$credentials}";
        $headers[] = 'Content-Type: application/x-www-form-urlencoded';
        $headers[] = 'Cache-Control: no-cache';

            // Initializing curl
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL,"127.0.0.2:8001/pendaftaran");
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST,'GET');
            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

            // Executing curl
            $response = curl_exec($curl);
            
            // Checking if any error occurs during request or not
            if($e = curl_error($curl)) {
                echo $e;
            } else {
                
                // Decoding JSON data
                $decodedData =
                    json_decode($response, true);
                    
                // Outputting JSON data in
                // Decoded form
                // var_dump($decodedData);
                $data = $decodedData;
            }

        // Closing curl
        curl_close($curl);
        return view('mhs.index', ["data"=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('mhs.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required',
            'jenis_kelamin'=>'required',
            'agama' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'alamat' => 'required',
            'kota' => 'required',
            'kabupaten' => 'required',
            'provinsi' => 'required',
            'tlp' => 'required',
            'wa' => 'required',
            'email' => 'required',
            'status_camaba' => 'required',
            'asal_sekolah' => 'required',
            'alamat_sekolah' => 'required',
            'nilai' => 'required',
            'thn_lulus' => 'required',
            'jenjang_yang_dipilih' => 'required',
            'pilih_prodi1' => 'required',
            'pilih_prodi2' => 'required',
            'pilih_prodi3' => 'required',
        ]);

        $postData = array(
            "nama" => $request->input('nama'),
            "jenis_kelamin" =>  $request->input('jenis_kelamin'),
            "agama" => $request->input('agama'),
            "tempat_lahir" => $request->input('tempat_lahir'),
            'tanggal_lahir' => $request->input('tanggal_lahir'),
            'alamat' => $request->input('alamat'),
            'kota' => $request->input('kota'),
            'kabupaten' => $request->input('kabupaten'),
            'provinsi' => $request->input('provinsi'),
            'tlp' => $request->input('tlp'),
            'wa' => $request->input('wa'),
            'email' => $request->input('email'),
            'status_camaba' => $request->input('status_camaba'),
            'asal_sekolah' => $request->input('asal_sekolah'),
            'alamat_sekolah' => $request->input('alamat_sekolah'),
            'nilai' => $request->input('nilai'),
            'thn_lulus' => $request->input('thn_lulus'),
            'jenjang_yang_dipilih' => $request->input('jenjang_yang_dipilih'),
            'pilih_prodi1' => $request->input('pilih_prodi1'),
            'pilih_prodi2' => $request->input('pilih_prodi2'),
            'pilih_prodi3' => $request->input('pilih_prodi3')

        );

        $data_string = json_encode($postData);

        // Ini adalah scrip untuk melakukan post data dari Rekweb API yang telah kita buat
        $username = 'user';
        $password = 'user';
        $credentials = base64_encode("$username:$password");

        $headers = [];
        $headers[] = "Authorization: Basic {$credentials}";
        $headers[] = 'Content-Type: application/json';
        $headers[] = 'Cache-Control: no-cache';
        $headers[] = 'Content-Length: ' . strlen($data_string);
        
        
            // Initializing curl
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL,"127.0.0.2:8001/pendaftaran");
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
   
            // Executing curl
            $response = curl_exec($curl);
            
            //var_dump($response); die;
            // Checking if any error occurs during request or not
            if($e = curl_error($curl)) {
                echo $e;
            } 
        // Closing curl
        curl_close($curl);
        return redirect()->route('index')->with('success', 'Data mahasiswa telah dibuat!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    
    public function edit($id)
    {
        // Ini adalah scrip untuk melakukan post data dari Rekweb API yang telah kita buat
        $username = 'user';
        $password = 'user';
        $credentials = base64_encode("$username:$password");

        $headers = [];
        $headers[] = "Authorization: Basic {$credentials}";
        $headers[] = 'Content-Type: application/json';
        $headers[] = 'Cache-Control: no-cache';
        
        
            // Initializing curl
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL,"127.0.0.2:8001/detail/$id");
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
   
            // Executing curl
            $response = curl_exec($curl);
            
            //var_dump($response); die;
            // Checking if any error occurs during request or not
            if($e = curl_error($curl)) {
                echo $e;
            } else {
                // Decoding JSON data
                $decodedData =
                    json_decode($response, true);
                // Outputting JSON data in
                // Decoded form
                //var_dump($decodedData);
                $data = $decodedData;
            } 
        // Closing curl
        curl_close($curl);
        return view('mhs.edit', ["data" => $data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nama' => 'required',
            'jenis_kelamin'=>'required',
            'agama' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'alamat' => 'required',
            'kota' => 'required',
            'kabupaten' => 'required',
            'provinsi' => 'required',
            'tlp' => 'required',
            'wa' => 'required',
            'email' => 'required',
            'status_camaba' => 'required',
            'asal_sekolah' => 'required',
            'alamat_sekolah' => 'required',
            'nilai' => 'required',
            'thn_lulus' => 'required',
            'jenjang_yang_dipilih' => 'required',
            'pilih_prodi1' => 'required',
            'pilih_prodi2' => 'required',
            'pilih_prodi3' => 'required'
        ]);

        $postData = array(
            "nama"      => $request->input('nama'),
            "jenis_kelamin"     =>  $request->input('jenis_kelamin'),
            "agama" => $request->input('agama'),
            "tempat_lahir" => $request->input('tempat_lahir'),
            'tanggal_lahir' => $request->input('tanggal_lahir'),
            'alamat' => $request->input('alamat'),
            'kota' => $request->input('kota'),
            'kabupaten' => $request->input('kabupaten'),
            'provinsi' => $request->input('provinsi'),
            'tlp' => $request->input('tlp'),
            'wa' => $request->input('wa'),
            'email' => $request->input('email'),
            'status_camaba' => $request->input('status_camaba'),
            'asal_sekolah' => $request->input('asal_sekolah'),
            'alamat_sekolah' => $request->input('alamat_sekolah'),
            'nilai' => $request->input('nilai'),
            'thn_lulus' => $request->input('thn_lulus'),
            'jenjang_yang_dipilih' => $request->input('jenjang_yang_dipilih'),
            'pilih_prodi1' => $request->input('pilih_prodi1'),
            'pilih_prodi2' => $request->input('pilih_prodi2'),
            'pilih_prodi3' => $request->input('pilih_prodi3')

        );

        $data_string = json_encode($postData);

        // Ini adalah scrip untuk melakukan post data dari Rekweb API yang telah kita buat
        $username = 'user';
        $password = 'user';
        $credentials = base64_encode("$username:$password");

        $headers = [];
        $headers[] = "Authorization: Basic {$credentials}";
        $headers[] = 'Content-Type: application/json';
        $headers[] = 'Cache-Control: no-cache';
        $headers[] = 'Content-Length: ' . strlen($data_string);
        
        
            // Initializing curl
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL,"127.0.0.2:8001/update/$id");
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'PUT');
            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
   
            // Executing curl
            $response = curl_exec($curl);
            
            // Checking if any error occurs during request or not
            if($e = curl_error($curl)) {
                echo $e;
            } 
        // Closing curl
        curl_close($curl);
        return redirect()->route('index')->with('success', 'Data mahasiswa telah diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    public function destroy($id)
    {
        // Ini adalah scrip untuk melakukan post data dari Rekweb API yang telah kita buat
        $username = 'user';
        $password = 'user';
        $credentials = base64_encode("$username:$password");

        $headers = [];
        $headers[] = "Authorization: Basic {$credentials}";
        $headers[] = 'Content-Type: application/json';
        $headers[] = 'Cache-Control: no-cache';
        
        
            // Initializing curl
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL,"127.0.0.2:8001/delete/$id");
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'DELETE');
            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
   
            // Executing curl
            $response = curl_exec($curl);
            
            // Checking if any error occurs during request or not
            //var_dump($response); die;
            if($e = curl_error($curl)) {
                echo $e;
            } 
        // Closing curl
        curl_close($curl);
        return redirect()->route('index')->with('success', 'Data mahasiswa telah dihapus!');
    }
}
