<?php
Route::get('/', function () {
    return view('welcome');
    
    // return redirect('http://sakatoplan.sumbarprov.go.id/');
    
    //return redirect('maintenance.html');
})->middleware('guest')->name('awal');
Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('view:clear');
    // return what you want
});
Route::get('formrpjmd/',  'RpjmdController@index')->name('formrpjmd');
// Route::get('rpjmd/', 'RpjmdController@cari')->name('carirpjmd');

Route::get('formrkpd/',  'RkpdController@index')->name('formrkpd');
Route::get('rkpd/', 'RkpdController@cari')->name('carirkpd');

Route::get('forme54/',  'E54Controller@index')->name('forme54');
Route::get('carie54/', 'E54Controller@cari')->name('carie54');

//menu data master
Route::resource('periode_rpjmd','master\MasterPeriodeRpjmdController');
Route::resource('periode_renja','master\MasterPeriodeRenjaController');

Route::get('urusan','master\MasterBidangUrusanController@index_dafunit')->name('urusan');
Route::resource('bidang_urusan','master\MasterBidangUrusanController');
Route::resource('data-opd','MasterOpdController');
Route::resource('program','master\MasterProgramController');

//menu data
Route::resource('urusan-opd','UrusanOpdController');
Route::resource('rpjmd','RpjmdController');
//Route::get('rpjmd_impor','RpjmdController@impor');

Route::get('/rpjmd/{idprgrm}/id_instansi/{id_instansi}', 'RpjmdController@indikator_program')->name('rpjmd.indikator_program');

// master kegiatan
Route::get('master-kegiatan','RenstraController@index_kegiatan')->name('master-kegiatan');
Route::resource('masterkegiatan','RenstraController');

// sub kegiatan
Route::resource('mastersubkegiatan','SubkegController');


Route::get('modal/{id}/id_instansi/{id_instansi}/{id_periode_rpjmd}',  'ModalController@show')->name('modal');

//Route::get('rpjmd_prog_ind/',  'ModalController@inprog');
//Route::get('renstra_keg/',  'ModalController@kegiatan');

Route::resource('evaluasi-renja','RenjaController',[ 'except' => ['create','edit','update','show','destroy'] ]);
Route::get('evaluasi_renja_prog','RenjaController@storeProg');
Route::get('evaluasi_renja_keg','RenjaController@storeKeg');
Route::get('evaluasi_renja_sub','RenjaController@storeSub');
Route::get('evaluasi_renja_ren','RenjaController@storeRen');
Route::get('modal-renja/{periode}/{triwulan}/{id}/id_instansi/{id_instansi}/{data_renja}',  'RenjaController@show_evaluasi_renja')->name('modal-renja');
Route::get('renja_indikator','RenjaController@renja_indikator');

//export evaluasi renja
Route::get('evaluasi_renja_excel/{periode}/{jenis}/{id_instansi}/{triwulan}/{rekap}/{data_renja}/{dok}','RenjaController@ekspor_renja_excel');

Route::get('tcevaluasi_renja_excel/{periode}/{jenis}/{id_instansi}/{triwulan}/{rekap}/{data_renja}/{dok}','RenjaController@tcekspor_renja_excel');

//master renja
Route::resource('data-renja','MasterRenjaController');

Route::resource('data-rkpd','MasterRkpdController');

Route::get('modal-master-renja/{periode}/{data_renja}/{id}/id_instansi/{id_instansi}/{unitkey}',  'MasterRenjaController@show_kegiatan')->name('modal-master-renja');

//status e55
Route::resource('status-evaluasi-renja','StatusE55Controller');
//profil opd
Route::resource('profil','ProfilOpdController');
//data renstra
Route::resource('renstra','MasterRenstraController');
Route::get('modal-master-renstra/{periode}/{id}/id_instansi/{id_instansi}/{unitkey}', 'MasterRenstraController@show_kegiatan_renstra')->name('show_kegiatan_renstra');

Route::resource('settings_triwulan','SetTriwulanController');
Route::get('/setrules', 'SetTriwulanController@indexsetrules');
Route::get('/setedit', 'SetTriwulanController@setedit');
Route::get('/sethapus', 'SetTriwulanController@sethapus');

Route::resource('monitoring_evaluasi_rkpd','MonitoringEvaRkpdController');
Route::get('modal-renja2/{periode}/{triwulan}/{id}/id_instansi/{id_instansi}/{data_renja}',  'MonitoringEvaRkpdController@show_evaluasi_renja')->name('modal-renja2');

Route::resource('import','ImportController');

//UPDATE UNTUK PERUBAHAN
Route::get('salin_nmkeg_renja', function () {
	$jml=0;
	$data=DB::table('renja')->get();
	foreach ($data as $v) {

		$cari2=DB::table('renstra_keg')->find($v->kdkegunit);
		if($cari2!=null){
		// DB::table('renja')->where('id',$v->id)->update(['nmkegunit' => $cari2->nmkegunit]);
		$jml++;		
		}else{
			echo $v->kdkegunit.'<br>';
		}
	}
	echo $jml.' data diubah';
});

// update output renja awal
Route::get('update_output_renja_awal', function () {
	$jml=0;
	$data=DB::table('renja_indikator_det')->get();
	foreach ($data as $v) {

		$cari2=DB::table('renja_indikator')->find($v->id_kegindikator);
		if($cari2!=null){
			$cari3=DB::table('renja')->find($cari2->id_renja);
			if($cari3!=null){
				// DB::table('renja_indikator_det')->where('id',$v->id)->update(['kdkegunit' => $cari3->kdkegunit,'id_instansi' => $cari3->id_instansi,'periode' => $cari3->periode,'perubahan' => 2]);
				// periode=...
				$jml++;
			}		
		}else{
			echo $v->kdkegunit.'<br>';
		}
	}
	echo $jml.' data diubah';
});

// insert program perubahan
Route::get('update_program_per', function () {
	$url_json = 'http://simonevdokrenda.sumbarprov.go.id/2020/rkpd_per_2020/mpgrmkupa2020.json';
	$data_json = file_get_contents($url_json);
	$row = json_decode($data_json);
	// dd($row);

	foreach ($row as $v) {
		$st=strpos($v->IDPGRM,'_');
		if(!$st){
			$idpro=$v->IDPGRM;
		}else{
			$idpro=null;
		}
		$store=[
            'idprgrm_per' => $v->IDPGRM,
            'unitkey' => $v->UNITKEY,
            'nmprgrm' => $v->NMPRGRM,
            'nuprgrm' => $v->NUPRGRM,
            'idprgrm' => $idpro
        ];
        // dd($store);
        // DB::table('program_per')->insert($store);
	}
});
// penyelarasan kode program perubahan
Route::get('penyesuaian_program_per', function () {
	/*
	$row=DB::table('program_per')->get();
	foreach ($row as $v) {
		$st=strpos($v->idprgrm_per,'_');
		if(!$st){
			$carist=DB::table('program')->where('id','=',$v->idprgrm)->first();
			if($carist!=""){
				// echo $carist->id.'<br>';
			}else{
				echo $v->idprgrm_per.'<br>';
			}
		}
	}
	*/
	
	$row=DB::table('program_per')->get();
	echo"<table border=1>
		<tr>
			<td>No</td>
			<td>idprgrm per</td>
			<td>idprgrm awal</td>
			<td>nmprgrm per</td>
			<td>nmprgrm awal</td>
		</tr>";
		$no=0;
	foreach ($row as $v) {
		$carist=DB::table('program')->where('id','=',$v->idprgrm)->first();
		$no++;
		$st=strpos($v->idprgrm_per,'_');
		if(!$st){
			$cari=DB::table('program')->where('id',$v->idprgrm_per)->first();
			if($v->idprgrm_per!="227"){
			echo"<tr>
				<td>".$no."</td>
				<td>".$v->idprgrm_per."</td>
				<td>".$cari->id."</td>
				<td>".$v->nmprgrm."</td>
				<td>".$cari->id.' '.$cari->nmprgrm."</td>
				<td>".$carist->id_status."</td>
			</tr>";

			// <td>".$carist->id_status."</td>

			// $up=DB::table('program_per')->where('idprgrm_per',$v->idprgrm_per)->first();
			// $save=$up->update(['idprgrm'=>$cari->id]);
			// DB::table('program_per')
			//             ->where('idprgrm_per', $v->idprgrm_per)
			//             ->update(['idprgrm' => $cari->id]);
			}else{
				echo"$v->idprgrm_per<br>";
			}
		}else{
			$cari=DB::table('program')->where('nmprgrm','=',$v->nmprgrm)->first();
			$nmprgrm=0;
			if($cari!=""){
				$nmprgrm=$cari->nmprgrm;
				// DB::table('program_per')
				//             ->where('idprgrm_per', $v->idprgrm_per)
				//             ->update(['idprgrm' => $cari->id]);
			}
			
			echo"<tr>
				<td>".$no."</td>
				<td>".$v->idprgrm_per."</td>
				<td>".$v->idprgrm."</td>
				<td>".$v->nmprgrm."</td>
				<td>".$nmprgrm."</td>
				<td>".$carist->id_status."</td>
			</tr>";
		}


	}
	echo"</table>";
	
});

// insert kegiatan perubahan
Route::get('update_kegiatan_per', function () {
	$url_json = 'http://simonevdokrenda.sumbarprov.go.id/2020/rkpd_per_2020/mkegiatan_rkpd_penetapan_kupa2020.json';
	$data_json = file_get_contents($url_json);
	$row = json_decode($data_json);
	// dd($row);
	foreach ($row as $v) {
		$store=[
            'kdkegunit_per' => $v->KDKEGUNIT,
            'idprgrm_per' => $v->IDPRGRM,
            'kdperspektif' => $v->KDPERPEKSTIF,
            'nmkegunit_awal' => $v->NMKEGUNIT,
            'nmkegunit' => $v->NMKEGUNIT_PERUBAHAN,
            'nukeg' => $v->NUKEG,
            'levelkeg' => $v->LEVELKEG,
            'tipe' => $v->TYPE
            // 'idprgrm' => $v->IDPRGRM,
        ];
        // dd($store);
        // DB::table('kegiatan_per')->insert($store);
	}
});

// insert renja perubahan TMP
Route::get('insert_renja_per_tmp', function () {
	// $url_token="http://eplanning.sumbarprov.go.id/sin/sinkron/generate_token/pe/123456";
	// $data_token = file_get_contents($url_token);
	// $url_json = 'http://eplanning.sumbarprov.go.id/sin/sinkron/rkpd_penetapan_kupa2020/'.$data_token;
	$url_json = 'http://simonevdokrenda.sumbarprov.go.id/2020/rkpd_per_2020/rkpd_penetapan_kupa2020_baru.json';
	
	// http://simonevdokrenda.sumbarprov.go.id/2019/eplanning-perubahan/rkpd_per.json
	$data_json = file_get_contents($url_json);
	$row = json_decode($data_json);
	// dd($row);
	$jml=0;
	$tot=0;
	foreach ($row as $v) {
		$jml++;
		$store=[
            'KDTAHAP' => $v->KDTAHAP,
            'UNITKEY' => $v->UNITKEY,
            'KDKEGUNIT' => $v->KDKEGUNIT,
            'IDPRGRM' => $v->IDPRGRM,
            'NOPRIOR' => $v->NOPRIOR,
            'KDSIFAT' => $v->KDSIFAT,
            'NIP' => $v->NIP,
            'TGLAKHIR' => $v->TGLAKHIR,
            'TGLAWAL' => $v->TGLAWAL,
            'TARGETP' => $v->TARGETP,
            'LOKASI' => $v->LOKASI,
            'JUMLAHMIN1' => $v->JUMLAHMIN1,
            'PAGU' => $v->PAGU,
            'JUMLAHPLS1' => $v->JUMLAHPLS1,
            'SASARAN' => $v->SASARAN,
            'KETKEG' => $v->KETKEG,
            // 'ID_PRIORITAS' => $v->ID_PRIORITAS,
            'ID_PRIORITAS' => 0,
            // 'ID_SASARAN' => $v->ID_SASARAN
            'ID_SASARAN' => 0
            // 'idprgrm' => $v->IDPRGRM,
        ];
        
        $tot=$tot+$v->PAGU;        	
        

        // dd($store);
        // DB::table('renja_per_tmp')->insert($store);
	}

	// pagu rekomendasi
		// $url_json2 = 'http://eplanning.sumbarprov.go.id/sin/sinkron/penambahan_pagu_p20/'.$data_token;
		$url_json2 = 'http://simonevdokrenda.sumbarprov.go.id/2020/rkpd_per_2020/penambahan_pagu_p20.json';
		
		// http://simonevdokrenda.sumbarprov.go.id/2019/eplanning-perubahan/rkpd_per.json
		$data_json2 = file_get_contents($url_json2);
		$row2 = json_decode($data_json2);
		// dd($row);
		$jml2=0;
		$tot2=0;
		foreach ($row2 as $v2) {
			$jml2++;
			$store2=[
	            'UNITKEY' => $v2->UNITKEY,
	            'KDKEGUNIT' => $v2->KDKEGUNIT,
	            'PAGU_TAMBAHAN' => $v2->PAGU_TAMBAHAN,
	        ];
	        
	        $tot2=$tot2+$v2->PAGU_TAMBAHAN;        	
	        

	        // dd($store);
	        // DB::table('renja_per_tmp')
	        // ->where('UNITKEY', $v2->UNITKEY)
	        // ->where('KDKEGUNIT', $v2->KDKEGUNIT)
         //    ->update(['PAGU_TAMBAHAN' => $v2->PAGU_TAMBAHAN]);
		}
	echo "<br>Pagu :".number_format($tot,0);
	echo "<br>PAGU_TAMBAHAN :".number_format($tot2,0);
	echo "<br>TOTAL :".number_format($tot+$tot2,0);
	echo "<br>jml :".$jml;
	echo "<br>jml2 :".$jml2;
});
// penyelarasan kode kegiatan perubahan
Route::get('penyesuaian_kegiatan_per', function () {
	$row=DB::table('kegiatan_per')->get();
	echo"<table border=1>
		<tr>
			<td>No</td>
			<td>kdkegunit per</td>
			<td>kdkegunit awal</td>
			<td>idprgrm per</td>
			<td>idprgrm awal</td>
			<td>nmkegunit per</td>
			<td>nmkegunit awal</td>
			<td>nmkegunit awal (awal)</td>
		</tr>";
		$no=0;
	foreach ($row as $v) {
		// if($v->kdkegunit==''){
		// 	// $cari=DB::table('renstra_keg')->where('nmkegunit',$v->nmkegunit)->first();
		// 	// if($cari!=""){
		// 	// 	// DB::table('kegiatan_per')
		// 	// 	//             ->where('kdkegunit_per', $v->kdkegunit_per)
		// 	// 	//             ->update(['kdkegunit' => $cari->id]);
				
		// 	// }
		// 	echo"<tr>
		// 		<td>".$no."</td>
		// 		<td>".$v->kdkegunit_per."</td>
		// 		<td>".$v->kdkegunit."</td>
		// 		<td>".$v->idprgrm_per."</td>
		// 		<td>".$v->idprgrm."</td>
		// 		<td>".$v->nmkegunit."</td>
		// 		<td>".$v->nmkegunit_awal."</td>
		// 	</tr>";
			
		// }

		// $carist=DB::table('renstra_keg')->where('id','=',$v->idprgrm)->first();
		$p=strpos($v->idprgrm_per,'_');
		if(!$p){
			// DB::table('kegiatan_per')
   //          ->where('kdkegunit_per', $v->kdkegunit_per)
   //          ->update(['idprgrm' => $v->idprgrm_per]);
		}else{
			// $ckp=DB::table('program_per')
   //          	->where('idprgrm_per', $v->idprgrm_per)->first();
			// DB::table('kegiatan_per')
   //          ->where('kdkegunit_per', $v->kdkegunit_per)
   //          ->update(['idprgrm' => $ckp->idprgrm]);
		}

		if($v->kdkegunit==null){
			// DB::table('kegiatan_per')
   //          ->where('kdkegunit_per', $v->kdkegunit_per)
   //          ->update(['nmkegunit_awal' => null]);
   			// DB::table('kegiatan_per')
      //          ->where('kdkegunit_per', $v->kdkegunit_per)
      //          ->update(['kdkegunit' => $v->kdkegunit_per]);	
		}

		$st=strpos($v->kdkegunit_per,'_');
		if(!$st){
			$cari=DB::table('renstra_keg')->where('id',$v->kdkegunit_per)->first();
			if($cari!=""){
				if($v->nmkegunit==$cari->nmkegunit){$wr='';}else{$wr='red';}
				// DB::table('kegiatan_per')
				//             ->where('kdkegunit_per', $v->kdkegunit_per)
				//             ->update(['kdkegunit' => $v->kdkegunit_per]);
				// echo"<tr>
				// 	<td>".$no."</td>
				// 	<td>".$v->kdkegunit_per."</td>
				// 	<td>".$v->kdkegunit."</td>
				// 	<td>".$v->idprgrm_per."</td>
				// 	<td>".$v->idprgrm."</td>
				// 	<td>".$v->nmkegunit."</td>
				// 	<td>".$v->nmkegunit_awal."</td>
				// 	<td>".$cari->id.' '.$cari->nmkegunit."</td>
				// </tr>";	
			}else{
			// kegiatan baru
				$cari=DB::table('renstra_keg')->where('nmkegunit',$v->nmkegunit)->first();
				if($cari!=""){
					// DB::table('kegiatan_per')
					//             ->where('kdkegunit_per', $v->kdkegunit_per)
					//             ->update(['kdkegunit' => $cari->id]);
					// echo"<tr>
					// 	<td>".$no."</td>
					// 	<td>".$v->kdkegunit_per."</td>
					// 	<td>".$v->kdkegunit."</td>
					// 	<td>".$v->idprgrm_per."</td>
					// 	<td>".$v->idprgrm."</td>
					// 	<td>".$v->nmkegunit."</td>
					// 	<td style='background-color:red;'>0</td>
					// </tr>";
				}else{
					// echo"<tr style='background-color:red;'>
					// 	<td>".$no."</td>
					// 	<td>".$v->kdkegunit_per."</td>
					// 	<td>".$v->kdkegunit."</td>
					// 	<td>".$v->idprgrm_per."</td>
					// 	<td>".$v->idprgrm."</td>
					// 	<td>".$v->nmkegunit."</td>
					// 	<td style='background-color:red;'>0</td>
					// </tr>";
							//insert kegiatan baru
							// $store=[
					  //           'id' => $v->kdkegunit_per,
					  //           'idprgrm' => $v->idprgrm_per,
					  //           'kdperspektif' => $v->kdperspektif,
					  //           'nmkegunit' => $v->nmkegunit,
					  //           'levelkeg' => $v->levelkeg,
					  //           'type' => $v->tipe,
					  //           'id_status' => 1
					  //       ];
					  //       DB::table('renstra_keg')->insert($store);
				}
				
				        		 
			}

		}else{
			$cari=DB::table('renstra_keg')->where('nmkegunit','=',$v->nmkegunit)->first();
			$nmkegunit=0;
			if($cari!=""){
				// $nmkegunit=$cari->nmkegunit;
				// DB::table('kegiatan_per')
				//             ->where('kdkegunit_per', $v->kdkegunit_per)
				//             ->update(['kdkegunit' => $cari->id]);
				// echo"<tr>
				// 	<td>".$no."</td>
				// 	<td>".$v->kdkegunit_per."</td>
				// 	<td>".$v->kdkegunit."</td>
				// 	<td>".$v->idprgrm_per."</td>
				// 	<td>".$v->idprgrm."</td>
				// 	<td>".$v->nmkegunit."</td>
				// 	<td>".$nmkegunit."</td>
				// </tr>";
			}else{
				// $st2=strpos($v->kdkegunit_per,'B4');
				// if(!$st2){
				// 	// $no++;
				// 	// echo"<tr>
				// 	// 	<td>".$no."</td>
				// 	// 	<td>".$v->kdkegunit_per."</td>
				// 	// 	<td>".$v->kdkegunit."</td>
				// 	// 	<td>".$v->idprgrm_per."</td>
				// 	// 	<td>".$v->idprgrm."</td>
				// 	// 	<td>".$v->nmkegunit."</td>
				// 	// 	<td>".$v->nmkegunit_awal."</td>
				// 	// 	<td>".$nmkegunit."</td>
				// 	// </tr>";
				// }else{
					
				// }

						//insert kegiatan baru
						// $store=[
				  //           'id' => $v->kdkegunit_per,
				  //           'idprgrm' => $v->idprgrm_per,
				  //           'kdperspektif' => $v->kdperspektif,
				  //           'nmkegunit' => $v->nmkegunit,
				  //           'levelkeg' => $v->levelkeg,
				  //           'type' => $v->tipe,
				  //           'id_status' => 1
				  //       ];
				  //       DB::table('renstra_keg')->insert($store);
				$no++;
				echo"<tr>
					<td>".$no."</td>
					<td>".$v->kdkegunit_per."</td>
					<td>".$v->kdkegunit."</td>
					<td>".$v->idprgrm_per."</td>
					<td>".$v->idprgrm."</td>
					<td>".$v->nmkegunit."</td>
					<td>".$v->nmkegunit_awal."</td>
					<td>".$nmkegunit."</td>
				</tr>";
			}
			
			
		}


	}
	echo"</table>";
});


