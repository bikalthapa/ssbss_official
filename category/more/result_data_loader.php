<?php
include "../../connection.php";
session_start();
$id = $_POST['id'];
$type = $_POST['type'];
$str = "";


  //Variable configuration for result form
  $data_start_after = 0;

function show_result($data, $total_students,$grade_id, $section_id,$conn,$attributes){// displays result form
    // Getting the name of grade //
    $sql = "SELECT * FROM class WHERE class_id = '$grade_id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $grade_name = $row['class_name'];
    // Getting the section if section_id is not eqal -1
    if($section_id!="null"){
        $sql = "SELECT * FROM class_section WHERE section_id = '$section_id'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        if(mysqli_num_rows($result)>0){
            $section_name = $row["section_name"];
        }else{
            $section_name = "";
        }
    }else{
        $section_name = "";
    }

    $row = " ";
      $rank = $data[1][$attributes["rank"]];
      $attendance = $data[1][$attributes["attendance"]];
      $remarks = $data[1][$attributes["remarks"]];
      $gpa = $data[1][$attributes["gpa"]];
    for($i = 1; $i<$_SESSION['total_subject'];$i++){
      $sub_name = $data[1][$attributes["sub"][$i-1]];
      $tch = intval($data[1][$attributes["TCH"][$i-1]]);
      $pch = intval($data[1][$attributes["PCH"][$i-1]]);
      $theory_grade = $data[1][$attributes["TH"][$i-1]];
      $internal_grade = $data[1][$attributes["IN"][$i-1]];
      $fgrade = $data[1][$attributes["fgrade"][$i-1]];
      $each_rm = $data[1][$attributes["rm"][$i-1]];
      $gp = $data[1][$attributes["gp"][$i-1]];
      // if(!empty($th)){
      $row .= '<tr>
                <td>'.$i.'</td>
                <td style="text-align:left;">'.$sub_name.'</td>
                <td>'.$tch+$pch.'</td>
                <td>'.$theory_grade.'</td>
                <td>'.$internal_grade.'</td>
                <td>'.$fgrade.'</td>
                <td>'.$gp.'</td>
                <td>'.$each_rm.'</td>
              </tr>';
      }
    // }
        return '
          <div class="design1" id="design1">
            <div class="row">
              <div class="text-center header">
                <img src="../../../images/slogo.png" class="logo">
                <div class="head_para">
                  <p class="text-primary school_name">Shree Shanti Bhagwati Secondary School</p>
                  <p class="address">LETANG-4, MORANG<br>ESTD 2009</p>
                  <p class="examination_title">'.$data[1][$attributes["term"]].'</p>
                  <p class="display-6 GS text-danger">GRADE SHEET</p>
                </div>
              </div>
              <div class="details">
                <div class="row">
                  <div class="col-sm-6">
                    Name : <span class="details_data">'.$data[1][$attributes["name"]].'</span><br>
                  </div>
                  <div class="col-sm-3">
                    Grade : <span class="details_data">'.$grade_name.'</span>
                  </div>
                  <div class="col-sm-3">
                    Symbol No : <span class="details_data">'.$data[1][$attributes["sn"]].'</span>
                  </div>
                </div>
                <table border="1"  cellspacing="0" cellpadding="5" class="text-center" style="margin:auto; width:100%;">
                  <tr class="text-primary">
                    <th rowspan="2">S.N</th>
                    <th rowspan="2">Subjects</th>
                    <th rowspan="2">CH</th>
                    <th colspan="2">Obtained Marks</th>
                    <th rowspan="2">Final<br>Grade</th>
                    <th rowspan="2">Grade<br>Point</th>
                    <th rowspan="2">Remarks</th>
                  </tr>
                  <tr class="text-primary">
                    <th>TH</th>
                    <th>IN</th>
                  </tr>
                  '.$row.'
                  <tr class="text-primary">
                    <th></th>
                    <th colspan="4" style="text-align:left;">GPA: <span class="details_data">'.$gpa.'</span></th>
                    <th colspan="4" style="text-align:left;">Rank :<span class="details_data">'.$rank.'</span> </th>
                  </tr>
                </table>
                <div class="result_conclusion row row-cols-2">
                  <div class="col gy-2 gx-5">
                    <p class="total_students">TOTAL STUDENTS :<span class="details_data">'.$_SESSION["num_records"].'</span></p>
                    <p class="remarks">REMAKRS :<span class="details_data">'.$remarks.'</span></p>
                  </div>
                  <div class="col gy-2 gx-5">
                    <p class="attendance">ATTENDANCE : <span class="details_data">'.$attendance.'</span></p>
                    <p class="date_of_issue">DATE OF ISSUE :<span class="details_data">2080/07/17</span></p>
                  </div>
                </div>
                <hr>
                <div class="result_footer row row-cols-2">
                  <div class="col gy-2 gx-5">
                    <p class="class_teacher">CLASS TEACHER</p>
                  </div>
                  <div class="col gy-2 gx-5">
                    <p class="head_teacher">HEAD TEACHER
                      <img src="../../images/head_teacher_signature.png" class="signature">
                    <p>
                  </div>
                </div><hr>
                <div class="note row row-cols-1">
                  <p class="result_notes col gx-5">
                    NOTE: PM = Pass Marks, FM = Full Marks, F = Fail, TH = Theory, IN = Internal
                  </p>
                </div>
              </div>
            </div>
          </div>
          <div class="row row-cols-2 row-cols-md-2 d-flex justify-content-center">
            <button class="btn btn-primary col g-5" style="max-width:395px; margin:10px;" id="print_btn">Print</button>
            <button class="btn btn-primary col g-5" style="max-width:395px; margin:10px;">Download</button>
          </div>
          ';
}

