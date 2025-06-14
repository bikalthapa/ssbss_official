<?php
include "script/php_scripts/database.php";
include "result_design/design1.php";
session_start();
$id = $_POST['id'];
$type = $_POST['type'];
$str = "";


  //Variable configuration for result form
  $data_start_after = 0;

// It will return the design of marksheet
function show_result($data, $total_students,$grade_id, $section_id,$conn,$attributes){
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
      $term = $data[1][$attributes["TERM"]];
      $student_name = $data[1][$attributes["NAME"]];
      $rank = $data[1][$attributes["PRNK"]];
      $attendance = $data[1][$attributes["ATT"]];
      $remarks = $data[1][$attributes["RS"]];
      $gpa = $data[1][$attributes["GPA"]];
      $symbol_no = $data[1][$attributes["SYM"]];
    for($i = 1; $i<$_SESSION['total_subject'];$i++){
      $sub_name = $data[1][$attributes["SN".$i]];
      $tch = intval($data[1][$attributes["THC".$i]]);
      $pch = intval($data[1][$attributes["INC".$i]]);
      $theory_grade = $data[1][$attributes["TGR".$i]];
      $internal_grade = $data[1][$attributes["IGR".$i]];
      $fgrade = $data[1][$attributes["GR".$i]];
      $each_rm = $data[1][$attributes["S".$i]];
      $gp = $data[1][$attributes["GP".$i]];
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
  return get_marksheet($term,$student_name,$grade_name,$symbol_no,$row,$gpa,$rank,$total_students,$remarks,$attendance,2080,"");
}

// It will return the names of student
function get_names($file_name,$section){
      $str = "<option>Choose Name</option>";
      $file = fopen("../../uploads/published_result/".$file_name, "r");
      $entity = array();
      global $data_start_after;
      $total_subject = 1;
      $row_counter = 0;
      $current_mode_for_sagarmatha = "ignore";
      while (($data = fgetcsv($file)) !== false){//Viewing the content of CSV file.
          $col_counter = 0;
          if($data[0]!=null){// SN is not empty so storing the data
            foreach($data as $a){
                $entity[$row_counter][$col_counter] = $a;
                $sub_col_indx = "SN".$total_subject;
                if($row_counter<=$data_start_after){
                  if($entity[$row_counter][$col_counter]==$sub_col_indx){
                    $total_subject++;
                  }
                  $_SESSION['attributes'][$a] = $col_counter;
                }
                $col_counter++;
            }
          }

          $sn = $data[$_SESSION['attributes']['SN']];
          // Printing all data except column header
          if($section=="Annapurna"){//Annapurna
            if($row_counter>$data_start_after && $sn!=null){//Your entities of csv files
                $str .= "<option value='{$sn}'>{$sn} &nbsp;&nbsp;".$data[$_SESSION['attributes']['NAME']]."</option>";
            }else if($sn==null){
              break;
            }
          }else if($section=="Sagarmatha"){
            if($sn==null){// SN is empty
              $current_mode_for_sagarmatha = "display";
            }else{// SN is not empty
              if($current_mode_for_sagarmatha=="display"){
                $str .= "<option value='{$sn}'>{$sn} &nbsp;&nbsp;".$data[$_SESSION['attributes']['NAME']]."</option>";
              }else{
                continue;
              }
            }
          }else{
            if($row_counter>$data_start_after && $sn!=null){//Your entities of csv files
                $str .= "<option value='{$sn}'>{$sn} &nbsp;&nbsp;".$data[$_SESSION['attributes']['NAME']]."</option>";
            }else if($sn==null){
              break;
            }
          }
        $row_counter++;
      } 
  // Storing the variables for further use
    $_SESSION["total_subject"] = $total_subject;
    $_SESSION["records"] = $entity;
    $_SESSION["subject_count"] = $total_subject;
    $_SESSION['num_records'] = $row_counter-$data_start_after-1;
    fclose($file);
    return $str;
}



if($type=="title"){// When the title is choosen//
  $_SESSION['term'] = $id;
}else if($type=="year"){// When the year is choosen class is going to be displayed//
  $_SESSION['year'] = $id;
}else if($type=="grade_load"){// loads all available grades in the database
    $sql = "SELECT * FROM class;";
    $result = mysqli_query($conn, $sql);
    if($result){
      $str .= "<option value='0'>Choose Class </option>";
        while($row = mysqli_fetch_assoc($result)){
            $classname = $row['class_name'];
            $id = $row['class_id'];
            $str .= "<option value='{$id}'>{$classname}</option>";
        }
    }
}else if($type=="grade"){//When the Grade is changed section is going to be displayed//
    $_SESSION['grade_id'] = $id;
    $sql = "SELECT * FROM class_section WHERE class_id = '$id'";
    $query = mysqli_query($conn,$sql);

    if(mysqli_num_rows($query)>0){//Grade Contains At least one section so printing section as option
      $str = "<option value='0'>Choose Section</option>";
      while($row = mysqli_fetch_assoc($query)){
          $sect_id = $row['section_id'];
          $section_name = $row['section_name'];
          $str .= "<option value='{$sect_id}'>{$section_name}</option>";
      }
    }else{// Grade doesn't contains section so setting str = "" (Useful for accessing names directly in ajax)
      $str .= "";
    }
}else if($type=="section"){//When the Section is changed name is going to be displayed//
    $_SESSION['section_id'] = $id;
    $grade_id = $_SESSION['grade_id'];
    $section_id = $id;
    $term = $_SESSION['term'];
    $published_year = $_SESSION['year'];
    
    // Gettting the name of file from the database
    $file_sql = "SELECT * FROM result_files WHERE class_id = \"$grade_id\" AND term = \"$term\" AND published_year = \"$published_year\"";
    $file_result = mysqli_query($conn,$file_sql);
    if(mysqli_num_rows($file_result)>0){// Result is published
      $row = mysqli_fetch_assoc($file_result);
      $file_name = $row['file_name'];
      $_SESSION["file_name"] = $file_name;

      // Getting the name of section
      if($section_id!=0){// choosen class contains section so getting the name of section from the database 
        $sql = "SELECT section_name FROM class_section WHERE section_id='$section_id'";
        $result = mysqli_query($conn, $sql);
        $section_name = mysqli_fetch_assoc($result)['section_name'];
      }else{
        $section_name = 0;
      }
      // This function will returns the list of name according to section
      $str .= get_names($file_name, $section_name);
    }else{// Result is not published 
      $str .= "<option>Not Published Yet</option>";
    }
}else if($type=="name"){// When the name is changed date of birth is going to be displayed //
    $_SESSION['std_id'] = $id;
}else if($type=="dob"){// Validation of DOB
    $grade_id = $_SESSION["grade_id"];
    $section_id = isset($_SESSION["section_id"])?$_SESSION["section_id"]:"null";
    $std_id = $_SESSION["std_id"];
    $file_name = $_SESSION['file_name'];
    $entity = $_SESSION["records"];
    $dob = $id; 
    $attributes = $_SESSION['attributes']; 
    if($dob!=$entity[$std_id][$attributes["DOB"]]){// Validates whether the dob is correct or not
        $str = show_result(array($entity[0],$entity[$std_id]),$_SESSION['num_records'],$grade_id,$section_id,$conn,$attributes);
    }else{
        if(!empty($dob)){
            $str = $entity[$std_id][$attributes["dob"]]."<p class='display-6 d-flex justify-content-center'>".$dob." is not your birthday !</p>";
        }
    }
}


echo $str;
?>