// insert renja perubahan
Route::get('insert_renja_perubahan', function () {
	$row=DB::table('renja_per_tmp')->get();


	// dd($row);
	foreach ($row as $v) {
		// $un=str_replace(' ','',$v->UNITKEY);
		$instansi=DB::table('data_opd')->where('unit_key',str_replace(' ','',$v->UNITKEY))->first();
		$kegiatan=DB::table('kegiatan_per')->where('kdkegunit_per',str_replace(' ','',$v->KDKEGUNIT))->first();
		$program=DB::table('program_per')->where('idprgrm_per',str_replace(' ','',$v->IDPRGRM))->first();
		
			if($instansi!=null and $kegiatan!=null){
				if($program!=null){
				$unitkey=DB::table('rpjmd_prog')->where('idprgrm',$program->idprgrm)->where('id_instansi',$instansi->id)->first();

				// if($kegiatan!=null){$kdk=$kegiatan->kdkegunit;$nmk=$kegiatan->nmkegunit;}else{$kdk=null;$nmk=null;}
			$pagu=$v->PAGU+$v->PAGU_TAMBAHAN;
			$store=[
                'periode' => 2020,
                'id_instansi' => $instansi->id,
                'urusan_key' => $unitkey->unitkey,
                'idprgrm' => $program->idprgrm,
                'kdkegunit' => $kegiatan->kdkegunit,
                'id_prioritas' => $v->ID_PRIORITAS,
                'id_sasaran_prioritas' => $v->ID_SASARAN,
                'id_jenis_belanja' => 2,
                'belanja_m_now' => 0,
                'belanja_bj_now' => $pagu,
                'belanja_p_now' => 0,
                'lokasi' => $v->LOKASI,
                'rpjmd_st' => 1,
                'rkpd_st' => 1,
                'apbd_st' => 1,
                'bappeda' => 1,
                'nmkegunit' => $kegiatan->nmkegunit,
                'sasaran' => $v->SASARAN
            ];
            // dd($store);
            // DB::table('renja_per')->insert($store);
            	}else{
            		echo 'program:'.$v->IDPRGRM.' ;<br>';
            	}
        	}else{
        		// BR788229
        		echo $v->UNITKEY.' '.$v->KDKEGUNIT."<br/>";
        	}

		// }
	}
});

// insert renja indikator perubahan
Route::get('insert_renja_per_indikator', function () {
		// $url_json = 'http://localhost/api/eplanning-perubahan/renja_kinkeg_per.json';
		$url_json = 'http://simonevdokrenda.sumbarprov.go.id/2020/rkpd_per_2020/kinkeg_rkpd_penetapan_kupa2020.json';
		$data_json = file_get_contents($url_json);
		$row = json_decode($data_json);
		// dd($row);
		$no=0;
		foreach ($row as $v) {
			$no++;
			$instansi=DB::table('data_opd')->where('unit_key',str_replace(' ','',$v->UNITKEY))->first();
			$kegiatan=DB::table('kegiatan_per')->where('kdkegunit_per',str_replace(' ','',$v->KDKEGUNIT))->first();
			if($instansi!=null and $kegiatan!=null){

				$renja_per=DB::table('renja_per')->where('kdkegunit',$kegiatan->kdkegunit)->where('id_instansi',$instansi->id)->first();
				if($renja_per!=null){
				$store=[
		            'id_renja' => $renja_per->id,
		            'kdjkk' => '02',
		            'kdkegunit' => $kegiatan->kdkegunit,
		            'kdtahap' => 1,
		            // 'unitkey' => $renja_per->urusan_key,
		            // 'id_instansi' => $instansi->id,
		            'tolokur' => $v->TOLOKUR,
		            'sat' => $v->TARGET,
		            'target' => $v->TARGET,
		            'ind_st' => 1
		            // 'idprgrm' => $v->IDPRGRM,
		        ];
		    	
		        // dd($store);
		        // DB::table('renja_indikator_per')->insert($store);

		    	}else{
		    		$no++;
		    		echo $no." | kdkegunit:".$kegiatan->kdkegunit." | id_instansi:".$instansi->id."<br>";
		    		echo $no." | kdkegunit:".$v->KDKEGUNIT." | id_instansi:".$v->UNITKEY."<br>";
		    	}
		    	
	    	}
			// if($instansi==null){echo $v->UNITKEY."<br/>";}
			// if($kegiatan==null){echo $v->KDKEGUNIT."<br/>";}
			// if($renja_per==null){echo $v->KDKEGUNIT."<br/>";}
	    }
	    echo '<br/>Total:'.$no;
});

// update master kegiatan baru
Route::get('update_master_kegiatan_baru', function () {
	$data=DB::table('kegiatan_per')->get();
	foreach ($data as $v) {
			$cek=DB::table('renstra_keg')->where('id',$v->kdkegunit)->first();
			if($cek!=null){
				// DB::table('renstra_keg')
	   //          ->where('id', $v->kdkegunit)
	   //          ->update([
	   //          	'idprgrm' => $v->idprgrm,
	   //          	'nmkegunit' => $v->nmkegunit,
	   //          	'levelkeg' => $v->levelkeg,
	   //          	'type' => $v->tipe,
	   //          	'kdperspektif' => $v->kdperspektif,
	   //          	'id_status' => 1
	   //          ]);
			}else{
				$store=[
		            'id' => $v->kdkegunit,
		            'idprgrm' => $v->idprgrm,
		            'nmkegunit' => $v->nmkegunit,
		            'levelkeg' => $v->levelkeg,
		            'type' => $v->tipe,
		            'kdperspektif' => $v->kdperspektif,
		            'id_status' => 1
		        ];
		        // dd($store);
		        // DB::table('renstra_keg')->insert($store);
			}

	}
});

// sinkron output perubahan
Route::get('sinkron_output_perubahan', function () {
	$cek_awal=DB::table('renja_indikator')
		->join('renja', 'renja_indikator.id_renja', '=', 'renja.id')
        ->select('renja_indikator.id_renja','renja_indikator.id','renja.kdkegunit','renja.id_instansi')->get();
        // ->where('renja.id_instansi',$v->id_instansi)
        // ->where('renja.kdkegunit',$v->kdkegunit)->first();
    // dd($cek_awal);
    foreach ($cek_awal as $vup) {
   		// DB::table('renja_indikator_det')
     //    ->where('id_kegindikator', $vup->id)
     //    ->update([
     //    	'id_instansi' => $vup->id_instansi,
     //    	'kdkegunit' => $vup->kdkegunit,
     //    ]);
    }

	// $data=DB::table('renja_indikator_det')->where('perubahan',2)->get();
	$data=DB::table('renja_indikator_det')->get();
	foreach ($data as $v) {
		

		$cek=DB::table('renja_indikator_per')
			->join('renja_per', 'renja_indikator_per.id_renja', '=', 'renja_per.id')
            ->select('renja_indikator_per.id')
            ->where('renja_per.id_instansi',$v->id_instansi)
            ->where('renja_per.kdkegunit',$v->kdkegunit)->first();

		// select r.id,r.nmkegunit,d.sat_det,d.target_det from renja r,renja_indikator ri,renja_indikator_det d where r.id_instansi='4' and r.kdkegunit='2983' and r.id=ri.id_renja and ri.id=d.id_kegindikator
		// $cek=
           if($cek!=null){
           	// echo $cek->id.'<br/>';
           	// DB::table('renja_indikator_det')
	           //  ->where('id', $v->id)
	           //  ->update([
	           //  	'id_kegindikator_per' => $cek->id,
	           //  	'target_det_per' => $v->target_det,
	           //  	'sub_keg_per' => $v->sub_keg,
	           //  	'perubahan' => 1
	           //  ]);
           }
	}
	echo"<script>alert('sinkron output kegiatan sukses...!')</script>";
	//return back();
});
// sinkron realisasi renja perubahan
Route::get('sinkron_realisasi_perubahan', function () {
	$data=DB::table('realisasi')->get();
	foreach ($data as $v) {
		$cekrenja=DB::table('renja')->where('id',$v->id_renja)->first();
		if($cekrenja!=null){
			$cekrenja_per=DB::table('renja_per')->where('id_instansi',$cekrenja->id_instansi)->where('kdkegunit',$cekrenja->kdkegunit)->first();
			if($cekrenja_per!=null){
				DB::table('realisasi')
				->where('id',$v->id)
				->update(['id_renja_per' => $cekrenja_per->id,
						  'periode_renja' => $cekrenja_per->periode,
						  'id_instansi_renja' => $cekrenja_per->id_instansi,
						  'kdkegunit_renja' => $cekrenja_per->kdkegunit]);
			}
		}
	}
	echo"<script>alert('sinkron realisasi kegiatan sukses...!')</script>";
	// return back();
});

// update output renja awal
// Route::get('update_output_renja_perubahan', function () {
// 	$jml=0;
// 	$data=DB::table('renja_indikator_det')->get();
// 	foreach ($data as $v) {
// 		if($v->perubahan==2){
// 			$cari2=DB::table('renja_per')->where('id_instansi',$v->id_instansi)->where('kdkegunit',$v->kdkegunit)->first();
// 			if($cari2!=null){
// 				$cari3=DB::table('renja_indikator_per')->find($cari2->id_renja);
// 				if($cari3!=null){
// 					DB::table('renja_indikator_det')->where('id',$v->id)->update(['target_det_per' => $v->target_det]);
// 					$jml++;
// 				}
// 			}
// 		}
// 		echo $v->kdkegunit.'<br>';
// 	}
// 	echo $jml.' data diubah';
// });


// field bappeda renja=1
// Route::get('bappeda_ver', function () {
// 	$url_json = 'http://localhost/api_eplanning/rkpd/data_rancangan_akhir.json';
// 	$data_json = file_get_contents($url_json);
// 	$urusan_opd = json_decode($data_json);
// 	//dd($urusan_opd);
// 	foreach ($urusan_opd as $v) {
// 	if($v->type=="table")
// 	{
// 	    //dd($v->data);
// 	    $no=0;
// 	    foreach ($v->data as $r) {                
// 	        $store=[
// 	                'id' => $r->id_renja,
// 	                'bappeda' => $r->bappeda,
// 	            ];

// 	            // dd($store);
// 	        	$data = DB::table('renja')->where('id',$r->id_renja)->update(['bappeda'=>$r->bappeda]);
// 	    	$no++;
// 	    }
// 	    echo $no;
// 	}
// 	}
// });
//pecah target 1. spasi = 1 (tanpa . , ; - / dan)

// Route::get('pecah_target', function () {
//     $data = DB::table('renja_indikator_det')->get();
//     echo"<table border=1 style='border-collapse:collapse;'>
//     <tr>
//     	<th>No</th>
//     	<th>Id indikator / id_kegindikator</th>
//     	<th>Tolokur</th>
//     	<th>Target Sumber</th>
//     	<th>Satuan</th>
//     	<th>Satuan Hasil</th>
//     	<th>Target</th>
//     	<th>Target Hasil</th>
//     	<th>SQL</th>
//     </tr>
//     ";
//     $no=0;
//     $hsl="";
//     foreach ($data as $v) {
//     	$matches = [];
//     	$string = $v->target_det;

//     	if (is_numeric($string)) // find only numbers and collect the first group of 4 numbers
//     	{
//     		// var_dump($matches); // if a match of 4 numbers is found, dump the matches array so you can see you can access it using $matches[0]
//     	}else{$no++;

//     		// $ketemu=strpos($v->sat_det,'Km');
//     		// $hsl=0;
//     		// if($ketemu){
//     		// 	// $hkm=str_replace(' Km', '', $v->target_det);
//     		// 	$hsl=stristr($v->sat_det, 'Km');
//     		// 	// $data = DB::table('renja_indikator_det')->where('id',$v->id)->update(['sat_det'=>$hsl]);
//     		echo"
// 		    		<tr>
// 		    		<td>$no</td>
// 		    		<td>$v->id / $v->id_kegindikator</td>
// 		    		<td>$v->tolokur_sumber</td>
// 		    		<td>$v->target_sumber</td>
// 		    		<td>$v->sat_det</td>
// 		    		<td></td>
// 		    		<td>$v->target_det</td>
// 		    		<td>$hsl</td>
// 		    		<td>

// 		    		</td>
// 		    		</tr>
// 		    		";
// 		    }

//     	}
//     echo"</table>";
// });

// Route::get('rpjmd_prog_ind_cek', function () {
// 	// $data = DB::table('rpjmd_prog_indikator')->get();
// 	$data = DB::table('rpjmd_prog_indikator')
// 				->join('data_opd', 'rpjmd_prog_indikator.id_instansi', '=', 'data_opd.id')
// 	            ->join('program', 'rpjmd_prog_indikator.idprgrm', '=', 'program.id')
// 	            ->select('rpjmd_prog_indikator.*', 'data_opd.nm_instansi', 'program.nmprgrm')
// 	            ->get();
// 	echo"<table border=1 style='border-collapse:collapse;'>
// 	<tr>
// 		<th>No</th>
// 		<th>Id</th>
// 		<th>OPD</th>
// 		<th>Program</th>
// 		<th>Indikator</th>
// 		<th>Satuan</th>
// 		<th>2016</th>
// 		<th>2017</th>
// 		<th>2018</th>
// 		<th>2019</th>
// 		<th>2020</th>
// 		<th>2021</th>
// 		<th>Ketemu</th>
// 	</tr>
// 	";
// 	$no=0;
// 	foreach ($data as $v) {
		
		
// 		$kalimat = $v->satuan;
// 		$pattern = '/%/';
// 		if(preg_match($pattern, $kalimat)) {
// 		  // echo 'Ketemu';
// 			if(strlen($kalimat)<5){
// 			$satuan = str_replace(' ', '', $v->satuan);
			
// 			$t1 = str_replace(' ', '', $v->t1);
// 			$t2 = str_replace(' ', '', $v->t2);
// 			$t3 = str_replace(' ', '', $v->t3);
// 			$t4 = str_replace(' ', '', $v->t4);
// 			$t5 = str_replace(' ', '', $v->t5);
// 			$t6 = str_replace(' ', '', $v->t6);

// 			$t1 = str_replace(',', '.', $t1);
// 			$t2 = str_replace(',', '.', $t2);
// 			$t3 = str_replace(',', '.', $t3);
// 			$t4 = str_replace(',', '.', $t4);
// 			$t5 = str_replace(',', '.', $t5);
// 			$t6 = str_replace(',', '.', $t6);

// 			$t1 = str_replace('%', '', $t1);
// 			$t2 = str_replace('%', '', $t2);
// 			$t3 = str_replace('%', '', $t3);
// 			$t4 = str_replace('%', '', $t4);
// 			$t5 = str_replace('%', '', $t5);
// 			$t6 = str_replace('%', '', $t6);