function choose_data_from_section(){
  
}




if($type=="grade"){// This will fetch data for section//
    $_SESSION['grade_id'] = $id;
    $sql = "SELECT * FROM class_section WHERE class_id = '$id'";
    $query = mysqli_query($conn,$sql);   
    if(mysqli_num_rows($query)>0){
      $str = "<option value='0'>Choose Section</option>";
      while($row = mysqli_fetch_assoc($query)){
          $sect_id = $row['section_id'];
          $section_name = $row['section_name'];
          $str .= "<option value='{$sect_id}'>{$section_name}</option>";
      }
    }
}else if($type=="section"){// Getting all names from csv file
    $_SESSION['section_id'] = $id;
    $grade_id = $_SESSION['grade_id'];
    function col($sub,$data_type){
      switch($data_type){
        case "gp":// gets an column index of grade point
          $col_val = $_SESSION['attributes']["sub"][$sub]+13;
          break;
        case "tch":// gets an column index of theory credit hour
          $col_val = $_SESSION['attributes']["sub"][$sub]+3;
          break;
        case "pch":// gets an column index of practical credit hour
          $col_val = $_SESSION['attributes']["sub"][$sub]+8;
          break;
        case "th":// gets an column index of theory grade
          $col_val = $_SESSION['attributes']["sub"][$sub]+4;
          break;
        case "in"://gets an column index of Internal(pracical) grade
          $col_val = $_SESSION['attributes']["sub"][$sub]+9;
          break;
        case "fg"://gets an column index of final grade 
          $col_val = $_SESSION['attributes']["sub"][$sub]+12;
          break;
        case "rm":// gets an index of reamarks for each subject
          $col_val = $_SESSION['attributes']["sub"][$sub]+14;
          break;
      }
        return strval($col_val);
    }
    $_SESSION['attributes'] = array("term"=> "7","section"=>"6",
      "sn" => "0","name" => "3","dob" => "9",
      "sub" => array(11,27,43,59,75,91,107,123,123,123),
      "TCH" => array(col(0,"tch"),col(1,"tch"),col(2,"tch"),col(3,"tch"),col(4,"tch"),col(5,"tch"),col(6,"tch"),col(7,"tch"),col(8,"tch"),col(9,"tch")),
      "PCH" => array(col(0,"pch"),col(1,"pch"),col(2,"pch"),col(3,"pch"),col(4,"pch"),col(5,"pch"),col(6,"pch"),col(7,"pch"),col(8,"pch"),col(9,"pch"),col(10,"pch")),
      "TH" => array(col(0,"th"),col(1,"th"),col(2,"th"),col(3,"th"),col(4,"th"),col(5,"th"),col(6,"th"),col(7,"th"),col(8,"th"),col(9,"th"),col(10,"th")),
      "IN" => array(col(0,"in"), col(1,"in"),col(2,"in"),col(3,"in"),col(4,"in"),col(5,"in"),col(6,"in"),col(7,"in"),col(8,"in"),col(9,"in"),col(10,"in")),
      "rm" => array(col(0,"rm"),col(1,"rm"),col(2,"rm"),col(3,"rm"),col(4,"rm"),col(5,"rm"),col(6,"rm"),col(7,"rm"),col(8,"rm"),col(9,"rm")),
      "gp" => array(col(0,"gp"),col(1,"gp"),col(2,"gp"),col(3,"gp"),col(4,"gp"),col(5,"gp"),col(6,"gp"),col(7,"gp"),col(8,"gp"),col(9,"gp")),
      "fgrade" => array(col(0,"fg"),col(1,"fg"),col(2,"fg"),col(3,"fg"),col(4,"fg"),col(5,"fg"),col(6,"fg"),col(7,"fg"),col(8,"fg"),col(9,"fg")),
      "remarks" => "145",
      "om" => "27","percent" => "28","gpa" => "142","rank"=>"141","attendance"=>"144"
  );

    $section_id = $id;
    
    // Gettting the name of file
    if($section_id!=null || $section_id!=0){
        $file_sql = "SELECT * FROM result_files WHERE class_id = \"$grade_id\" AND section_id = \"$section_id\"";
    }else{
        $file_sql = "SELECT * FROM result_files WHERE class_id = \"$grade_id\";";
    }
    $file_result = mysqli_query($conn,$file_sql);
    $row = mysqli_fetch_assoc($file_result);
    $file_name = $row['file_name'];
    $_SESSION["file_name"] = $file_name;

    // Getting the name of section
    $sql = "SELECT section_name FROM class_section WHERE section_id='$section_id'";
    $result = mysqli_query($conn, $sql);
    $section_name = mysqli_fetch_assoc($result)['section_name'];

    $str = "<option selected>Choose Name</option>";
    $file = fopen("../../uploads/published_result/".$file_name, "r");
    $row_counter = 0;
    $entity = array();
    $total_subject = 1;
if($section_name=="Annapurna"){
    while (($data = fgetcsv($file)) !== false){//Viewing the content of CSV file.
        $col_counter = 0;
        $sn = $data[$_SESSION['attributes']['sn']];
        $current_section = $data[$_SESSION["attributes"]['section']];
        // Printing all data except column header
        if($row_counter>$data_start_after && $sn!=null){//Your entities of csv files
            $str .= "<option value='{$data[$_SESSION['attributes']['sn']]}'>{$sn} &nbsp;&nbsp;".$data[$_SESSION['attributes']['name']]."</option>";
        }else if($sn==null){
          break;
        }

        if($data[$_SESSION['attributes']['sn']]!=null){// SN is not empty so storing the data
          foreach($data as $a){
              $entity[$row_counter][$col_counter] = $a;
              $sub_col_indx = "SN".$total_subject;
              if($entity[$row_counter][$col_counter]==$sub_col_indx){
                $total_subject++;
              }
              $col_counter++;
              // $subject_title = "SN".$subject_counter;
          }
          $row_counter++;
        }
    }
}else if($section_name=="Sagarmatha"){
  echo "<script>alert(".$section_name.")</script>";
}
    $_SESSION["total_subject"] = $total_subject;
    $_SESSION["records"] = $entity;
    $_SESSION["subject_count"] = $total_subject;
    $_SESSION['num_records'] = $row_counter-$data_start_after-1;
    fclose($file);

}else if($type=="name"){
    $_SESSION['std_id'] = $id;
}else if($type=="dob"){
    $grade_id = $_SESSION["grade_id"];
    $section_id = isset($_SESSION["section_id"])?$_SESSION["section_id"]:"null";
    $std_id = $_SESSION["std_id"];
    $file_name = $_SESSION['file_name'];
    $entity = $_SESSION["records"];
    $dob = $id; 
    $attributes = $_SESSION['attributes']; 
 
    if($dob==$entity[$std_id][$attributes["dob"]]){// Validates whether the dob is correct or not
        $str = show_result(array($entity[0],$entity[$std_id]),$_SESSION['num_records'],$grade_id,$section_id,$conn,$attributes);
    }else{
        if(!empty($dob)){
            $str = $entity[$std_id][$attributes["dob"]]."<p class='display-6 d-flex justify-content-center'>".$dob." is not your birthday !</p>";
        }
    }
}


echo $str;
?>