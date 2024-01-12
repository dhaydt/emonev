<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
class SsoSakatoController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $kiriman)
    {
      // echo $kiriman->token;
        // Auth::guard('opd')->LoginUsingId($datalogin[0]['id']);
        // return redirect()->route('opd');
      if(isset($kiriman->token)){
        
        // echo "tes: ".$kiriman->token;
        
        // koneksi
        // http://sakatoplan.sumbarprov.go.id/sin/sso/generate_token/sso/ssokoneksi
          $url_koneksi = 'http://sakatoplan.sumbarprov.go.id/sin/sso/generate_token/sso/ssokoneksi';
          $data_koneksi = file_get_contents($url_koneksi);
          // echo"<br>$data_koneksi";
          $url_login = 'http://sakatoplan.sumbarprov.go.id/sin/sso/sharing_datasso/'.$data_koneksi;
          $data_login = file_get_contents($url_login);
  
        $data = array(
            'username' => 'sakato_sso',
            'password' => 'asd123',
            'token' => $kiriman->token
        );
        
        function curl($url, $data){
            $ch = curl_init(); 
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
            $output = curl_exec($ch); 
            curl_close($ch);      
            return $output;
        }

        // Data Parameter yang Dikirim oleh cURL
        $send = curl("http://sakatoplan.sumbarprov.go.id/sin/sso/sharing_datasso/".$data_koneksi."/".$kiriman->token,json_encode($data));
        // echo json_encode(array('respon'=>$send),JSON_UNESCAPED_SLASHES);
        $hasil= json_decode($send);

        echo "<br>".$send;
        // echo $hasil[0]->ID_INSTANSI;
        if(count($hasil)>0){
          
          // insert or update table sso
          $cari_sso=DB::table('sso')->where('id',$hasil[0]->ID_USER)->where('username',$hasil[0]->USERNAME)->first();
          if($hasil[0]->ID_INSTANSI!="" and $hasil[0]->ID_INSTANSI!=0){
            // cek OPD
            $cari_opd=DB::table('data_opd')->where('ID_INSTANSI_SAKATO',$hasil[0]->ID_INSTANSI)->first();
            if($hasil[0]->ID_GROUP=="1"){$lvl="Super Admin";}else{$lvl="Viewer";}
            if($cari_sso!=null){
              DB::table('sso')->where('id',$cari_sso->id)->update(
                [
                  'username'=>$hasil[0]->USERNAME,
                  'nm_pegawai'=>null,
                  'SESSION_VALUE'=>$hasil[0]->SESSION_VALUE,
                  'ID_INSTANSI_SAKATO'=>$hasil[0]->ID_INSTANSI,
                  'NAMA_INSTANSI'=>$hasil[0]->NAMA_INSTANSI,
                  'ID_GROUP'=>$hasil[0]->ID_GROUP,
                  'NAMA_GROUP'=>$hasil[0]->NAMA_GROUP,
                  'ID_APLIKASI'=>$hasil[0]->ID_APLIKASI,
                  'id_instansi'=>$cari_opd->id,
                  'level'=>$lvl,
                ]
              );
            }else{
              // insert
                $store=[
                'id'=>$hasil[0]->ID_USER,
                'username'=>$hasil[0]->USERNAME,
                'nm_pegawai'=>null,
                'SESSION_VALUE'=>$hasil[0]->SESSION_VALUE,
                'ID_INSTANSI_SAKATO'=>$hasil[0]->ID_INSTANSI,
                'NAMA_INSTANSI'=>$hasil[0]->NAMA_INSTANSI,
                'ID_GROUP'=>$hasil[0]->ID_GROUP,
                'NAMA_GROUP'=>$hasil[0]->NAMA_GROUP,
                'ID_APLIKASI'=>$hasil[0]->ID_APLIKASI,
                'id_instansi'=>$cari_opd->id,
                'level'=>$lvl,
                  ];
                  DB::table('sso')->insert($store);
            }
          }

          // Auth::guard('opd')->attempt(['id_instansi_sakato' => $hasil[0]->ID_INSTANSI]);
          // cek aplikasi
          if(in_array('2',explode(",",$hasil[0]->ID_APLIKASI))){
            if($hasil[0]->ID_GROUP=="3"){
            // if($hasil[0]->ID_GROUP=="3"){
              // operator OPD
              Auth::guard('opd')->LoginUsingId($hasil[0]->ID_USER);
              return redirect()->route('opd');
            }elseif($hasil[0]->ID_GROUP=="1"){
              // admin
              // echo "admin";
              Auth::guard('web')->LoginUsingId($hasil[0]->ID_USER);
              return redirect()->route('home');
            }else{
              return redirect('/')->with('fail','Login Gagal');
            }
          }else{
            return redirect('/')->with('fail','Login Gagal');
          }
            // Auth::guard('opd')->LoginUsingId(81);

        }else{
            return redirect('/')->with('fail','Login Gagal');
        }
      }
    }
}
