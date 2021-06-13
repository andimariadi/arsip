<?php
$tanggal = 'Tanggal : ' . date('F Y', strtotime($start_date));
if($start_date != $end_date) {
    $tanggal = 'Tanggal : ' . date('F Y', strtotime($start_date)) . ' sampai ' . date('F Y', strtotime($end_date)) ;
}

// set document information
$pdf = new TCPDF("L", PDF_UNIT, 'A4', true, 'UTF-8', false);

// set document information
$pdf->SetCreator('Desa Banyu Landas');
$pdf->SetAuthor('Desa Banyu Landas');
$pdf->SetTitle('Laporan Pengarahan Kategory');
$pdf->SetSubject('Laporan Pengarahan Kategory');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
$pdf->SetHeaderData('assets/img/icons/bartim.jpg', 10, 'Laporan Pengarahan Kategory', "Alamat: Banyu landas RT. 01, Benua Lima, Kalimantan Tengah", array(0,0,0), array(0,0,0));
$pdf->setFooterData(array(0,0,0), array(0,0,0));

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
$pdf->AddPage();

$i=0;
$html='<style> table {border-collapse: collapse; width: 100%; font-size: 11px; }</style>

<table border="1">
    <thead>
      <tr>
        <th scope="col">ID Sub kategory</th>
        <th scope="col">Keterangan</th>
        <th scope="col">Area</th>
        <th scope="col">Karyawan</th>
        <th scope="col">Minute</th>
      </tr>
    </thead>
    <tbody class="list">';
    foreach ($data_desccategory as $value) : 
        $html .= '<tr>
            <th scope="row">' . $value['subcategory_description'] . '</th>
            <td>' . $value['remark'] . '</td>
            <td>' . $value['area'] . '</td>
            <td>' . $value['full_name'] . '</td>
            <td>' . $value['time_minutes'] . '</td>
        </tr>';
    endforeach;
$html.='</tbody>
</table>
<br /><br />

<table>
    <tbody>
      <tr>
        <th scope="col"></th>
        <th scope="col" align="center">Mengetahui,<br />Kepala Desa Banyu Landas<br /><br /><br /><br /><br />
<br />
BAHRAN
        </th>
      </tr>
    </tbody>';


$pdf->writeHTML($html, true, false, true, false, '');
$pdf->Output( 'Laporan Pengarahan Kategory.pdf', 'I');
?>