// 			// $cek=DB::table('rpjmd_prog_indikator')->find($v->id);
// 			// $cek->satuan=$satuan;
// 			// $cek->t1=$t1;
// 			// $cek->t2=$t2;
// 			// $cek->t3=$t3;
// 			// $cek->t4=$t4;
// 			// $cek->t5=$t5;
// 			// $cek->t6=$t6;
// 			// $cek->save();
// 			// $data = DB::table('rpjmd_prog_indikator')->where('id',$v->id)->update(['satuan'=>$satuan,'t1'=>$t1,'t2'=>$t2,'t3'=>$t3,'t4'=>$t4,'t5'=>$t5,'t6'=>$t6]);
// 			$ketemu="Ya";
// 				// echo"
// 			 //    		<tr>
// 			 //    		<td>$no</td>
// 			 //    		<td>$v->id</td>
// 			 //    		<td>$v->indikator</td>
// 			 //    		<td>$satuan</td>
// 			 //    		<td>$t1 ($v->t1)</td>
// 			 //    		<td>$t2 ($v->t2)</td>
// 			 //    		<td>$t3 ($v->t3)</td>
// 			 //    		<td>$t4 ($v->t4)</td>
// 			 //    		<td>$t5 ($v->t5)</td>
// 			 //    		<td>$t6 ($v->t6)</td>
// 			 //    		<td>$ketemu</td>
// 			 //    		</tr>
// 			 //    		";

			
// 			}else{
// 				$ketemu="Tidak Ketemu";
// 				$satuan = $v->satuan;
// 				$t1 = str_replace(' ', '', $v->t1);
// 				$t2 = str_replace(' ', '', $v->t2);
// 				$t3 = str_replace(' ', '', $v->t3);
// 				$t4 = str_replace(' ', '', $v->t4);
// 				$t5 = str_replace(' ', '', $v->t5);
// 				$t6 = str_replace(' ', '', $v->t6);

// 				$t1 = str_replace(',', '.', $t1);
// 				$t2 = str_replace(',', '.', $t2);
// 				$t3 = str_replace(',', '.', $t3);
// 				$t4 = str_replace(',', '.', $t4);
// 				$t5 = str_replace(',', '.', $t5);
// 				$t6 = str_replace(',', '.', $t6);

// 				$t1 = str_replace('%', '', $t1);
// 				$t2 = str_replace('%', '', $t2);
// 				$t3 = str_replace('%', '', $t3);
// 				$t4 = str_replace('%', '', $t4);
// 				$t5 = str_replace('%', '', $t5);
// 				$t6 = str_replace('%', '', $t6);

// 				// $data = DB::table('rpjmd_prog_indikator')->where('id',$v->id)->update(['satuan'=>$satuan,'t1'=>$t1,'t2'=>$t2,'t3'=>$t3,'t4'=>$t4,'t5'=>$t5,'t6'=>$t6]);
// 					// echo"
// 				 //    		<tr>
// 				 //    		<td>$no</td>
// 				 //    		<td>$v->id</td>
// 				 //    		<td>$v->indikator</td>
// 				 //    		<td>$satuan</td>
// 				 //    		<td>$t1 ($v->t1)</td>
// 				 //    		<td>$t2 ($v->t2)</td>
// 				 //    		<td>$t3 ($v->t3)</td>
// 				 //    		<td>$t4 ($v->t4)</td>
// 				 //    		<td>$t5 ($v->t5)</td>
// 				 //    		<td>$t6 ($v->t6)</td>
// 				 //    		<td>$ketemu</td>
// 				 //    		</tr>
// 				 //    		";
// 			}
// 		} else {
// 		  // echo 'Tidak Ketemu';
// 			$ketemu="Tidak Ketemu";
// 			$satuan = $v->satuan;
// 			$t1 = $v->t1;
// 			$t2 = $v->t2;
// 			$t3 = $v->t3;
// 			$t4 = $v->t4;
// 			$t5 = $v->t5;
// 			$t6 = $v->t6;

// 			if($v->satuan=="Skor 1-100"){
// 				$t1 = str_replace(' ', '', $v->t1);
// 				$t2 = str_replace(' ', '', $v->t2);
// 				$t3 = str_replace(' ', '', $v->t3);
// 				$t4 = str_replace(' ', '', $v->t4);
// 				$t5 = str_replace(' ', '', $v->t5);
// 				$t6 = str_replace(' ', '', $v->t6);

// 				$t1 = str_replace(',', '.', $t1);
// 				$t2 = str_replace(',', '.', $t2);
// 				$t3 = str_replace(',', '.', $t3);
// 				$t4 = str_replace(',', '.', $t4);
// 				$t5 = str_replace(',', '.', $t5);
// 				$t6 = str_replace(',', '.', $t6);
// 				// $data = DB::table('rpjmd_prog_indikator')->where('id',$v->id)->update(['t1'=>$t1,'t2'=>$t2,'t3'=>$t3,'t4'=>$t4,'t5'=>$t5,'t6'=>$t6]);
// 				// echo"
// 			 //    		<tr>
// 			 //    		<td>$no</td>
// 			 //    		<td>$v->id</td>
// 			 //    		<td>$v->indikator</td>
// 			 //    		<td>$satuan</td>
// 			 //    		<td>$t1 ($v->t1)</td>
// 			 //    		<td>$t2 ($v->t2)</td>
// 			 //    		<td>$t3 ($v->t3)</td>
// 			 //    		<td>$t4 ($v->t4)</td>
// 			 //    		<td>$t5 ($v->t5)</td>
// 			 //    		<td>$t6 ($v->t6)</td>
// 			 //    		<td>$ketemu</td>
// 			 //    		</tr>
// 			 //    		";
// 			}elseif($v->satuan=="Sekolah"){
// 				// $t1 = str_replace(' ', '', $v->t1);
// 				// $t2 = str_replace(' ', '', $v->t2);
// 				// $t3 = str_replace(' ', '', $v->t3);
// 				// $t4 = str_replace(' ', '', $v->t4);
// 				// $t5 = str_replace(' ', '', $v->t5);
// 				// $t6 = str_replace(' ', '', $v->t6);

// 				// $t1 = str_replace(',', '.', $t1);
// 				// $t2 = str_replace(',', '.', $t2);
// 				// $t3 = str_replace(',', '.', $t3);
// 				// $t4 = str_replace(',', '.', $t4);
// 				// $t5 = str_replace(',', '.', $t5);
// 				// $t6 = str_replace(',', '.', $t6);
// 				// $data = DB::table('rpjmd_prog_indikator')->where('id',$v->id)->update(['t1'=>$t1,'t2'=>$t2,'t3'=>$t3,'t4'=>$t4,'t5'=>$t5,'t6'=>$t6]);
// 					// echo"
// 				 //    		<tr>
// 				 //    		<td>$no</td>
// 				 //    		<td>$v->id</td>
// 				 //    		<td>$v->indikator</td>
// 				 //    		<td>$satuan</td>
// 				 //    		<td>$t1 ($v->t1)</td>
// 				 //    		<td>$t2 ($v->t2)</td>
// 				 //    		<td>$t3 ($v->t3)</td>
// 				 //    		<td>$t4 ($v->t4)</td>
// 				 //    		<td>$t5 ($v->t5)</td>
// 				 //    		<td>$t6 ($v->t6)</td>
// 				 //    		<td>$ketemu</td>
// 				 //    		</tr>
// 				 //    		";
// 			}elseif($v->satuan=="Orang" or $v->satuan=="orang" or $v->satuan=="orang " or $v->satuan==" orang "){
// 				// $t1 = str_replace(' ', '', $v->t1);
// 				// $t2 = str_replace(' ', '', $v->t2);
// 				// $t3 = str_replace(' ', '', $v->t3);
// 				// $t4 = str_replace(' ', '', $v->t4);
// 				// $t5 = str_replace(' ', '', $v->t5);
// 				// $t6 = str_replace(' ', '', $v->t6);

// 				// if($v->indikator=="Meningkatnya SDM Aparat dan pelaku usaha kelautan dan perikanan" or $v->indikator=="Anak Panti (bantuan beras)" or $v->indikator=="Peningkatan jumlah pemuda yang mandiri dan berkapasitas" or $v->indikator=="Peningkatan jumlah pemuda yang berkapasitas dalam organisasi kepemudaan dan keolahragaan"){
// 				// 	$t1 = str_replace('.', '', $t1);
// 				// 	$t2 = str_replace('.', '', $t2);
// 				// 	$t3 = str_replace('.', '', $t3);
// 				// 	$t4 = str_replace('.', '', $t4);
// 				// 	$t5 = str_replace('.', '', $t5);
// 				// 	$t6 = str_replace('.', '', $t6);
// 				// }else{
// 				// 	$t1 = str_replace(',', '.', $t1);
// 				// 	$t2 = str_replace(',', '.', $t2);
// 				// 	$t3 = str_replace(',', '.', $t3);
// 				// 	$t4 = str_replace(',', '.', $t4);
// 				// 	$t5 = str_replace(',', '.', $t5);
// 				// 	$t6 = str_replace(',', '.', $t6);
// 				// }

// 				// // $data = DB::table('rpjmd_prog_indikator')->where('id',$v->id)->update(['t1'=>$t1,'t2'=>$t2,'t3'=>$t3,'t4'=>$t4,'t5'=>$t5,'t6'=>$t6]);
// 				// 	echo"
// 				//     		<tr>
// 				//     		<td>$no</td>
// 				//     		<td>$v->id</td>
// 				//     		<td>$v->indikator</td>
// 				//     		<td>$satuan</td>
// 				//     		<td>$t1 ($v->t1)</td>
// 				//     		<td>$t2 ($v->t2)</td>
// 				//     		<td>$t3 ($v->t3)</td>
// 				//     		<td>$t4 ($v->t4)</td>
// 				//     		<td>$t5 ($v->t5)</td>
// 				//     		<td>$t6 ($v->t6)</td>
// 				//     		<td>$ketemu</td>
// 				//     		</tr>
// 				//     		";
// 			}elseif($v->satuan=="Puskesmas" or $v->satuan=="RS" or $v->satuan=="Unit" or $v->satuan=="unit" or $v->satuan=="Kab/Kota" or $v->satuan=="Hari" or $v->satuan=="dokumen" or $v->satuan=="laporan" or $v->satuan=="Kasus" or $v->satuan=="kasus" or $v->satuan=="konflik" or $v->satuan=="Rakor/Pertemuan per tahun" or $v->satuan=="Jumlah Panti" or $v->satuan=="Lembaga" or $v->satuan=="Kelompok" or $v->satuan=="Ratio" or $v->satuan=="Kab" or $v->satuan=="Kab" or $v->satuan=="Nagari/Desa" or $v->satuan=="Nagari/Desa/Kelurahan" or $v->satuan=="PUS" or $v->satuan=="Ranking"){
// 				// $t1 = str_replace(' ', '', $v->t1);
// 				// $t2 = str_replace(' ', '', $v->t2);
// 				// $t3 = str_replace(' ', '', $v->t3);
// 				// $t4 = str_replace(' ', '', $v->t4);
// 				// $t5 = str_replace(' ', '', $v->t5);
// 				// $t6 = str_replace(' ', '', $v->t6);

// 				// if($v->indikator=="Nagari/Desa Definitif"){
// 				// 	$t1 = str_replace('.', '', $t1);
// 				// 	$t2 = str_replace('.', '', $t2);
// 				// 	$t3 = str_replace('.', '', $t3);
// 				// 	$t4 = str_replace('.', '', $t4);
// 				// 	$t5 = str_replace('.', '', $t5);
// 				// 	$t6 = str_replace('.', '', $t6);
// 				// }else{
// 				// 	$t1 = str_replace(',', '.', $t1);
// 				// 	$t2 = str_replace(',', '.', $t2);
// 				// 	$t3 = str_replace(',', '.', $t3);
// 				// 	$t4 = str_replace(',', '.', $t4);
// 				// 	$t5 = str_replace(',', '.', $t5);
// 				// 	$t6 = str_replace(',', '.', $t6);
// 				// }
// 				// // $data = DB::table('rpjmd_prog_indikator')->where('id',$v->id)->update(['t1'=>$t1,'t2'=>$t2,'t3'=>$t3,'t4'=>$t4,'t5'=>$t5,'t6'=>$t6]);
// 				// 	echo"
// 				//     		<tr>
// 				//     		<td>$no</td>
// 				//     		<td>$v->id</td>
// 				//     		<td>$v->indikator</td>
// 				//     		<td>$satuan</td>
// 				//     		<td>$t1 ($v->t1)</td>
// 				//     		<td>$t2 ($v->t2)</td>
// 				//     		<td>$t3 ($v->t3)</td>
// 				//     		<td>$t4 ($v->t4)</td>
// 				//     		<td>$t5 ($v->t5)</td>
// 				//     		<td>$t6 ($v->t6)</td>
// 				//     		<td>$ketemu</td>
// 				//     		</tr>
// 				//     		";
// 			}elseif($v->satuan=="paket" or $v->satuan=="Rumusan Kebijakan" or $v->satuan=="Rumusan Kebijakan (SK/Pergub)" or $v->satuan=="Jumlah" or $v->satuan=="(Kg/kapita/ tahun)" or $v->satuan=="perbandingan" or $v->satuan=="kab/kota" or $v->satuan=="Indeks" or $v->satuan=="Sentra" or $v->satuan=="Kemitraan/ MoU" or $v->satuan=="standarisasi produk" or $v->satuan=="ratio" or $v->satuan=="Keg/Org/ Lemb" or $v->satuan=="19 Kab/Kota" or $v->satuan=="Jumlah LDS" or $v->satuan=="peringkat sumbar pada STQ Nasional" or $v->satuan=="Pondok Al-Qur'an" or $v->satuan=="Nagari" or $v->satuan=="Kali" or $v->satuan=="jenis" or $v->satuan=="Eksemplar" or $v->satuan=="Rata-rata kenaikan/ orang" or $v->satuan=="SKPD" or $v->satuan=="Jumlah SKPD (Kumulatif)" or $v->satuan=="sampel" or $v->satuan=="Kawasan" or $v->satuan=="pulau" or $v->satuan=="Jenis" or $v->satuan=="pelaku" or $v->satuan=="destinasi" or $v->satuan=="Pelaku Usaha" or $v->satuan=="klaster" or $v->satuan=="unit usaha" or $v->satuan=="Level 1-5"){
// 				$t1 = str_replace(' ', '', $v->t1);
// 				$t2 = str_replace(' ', '', $v->t2);
// 				$t3 = str_replace(' ', '', $v->t3);
// 				$t4 = str_replace(' ', '', $v->t4);
// 				$t5 = str_replace(' ', '', $v->t5);
// 				$t6 = str_replace(' ', '', $v->t6);

// 				$t1 = str_replace(',', '.', $t1);
// 				$t2 = str_replace(',', '.', $t2);
// 				$t3 = str_replace(',', '.', $t3);
// 				$t4 = str_replace(',', '.', $t4);
// 				$t5 = str_replace(',', '.', $t5);
// 				$t6 = str_replace(',', '.', $t6);
// 				// $data = DB::table('rpjmd_prog_indikator')->where('id',$v->id)->update(['t1'=>$t1,'t2'=>$t2,'t3'=>$t3,'t4'=>$t4,'t5'=>$t5,'t6'=>$t6]);
// 									// echo"
// 								 //    		<tr>
// 								 //    		<td>$no</td>
// 								 //    		<td>$v->id</td>
// 								 //    		<td>$v->indikator</td>
// 								 //    		<td>$satuan</td>
// 								 //    		<td>$t1 ($v->t1)</td>
// 								 //    		<td>$t2 ($v->t2)</td>
// 								 //    		<td>$t3 ($v->t3)</td>
// 								 //    		<td>$t4 ($v->t4)</td>
// 								 //    		<td>$t5 ($v->t5)</td>
// 								 //    		<td>$t6 ($v->t6)</td>
// 								 //    		<td>$ketemu</td>
// 								 //    		</tr>
// 								 //    		";
// 			}elseif($v->satuan=="(Kg/kapita/ tahun) " or $v->satuan=="kali" or $v->satuan=="Kali " or $v->satuan=="kelompok" or $v->satuan=="sentra" or $v->satuan=="Perangkat Daerah" or $v->satuan=="JPL/orang/ tahun" or $v->satuan==" JPL/orang/ tahun " or $v->satuan=="Perda " or $v->satuan=="Perda" or $v->satuan=="Rekomendasi" or $v->satuan=="Skor 0-4" or $v->satuan=="Segmen " or $v->satuan=="Jml Perda" or $v->satuan=="Rekomendasi" or $v->satuan=="Perangkat Daerah" or $v->satuan=="buku" or $v->satuan=="orang " or $v->satuan=="kawasan" or $v->satuan=="JPL/orang/ tahun" or $v->satuan=="stel" or $v->satuan==" Level 1-5 " or $v->satuan=="Jumlah Pemuda " or $v->satuan=="Perusahaan"){
// 				$t1 = str_replace(' ', '', $v->t1);
// 				$t2 = str_replace(' ', '', $v->t2);
// 				$t3 = str_replace(' ', '', $v->t3);
// 				$t4 = str_replace(' ', '', $v->t4);
// 				$t5 = str_replace(' ', '', $v->t5);
// 				$t6 = str_replace(' ', '', $v->t6);

