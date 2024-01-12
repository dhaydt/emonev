<table border=1 style="border-collapse: collapse;">
  <tr>
    <th rowspan=2>Kode Unit</th>
    <th rowspan=2>Urusan/Bidang Urusan/Program/Kegiatan</th>
    <th rowspan=2>Indikator</th>
    <th rowspan=2>Satuan</th>
    <th colspan=2>Tahun 2016</th>
    <th colspan=2>Tahun 2017</th>
    <th colspan=2>Tahun 2018</th>
    <th colspan=2>Tahun 2019</th>
    <th colspan=2>Tahun 2020</th>
    <th colspan=2>Tahun 2021</th>
  </tr>
  <tr>
    <th>Proyeksi</th>
    <th>Capaian</th>
    <th>Proyeksi</th>
    <th>Capaian</th>
    <th>Proyeksi</th>
    <th>Capaian</th>
    <th>Proyeksi</th>
    <th>Capaian</th>
    <th>Proyeksi</th>
    <th>Capaian</th>
    <th>Proyeksi</th>
    <th>Capaian</th>
  </tr>
@foreach ($urusan as $keyurusan => $vurusan)
  @php
  if($vurusan->unitkey!="225_"){
      $du = $dafunit->where('unitkey','=',$vurusan->unitkey)->first();
      $urusan = $du->nm_unit;
      $unitkey=$vurusan->unitkey;
  }else{
      $du = $dafunit->where('unitkey','=','212_')->first();
      $sekda = $data_opd->where('unit_key','=','80_')->first();
      $urusan = $du->nm_unit.' : '.$sekda->nm_instansi;   
      $unitkey='80_';           
  }

  //start urusan
  if($du->parent!=null){
    echo"
      <tr style='background-color: yellow;'>
        <td>".$du->parent->kdunit."</td>
        <td>".$du->parent->nm_unit."</td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
      </tr>
    ";
  }

  echo"
    <tr style='background-color: yellow;'>
      <td>".$vurusan->kdunit."</td>
      <td>".$urusan."</td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
    </tr>
  ";
    
    foreach ($vurusan->opd_rpjmd($unitkey) as $keyopd => $vopd) {
      $nm_opd=$data_opd->find($vopd->id_instansi);
      
      echo"
        <tr style='background-color: skyblue;'>
          <td>".$vurusan->kdunit.($keyopd+1)."</td>
          <td>".$nm_opd->nm_instansi."</td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
        </tr>
      ";

      foreach($nm_opd->program_rpjmd($unitkey) as $keyprog=>$prog){
      
        $noind=0;
        foreach($prog->indikator_program() as $pi){
          if($noind>0){
            $kdprog="";
            $nmprog="";
          }else{
            $kdprog=$vurusan->kdunit.($keyopd+1).'.'.($keyprog+1);
            $nmprog=$prog->master_program->nmprgrm;
          }
          $noind++;
          echo"
            <tr>
              <td>".$kdprog."</td>
              <td>".$nmprog."</td>
              <td>".$pi->indikator."</td>
              <td>".$pi->satuan."</td>
              <td>".$pi->t1."</td>
              <td></td>
              <td>".$pi->t2."</td>
              <td></td>
              <td>".$pi->t3."</td>
              <td></td>
              <td>".$pi->t4."</td>
              <td></td>
              <td>".$pi->t5."</td>
              <td></td>
              <td>".$pi->t6."</td>
              <td></td>
            </tr>
          ";
        }
      }
    }

    
  @endphp
@endforeach
</table>