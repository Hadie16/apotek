<?php
require('../fpdf184/fpdf.php');
$pdf = new FPDF('L', 'mm', 'A4');
$pdf->SetLeftMargin(20);
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(0, 10, 'LAPORAN DATA MAHASISWA', 0, 10, 'C');
$pdf->Cell(10, 7, '', 0, 1, 'C');
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(10, 8, 'No.', 1, 0, 'C');
$pdf->Cell(20, 8, 'NIM', 1, 0, 'C');
$pdf->Cell(50, 8, 'Nama Lengkap', 1, 0, 'C');
$pdf->Cell(18, 8, 'Jurusan', 1, 0, 'C');
$pdf->Cell(10, 8, 'JK', 1, 0, 'C');
$pdf->Cell(60, 8, 'Alamat', 1, 0, 'C');
$pdf->Cell(25, 8, 'Telepon', 1, 0, 'C');
$pdf->Cell(50, 8, 'Email', 1, 1, 'C');
$pdf->SetFont('Arial', '', 10);

include '../connection.php';
$no = 1;
$result = mysqli_query($con, "SELECT * FROM mahasiswa");
while ($data = mysqli_fetch_array($result)) {
  $pdf->Cell(10, 8, $no++, 1, 0, 'C');
  $pdf->Cell(20, 8, $data['nim'], 1, 0, 'C');
  $pdf->Cell(50, 8, $data['nama'], 1, 0);
  $pdf->Cell(18, 8, $data['jurusan'], 1, 0, 'C');
  $pdf->Cell(10, 8, $data['jenis_kelamin'], 1, 0, 'C');
  $pdf->Cell(60, 8, $data['alamat'], 1, 0);
  $pdf->Cell(25, 8, $data['telepon'], 1, 0);
  $pdf->Cell(50, 8, $data['email'], 1, 1);
}
$pdf->Output();