// 				$t1 = str_replace(',', '.', $t1);
// 				$t2 = str_replace(',', '.', $t2);
// 				$t3 = str_replace(',', '.', $t3);
// 				$t4 = str_replace(',', '.', $t4);
// 				$t5 = str_replace(',', '.', $t5);
// 				$t6 = str_replace(',', '.', $t6);
// 				// $data = DB::table('rpjmd_prog_indikator')->where('id',$v->id)->update(['t1'=>$t1,'t2'=>$t2,'t3'=>$t3,'t4'=>$t4,'t5'=>$t5,'t6'=>$t6]);
// 									// echo"
// 								 //    		<tr>
// 								 //    		<td>$no</td>
// 								 //    		<td>$v->id</td>
// 								 //    		<td>$v->indikator</td>
// 								 //    		<td>$satuan</td>
// 								 //    		<td>$t1 ($v->t1)</td>
// 								 //    		<td>$t2 ($v->t2)</td>
// 								 //    		<td>$t3 ($v->t3)</td>
// 								 //    		<td>$t4 ($v->t4)</td>
// 								 //    		<td>$t5 ($v->t5)</td>
// 								 //    		<td>$t6 ($v->t6)</td>
// 								 //    		<td>$ketemu</td>
// 								 //    		</tr>
// 								 //    		";
// 			}elseif($v->id==100 or $v->id==105 or $v->id==107 or $v->id==106 or $v->id==204 or $v->id==207 or $v->id==210 or $v->id==213 or $v->id==292 or $v->id==293 or $v->id==335 or $v->id==336){

// 			}elseif($v->satuan==" Zona " or $v->satuan==" zona  "or $v->satuan=="Zona"){
				
// 			}elseif($v->indikator=="Kepatuhan pelaksanan UU pelayanan publik (zona hijau)"){
// 				// $indb=str_replace("(zona hijau)", "(zona hijau=3); kuning=2; merah=1", $v->indikator);
// 				// if($t1=="hijau"){$t1=3;}elseif($t1=="kuning"){$t1=2;}elseif($t1=="merah"){$t1=1;}
// 				// if($t2=="hijau"){$t2=3;}elseif($t2=="kuning"){$t2=2;}elseif($t2=="merah"){$t2=1;}
// 				// if($t3=="hijau"){$t3=3;}elseif($t3=="kuning"){$t3=2;}elseif($t3=="merah"){$t3=1;}
// 				// if($t4=="hijau"){$t4=3;}elseif($t4=="kuning"){$t4=2;}elseif($t4=="merah"){$t4=1;}
// 				// if($t5=="hijau"){$t5=3;}elseif($t5=="kuning"){$t5=2;}elseif($t5=="merah"){$t5=1;}
// 				// if($t6=="hijau"){$t6=3;}elseif($t6=="kuning"){$t6=2;}elseif($t6=="merah"){$t6=1;}
// 				// 	echo"
// 				//     		<tr>
// 				//     		<td>$no</td>
// 				//     		<td>$v->id</td>
// 				//     		<td>$v->nm_instansi</td>
// 				//     		<td>$v->nmprgrm</td>
// 				//     		<td>$indb</td>
// 				//     		<td>$satuan <input type='text' value='$satuan'></td>
// 				//     		<td>$t1 ($v->t1)</td>
// 				//     		<td>$t2 ($v->t2)</td>
// 				//     		<td>$t3 ($v->t3)</td>
// 				//     		<td>$t4 ($v->t4)</td>
// 				//     		<td>$t5 ($v->t5)</td>
// 				//     		<td>$t6 ($v->t6)</td>
// 				//     		<td>$ketemu</td>
// 				//     		</tr>
// 				//     		";
// 				    // $data = DB::table('rpjmd_prog_indikator')->where('id',$v->id)->update(['t1'=>$t1,'t2'=>$t2,'t3'=>$t3,'t4'=>$t4,'t5'=>$t5,'t6'=>$t6,'indikator'=>$indb]);
				
// 			}elseif($v->indikator=="Nilai Evaluasi SAKIP SKPD"){
// 				// $indb=$v->indikator." [ AA (>90-100); A (>80-90); BB (>70-80); B (>60-70); CC (>50-60); C (>30-50); D (0-30); ]";
// 				// $t4 = str_replace(' ', '', $v->t4);
// 				// if($t1=="A"){$t1=80;}elseif($t1=="BB"){$t1=70;}
// 				// if($t2=="A"){$t2=80;}elseif($t2=="BB"){$t2=70;}
// 				// if($t3=="A"){$t3=80;}elseif($t3=="BB"){$t3=70;}
// 				// if($t4=="A"){$t4=80;}elseif($t4=="BB"){$t4=70;}
// 				// if($t5=="A"){$t5=80;}elseif($t5=="BB"){$t5=70;}
// 				// if($t6=="A"){$t6=80;}elseif($t6=="BB"){$t6=70;}
// 				// 	echo"
// 				//     		<tr>
// 				//     		<td>$no</td>
// 				//     		<td>$v->id</td>
// 				//     		<td>$v->nm_instansi</td>
// 				//     		<td>$v->nmprgrm</td>
// 				//     		<td>$indb</td>
// 				//     		<td>$satuan <input type='text' value='$satuan'></td>
// 				//     		<td>$t1 ($v->t1)</td>
// 				//     		<td>$t2 ($v->t2)</td>
// 				//     		<td>$t3 ($v->t3)</td>
// 				//     		<td>$t4 ($v->t4)</td>
// 				//     		<td>$t5 ($v->t5)</td>
// 				//     		<td>$t6 ($v->t6)</td>
// 				//     		<td>$ketemu</td>
// 				//     		</tr>
// 				//     		";
// 				   // $data = DB::table('rpjmd_prog_indikator')->where('id',$v->id)->update(['t1'=>$t1,'t2'=>$t2,'t3'=>$t3,'t4'=>$t4,'t5'=>$t5,'t6'=>$t6,'indikator'=>$indb]);
// 			}elseif($v->satuan==" Predikat " or $v->satuan==" predikat "){
					
// 			}elseif($v->satuan==" Skor " or $v->satuan=="Skor"){
					
// 			}elseif($v->indikator=="Nilai LAKIP SKPD (minimal BB)"){
// 				// $indb=$v->indikator." [ AA (>90-100); A (>80-90); BB (>70-80); B (>60-70); CC (>50-60); C (>30-50); D (0-30); ]";
// 				// $t4 = str_replace(' ', '', $v->t4);
// 				// if($t1=="A"){$t1=80;}elseif($t1=="BB"){$t1=70;}
// 				// if($t2=="A"){$t2=80;}elseif($t2=="BB"){$t2=70;}
// 				// if($t3=="A"){$t3=80;}elseif($t3=="BB"){$t3=70;}
// 				// if($t4=="A"){$t4=80;}elseif($t4=="BB"){$t4=70;}
// 				// if($t5=="A"){$t5=80;}elseif($t5=="BB"){$t5=70;}
// 				// if($t6=="A"){$t6=80;}elseif($t6=="BB"){$t6=70;}
// 				// 	echo"
// 				//     		<tr>
// 				//     		<td>$no</td>
// 				//     		<td>$v->id</td>
// 				//     		<td>$v->nm_instansi</td>
// 				//     		<td>$v->nmprgrm</td>
// 				//     		<td>$indb</td>
// 				//     		<td>$satuan <input type='text' value='$satuan'></td>
// 				//     		<td>$t1 ($v->t1)</td>
// 				//     		<td>$t2 ($v->t2)</td>
// 				//     		<td>$t3 ($v->t3)</td>
// 				//     		<td>$t4 ($v->t4)</td>
// 				//     		<td>$t5 ($v->t5)</td>
// 				//     		<td>$t6 ($v->t6)</td>
// 				//     		<td>$ketemu</td>
// 				//     		</tr>
// 				//     		";
// 				    // $data = DB::table('rpjmd_prog_indikator')->where('id',$v->id)->update(['t1'=>$t1,'t2'=>$t2,'t3'=>$t3,'t4'=>$t4,'t5'=>$t5,'t6'=>$t6,'indikator'=>$indb]);
// 			}elseif($v->id=="74" or $v->id=="75" or $v->id=="76" or $v->id=="77"){
// 			}else{
// 				$no++;
// 					echo"
// 				    		<tr>
// 				    		<td>$no</td>
// 				    		<td>$v->id</td>
// 				    		<td>$v->nm_instansi</td>
// 				    		<td>$v->nmprgrm</td>
// 				    		<td>$v->indikator</td>
// 				    		<td>$satuan <input type='text' value='$satuan'></td>
// 				    		<td>$t1 ($v->t1)</td>
// 				    		<td>$t2 ($v->t2)</td>
// 				    		<td>$t3 ($v->t3)</td>
// 				    		<td>$t4 ($v->t4)</td>
// 				    		<td>$t5 ($v->t5)</td>
// 				    		<td>$t6 ($v->t6)</td>
// 				    		<td>$ketemu</td>
// 				    		</tr>
// 				    		";
// 			}
// 		}
		
// 	}
// 	echo"</table>";
// });

// Route::get('buat_user_opd', function () {
// 		$data = DB::table('data_opd')
// 	            ->join('opd', 'data_opd.id', '=', 'opd.id_instansi')
// 	            ->select('data_opd.*', 'opd.username')
// 	            ->get();

// 		echo"<table border=1 style='border-collapse:collapse;'>
// 			<tr>
// 				<td>No</td>
// 				<td>OPD</td>
// 				<td>Username</td>
// 				<td>Password</td>
// 			</tr>";
// 			$no=0;
// 		foreach ($data as $v) {
// 			if($v->id!=85){
// 				$no++;
				
// 				echo"
// 				<tr>
// 					<td>$no</td>
// 					<td>$v->nm_instansi</td>
// 					<td>$v->username</td>
// 					<td>123456</td>
// 				<tr/>
// 				";
// 			}
// 		}	
// });

// Route::get('sasaran', function () {
// 		$url_json = 'http://localhost/json-eplanning/sumbar_3_data_sasaran.json';
// 	 	$data_json = file_get_contents($url_json);
// 	 	$data = json_decode($data_json);
// 		foreach ($data as $v) {
// 			DB::table('sasaran_pembangunan')->insert([
// 				'id' => $v->id_sasaran,
// 				'id_tujuan' => $v->id_tujuan,
// 				'id_prioritas' => $v->id_prioritas,
// 				'nourut' => $v->nourut,
// 				'sasaran' => $v->sasaran,
// 				'id_status' => $v->id_status
// 				]);
// 		}
// });

Route::resource('apbd','MasterApbdController');
Route::get('persandingan-apbd-rkpd','MasterApbdController@persandingan');
Route::get('sdgs','MasterSdgsController@data_sdgs');
Route::get('capaian-rpjmd','RpjmdController@capaian_rpjmd');
Route::resource('akun-opd','AkunOpdController');
Route::resource('akun-adm','AkunAdmController');
Route::get('data-urusan2/',  'MasterController@urusan')->name('data-urusan2');
//Route::get('data-program/',  'MasterController@program')->name('data-program');
Route::get('data-kegiatan/',  'MasterController@kegiatan')->name('data-kegiatan');

//evaluasi renja
// Route::get('evaluasi-renja/',  'E55Controller@index')->name('evaluasi-renja');
// Route::get('carie55/', 'E55Controller@cari')->name('carie55');
// Route::get('input-erenja/{periode}/{id_instansi}/{idprgrm}/{kdkegunit}/{idindikatorkeg}', 'E55Controller@tambah')->name('tambah-erenja');
// Route::post('simpan-erenja/', 'E55Controller@simpan')->name('simpan-erenja');

// Auth::routes(['register' => false]);
// Route::get('data-sdgs/',  'MastersdgsController@index')->name('sdgs');

Route::group(['prefix' => 'admin_simonev'], function() {
    Route::auth(['register' => false, 'reset' => false]);
});
Route::get('/home', 'HomeController@index')->name('home');

Route::post('cekopd/',  'OpdController@masuk')->name('cekopd');
// Route::get('keluar/',  'OpdController@keluar')->name('keluar');
Route::get('/keluar', function () {
    return redirect('http://sakatoplan.sumbarprov.go.id/');
});

Route::get('opd/',  'OpdHomeController@index')->name('opd');
Route::get('log_user/',  'LogActivityController@index')->name('log_user');

// RENSTRA UPDATE MODULE
//Evaluasi Renstra
Route::resource('evaluasi_renstra','EvaluasiRenstraController');
Route::get('modal-evaluasi-renstra/{periode}/{id}/id_instansi/{id_instansi}/{unitkey}', 'EvaluasiRenstraController@show_evaluasi_renstra')->name('show_evaluasi_renstra');

// insert renja indikator perubahan
Route::get('insert_renstra_dr_renja', function () {
	$renja_per=DB::table('renja_per')->get();
	foreach ($renja_per as $r) {
		$t2019=$r->belanja_p_now+$r->belanja_bj_now+$r->belanja_m_now;
		$store=[
            'id' => $r->id,
            'id_instansi' => $r->id_instansi,
            'id_prioritas' => $r->id_prioritas,
            'periode' => $r->periode,
            'urusan_key' => $r->urusan_key,
            'kdkegunit' => $r->kdkegunit,
            'nmkegunit' => $r->nmkegunit,
            'sasaran' => $r->sasaran,
            'idprgrm' => $r->idprgrm,
            // 'data_awl' => $r->data_awl,
            'trp_4' => $t2019,
        ];

        // dd($store);
        // DB::table('m_renstra')->insert($store);
	}
});

Route::get('insert_renstra_indikator', function () {
	$renja_per=DB::table('renja_indikator_per')->get();
	foreach ($renja_per as $r) {
		if($r->kdjkk=="02"){
		$store=[
            'id' => $r->id,
            'id_renstra' => $r->id_renja,
            'tolokur' => $r->tolokur,
            'kdjkk' => $r->kdjkk,
        ];

        // dd($store);
        // DB::table('m_renstra_indikator')->insert($store);
		}
	}
});

Route::get('insert_renstra_indikator_det', function () {
	$renja_per=DB::table('renja_indikator_det')->get();
	foreach ($renja_per as $r) {
		$store=[
            'id' => $r->id,
            'id_kegindikator' => $r->id_kegindikator_per,
            'sat_det' => $r->sat_det,
            'target4_det' => $r->target_det_per,
        ];

        // dd($store);
        // DB::table('m_renstra_indikator_det')->insert($store);
	}
});
Route::get('insert_realisasi_renja', function () {
	$renja_per=DB::table('realisasi')->get();
	foreach ($renja_per as $r) {
		$store=[
            'id' => $r->id,
            'id_renstra' => $r->id_renja,
            'rpt4' => $r->rpt1+$r->rpt2+$r->rpt3+$r->rpt4,
            'periode_renstra' => $r->periode_renja,
            'id_instansi_renstra' => $r->id_instansi_renja,
            'kdkegunit_renstra' => $r->kdkegunit_renja,
        ];

        // dd($store);
        // DB::table('realisasi_renstra')->insert($store);
	}
});

Route::get('insert_realisasi_renja_k', function () {
	$renja_per=DB::table('realisasi_target')->get();
	foreach ($renja_per as $r) {
		$store=[
            'id' => $r->id,
            'id_target' => $r->id_target,
            'kt4' => $r->kt1+$r->kt2+$r->kt3+$r->kt4,
            'ket_keg' => $r->ket_keg,
            'fpenghambat_keg' => $r->fpenghambat_keg,
            'fpendorong_keg' => $r->fpendorong_keg,
        ];

        // dd($store);
        // DB::table('realisasi_renstra_target')->insert($store);
	}
});

Route::get('insert_realisasi_program', function () {
	$renja_per=DB::table('realisasi_tprog')->get();
	foreach ($renja_per as $r) {
		$store=[
            'id' => $r->id,
            'id_ind_prog' => $r->id_ind_prog,
            'p_t4' => $r->p_t1+$r->p_t2+$r->p_t3+$r->p_t4,
            'ket_prog' => $r->ket_prog,
            'fpenghambat_prog' => $r->fpenghambat_prog,
            'fpendorong_prog' => $r->fpendorong_prog,
        ];

        // dd($store);
        // DB::table('realisasi_renstra_tprog')->insert($store);
	}
});

// Route::get('renja_impor','RenjaController@impor');
// Route::get('renja_impor_indikator','RenjaController@impor_indikator');
// Route::get('renja_impor_indikator_det','RenjaController@impor_indikator_det');

Route::get('salin_nmkeg_renja2020', function () {
	$jml=0;
	$data=DB::table('renja')->get();
	foreach ($data as $v) {

		$cari2=DB::table('renstra_keg')->find($v->kdkegunit);
		if($cari2!=null){
			// DB::table('renja')->where('id',$v->id)->update(['nmkegunit' => $cari2->nmkegunit]);
		$jml++;		
		}else{
			echo $v->kdkegunit.'tidak ada <br>';
		}
	}
	echo $jml.' data diubah';
});

Route::get('opd_renja_total', function () {
	$jml=0;
	$data=DB::table('data_opd')->orderby('id','asc')->get();
	echo"
	<table border=1 style='border-collapse:collapse;'>
	<tr>
		<td>No</td>
		<td>ID</td>
		<td>OPD</td>
		<td>Pagu</td>
	</tr>
	";
	$tot=0;
	foreach ($data as $v) {
		$jml++;
		
		$query=DB::table('renja')->select(DB::raw('sum(belanja_p_now+belanja_bj_now+belanja_m_now)'))->where('renja.id_instansi', $v->id)->first();
		echo"<tr>
			<td>".$jml."</td>
			<td>".$v->id."</td>
			<td>".$v->nm_instansi."</td>
			<td>".number_format($query->sum,0)."</td>
		</tr>";
		$tot=$tot+$query->sum;		
	}

	echo "<tr><td></td><td></td><td></td><td><b>".number_format($tot,0).'</b></td></tr>';
});

