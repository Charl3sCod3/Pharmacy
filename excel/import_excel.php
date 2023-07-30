<?php
/**
 * Created by PhpStorm.
 * User: Aravinth
 * Date: 10-09-2017
 * Time: 12:30 PM
 */

use Box\Spout\Reader\ReaderFactory;
use Box\Spout\Common\Type;

require_once ('connect.php');
require_once ('Spout/Autoloader/autoload.php');

if(!empty($_FILES['excelfile']['name']))
{
    // Get File extension eg. 'xlsx' to check file is excel sheet
    $pathinfo = pathinfo($_FILES['excelfile']['name']);

    // check file has extension xlsx, xls and also check
    // file is not empty
    if (($pathinfo['extension'] == 'xlsx' || $pathinfo['extension'] == 'xls')
        && $_FILES['excelfile']['size'] > 0 )
    {
        $file = $_FILES['excelfile']['tmp_name'];

        // Read excel file by using ReadFactory object.
        $reader = ReaderFactory::create(Type::XLSX);

        // Open file
        $reader->open($file);
        $count = 0;
        $thehousehead = "";
        $m_id = 0;
        $b_id = 0;
        // Number of sheet in excel file
        foreach ($reader->getSheetIterator() as $sheet)
            {
                
                foreach ($sheet->getRowIterator() as $row)
                {
                    $fullname = $row[4];
                    $ncheck = "SELECT * FROM `familyheads` WHERE `fullname`='$fullname'";
                    $ncquery = $con->query($ncheck);
                    $numcheck = $ncquery->num_rows;
                    if($numcheck == 0){
                            if ($count == 0) {
                             $m_id = $row[0];
                             }

                            // It reads data after header. In the my excel sheet,
                            // header is in the first row.
                            if ($count > 11) 
                            {
                                    // Data of excel sheet
                                    $barangay = $row[0];
                                    if (!empty($barangay) AND $barangay > 0) 
                                    {
                                        $b_id = $barangay;
                                    }

                                    $purok = $row[1];
                                    $ignore  = $row[2];
                                    $househead = $row[3];
                                    $familyhead = $row[4];
                                    $family1 = $row[5];
                                    $family2 = $row[6];
                                    $family3 = $row[7];

                                    $sin10to20 = $row[8];
                                    $sin20to30 = $row[9];
                                    $sin30more = $row[10];
                                    $nipa = $row[11];
                                    $coloredroof = $row[12];
                                    $roof_id = 0;

                                    if (!empty($sin10to20)) 
                                    {
                                        $roof_id = 1;
                                    }
                                     if (!empty($sin20to30)) 
                                    {
                                        $roof_id = 1;
                                    }
                                     if (!empty($sin30more)) 
                                    {
                                        $roof_id = 1;
                                    }
                                     if (!empty($nipa)) 
                                    {
                                        $roof_id = 2;
                                    }
                                    if (!empty($coloredroof)) 
                                    {
                                        $roof_id = 3;
                                    }



                                    $ceiling = $row[13];
                                    $walls = $row[14];
                                    $posts = $row[15];

                                    $house_stat = 0;
                                    $hstatus1 = $row[16];
                                    $hstatus2 = $row[17];
                                    $hstatus3 = $row[18];

                                    if (!empty($hstatus1)) 
                                    {
                                        $house_stat = 1;
                                    }
                                    if (!empty($hstatus2)) 
                                    {
                                        $house_stat = 2;
                                    }
                                    if (!empty($hstatus3)) 
                                    {
                                        $house_stat = 3;
                                    }

                                    $area_stat = 0;
                                    $tss = $row[19];
                                    $landslide = $row[20];
                                    $flashflood = $row[21];
                                    if (!empty($tss)) 
                                    {
                                        $area_stat = 1;
                                    }
                                    if (!empty($landslide)) 
                                    {
                                        $area_stat = 2;
                                    }
                                    if (!empty($flashflood)) 
                                    {
                                        $area_stat = 3;
                                    }

                                    $own_id = 0;
                                    $ownership1 = $row[22];
                                    $ownership2 = $row[23];
                                    $ownership3 = $row[24];
                                    $ownership4 = $row[25];
                                    $ownership5 = $row[26];

                                    if (!empty($ownership1)) 
                                    {
                                        $own_id = 1;
                                    }
                                    if (!empty($ownership2)) 
                                    {
                                        $own_id = 2;
                                    }
                                    if (!empty($ownership3)) 
                                    {
                                        $own_id = 3;
                                    }
                                    if (!empty($ownership4)) 
                                    {
                                        $own_id = 4;
                                    }
                                    if (!empty($ownership5)) 
                                    {
                                        $own_id = 5;
                                    }


                                     if (!empty($househead)) 
                                    {
                                        $thehousehead = $househead;
                                    }
                                    $num_family = 0;
                                    if (!empty($family1)) 
                                    {
                                        $num_family = $family1;
                                    }
                                    if (!empty($family2)) 
                                    {
                                        $num_family = $family2;
                                    }
                                    if (!empty($family3)) 
                                    {
                                        $num_family = $family3;
                                    }

                                    $fisherman = $row[27];
                                    $boat_body_damage = 0;
                                    if ($row[28] == 1) 
                                    {
                                       $boat_body_damage = 1;
                                    }
                                    if ($row[29] == 1) 
                                    {
                                       $boat_body_damage = 2;
                                    }
                                    if ($row[30] == 1) 
                                    {
                                       $boat_body_damage = 3;
                                    }
                                    $boat_body = $boat_body_damage;
                                    $body_status = 0;

                                    if ($row[31] == 1) 
                                    {
                                       $body_status = 1;
                                    }
                                    if ($row[32] == 1) 
                                    {
                                       $body_status = 2;
                                    }
                                    if ($row[33] == 1) 
                                    {
                                       $body_status = 3;
                                    }


                                    $boat_body_status = $body_status;
                                    $boat_engine_damage = 0;

                                    if ($row[34] == 1) 
                                    {
                                       $boat_engine_damage = 1;
                                    }
                                    if ($row[35] == 1) 
                                    {
                                       $boat_engine_damage = 2;
                                    }
                                    if ($row[36] == 1) 
                                    {
                                       $boat_engine_damage = 3;
                                    }

                                    $boat_engine = $boat_engine_damage;
                                    $engine_status =0;
                                     if ($row[37] == 1) 
                                    {
                                       $engine_status = 1;
                                    }
                                    if ($row[38] == 1) 
                                    {
                                       $engine_status = 2;
                                    }
                                    if ($row[39] == 1) 
                                    {
                                       $engine_status = 3;
                                    }

                                    $boat_engine_status = $engine_status;
                                    $fishingmaterials = $row[40];
                                    $farmer = $row[41];

                                    $riceland = $row[42]; 
                                    $coconut = $row[43];   
                                    $fruits = $row[44];
                                    $commercialtrees = $row[45];
                                    $rootandvege = $row[46];
                                    $aquamarine = $row[47];
                                    $livestock = $row[48];

                                    $enterprenuer = $row[49];
                                    $driver = $row[50];
                                    $laborer = $row[51];
                                    $skilledworker = $row[52];
                                    $govemp = $row[53];
                                    $unemployed = $row[54];
                                    $others = $row[55];
                                    $new_m_id = $row[56];


                                    //Here, You can insert data into database.
                                    $qry = "INSERT INTO `familyheads`
                                    ( `m_id`, `b_id`,`purok`, `house_head`, `fullname`, `num_family`, `sin10to20`,`sin20to30`,`sin30more`, `nipa`, `colored roof`, `ceiling`, `walls`, `posts`, `hs_repaired`,`hs_ongoing`,`hs_makeshift`, `tss`, `landslide`, `flashflood`, `tagiya`,`nagabang`,`gisalig`,`private`,`public`,`fisherman`,`boat_body`,`boat_body_status`,`boat_engine`,`boat_engine_status`,`fishingmaterials`,`farmer`,`riceland`,`coconut`,`fruits`,`commercialtrees`,`rootandvege`,`aquamarine`,`livestock`,`enterprenuer`,`driver`,`laborer`,`skilledworker`,`govemp`,`unemployed`,`others`) 
                                     VALUES 
                                    ('$new_m_id','$b_id','$purok','$thehousehead','$familyhead','$num_family','$sin10to20','$sin20to30','$sin30more','$nipa','$coloredroof','$ceiling','$walls','$posts','$hstatus1','$hstatus2','$hstatus3','$tss','$landslide','$flashflood','$ownership1','$ownership2','$ownership3','$ownership4','$ownership5','$fisherman','$boat_body','$boat_body_status','$boat_engine','$boat_engine_status','$fishingmaterials','$farmer','$riceland','$coconut','$fruits','$commercialtrees','$rootandvege','$aquamarine','$livestock','$enterprenuer','$driver','$laborer','$skilledworker','$govemp','$unemployed','$others')";
                                    $res = mysqli_query($con,$qry);
                                    $fh_id = mysqli_insert_id($con);

                                    $sql = "INSERT INTO `house_information`(`roof_id`, `ceiling`, `walls`, `posts`, `house_status`, `area_status`, `owner_ship`,`fh_id`) VALUES ('$roof_id','$ceiling','$walls','$posts','$house_stat','$area_stat','$own_id','$fh_id')";
                                    $query = mysqli_query($con,$sql);

                                    if ($fisherman == 1) 
                                    {

                                        $inseris = "INSERT INTO `income_source`(`job_id`,`fh_id`) VALUES (1,'$fh_id')";
                                        $isquery = mysqli_query($con,$inseris);

                                        $select = "SELECT * FROM `job_sub` WHERE `job_id` = 1 ";
                                        $squery = mysqli_query($con,$select);
                                        $num = 0;
                                        while ($srow = mysqli_fetch_array($squery)) 
                                        {
                                                $num ++;
                                                $job_sub_id = $srow[0];
                                                echo $row[4].' '.$num.'-'.$boat_body.' '.$boat_body_status.'<br>';

                                                if ($num == 1 AND $boat_body  == 1 ) {
                                                    $inboat_status = "INSERT INTO `income_source_issue`(`job_sub_id`, `damage_status`, `repair_status`) VALUES ('$job_sub_id','$boat_body','$body_status')";
                                                    $inboat_query = mysqli_query($con,$inboat_status);

                                                }
                                                if ($num == 1 AND $boat_body == 2 ) {
                                                    $inboat_status = "INSERT INTO `income_source_issue`(`job_sub_id`, `damage_status`, `repair_status`) VALUES ('$job_sub_id','$boat_body','$body_status')";
                                                    $inboat_query = mysqli_query($con,$inboat_status);

                                                }
                                                if ($num == 1 AND $boat_body  == 3 ) {
                                                    $inboat_status = "INSERT INTO `income_source_issue`(`job_sub_id`, `damage_status`, `repair_status`) VALUES ('$job_sub_id','$boat_body','$body_status')";
                                                    $inboat_query = mysqli_query($con,$inboat_status);

                                                }

                                                  if ($num == 2 AND $row[34] == 1 ) {
                                                    $inboat_status = "INSERT INTO `income_source_issue`(`job_sub_id`, `damage_status`, `repair_status`) VALUES ('$job_sub_id','$boat_engine','$boat_engine_status')";
                                                    $inboat_query = mysqli_query($con,$inboat_status);

                                                }
                                                if ($num == 2 AND $row[35] == 1 ) {
                                                    $inboat_status = "INSERT INTO `income_source_issue`(`job_sub_id`, `damage_status`, `repair_status`) VALUES ('$job_sub_id','$boat_engine','$boat_engine_status')";
                                                    $inboat_query = mysqli_query($con,$inboat_status);

                                                }
                                                if ($num == 2 AND $row[36] == 1 ) {
                                                    $inboat_status = "INSERT INTO `income_source_issue`(`job_sub_id`, `damage_status`, `repair_status`) VALUES ('$job_sub_id','$boat_body','$boat_engine_status')";
                                                    $inboat_query = mysqli_query($con,$inboat_status);

                                                }
                                             

                                                if ($num == 3 AND $fishingmaterials == 1) {
                                                   $inboat_status = "INSERT INTO `income_source_issue`(`job_sub_id`, `damage_status`, `repair_status`) VALUES ('$job_sub_id',3,3)";
                                                    $inboat_query = mysqli_query($con,$inboat_status);
                                                }
                                        }
                                    }
                                     if (!empty($farmer)) {

                                    $inseris = "INSERT INTO `income_source`(`job_id`,`fh_id`) VALUES (2,'$fh_id')";
                                    $isquery = mysqli_query($con,$inseris);

                                            if ($riceland == 1) {
                                           $inboat_status = "INSERT INTO `income_source_issue`(`job_sub_id`, `damage_status`, `repair_status`) VALUES (3,3,3)";
                                            $inboat_query = mysqli_query($con,$inboat_status);
                                        }
                                           if ($coconut == 1) {
                                           $inboat_status = "INSERT INTO `income_source_issue`(`job_sub_id`, `damage_status`, `repair_status`) VALUES (4,3,3)";
                                            $inboat_query = mysqli_query($con,$inboat_status);
                                        }
                                           if ($fruits == 1) {
                                           $inboat_status = "INSERT INTO `income_source_issue`(`job_sub_id`, `damage_status`, `repair_status`) VALUES (5,3,3)";
                                            $inboat_query = mysqli_query($con,$inboat_status);
                                        }
                                           if ($commercialtrees == 1) {
                                           $inboat_status = "INSERT INTO `income_source_issue`(`job_sub_id`, `damage_status`, `repair_status`) VALUES (6,3,3)";
                                            $inboat_query = mysqli_query($con,$inboat_status);
                                        }
                                           if ($rootandvege == 1) {
                                           $inboat_status = "INSERT INTO `income_source_issue`(`job_sub_id`, `damage_status`, `repair_status`) VALUES (7,3,3)";
                                            $inboat_query = mysqli_query($con,$inboat_status);
                                        }   if ($aquamarine == 1) {
                                           $inboat_status = "INSERT INTO `income_source_issue`(`job_sub_id`, `damage_status`, `repair_status`) VALUES (8,3,3)";
                                            $inboat_query = mysqli_query($con,$inboat_status);
                                        }
                                           if ($livestock == 1) {
                                           $inboat_status = "INSERT INTO `income_source_issue`(`job_sub_id`, `damage_status`, `repair_status`) VALUES (9,3,3)";
                                            $inboat_query = mysqli_query($con,$inboat_status);
                                        }


                                    
                                    }
                                     if (!empty($enterprenuer)) {

                                    $inseris = "INSERT INTO `income_source`(`job_id`,`fh_id`) VALUES (3,'$fh_id')";
                                    $isquery = mysqli_query($con,$inseris);

                                    }
                                    if (!empty($driver)) {

                                    $inseris = "INSERT INTO `income_source`(`job_id`,`fh_id`) VALUES (4,'$fh_id')";
                                    $isquery = mysqli_query($con,$inseris);

                                    }
                                    if (!empty($laborer)) {

                                    $inseris = "INSERT INTO `income_source`(`job_id`,`fh_id`) VALUES (5,'$fh_id')";
                                    $isquery = mysqli_query($con,$inseris);

                                    }
                                    if (!empty($skilledworker)) {

                                    $inseris = "INSERT INTO `income_source`(`job_id`,`fh_id`) VALUES (6,'$fh_id')";
                                    $isquery = mysqli_query($con,$inseris);

                                    }
                                    if (!empty($govemp)) {

                                    $inseris = "INSERT INTO `income_source`(`job_id`,`fh_id`) VALUES (7,'$fh_id')";
                                    $isquery = mysqli_query($con,$inseris);

                                    }
                                    if (!empty($unemployed)) {

                                    $inseris = "INSERT INTO `income_source`(`job_id`,`fh_id`) VALUES (8,'$fh_id')";
                                    $isquery = mysqli_query($con,$inseris);

                                    }
                                    if (!empty($others)) {

                                    $inseris = "INSERT INTO `income_source`(`job_id`,`fh_id`) VALUES (9,'$fh_id')";
                                    $isquery = mysqli_query($con,$inseris);

                                    }

                                    

                            } 


                            $count++;
                    } // HERE
                }
        }

        if($res)
        {
            // header('location:../?q=excelupload&upload=success');
            echo "UPLOAD SUCCESSFUL";
        }
        else
        {
            echo "Your file Uploaded Failed";
        }

        // Close excel file
        $reader->close();
    }
    else
    {
        echo "Please Choose only Excel file";
    }
}
else
{
    echo "File is Empty"."<br>";
    echo "Please Choose Excel file";
}

?>
