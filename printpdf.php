<?php
require('includes/fpdf.php');
require('includes/config.php');
$d = date('d_m_Y');

class PDF extends FPDF
{

    function Header()
    {
        $this->Ln(15);
        //$this->Image('images/tuk.png',0,0,0);
        $this->SetFont('Helvetica', '', 25);
        $this->SetFontSize(25);
        //Move to the right
        //$this->Cell(80);
        $this->Cell(0, 0, 'TECHNICAL UNIVERSITY OF KENYA', 0, 0, 'C');
        //Line break
        $this->Ln(20);
    }

//Page footer
    function Footer()
    {
        $this->SetY(-25);
        $this->SetFont('Helvetica', '', 25);
        $this->SetFontSize(10);
        $this->Cell(0, 10, '----------CHURCHMIS---------', 0, 0, 'C');
    }

//Load data
    function LoadData($file)
    {
        //Read file lines
        $lines = file($file);
        $data = array();
        foreach ($lines as $line)
            $data[] = explode(';', chop($line));
        return $data;
    }

//Simple table
    function BasicTable($header, $data)
    {

        $this->SetFillColor(255, 255, 255);
//$this->SetDrawColor(255, 0, 0);
        $w = array(35, 50, 35);


        //Header
        $this->SetFont('Arial', 'B', 9);
        for ($i = 0; $i < count($header); $i++)
            $this->Cell($w[$i], 7, $header[$i], 1, 0, 'L', true);
        $this->Ln();

        //Data

        $this->SetFont('Arial', '', 10);
        foreach ($data as $eachResult) { //width
            $this->Cell(10);
            $this->Cell(35, 6, $eachResult["number"], 1);
            $this->Cell(50, 6, $eachResult["fullname"], 1);
            $this->Cell(35, 6, $eachResult["votes"], 1);
            $this->Ln();

        }
    }

//Better table
}


$pdf = new PDF();


$header = array('RANK', 'ASPIRANT FULL NAME', 'VOTES');
//Data loading
//*** Load MySQL Data ***//
//$objConnect = mysql_connect("localhost","root","") or die("Error:Please check your database username & password");
//objDB = mysql_select_db("e_voting");
$objQuery = mysql_query("SELECT * FROM student_posts WHERE post_id = 1 ORDER BY votes DESC");
$rank = 1;
while ($q = mysql_fetch_array($objQuery)) {
    $query = "SELECT name FROM students WHERE id=$q[std_id]";
    $querys = mysql_query($query);
    $que = mysql_fetch_array($querys);

    $mydata = array(
        'number' => $rank,
        'fullname' => $que['name'],
        'votes' => $q['votes']
    );

    $resultData[] = $mydata;
    $rank++;
}
//************************//

$sql = "SELECT * FROM mpesa";
$result = db_operations::getDBCONN()->query($sql)->fetch();
foreach ($result as $item) {

}


//*** Table 1 ***//
$pdf->AddPage();

$pdf->SetFont('Helvetica', '', 14);
$pdf->Cell(68);
$pdf->Write(5, 'Chairman Votes Report');
$pdf->Ln();

$pdf->Cell(22);
$pdf->SetFontSize(8);
$pdf->Cell(57);
$result = mysql_query("select date_format(now(), '%W, %M %d, %Y') as date");
while ($row = mysql_fetch_array($result)) {
    $pdf->Write(5, $row['date']);
}
$pdf->Ln();

//count total numbers of visitors
$result = mysql_query("SELECT * FROM students") or die ("Database query failed: $query" . mysql_error());

$count = mysql_num_rows($result);
$pdf->Cell(0);
$pdf->Write(5, '             Total Students To Vote: ' . $count . '');
$pdf->Ln();

$pdf->Ln(5);

$pdf->Ln(0);
$pdf->Cell(10);
$pdf->BasicTable($header, $resultData);
//forme();
//$pdf->Output("$d.pdf","F");
$pdf->Output();

?>