//pecah target 1. spasi = 1 (tanpa . , ; - / dan)
Route::get('pecah_target', function () {
    $data = DB::table('renja_indikator')->get();
    echo"<table border=1 style='border-collapse:collapse;'>
    <tr>
    	<th>No</th>
    	<th>Id indikator</th>
    	<th>Tolokur</th>
    	<th>Satuan Hasil</th>
    	<th>Target Hasil</th>
    	<th>Target Sumber</th>
    </tr>
    ";
    $no=0;
    $hsl="";
    foreach ($data as $v) {
    	$matches = [];
    	$string = $v->target;
    	$sat="";
    	$trg="";
    	if (is_numeric($string)) // find only numbers and collect the first group of 4 numbers
    	{
    		// hanya number satuan = -
			// $no++;

			// 	$hsl=str_replace('.', '', $v->target);
			// 	DB::table('renja_indikator_det')->insert(
			// 	    [
			// 	    	'id_kegindikator' => $v->id,
			// 	     	'sat_det' => '-',
			// 	     	'target_det' => $hsl
			// 	     ]
			// 	);
			// echo"
		 //    		<tr>
		 //    		<td>$no</td>
		 //    		<td>$v->id</td>
		 //    		<td>$v->tolokur</td>
		 //    		<td>$hsl</td>
		 //    		<td>

		 //    		</td>
		 //    		<td>$v->target</td>
		 //    		</tr>
		 //    		";
		    
    	}else{
    		$result = substr_count($v->target, " ");
    		if($result=="1"){
    			// $no++;
    			// $sat=preg_replace("/[^a-zA-Z%\/]/", "", $v->target);
    			// $trg=preg_replace('/[^0-9\,.]/', '', $v->target);
    			// $trg=str_replace(',', '.', $trg);
    			// $trg=str_replace(' ', '', $trg);
    			// if($sat=="orang" or $sat=="Eksemplar" or $sat=="Kotak" or $sat=="Orang" or $sat=="buah" or $sat=="bibit" or $sat=="batang"){$trg=str_replace('.', '', $trg);}
    			// if($sat=="DI" or $sat=="Kab/Kota"){$trg=str_replace('.', '', $trg);}

    			// if($trg==""){$trg=1;}
    			// 	// DB::table('renja_indikator_det')->insert(
    			// 	//     [
    			// 	//     	'id_kegindikator' => $v->id,
    			// 	//      	'sat_det' => $sat,
    			// 	//      	'target_det' => $trg
    			// 	//      ]
    			// 	// );
    			// echo"
			    // 		<tr>
			    // 		<td>$no</td>
			    // 		<td>$v->id</td>
			    // 		<td>$v->tolokur</td>
			    // 		<td>$sat</td>
			    // 		<td>$trg</td>
			    // 		<td>$v->target</td>
			    // 		</tr>
			    // 		";
    		}elseif($result=="0"){
    			// $sat=preg_replace("/[^a-zA-Z%\/]/", "", $v->target);
    			// $trg=preg_replace('/[^0-9\,.]/', '', $v->target);
    			// if($sat=="%"){
    			// $no++;
    				// DB::table('renja_indikator_det')->insert(
    				//     [
    				//     	'id_kegindikator' => $v->id,
    				//      	'sat_det' => $sat,
    				//      	'target_det' => $trg
    				//      ]
    				// );
    			// echo"
			    // 		<tr>
			    // 		<td>$no</td>
			    // 		<td>$v->id</td>
			    // 		<td>$v->tolokur</td>
			    // 		<td>$sat</td>
			    // 		<td>$trg</td>
			    // 		<td>$v->target</td>
			    // 		</tr>
			    // 		";
			    // }

    			if($v->target=="-"){
	    			$no++;
	    			echo"
				    		<tr>
				    		<td>$no</td>
				    		<td>$v->id</td>
				    		<td>$v->tolokur</td>
				    		<td>$sat</td>
				    		<td>$trg</td>
				    		<td>$v->target</td>
				    		</tr>
				    		";

    			}
    		}else{

    			// $no++;
    			// echo"
			    // 		<tr>
			    // 		<td>$no</td>
			    // 		<td>$v->id</td>
			    // 		<td>$v->tolokur</td>
			    // 		<td>$sat</td>
			    // 		<td>$trg</td>
			    // 		<td>$v->target</td>
			    // 		</tr>
			    // 		";
    		}

		}

   	}
    echo"</table>";
});

Route::get('opd_akun_insert', function () {
	// $renja_per=DB::table('renja_indikator_per')->get();
	
	$jsonData_sakato = json_decode(file_get_contents('http://simonevdokrenda.sumbarprov.go.id/2021/api/opd_simonev_2021.json'));
	// $jsonData_sakato = json_decode(file_get_contents('http://simonevdokrenda.sumbarprov.go.id/2021/api/opd_akun.json'));
	foreach ($jsonData_sakato as $v) {
		// $store=[
  //           'id'=>$v->id,
		// 	'username'=>$v->username,
		// 	'email'=>$v->email,
		// 	'id_instansi'=>$v->id_instansi,
		// 	'email_verified_at'=>$v->email_verified_at,
		// 	'password'=>$v->password,
		// 	'remember_token'=>$v->remember_token,
		// 	'created_at'=>$v->created_at,
		// 	'updated_at'=>$v->updated_at,
		// 	'nip'=>$v->nip,
		// 	'nm_pegawai'=>$v->nm_pegawai,
		// 	'status'=>$v->status
  //       ];

		if($v->unit_key!=""){$unit_key=$v->unit_key;}else{$unit_key="tmp_".$v->id;}
		if($v->kdunit!=""){$kdunit=$v->kdunit;}else{$kdunit="kdunit".$v->id;}
		if($v->kdlevel!=""){$kdlevel=$v->kdlevel;}else{$kdlevel=0;}
		if($v->tipe!=""){$tipe=$v->tipe;}else{$tipe="D";}
		if($v->created_at!=""){$created_at=$v->created_at;}else{$created_at="2019-01-23 01:54:33";}
		if($v->updated_at!=""){$updated_at=$v->updated_at;}else{$updated_at="2019-01-23 01:54:33";}
        $store=[
            'id'=>$v->id,
			'unit_key'=>$unit_key,
			'kdunit'=>$kdunit,
			'kdlevel'=>$kdlevel,
			'tipe'=>$tipe,
			'nm_instansi'=>$v->nm_instansi,
			'nip'=>$v->nip,
			'kepala'=>$v->kepala,
			'singkatan'=>$v->singkatan,
			'akrounit'=>$v->akrounit,
			'telp'=>$v->telp,
			'alamat'=>$v->alamat,
			'created_at'=>$created_at,
			'updated_at'=>$updated_at,
			'pimpinan'=>$v->pimpinan,
			'non_urusan'=>$v->non_urusan
        ];

        // dd($store);
        // DB::table('opd')->insert($store);
        // DB::table('data_opd')->insert($store);
	}

});

Route::post('/sso_sakato', 'SsoSakatoController@index')->name('sso_sakato');

Route::get('update_idsakato', function () {
	$jsonData = json_decode(file_get_contents('http://simonevdokrenda.sumbarprov.go.id/2021/api/id_instansi_sakato.json'));
		// dd($jsonData);
		foreach ($jsonData as $v) {
			if($v->type=="table"){
				// dd($v->data);
				foreach ($v->data as $r) {
				// DB::table('data_opd')
	   //          ->where('id', $r->id_instansi)
	   //          ->update(['ID_INSTANSI_SAKATO' => $r->id]);
						
				}
			}
		}
});

Route::get('cek_nomenklatur', function () {
	$id_instansi="4";
	$arr=array();
	$r=DB::table('rkpd_subkeg')->where('idopd',$id_instansi)->get();
	foreach ($r as $v) {
		$cari_rkpd=DB::table('sub_kegiatan')->where('id',$v->idsubkeg)->first();
		if($cari_rkpd!=null){
		}else{
			$arr[]=[
				'idsubkeg'=>$v->idsubkeg,
				'pagu_awal'=>$v->pagu_awal,
				'pagu_perubahan'=>$v->pagu_perubahan,
			];
		}
	}
	dd($arr);
	// dd($r);
});

Route::get('jml_prog_keg_subkeg', function () {
	// $idopd=82;
	echo"<table border='1' style='border-collapse:collapse;'>
		<tr>
			<th>No</th>
			<th>OPD</th>
			<th>Program</th>
			<th>Kegiatan</th>
			<th>Sub Kegiatan</th>
		</tr>
	";
	$opd = DB::table('data_opd')->get();
	foreach ($opd as $key => $v) {
		$no=$key+1;

		$jml_prog=count(DB::select("select k.idprog from rkpd_subkeg s join rkpd_keg k on s.idkeg=k.idkeg where s.idopd='".$v->id."' group by k.idprog"));
		$jml_keg=count(DB::select("select idkeg from rkpd_subkeg where idopd='".$v->id."' group by idkeg"));
		$jml_subkeg=count(DB::table('rkpd_subkeg')->where('idopd',$v->id)->get());
		echo"
		<tr>
			<td>".$no."</td>
			<td>$v->nm_instansi</td>
			<td>$jml_prog</td>
			<td>$jml_keg</td>
			<td>$jml_subkeg</td>
		</tr>
		";
	}
	echo"</table>";
});

