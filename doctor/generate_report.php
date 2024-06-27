<?php
require_once('vendor/tecnickcom/tcpdf/tcpdf.php');
$patientName = $_POST['patient-name'];
$date = $_POST['date'];
$reason = $_POST['reason'];
$diagnosis = $_POST['diagnosis'];
$medications = $_POST['medications'];
$examinations = $_POST['examinations'];
$pdf = new TCPDF();
$pdf->SetCreator('Task Master');
$pdf->SetAuthor('fatima');
$pdf->SetTitle($patientName . ' Report');
$pdf->AddPage();
$content = '<h4><strong>Medical Report</strong></h4>
            <p><strong>Patient Name:</strong> '. $patientName .'</p>
            <p><strong>Date:</strong> '. $date .'</p>
            <p><strong>Reason for Admission:</strong> '. $reason .'</p>
            <p><strong>Diagnosis:</strong> '. $diagnosis .'</p>
            <p><strong>Medications:</strong> '. $medications .'</p>
            <p><strong>Examinations and X-ray Needed:</strong> '. $examinations .'</p>';

$pdf->writeHTML($content, true, false, true, false, '');

$pdf->Output($patientName.'_report.pdf', 'D');
?>