Route::get('restore_rkpd_per', function () {
	// $idopd=86;
/*
	DB::table('rkpd_prog')->where('idopd',$idopd)->delete();
	DB::table('rkpd_prog_ind')->where('idopd',$idopd)->delete();
	DB::table('rkpd_keg')->where('idopd',$idopd)->delete();
	DB::table('rkpd_keg_ind')->where('idopd',$idopd)->delete();
	DB::table('rkpd_subkeg')->where('idopd',$idopd)->delete();
	DB::table('rkpd_subkeg_ind')->where('idopd',$idopd)->delete();
	DB::table('renja_indikator_det')->where('id_instansi',$idopd)->delete();
*/	
});
Route::get('insert_rkpd_per', function () {
	// $renja_per=DB::table('renja_indikator_per')->get();
	
	// 4 Disdik
	// $jsonData = json_decode(file_get_contents('http://simonevdokrenda.sumbarprov.go.id/2021/api/rkpd_per_2021/4_disdik.json'));
	// $penunjang_urusan="1.01.01";

	// 6 DINKES
	// $jsonData = json_decode(file_get_contents('http://simonevdokrenda.sumbarprov.go.id/2021/api/rkpd_per_2021/6_dinkes.json'));
	// $penunjang_urusan="1.02.01";

	// 7 RSAM
	// $jsonData = json_decode(file_get_contents('http://simonevdokrenda.sumbarprov.go.id/2021/api/rkpd_per_2021/7_rsam.json'));
	// $penunjang_urusan="1.02.01";
	
	// 8 HBSAANIN
	// $jsonData = json_decode(file_get_contents('http://simonevdokrenda.sumbarprov.go.id/2021/api/rkpd_per_2021/8_hbsaanin.json'));
	// $penunjang_urusan="1.02.01";
	
	// 9 rsud_m_natsir
	// $jsonData = json_decode(file_get_contents('http://simonevdokrenda.sumbarprov.go.id/2021/api/rkpd_per_2021/9_rsud_m_natsir.json'));
	// $penunjang_urusan="1.02.01";
	
	// 10 rsud_pariaman
	// $jsonData = json_decode(file_get_contents('http://simonevdokrenda.sumbarprov.go.id/2021/api/rkpd_per_2021/10_rsud_pariaman.json'));
	// $penunjang_urusan="1.02.01";

	// 12_DINAS BINA MARGA, CIPTA KARYA DAN TATA RUANG
	// $jsonData = json_decode(file_get_contents('http://simonevdokrenda.sumbarprov.go.id/2021/api/rkpd_per_2021/12_DINASBINAMARGACIPTAKARYADANTATARUANG.json'));
	// $penunjang_urusan="1.03.01";

	// 13_DINASSUMBERDAYAAIRDANBINAKONSTRUKSI
	// $jsonData = json_decode(file_get_contents('http://simonevdokrenda.sumbarprov.go.id/2021/api/rkpd_per_2021/13_DINASSUMBERDAYAAIRDANBINAKONSTRUKSI.json'));
	// $penunjang_urusan="1.03.01";

	// 15_DINASPERUMAHANRAKYATKAWASANPERMUKIMANDANPERTANAHAN
	// $jsonData = json_decode(file_get_contents('http://simonevdokrenda.sumbarprov.go.id/2021/api/rkpd_per_2021/15_DINASPERUMAHANRAKYATKAWASANPERMUKIMANDANPERTANAHAN.json'));
	// $penunjang_urusan="1.04.01";

	// 17_SATUANPOLISIPAMONGPRAJA
	// $jsonData = json_decode(file_get_contents('http://simonevdokrenda.sumbarprov.go.id/2021/api/rkpd_per_2021/17_SATUANPOLISIPAMONGPRAJA.json'));
	// $penunjang_urusan="1.05.01";

	// 19_dinsos
	// $jsonData = json_decode(file_get_contents('http://simonevdokrenda.sumbarprov.go.id/2021/api/rkpd_per_2021/19_dinsos.json'));
	// $penunjang_urusan="1.06.01";
	
	// 22_nakertrans
	// $jsonData = json_decode(file_get_contents('http://simonevdokrenda.sumbarprov.go.id/2021/api/rkpd_per_2021/22_nakertrans.json'));
	// $penunjang_urusan="2.07.01";

	// 24_dp3ap2kb
	// $jsonData = json_decode(file_get_contents('http://simonevdokrenda.sumbarprov.go.id/2021/api/rkpd_per_2021/24_dp3ap2kb.json'));
	// $penunjang_urusan="2.08.01";

	// 26_dinas_pangan
	// $jsonData = json_decode(file_get_contents('http://simonevdokrenda.sumbarprov.go.id/2021/api/rkpd_per_2021/26_dinas_pangan.json'));
	// $penunjang_urusan="2.09.01";

	// 29_dinas_lingkungan_hidup
	// $jsonData = json_decode(file_get_contents('http://simonevdokrenda.sumbarprov.go.id/2021/api/rkpd_per_2021/29_dinas_lingkungan_hidup.json'));
	// $penunjang_urusan="2.11.01";
	
	// 32_dpmd
	// $jsonData = json_decode(file_get_contents('http://simonevdokrenda.sumbarprov.go.id/2021/api/rkpd_per_2021/32_dpmd.json'));
	// $penunjang_urusan="2.13.01";

	// 34_dukcapil
	// $jsonData = json_decode(file_get_contents('http://simonevdokrenda.sumbarprov.go.id/2021/api/rkpd_per_2021/34_dukcapil.json'));
	// $penunjang_urusan="2.12.01";

	// 36_dinas_perhubungan
	// $jsonData = json_decode(file_get_contents('http://simonevdokrenda.sumbarprov.go.id/2021/api/rkpd_per_2021/36_dinas_perhubungan.json'));
	// $penunjang_urusan="2.15.01";

	// 38_diskominfo
	// $jsonData = json_decode(file_get_contents('http://simonevdokrenda.sumbarprov.go.id/2021/api/rkpd_per_2021/38_diskominfo.json'));
	// $penunjang_urusan="2.16.01";

	// 40_diskop_umkm
	// $jsonData = json_decode(file_get_contents('http://simonevdokrenda.sumbarprov.go.id/2021/api/rkpd_per_2021/40_diskop_umkm.json'));
	// $penunjang_urusan="2.17.01";

	// 42_dpmptsp
	// $jsonData = json_decode(file_get_contents('http://simonevdokrenda.sumbarprov.go.id/2021/api/rkpd_per_2021/42_dpmptsp.json'));
	// $penunjang_urusan="2.18.01";

	// 44_dispora
	// $jsonData = json_decode(file_get_contents('http://simonevdokrenda.sumbarprov.go.id/2021/api/rkpd_per_2021/44_dispora.json'));
	// $penunjang_urusan="2.19.01";

	// 48_disbud
	// $jsonData = json_decode(file_get_contents('http://simonevdokrenda.sumbarprov.go.id/2021/api/rkpd_per_2021/48_disbud.json'));
	// $penunjang_urusan="2.22.01";

	// 51_disarsipdanpustaka
	// $jsonData = json_decode(file_get_contents('http://simonevdokrenda.sumbarprov.go.id/2021/api/rkpd_per_2021/51_disarsipdanpustaka.json'));
	// $penunjang_urusan="2.24.01";

	// 54_dkp
	// $jsonData = json_decode(file_get_contents('http://simonevdokrenda.sumbarprov.go.id/2021/api/rkpd_per_2021/54_dkp.json'));
	// $penunjang_urusan="3.25.01";

	// 56_dinas_pariwisata
	// $jsonData = json_decode(file_get_contents('http://simonevdokrenda.sumbarprov.go.id/2021/api/rkpd_per_2021/56_dinas_pariwisata.json'));
	// $penunjang_urusan="3.26.01";

	// 58_dinas_perkebunan
	// $jsonData = json_decode(file_get_contents('http://simonevdokrenda.sumbarprov.go.id/2021/api/rkpd_per_2021/58_dinas_perkebunan.json'));
	// $penunjang_urusan="3.27.01";
	
	// 59_dinas_peternakan
	// $jsonData = json_decode(file_get_contents('http://simonevdokrenda.sumbarprov.go.id/2021/api/rkpd_per_2021/59_dinas_peternakan.json'));
	// $penunjang_urusan="3.27.01";

	// 61_dishut
	// $jsonData = json_decode(file_get_contents('http://simonevdokrenda.sumbarprov.go.id/2021/api/rkpd_per_2021/61_dishut.json'));
	// $penunjang_urusan="3.28.01";

	// 63_dinas_esdm
	// $jsonData = json_decode(file_get_contents('http://simonevdokrenda.sumbarprov.go.id/2021/api/rkpd_per_2021/63_dinas_esdm.json'));
	// $penunjang_urusan="3.29.01";

	// 66_disperindag
	// $jsonData = json_decode(file_get_contents('http://simonevdokrenda.sumbarprov.go.id/2021/api/rkpd_per_2021/66_disperindag.json'));
	// $penunjang_urusan="3.30.01";

	// 70_inspektorat
	// $jsonData = json_decode(file_get_contents('http://simonevdokrenda.sumbarprov.go.id/2021/api/rkpd_per_2021/70_inspektorat.json'));
	// $penunjang_urusan="6.01.01";

	// 72_bappeda
	// $jsonData = json_decode(file_get_contents('http://simonevdokrenda.sumbarprov.go.id/2021/api/rkpd_per_2021/72_bappeda.json'));
	// $penunjang_urusan="5.01.01";

	// 74_bpkad
	// $jsonData = json_decode(file_get_contents('http://simonevdokrenda.sumbarprov.go.id/2021/api/rkpd_per_2021/74_bpkad.json'));
	// $penunjang_urusan="5.02.01";

	// 76_bkd
	// $jsonData = json_decode(file_get_contents('http://simonevdokrenda.sumbarprov.go.id/2021/api/rkpd_per_2021/76_bkd.json'));
	// $penunjang_urusan="5.03.01";

	// 78_bpsdm
	// $jsonData = json_decode(file_get_contents('http://simonevdokrenda.sumbarprov.go.id/2021/api/rkpd_per_2021/78_bpsdm.json'));
	// $penunjang_urusan="5.04.01";

	// 80_balitbang
	// $jsonData = json_decode(file_get_contents('http://simonevdokrenda.sumbarprov.go.id/2021/api/rkpd_per_2021/80_balitbang.json'));
	// $penunjang_urusan="5.05.01";

	// 82_badan_penghubung
	// $jsonData = json_decode(file_get_contents('http://simonevdokrenda.sumbarprov.go.id/2021/api/rkpd_per_2021/82_badan_penghubung.json'));
	// $penunjang_urusan="5.07.01";

	// 86_biro_pemerintahan
	// $jsonData = json_decode(file_get_contents('http://simonevdokrenda.sumbarprov.go.id/2021/api/rkpd_per_2021/86_biro_pemerintahan.json'));
	// $penunjang_urusan="4.01.01";

	// 87_biro_admpim
	// $jsonData = json_decode(file_get_contents('http://simonevdokrenda.sumbarprov.go.id/2021/api/rkpd_per_2021/87_biro_admpim.json'));
	// $penunjang_urusan="4.01.01";

	// 88_biro_hukum
	// $jsonData = json_decode(file_get_contents('http://simonevdokrenda.sumbarprov.go.id/2021/api/rkpd_per_2021/88_biro_hukum.json'));
	// $penunjang_urusan="4.01.01";

	// 89_biro_perekonomian
	// $jsonData = json_decode(file_get_contents('http://simonevdokrenda.sumbarprov.go.id/2021/api/rkpd_per_2021/89_biro_perekonomian.json'));
	// $penunjang_urusan="4.01.01";

	// 90_biro_kesra
	// $jsonData = json_decode(file_get_contents('http://simonevdokrenda.sumbarprov.go.id/2021/api/rkpd_per_2021/90_biro_kesra.json'));
	// $penunjang_urusan="4.01.01";

	// 91_biro_admpemb
	// $jsonData = json_decode(file_get_contents('http://simonevdokrenda.sumbarprov.go.id/2021/api/rkpd_per_2021/91_biro_admpemb.json'));
	// $penunjang_urusan="4.01.01";

	// 92_biro_organisasi
	// $jsonData = json_decode(file_get_contents('http://simonevdokrenda.sumbarprov.go.id/2021/api/rkpd_per_2021/92_biro_organisasi.json'));
	// $penunjang_urusan="4.01.01";

	// 93_biro_umum
	// $jsonData = json_decode(file_get_contents('http://simonevdokrenda.sumbarprov.go.id/2021/api/rkpd_per_2021/93_biro_umum.json'));
	// $penunjang_urusan="4.01.01";
	
	// 94_biro_pengadaan_barangdanjasa
	// $jsonData = json_decode(file_get_contents('http://simonevdokrenda.sumbarprov.go.id/2021/api/rkpd_per_2021/94_biro_pengadaan_barangdanjasa.json'));
	// $penunjang_urusan="4.01.01";

	// 96_set_dprd
	// $jsonData = json_decode(file_get_contents('http://simonevdokrenda.sumbarprov.go.id/2021/api/rkpd_per_2021/96_set_dprd.json'));
	// $penunjang_urusan="4.02.01";

	// 99_kesbangpol
	// $jsonData = json_decode(file_get_contents('http://simonevdokrenda.sumbarprov.go.id/2021/api/rkpd_per_2021/99_kesbangpol.json'));
	// $penunjang_urusan="8.01.01";

	// 100_bpbd
	// $jsonData = json_decode(file_get_contents('http://simonevdokrenda.sumbarprov.go.id/2021/api/rkpd_per_2021/100_bpbd.json'));
	// $penunjang_urusan="1.05.01";

	// 163_bapenda
	// $jsonData = json_decode(file_get_contents('http://simonevdokrenda.sumbarprov.go.id/2021/api/rkpd_per_2021/163_bapenda.json'));
	// $penunjang_urusan="5.02.01";

	// $jsonData = json_decode(file_get_contents('http://simonevdokrenda.sumbarprov.go.id/2021/api/rkpd_per_2021/rsam_7.json'));
	foreach ($jsonData as $v) {
		$o_urusan="";
		$o_burusan="";
		$o_prog="";
		$o_keg="";
		$o_subkeg="";
		
		$o_kode="";
		$o_indikator="";

		$arr_urusan=array('X.XX');
		if($v->type=="table"){
			// dd($v->data);
			foreach ($v->data as $r) {
				$urusan=$r->urusan;
				$burusan=$r->burusan;
				$prog=$r->prog;
				$keg=$r->keg;
				$subkeg=$r->subkeg;

				$idopd=$r->idopd;
			//// INSERT
				// urusan
				if($urusan!="" and $burusan=="" and $prog=="" and $keg=="" and $subkeg==""){
					$kode=$urusan;
					$o_kode=$urusan;
				}
				// burusan
				if($urusan!="" and $burusan!="" and $prog=="" and $keg=="" and $subkeg==""){
					$kode=$urusan.".".$burusan;
					$o_kode=$urusan.".".$burusan;
					$arr_urusan[]=$kode;
				}
				// program
				if($urusan!="" and $burusan!="" and $prog!="" and $keg=="" and $subkeg==""){
					$kode=$urusan.".".$burusan.".".$prog;
					$o_kode=$urusan.".".$burusan.".".$prog;
				}
				// kegiatan
				if($urusan!="" and $burusan!="" and $prog!="" and $keg!="" and $subkeg==""){
					$kode=$urusan.".".$burusan.".".$prog.".".$keg;
					$o_kode=$urusan.".".$burusan.".".$prog.".".$keg;
				}
				// sub kegiatan
				if($urusan!="" and $burusan!="" and $prog!="" and $keg!="" and $subkeg!=""){
					$kode=$urusan.".".$burusan.".".$prog.".".$keg.".".$subkeg;
					$o_kode=$urusan.".".$burusan.".".$prog.".".$keg.".".$subkeg;
				}
				$kode_kosong=0;
				// kode kosong
				if($urusan=="" and $burusan=="" and $prog=="" and $keg=="" and $subkeg==""){
					$kode=$o_kode;
					$kode_kosong=1;
				}

				if(substr($kode,0,7)==$penunjang_urusan){
				// if($r->nomenklatur=="PROGRAM PENUNJANG URUSAN PEMERINTAHAN DAERAH"){
					// $kode=str_replace("1.02.01","X.XX.01",$kode);
					$kode="X.XX.01".substr($kode,7,100);
				}else{

				}

				if($kode_kosong=="0"){
					// insert
					$pjg_kode=strlen($kode);
					if($pjg_kode<=1){
						//urusan
					}elseif($pjg_kode<=4){
						//burusan
					}elseif($pjg_kode<=7){
						//program
				        $cari_master_program=DB::table('program')->where('id',$kode)->first();
				        if($cari_master_program!=null){
				        }else{
				        	// insert
		        	        $storem=[
		        	            'id'=>$kode,
		        	            'nmprgrm'=>$r->nomenklatur."     ",
		        	            'nomor'=>$kode,
		        				'id_status'=>1,
		        				'non_urusan'=>0,
		        			];
		        	        DB::table('program')->insert($storem);
				        }

				        $cari_rkpd=DB::table('rkpd_prog')->where('idopd',$r->idopd)->where('idprog',$kode)->first();
				        if($cari_rkpd!=null){
				        	// update
				        	DB::table('rkpd_prog')->where('idopd',$r->idopd)->where('idprog',$kode)->update(
				        		[
	        			            'idprog'=>$kode,
	        						'prog_awal'=>0,
	        						'prog_perubahan'=>1,
	        						'idopd'=>$r->idopd,
	        						'periode'=>2021
				        		]
				        	);
				        }else{
				        	// insert
		        	        $store=[
		        	            'idprog'=>$kode,
		        				'prog_awal'=>0,
		        				'prog_perubahan'=>1,
		        				'idopd'=>$r->idopd,
		        				'periode'=>2021,
		        				
		        	        ];
		        	        DB::table('rkpd_prog')->insert($store);
				        }

				        // insert indikator
				        $cari_rkpd_ind=DB::table('rkpd_prog_ind')->where('idopd',$r->idopd)->where('idprog',$kode)->where('indikator_perubahan',$r->indikator)->first();
				        if($cari_rkpd_ind!=null){
				        	DB::table('rkpd_prog_ind')->where('idopd',$r->idopd)->where('idprog',$kode)->where('indikator_perubahan',$r->indikator)->update(
				        		[
	        			            'idprog'=>$kode,
	        						'prog_ind_awal'=>0,
	        						'prog_ind_perubahan'=>1,
	        						'indikator_perubahan'=>$r->indikator,
	        						'raw_sat_perubahan'=>$r->Menjadi,
	        						'sat_perubahan'=>str_replace('?',' ',str_replace('[?]',' ',$r->Satuan)),
	        						'target_perubahan'=>str_replace('?',' ',str_replace('[?]',' ',$r->Target)),
	        						'idopd'=>$r->idopd,
	        						'periode'=>2021
				        		]
				        	);
				        }else{
		        	        $store=[
		        	            'idprog'=>$kode,
        						'prog_ind_awal'=>0,
        						'prog_ind_perubahan'=>1,
        						'indikator_perubahan'=>$r->indikator,
        						'raw_sat_perubahan'=>$r->Menjadi,
        						'sat_perubahan'=>str_replace('?',' ',str_replace('[?]',' ',$r->Satuan)),
        						'target_perubahan'=>str_replace('?',' ',str_replace('[?]',' ',$r->Target)),
        						'idopd'=>$r->idopd,
        						'periode'=>2021
		        			];
		        	        DB::table('rkpd_prog_ind')->insert($store);
				        }
				        // dd($store);
					}elseif($pjg_kode<=12){
				        $cari_master_program=DB::table('renstra_keg')->where('id',$kode)->first();
				        if($cari_master_program!=null){
				        }else{
				        	// insert
		        	        $storem=[
		        	            'id'=>$kode,
		        	            'nmkegunit'=>$r->nomenklatur."     ",
		        	            'idprgrm'=>substr($kode, 0,7),
		        				'id_status'=>1,
		        			];
		        	        DB::table('renstra_keg')->insert($storem);
				        }
						//kegiatan
        			        $cari_rkpd=DB::table('rkpd_keg')->where('idopd',$r->idopd)->where('idkeg',$kode)->first();
        			        if($cari_rkpd!=null){
        			        	// update
        			        	DB::table('rkpd_keg')->where('idopd',$r->idopd)->where('idkeg',$kode)->update(
        			        		[
				                        'idkeg'=>$kode,
				                        'idprog'=>substr($kode,0,7),
				            			'keg_awal'=>0,
				            			'keg_perubahan'=>1,
				            			'idopd'=>$r->idopd,
				            			'periode'=>2021
        			        		]
        			        	);
        			        }else{
        			        	// insert
	        	                $store=[
	        	                    'idkeg'=>$kode,
	        	                    'idprog'=>substr($kode,0,7),
	        	        			'keg_awal'=>0,
	        	        			'keg_perubahan'=>1,
	        	        			'idopd'=>$r->idopd,
	        	        			'periode'=>2021,
	        	        		];
        	        	        DB::table('rkpd_keg')->insert($store);
        			        }

        			        // insert indikator
    				        $cari_rkpd_ind=DB::table('rkpd_keg_ind')->where('idopd',$r->idopd)->where('idkeg',$kode)->where('indikator_perubahan',$r->indikator)->first();
    				        if($cari_rkpd_ind!=null){
    				        	DB::table('rkpd_keg_ind')->where('idopd',$r->idopd)->where('idkeg',$kode)->where('indikator_perubahan',$r->indikator)->update(
    				        		[
    	        			            'idkeg'=>$kode,
    	        						'keg_ind_awal'=>0,
    	        						'keg_ind_perubahan'=>1,
    	        						'indikator_perubahan'=>$r->indikator,
    	        						'raw_sat_perubahan'=>$r->Menjadi,
    	        						'sat_perubahan'=>str_replace('?',' ',str_replace('[?]',' ',$r->Satuan)),
    	        						'target_perubahan'=>str_replace('?',' ',str_replace('[?]',' ',$r->Target)),
    	        						'idopd'=>$r->idopd,
    	        						'periode'=>2021
    				        		]
    				        	);
    				        }else{
    		        	        $store=[
    		        	            'idkeg'=>$kode,
            						'keg_ind_awal'=>0,
            						'keg_ind_perubahan'=>1,
            						'indikator_perubahan'=>$r->indikator,
            						'raw_sat_perubahan'=>$r->Menjadi,
            						'sat_perubahan'=>str_replace('?',' ',str_replace('[?]',' ',$r->Satuan)),
            						'target_perubahan'=>str_replace('?',' ',str_replace('[?]',' ',$r->Target)),
            						'idopd'=>$r->idopd,
            						'periode'=>2021
    		        			];
    		        	        DB::table('rkpd_keg_ind')->insert($store);
    				        }
        			    // dd($store);
					}else{
				        $cari_master_program=DB::table('sub_kegiatan')->where('id',$kode)->first();
				        if($cari_master_program!=null){
				        }else{
				        	// insert
		        	        $storem=[
		        	            'id'=>$kode,
		        	            'nmsub_keg'=>$r->nomenklatur."     ",
		        	            'kdkegunit'=>substr($kode, 0,12),
		        				'id_status'=>1,
		        			];
		        	        DB::table('sub_kegiatan')->insert($storem);
				        }
						// subkegiatan
    			        $cari_rkpd=DB::table('rkpd_subkeg')->where('idopd',$r->idopd)->where('idsubkeg',$kode)->first();
    			        if($cari_rkpd!=null){
    			        	// update
    			        	DB::table('rkpd_subkeg')->where('idopd',$r->idopd)->where('idsubkeg',$kode)->update(
    			        		[
                                    'idsubkeg'=>$kode,
                                    'idkeg'=>substr($kode,0,12),
                        			'subkeg_awal'=>0,
                        			'subkeg_perubahan'=>1,
                        			'idopd'=>$r->idopd,
                        			'periode'=>2021,
                        			'pagu_awal'=>$cari_rkpd->pagu_awal+str_replace(",","",$r->RKPD2021),
                        			'pagu_perubahan'=>$cari_rkpd->pagu_perubahan+str_replace(",","",$r->RKPD2021Perubahan),
                        			'lokasi'=>$r->Lokasi,
                        			'sumber_dana'=>$r->SumberDana,
                        			'pn'=>$r->Nasional,
                        			'pd'=>$r->Daerah
    			        		]
    			        	);
    			        }else{
    			        	// insert
	                        $store=[
	                            'idsubkeg'=>$kode,
	                            'idkeg'=>substr($kode,0,12),
	                			'subkeg_awal'=>0,
	                			'subkeg_perubahan'=>1,
	                			'idopd'=>$r->idopd,
	                			'periode'=>2021,
	                			'pagu_awal'=>str_replace(",","",$r->RKPD2021),
	                			'pagu_perubahan'=>str_replace(",","",$r->RKPD2021Perubahan),
	                			'lokasi'=>$r->Lokasi,
	                			'sumber_dana'=>$r->SumberDana,
	                			'pn'=>$r->Nasional,
	                			'pd'=>$r->Daerah,
	                		];
    	        	        DB::table('rkpd_subkeg')->insert($store);
    			        }

    			        // insert indikator
    			        $cari_rkpd_ind=DB::table('rkpd_subkeg_ind')->where('idopd',$r->idopd)->where('idsubkeg',$kode)->where('indikator_perubahan',$r->indikator)->first();
				        if($cari_rkpd_ind!=null){
				        	DB::table('rkpd_subkeg_ind')->where('idopd',$r->idopd)->where('idsubkeg',$kode)->where('indikator_perubahan',$r->indikator)->update(
				        		[
	        			            'idsubkeg'=>$kode,
	        						'subkeg_ind_awal'=>0,
	        						'subkeg_ind_perubahan'=>1,
	        						'indikator_perubahan'=>$r->indikator,
	        						'raw_sat_perubahan'=>$r->Menjadi,
        							'sat_perubahan'=>str_replace('?',' ',str_replace('[?]',' ',$r->Satuan)),
	        						'target_perubahan'=>str_replace('?',' ',str_replace('[?]',' ',$r->Target)),
	        						'idopd'=>$r->idopd,
	        						'periode'=>2021
				        		]
				        	);

				        	$o_indikator=$r->indikator;
				        }else{
		        	        $store=[
		        	            'idsubkeg'=>$kode,
        						'subkeg_ind_awal'=>0,
        						'subkeg_ind_perubahan'=>1,
        						'indikator_perubahan'=>$r->indikator,
        						'raw_sat_perubahan'=>$r->Menjadi,
        						'sat_perubahan'=>str_replace('?',' ',str_replace('[?]',' ',$r->Satuan)),
        						'target_perubahan'=>str_replace('?',' ',str_replace('[?]',' ',$r->Target)),
        						'idopd'=>$r->idopd,
        						'periode'=>2021
		        			];
		        	        DB::table('rkpd_subkeg_ind')->insert($store);

		        	        $o_indikator=$r->indikator;
				        }

    			        // insert indikator det
    			        $cari_rkpd_ind_id=DB::table('rkpd_subkeg_ind')->where('idopd',$r->idopd)->where('idsubkeg',$kode)->where('indikator_perubahan',$r->indikator)->first();
    			        $cari_rkpd_ind_det=DB::table('renja_indikator_det')->where('id_instansi',$r->idopd)->where('kdkegunit',$kode)->where('sat_det',str_replace('?',' ',str_replace('[?]',' ',$r->Satuan)))->where('rkpd_subkeg_ind.indikator_perubahan',$r->indikator)
    			        ->join('rkpd_subkeg_ind', 'renja_indikator_det.id_kegindikator_per', '=', 'rkpd_subkeg_ind.id')
    			        ->first();
				        if($cari_rkpd_ind_det!=null){
				        	DB::table('renja_indikator_det')->where('id_kegindikator_per',$cari_rkpd_ind_det->id)->update(
				        		[
	        			            'kdkegunit'=>$kode,
	        						'id_kegindikator'=>0,
	        						'id_kegindikator_per'=>$cari_rkpd_ind_id->id,
	        						'sat_det'=>str_replace('?',' ',str_replace('[?]',' ',$r->Satuan)),
	        						'target_det_per'=>str_replace('?',' ',str_replace('[?]',' ',$r->Target)),
	        						'id_instansi'=>$r->idopd,
	        						'periode'=>2021
				        		]
				        	);
				        }else{
		        	        $store=[
    	                        'kdkegunit'=>$kode,
        						'id_kegindikator'=>0,
    	            			'id_kegindikator_per'=>$cari_rkpd_ind_id->id,
    	            			'sat_det'=>str_replace('?',' ',str_replace('[?]',' ',$r->Satuan)),
    	            			'target_det_per'=>str_replace('?',' ',str_replace('[?]',' ',$r->Target)),
    	            			'id_instansi'=>$r->idopd,
    	            			'periode'=>2021
		        			];
		        	        DB::table('renja_indikator_det')->insert($store);
				        }
						// dd($store);
					}
				}else{
				// insert indikator kosong kode

					// insert
					$pjg_kode=strlen($kode);
					if($pjg_kode<=1){
						//urusan
					}elseif($pjg_kode<=4){
						//burusan
					}elseif($pjg_kode<=7){
						//program
				        
				        // insert indikator
				        $cari_rkpd_ind=DB::table('rkpd_prog_ind')->where('idopd',$r->idopd)->where('idprog',$kode)->where('indikator_perubahan',$r->indikator)->first();
				        if($cari_rkpd_ind!=null){
				        	DB::table('rkpd_prog_ind')->where('idopd',$r->idopd)->where('idprog',$kode)->where('indikator_perubahan',$r->indikator)->update(
				        		[
	        			            'idprog'=>$kode,
	        						'prog_ind_awal'=>0,
	        						'prog_ind_perubahan'=>1,
	        						'indikator_perubahan'=>$r->indikator,
	        						'raw_sat_perubahan'=>$r->Menjadi,
	        						'sat_perubahan'=>str_replace('?',' ',str_replace('[?]',' ',$r->Satuan)),
	        						'target_perubahan'=>str_replace('?',' ',str_replace('[?]',' ',$r->Target)),
	        						'idopd'=>$r->idopd,
	        						'periode'=>2021
				        		]
				        	);
				        }else{
		        	        $store=[
		        	            'idprog'=>$kode,
        						'prog_ind_awal'=>0,
        						'prog_ind_perubahan'=>1,
        						'indikator_perubahan'=>$r->indikator,
        						'raw_sat_perubahan'=>$r->Menjadi,
        						'sat_perubahan'=>str_replace('?',' ',str_replace('[?]',' ',$r->Satuan)),
        						'target_perubahan'=>str_replace('?',' ',str_replace('[?]',' ',$r->Target)),
        						'idopd'=>$r->idopd,
        						'periode'=>2021
		        			];
		        	        DB::table('rkpd_prog_ind')->insert($store);
				        }
				        // dd($store);
					}elseif($pjg_kode<=12){
						//kegiatan
        			       // insert indikator
    				        $cari_rkpd_ind=DB::table('rkpd_keg_ind')->where('idopd',$r->idopd)->where('idkeg',$kode)->where('indikator_perubahan',$r->indikator)->first();
    				        if($cari_rkpd_ind!=null){
    				        	DB::table('rkpd_keg_ind')->where('idopd',$r->idopd)->where('idkeg',$kode)->where('indikator_perubahan',$r->indikator)->update(
    				        		[
    	        			            'idkeg'=>$kode,
    	        						'keg_ind_awal'=>0,
    	        						'keg_ind_perubahan'=>1,
    	        						'indikator_perubahan'=>$r->indikator,
    	        						'raw_sat_perubahan'=>$r->Menjadi,
    	        						'sat_perubahan'=>str_replace('?',' ',str_replace('[?]',' ',$r->Satuan)),
    	        						'target_perubahan'=>str_replace('?',' ',str_replace('[?]',' ',$r->Target)),
    	        						'idopd'=>$r->idopd,
    	        						'periode'=>2021
    				        		]
    				        	);
    				        }else{
    		        	        $store=[
    		        	            'idkeg'=>$kode,
            						'keg_ind_awal'=>0,
            						'keg_ind_perubahan'=>1,
            						'indikator_perubahan'=>$r->indikator,
            						'raw_sat_perubahan'=>$r->Menjadi,
            						'sat_perubahan'=>str_replace('?',' ',str_replace('[?]',' ',$r->Satuan)),
            						'target_perubahan'=>str_replace('?',' ',str_replace('[?]',' ',$r->Target)),
            						'idopd'=>$r->idopd,
            						'periode'=>2021
    		        			];
    		        	        DB::table('rkpd_keg_ind')->insert($store);
    				        }
        			    // dd($store);
					}else{
						// subkegiatan
    			        // insert indikator
    			        $cari_rkpd_ind=DB::table('rkpd_subkeg_ind')->where('idopd',$r->idopd)->where('idsubkeg',$kode)->where('indikator_perubahan',$r->indikator)->first();
				        if($cari_rkpd_ind!=null){
				        	DB::table('rkpd_subkeg_ind')->where('idopd',$r->idopd)->where('idsubkeg',$kode)->where('indikator_perubahan',$r->indikator)->update(
				        		[
	        			            'idsubkeg'=>$kode,
	        						'subkeg_ind_awal'=>0,
	        						'subkeg_ind_perubahan'=>1,
	        						'indikator_perubahan'=>$r->indikator,
	        						'raw_sat_perubahan'=>$r->Menjadi,
        							'sat_perubahan'=>str_replace('?',' ',str_replace('[?]',' ',$r->Satuan)),
	        						'target_perubahan'=>str_replace('?',' ',str_replace('[?]',' ',$r->Target)),
	        						'idopd'=>$r->idopd,
	        						'periode'=>2021
				        		]
				        	);

				        	$o_indikator=$r->indikator;
				        }else{
		        	        $store=[
		        	            'idsubkeg'=>$kode,
        						'subkeg_ind_awal'=>0,
        						'subkeg_ind_perubahan'=>1,
        						'indikator_perubahan'=>$r->indikator,
        						'raw_sat_perubahan'=>$r->Menjadi,
        						'sat_perubahan'=>str_replace('?',' ',str_replace('[?]',' ',$r->Satuan)),
        						'target_perubahan'=>str_replace('?',' ',str_replace('[?]',' ',$r->Target)),
        						'idopd'=>$r->idopd,
        						'periode'=>2021
		        			];
		        	        DB::table('rkpd_subkeg_ind')->insert($store);
		        	        $o_indikator=$r->indikator;
				        }

    			        // insert indikator det
    			        if($r->indikator==""){
    			        	$indikator=$o_indikator;
    			        }else{
    			        	$indikator=$r->indikator;
    			        	$o_indikator=$r->indikator;
    			        }
    			        if($r->Satuan!="#VALUE!" and $r->Target!="#VALUE!"){

    			        $cari_rkpd_ind_id=DB::table('rkpd_subkeg_ind')->where('idopd',$r->idopd)->where('idsubkeg',$kode)->where('indikator_perubahan',$indikator)->first();
    			        $cari_rkpd_ind_det=DB::table('renja_indikator_det')->where('id_instansi',$r->idopd)->where('kdkegunit',$kode)->where('sat_det',str_replace('?',' ',str_replace('[?]',' ',$r->Satuan)))->where('rkpd_subkeg_ind.indikator_perubahan',$indikator)
    			        ->join('rkpd_subkeg_ind', 'renja_indikator_det.id_kegindikator_per', '=', 'rkpd_subkeg_ind.id')
    			        ->first();
				        if($cari_rkpd_ind_det!=null){
				        	DB::table('renja_indikator_det')->where('id_kegindikator_per',$cari_rkpd_ind_det->id)->update(
				        		[
	        			            'kdkegunit'=>$kode,
	        						'id_kegindikator'=>0,
	        						'id_kegindikator_per'=>$cari_rkpd_ind_id->id,
	        						'sat_det'=>str_replace('?',' ',str_replace('[?]',' ',$r->Satuan)),
	        						'target_det_per'=>str_replace('?',' ',str_replace('[?]',' ',$r->Target)),
	        						'id_instansi'=>$r->idopd,
	        						'periode'=>2021
				        		]
				        	);
				        }else{
		        	        $store=[
    	                        'kdkegunit'=>$kode,
        						'id_kegindikator'=>0,
    	            			'id_kegindikator_per'=>$cari_rkpd_ind_id->id,
    	            			'sat_det'=>str_replace('?',' ',str_replace('[?]',' ',$r->Satuan)),
    	            			'target_det_per'=>str_replace('?',' ',str_replace('[?]',' ',$r->Target)),
    	            			'id_instansi'=>$r->idopd,
    	            			'periode'=>2021
		        			];
		        	        DB::table('renja_indikator_det')->insert($store);
				        }

				        }

						// dd($store);
					}

				}
			}
		}
	}

	// echo implode(',', (array_unique($arr_urusan)));
	$arr_urusan= implode(',', (array_unique($arr_urusan)));
	$cari2=DB::table('urusan_opd')->where('id_instansi',$idopd)->first();
	if($cari2!=null){
		// update
		DB::table('urusan_opd')->where('id_instansi',$cari2->id_instansi)->update(['arr_urusan' => $arr_urusan]);
	}else{
		// insert
        $store=[
            'id_instansi'=>$idopd,
            'arr_urusan' => $arr_urusan,
			'th_awal'=>2019,
			'th_akhir'=>2021,
		];

		DB::table('urusan_opd')->insert($store);
	}
});

Route::get('update_nmnomenklatur', function () {
	// $renja_per=DB::table('renja_indikator_per')->get();
	
	// 4 Disdik
	// $jsonData = json_decode(file_get_contents('http://simonevdokrenda.sumbarprov.go.id/2021/api/rkpd_per_2021/4_disdik.json'));
	// $penunjang_urusan="1.01.01";

	// 6 DINKES
	// $jsonData = json_decode(file_get_contents('http://simonevdokrenda.sumbarprov.go.id/2021/api/rkpd_per_2021/6_dinkes.json'));
	// $penunjang_urusan="1.02.01";

	// 7 RSAM
	// $jsonData = json_decode(file_get_contents('http://simonevdokrenda.sumbarprov.go.id/2021/api/rkpd_per_2021/7_rsam.json'));
	// $penunjang_urusan="1.02.01";
	
	// 8 HBSAANIN
	// $jsonData = json_decode(file_get_contents('http://simonevdokrenda.sumbarprov.go.id/2021/api/rkpd_per_2021/8_hbsaanin.json'));
	// $penunjang_urusan="1.02.01";
	
	// 9 rsud_m_natsir
	// $jsonData = json_decode(file_get_contents('http://simonevdokrenda.sumbarprov.go.id/2021/api/rkpd_per_2021/9_rsud_m_natsir.json'));
	// $penunjang_urusan="1.02.01";
	
	// 10 rsud_pariaman
	// $jsonData = json_decode(file_get_contents('http://simonevdokrenda.sumbarprov.go.id/2021/api/rkpd_per_2021/10_rsud_pariaman.json'));
	// $penunjang_urusan="1.02.01";

	// 12_DINAS BINA MARGA, CIPTA KARYA DAN TATA RUANG
	// $jsonData = json_decode(file_get_contents('http://simonevdokrenda.sumbarprov.go.id/2021/api/rkpd_per_2021/12_DINASBINAMARGACIPTAKARYADANTATARUANG.json'));
	// $penunjang_urusan="1.03.01";

	// 13_DINASSUMBERDAYAAIRDANBINAKONSTRUKSI
	// $jsonData = json_decode(file_get_contents('http://simonevdokrenda.sumbarprov.go.id/2021/api/rkpd_per_2021/13_DINASSUMBERDAYAAIRDANBINAKONSTRUKSI.json'));
	// $penunjang_urusan="1.03.01";

	// 15_DINASPERUMAHANRAKYATKAWASANPERMUKIMANDANPERTANAHAN
	// $jsonData = json_decode(file_get_contents('http://simonevdokrenda.sumbarprov.go.id/2021/api/rkpd_per_2021/15_DINASPERUMAHANRAKYATKAWASANPERMUKIMANDANPERTANAHAN.json'));
	// $penunjang_urusan="1.04.01";

	// 17_SATUANPOLISIPAMONGPRAJA
	// $jsonData = json_decode(file_get_contents('http://simonevdokrenda.sumbarprov.go.id/2021/api/rkpd_per_2021/17_SATUANPOLISIPAMONGPRAJA.json'));
	// $penunjang_urusan="1.05.01";

	// 19_dinsos
	// $jsonData = json_decode(file_get_contents('http://simonevdokrenda.sumbarprov.go.id/2021/api/rkpd_per_2021/19_dinsos.json'));
	// $penunjang_urusan="1.06.01";
	
	// 22_nakertrans
	// $jsonData = json_decode(file_get_contents('http://simonevdokrenda.sumbarprov.go.id/2021/api/rkpd_per_2021/22_nakertrans.json'));
	// $penunjang_urusan="2.07.01";

	// 24_dp3ap2kb
	// $jsonData = json_decode(file_get_contents('http://simonevdokrenda.sumbarprov.go.id/2021/api/rkpd_per_2021/24_dp3ap2kb.json'));
	// $penunjang_urusan="2.08.01";

	// 26_dinas_pangan
	// $jsonData = json_decode(file_get_contents('http://simonevdokrenda.sumbarprov.go.id/2021/api/rkpd_per_2021/26_dinas_pangan.json'));
	// $penunjang_urusan="2.09.01";

	// 29_dinas_lingkungan_hidup
	// $jsonData = json_decode(file_get_contents('http://simonevdokrenda.sumbarprov.go.id/2021/api/rkpd_per_2021/29_dinas_lingkungan_hidup.json'));
	// $penunjang_urusan="2.11.01";
	
	// 32_dpmd
	// $jsonData = json_decode(file_get_contents('http://simonevdokrenda.sumbarprov.go.id/2021/api/rkpd_per_2021/32_dpmd.json'));
	// $penunjang_urusan="2.13.01";

	// 34_dukcapil
	// $jsonData = json_decode(file_get_contents('http://simonevdokrenda.sumbarprov.go.id/2021/api/rkpd_per_2021/34_dukcapil.json'));
	// $penunjang_urusan="2.12.01";

	// 36_dinas_perhubungan
	// $jsonData = json_decode(file_get_contents('http://simonevdokrenda.sumbarprov.go.id/2021/api/rkpd_per_2021/36_dinas_perhubungan.json'));
	// $penunjang_urusan="2.15.01";

	// 38_diskominfo
	// $jsonData = json_decode(file_get_contents('http://simonevdokrenda.sumbarprov.go.id/2021/api/rkpd_per_2021/38_diskominfo.json'));
	// $penunjang_urusan="2.16.01";

	// 40_diskop_umkm
	// $jsonData = json_decode(file_get_contents('http://simonevdokrenda.sumbarprov.go.id/2021/api/rkpd_per_2021/40_diskop_umkm.json'));
	// $penunjang_urusan="2.17.01";

	// 42_dpmptsp
	// $jsonData = json_decode(file_get_contents('http://simonevdokrenda.sumbarprov.go.id/2021/api/rkpd_per_2021/42_dpmptsp.json'));
	// $penunjang_urusan="2.18.01";

	// 44_dispora
	// $jsonData = json_decode(file_get_contents('http://simonevdokrenda.sumbarprov.go.id/2021/api/rkpd_per_2021/44_dispora.json'));
	// $penunjang_urusan="2.19.01";

	// 48_disbud
	// $jsonData = json_decode(file_get_contents('http://simonevdokrenda.sumbarprov.go.id/2021/api/rkpd_per_2021/48_disbud.json'));
	// $penunjang_urusan="2.22.01";

	// 51_disarsipdanpustaka
	// $jsonData = json_decode(file_get_contents('http://simonevdokrenda.sumbarprov.go.id/2021/api/rkpd_per_2021/51_disarsipdanpustaka.json'));
	// $penunjang_urusan="2.24.01";

	// 54_dkp
	// $jsonData = json_decode(file_get_contents('http://simonevdokrenda.sumbarprov.go.id/2021/api/rkpd_per_2021/54_dkp.json'));
	// $penunjang_urusan="3.25.01";

	// 56_dinas_pariwisata
	// $jsonData = json_decode(file_get_contents('http://simonevdokrenda.sumbarprov.go.id/2021/api/rkpd_per_2021/56_dinas_pariwisata.json'));
	// $penunjang_urusan="3.26.01";

	// 58_dinas_perkebunan
	// $jsonData = json_decode(file_get_contents('http://simonevdokrenda.sumbarprov.go.id/2021/api/rkpd_per_2021/58_dinas_perkebunan.json'));
	// $penunjang_urusan="3.27.01";
	
	// 59_dinas_peternakan
	// $jsonData = json_decode(file_get_contents('http://simonevdokrenda.sumbarprov.go.id/2021/api/rkpd_per_2021/59_dinas_peternakan.json'));
	// $penunjang_urusan="3.27.01";

	// 61_dishut
	// $jsonData = json_decode(file_get_contents('http://simonevdokrenda.sumbarprov.go.id/2021/api/rkpd_per_2021/61_dishut.json'));
	// $penunjang_urusan="3.28.01";

	// 63_dinas_esdm
	// $jsonData = json_decode(file_get_contents('http://simonevdokrenda.sumbarprov.go.id/2021/api/rkpd_per_2021/63_dinas_esdm.json'));
	// $penunjang_urusan="3.29.01";

	// 66_disperindag
	// $jsonData = json_decode(file_get_contents('http://simonevdokrenda.sumbarprov.go.id/2021/api/rkpd_per_2021/66_disperindag.json'));
	// $penunjang_urusan="3.30.01";

	// 70_inspektorat
	// $jsonData = json_decode(file_get_contents('http://simonevdokrenda.sumbarprov.go.id/2021/api/rkpd_per_2021/70_inspektorat.json'));
	// $penunjang_urusan="6.01.01";

	// 72_bappeda
	// $jsonData = json_decode(file_get_contents('http://simonevdokrenda.sumbarprov.go.id/2021/api/rkpd_per_2021/72_bappeda.json'));
	// $penunjang_urusan="5.01.01";

	// 74_bpkad
	// $jsonData = json_decode(file_get_contents('http://simonevdokrenda.sumbarprov.go.id/2021/api/rkpd_per_2021/74_bpkad.json'));
	// $penunjang_urusan="5.02.01";

	// 76_bkd
	// $jsonData = json_decode(file_get_contents('http://simonevdokrenda.sumbarprov.go.id/2021/api/rkpd_per_2021/76_bkd.json'));
	// $penunjang_urusan="5.03.01";

	// 78_bpsdm
	// $jsonData = json_decode(file_get_contents('http://simonevdokrenda.sumbarprov.go.id/2021/api/rkpd_per_2021/78_bpsdm.json'));
	// $penunjang_urusan="5.04.01";

	// 80_balitbang
	// $jsonData = json_decode(file_get_contents('http://simonevdokrenda.sumbarprov.go.id/2021/api/rkpd_per_2021/80_balitbang.json'));
	// $penunjang_urusan="5.05.01";

	// 82_badan_penghubung
	// $jsonData = json_decode(file_get_contents('http://simonevdokrenda.sumbarprov.go.id/2021/api/rkpd_per_2021/82_badan_penghubung.json'));
	// $penunjang_urusan="5.07.01";

	// 86_biro_pemerintahan
	// $jsonData = json_decode(file_get_contents('http://simonevdokrenda.sumbarprov.go.id/2021/api/rkpd_per_2021/86_biro_pemerintahan.json'));
	// $penunjang_urusan="4.01.01";

	// 87_biro_admpim
	// $jsonData = json_decode(file_get_contents('http://simonevdokrenda.sumbarprov.go.id/2021/api/rkpd_per_2021/87_biro_admpim.json'));
	// $penunjang_urusan="4.01.01";

	// 88_biro_hukum
	// $jsonData = json_decode(file_get_contents('http://simonevdokrenda.sumbarprov.go.id/2021/api/rkpd_per_2021/88_biro_hukum.json'));
	// $penunjang_urusan="4.01.01";

	// 89_biro_perekonomian
	// $jsonData = json_decode(file_get_contents('http://simonevdokrenda.sumbarprov.go.id/2021/api/rkpd_per_2021/89_biro_perekonomian.json'));
	// $penunjang_urusan="4.01.01";

	// 90_biro_kesra
	// $jsonData = json_decode(file_get_contents('http://simonevdokrenda.sumbarprov.go.id/2021/api/rkpd_per_2021/90_biro_kesra.json'));
	// $penunjang_urusan="4.01.01";

	// 91_biro_admpemb
	// $jsonData = json_decode(file_get_contents('http://simonevdokrenda.sumbarprov.go.id/2021/api/rkpd_per_2021/91_biro_admpemb.json'));
	// $penunjang_urusan="4.01.01";

	// 92_biro_organisasi
	// $jsonData = json_decode(file_get_contents('http://simonevdokrenda.sumbarprov.go.id/2021/api/rkpd_per_2021/92_biro_organisasi.json'));
	// $penunjang_urusan="4.01.01";

	// 93_biro_umum
	// $jsonData = json_decode(file_get_contents('http://simonevdokrenda.sumbarprov.go.id/2021/api/rkpd_per_2021/93_biro_umum.json'));
	// $penunjang_urusan="4.01.01";
	
	// 94_biro_pengadaan_barangdanjasa
	// $jsonData = json_decode(file_get_contents('http://simonevdokrenda.sumbarprov.go.id/2021/api/rkpd_per_2021/94_biro_pengadaan_barangdanjasa.json'));
	// $penunjang_urusan="4.01.01";

	// 96_set_dprd
	// $jsonData = json_decode(file_get_contents('http://simonevdokrenda.sumbarprov.go.id/2021/api/rkpd_per_2021/96_set_dprd.json'));
	// $penunjang_urusan="4.02.01";

	// 99_kesbangpol
	// $jsonData = json_decode(file_get_contents('http://simonevdokrenda.sumbarprov.go.id/2021/api/rkpd_per_2021/99_kesbangpol.json'));
	// $penunjang_urusan="8.01.01";

	// 100_bpbd
	// $jsonData = json_decode(file_get_contents('http://simonevdokrenda.sumbarprov.go.id/2021/api/rkpd_per_2021/100_bpbd.json'));
	// $penunjang_urusan="1.05.01";

	// 163_bapenda
	// $jsonData = json_decode(file_get_contents('http://simonevdokrenda.sumbarprov.go.id/2021/api/rkpd_per_2021/163_bapenda.json'));
	// $penunjang_urusan="5.02.01";

	// $jsonData = json_decode(file_get_contents('http://simonevdokrenda.sumbarprov.go.id/2021/api/rkpd_per_2021/rsam_7.json'));
	foreach ($jsonData as $v) {
		$o_urusan="";
		$o_burusan="";
		$o_prog="";
		$o_keg="";
		$o_subkeg="";
		
		$o_kode="";
		$o_indikator="";

		$arr_urusan=array('X.XX');
		if($v->type=="table"){
			// dd($v->data);
			foreach ($v->data as $r) {
				$urusan=$r->urusan;
				$burusan=$r->burusan;
				$prog=$r->prog;
				$keg=$r->keg;
				$subkeg=$r->subkeg;

				$idopd=$r->idopd;
			//// INSERT
				// urusan
				if($urusan!="" and $burusan=="" and $prog=="" and $keg=="" and $subkeg==""){
					$kode=$urusan;
					$o_kode=$urusan;
				}
				// burusan
				if($urusan!="" and $burusan!="" and $prog=="" and $keg=="" and $subkeg==""){
					$kode=$urusan.".".$burusan;
					$o_kode=$urusan.".".$burusan;
					$arr_urusan[]=$kode;
				}
				// program
				if($urusan!="" and $burusan!="" and $prog!="" and $keg=="" and $subkeg==""){
					$kode=$urusan.".".$burusan.".".$prog;
					$o_kode=$urusan.".".$burusan.".".$prog;
				}
				// kegiatan
				if($urusan!="" and $burusan!="" and $prog!="" and $keg!="" and $subkeg==""){
					$kode=$urusan.".".$burusan.".".$prog.".".$keg;
					$o_kode=$urusan.".".$burusan.".".$prog.".".$keg;
				}
				// sub kegiatan
				if($urusan!="" and $burusan!="" and $prog!="" and $keg!="" and $subkeg!=""){
					$kode=$urusan.".".$burusan.".".$prog.".".$keg.".".$subkeg;
					$o_kode=$urusan.".".$burusan.".".$prog.".".$keg.".".$subkeg;
				}
				$kode_kosong=0;
				// kode kosong
				if($urusan=="" and $burusan=="" and $prog=="" and $keg=="" and $subkeg==""){
					$kode=$o_kode;
					$kode_kosong=1;
				}

				if(substr($kode,0,7)==$penunjang_urusan){
				// if($r->nomenklatur=="PROGRAM PENUNJANG URUSAN PEMERINTAHAN DAERAH"){
					// $kode=str_replace("1.02.01","X.XX.01",$kode);
					$kode="X.XX.01".substr($kode,7,100);
				}else{

				}

				if($kode_kosong=="0"){
					// insert
					$pjg_kode=strlen($kode);
					if($pjg_kode<=1){
						//urusan
					}elseif($pjg_kode<=4){
						//burusan
					}elseif($pjg_kode<=7){
						//program
				        $cari_master_program=DB::table('program')->where('id',$kode)->first();
				        if($cari_master_program!=null){
				        }else{
				        	// insert
				        }

				        $cari_rkpd=DB::table('rkpd_prog')->where('idopd',$r->idopd)->where('idprog',$kode)->first();
				        if($cari_rkpd!=null){
				        	// update
				        	DB::table('rkpd_prog')->where('idopd',$r->idopd)->where('idprog',$kode)->update(
				        		[
	        			            //'idprog'=>$kode,
	        						//'prog_awal'=>0,
	        						//'prog_perubahan'=>1,
	        						'nmprog'=>$r->nomenklatur
	        						//'periode'=>2021
				        		]
				        	);
				        }else{
				        	// insert
		        	    }

				        // dd($store);
					}elseif($pjg_kode<=12){
				        $cari_master_program=DB::table('renstra_keg')->where('id',$kode)->first();
				        if($cari_master_program!=null){
				        }else{
				        	// insert
				        }
						//kegiatan
        			        $cari_rkpd=DB::table('rkpd_keg')->where('idopd',$r->idopd)->where('idkeg',$kode)->first();
        			        if($cari_rkpd!=null){
        			        	// update
        			        	DB::table('rkpd_keg')->where('idopd',$r->idopd)->where('idkeg',$kode)->update(
        			        		[
				                        'nmkeg'=>$r->nomenklatur
        			        		]
        			        	);
        			        }else{
        			        	// insert
	        	            }
        			    // dd($store);
					}else{
				        $cari_master_program=DB::table('sub_kegiatan')->where('id',$kode)->first();
				        if($cari_master_program!=null){
				        }else{
				        	// insert
		        	    }
						// subkegiatan
    			        $cari_rkpd=DB::table('rkpd_subkeg')->where('idopd',$r->idopd)->where('idsubkeg',$kode)->first();
    			        if($cari_rkpd!=null){
    			        	// update
    			        	DB::table('rkpd_subkeg')->where('idopd',$r->idopd)->where('idsubkeg',$kode)->update(
    			        		[
                                    'nmsubkeg'=>$r->nomenklatur
    			        		]
    			        	);
    			        }else{
    			        	// insert
	                    }

    			        // insert indikator
    			        
    			        // insert indikator det
    			        
					}
				}
			}
		}
	}
	
});
Route::get('update_rkpd_awal', function () {
	// $id_instansi=86;
	$rkpd_subkeg=DB::table('rkpd_subkeg')->where('idopd',$id_instansi)->where('pagu_perubahan',0)->get();
	//dd($cari_rkpd);
	foreach ($rkpd_subkeg as $sk) {
    	DB::table('rkpd_subkeg')->where('id',$sk->id)->where('idopd',$id_instansi)->update(
    		[
                'subkeg_awal'=>1,
                'subkeg_perubahan'=>0
    		]
    	);

    	DB::table('rkpd_subkeg_ind')->where('idsubkeg',$sk->idsubkeg)->where('idopd',$id_instansi)->update(
    		[
                'subkeg_ind_awal'=>1,
                'subkeg_ind_perubahan'=>0
    		]
    	);
	}
	
	$rkpd_keg=DB::table('rkpd_keg')->where('idopd',$id_instansi)->get();
	foreach ($rkpd_keg as $k) {
		// DB::select(DB::raw('select * from users'))[0];
		$cek_rkpd_keg=DB::select(DB::raw("select sum(pagu_perubahan)as tot from rkpd_subkeg where idopd='".$id_instansi."' and idkeg='".$k->idkeg."'"))[0];
		if($cek_rkpd_keg->tot=="0" or $cek_rkpd_keg->tot==0 or $cek_rkpd_keg->tot==null){
			//dd($cek_rkpd_keg);
			DB::table('rkpd_keg')->where('idkeg',$k->idkeg)->where('idopd',$id_instansi)->update(
				[
		            'keg_awal'=>1,
		            'keg_perubahan'=>0
				]
			);

			DB::table('rkpd_keg_ind')->where('idkeg',$k->idkeg)->where('idopd',$id_instansi)->update(
				[
		            'keg_ind_awal'=>1,
		            'keg_ind_perubahan'=>0
				]
			);
		}
	}

	$rkpd_prog=DB::table('rkpd_prog')->where('idopd',$id_instansi)->get();
	foreach ($rkpd_prog as $p) {
		// DB::select(DB::raw('select * from users'))[0];
		$cek_rkpd_prog=DB::select(DB::raw("select sum(pagu_perubahan)as tot from rkpd_subkeg where idopd='".$id_instansi."' and SUBSTRING(idkeg,1,7)='".$p->idprog."'"))[0];
		if($cek_rkpd_prog->tot=="0" or $cek_rkpd_prog->tot==null){
			// dd($p);
			DB::table('rkpd_prog')->where('idprog',$p->idprog)->where('idopd',$id_instansi)->update(
				[
		            'prog_awal'=>1,
		            'prog_perubahan'=>0
				]
			);

			DB::table('rkpd_prog_ind')->where('idprog',$p->idprog)->where('idopd',$id_instansi)->update(
				[
		            'prog_ind_awal'=>1,
		            'prog_ind_perubahan'=>0
				]
			);
		}
	}
});

Route::get('update_rkpd_perubahan', function () {
	
	// $rkpd_subkeg=DB::table('rkpd_subkeg')->where('idopd',$id_instansi)->where('pagu_perubahan',0)->get();
	// //dd($cari_rkpd);
	// foreach ($rkpd_subkeg as $sk) {
 //    	DB::table('rkpd_subkeg')->where('id',$sk->id)->where('idopd',$id_instansi)->update(
 //    		[
 //                'subkeg_awal'=>1,
 //                'subkeg_perubahan'=>0
 //    		]
 //    	);

 //    	DB::table('rkpd_subkeg_ind')->where('idsubkeg',$sk->idsubkeg)->where('idopd',$id_instansi)->update(
 //    		[
 //                'subkeg_ind_awal'=>1,
 //                'subkeg_ind_perubahan'=>0
 //    		]
 //    	);
	// }

/*
	// $data_opd=DB::table('data_opd')->where('id',7)->get();
	$data_opd=DB::table('data_opd')->get();
	foreach ($data_opd as $opd) {
	
	$id_instansi=$opd->id;
	$rkpd_keg=DB::table('rkpd_keg')->where('idopd',$id_instansi)->get();
	foreach ($rkpd_keg as $k) {
		// DB::select(DB::raw('select * from users'))[0];
		// $cek_rkpd_keg=DB::select(DB::raw("select sum(pagu_perubahan)as tot from rkpd_subkeg where idopd='".$id_instansi."' and idkeg='".$k->idkeg."'"))[0];
		// if($cek_rkpd_keg->tot=="0" or $cek_rkpd_keg->tot==0 or $cek_rkpd_keg->tot==null){
		// echo $k->idkeg."<br>";
		// $cari_rkpd=DB::table('rkpd_subkeg')->where('idopd',$id_instansi)->where('idsubkeg',$k->idkeg)->where('subkeg_perubahan',1)->first();
		$cari_rkpd=DB::select(DB::raw("select * from rkpd_subkeg where idopd='".$id_instansi."' and idkeg='".$k->idkeg."' and subkeg_perubahan='1'"));
		if($cari_rkpd!=null){
			// dd($cari_rkpd);
			DB::table('rkpd_keg')->where('idkeg',$k->idkeg)->where('idopd',$id_instansi)->update(
				[
		            'keg_perubahan'=>1
				]
			);

			DB::table('rkpd_keg_ind')->where('idkeg',$k->idkeg)->where('idopd',$id_instansi)->update(
				[
		            'keg_ind_perubahan'=>1
				]
			);
		}
		// $cari_rkpd_awl=DB::table('rkpd_subkeg')->where('idopd',$id_instansi)->where('idsubkeg',$k->idkeg)->where('subkeg_perubahan',0)->first();
		$cari_rkpd_awl=DB::select(DB::raw("select * from rkpd_subkeg where idopd='".$id_instansi."' and idkeg='".$k->idkeg."' and subkeg_perubahan='0'"));
		if($cari_rkpd_awl!=null and $cari_rkpd==null){
				DB::table('rkpd_keg')->where('idkeg',$k->idkeg)->where('idopd',$id_instansi)->update(
					[
			            'keg_awal'=>1,
			            'keg_perubahan'=>0
					]
				);

				DB::table('rkpd_keg_ind')->where('idkeg',$k->idkeg)->where('idopd',$id_instansi)->update(
					[
			            'keg_ind_awal'=>1,
			            'keg_ind_perubahan'=>0
					]
				);
		}
	}

	$rkpd_prog=DB::table('rkpd_prog')->where('idopd',$id_instansi)->get();
	foreach ($rkpd_prog as $p) {
		// DB::select(DB::raw('select * from users'))[0];
		$cek_rkpd_prog=DB::select(DB::raw("select * from rkpd_subkeg where idopd='".$id_instansi."' and SUBSTRING(idkeg,1,7)='".$p->idprog."' and subkeg_perubahan='1'"));

		if($cek_rkpd_prog!=null){
		// $cari_rkpd_prog=DB::table('rkpd_subkeg')->where('idopd',$id_instansi)->where('idsubkeg',$p->idprog)->where('subkeg_perubahan',1)->first();
		// if($cari_rkpd_prog!=null){
			// dd($p);
			DB::table('rkpd_prog')->where('idprog',$p->idprog)->where('idopd',$id_instansi)->update(
				[
		            'prog_perubahan'=>1
				]
			);

			DB::table('rkpd_prog_ind')->where('idprog',$p->idprog)->where('idopd',$id_instansi)->update(
				[
		            'prog_ind_perubahan'=>1
				]
			);
		}
	}

	}
*/	
});