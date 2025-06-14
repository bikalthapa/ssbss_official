<?php
	function get_marksheet($term,$name,$grade,$symbol_no,$marks_row,$gpa,$rank,$tot_std,$res,$att,$date,$sig_src){ 
?>
	<style>
    .header{
      position: relative;
    }

    .header .logo{
      height: 37%;
      width: 14%;
      border: 2px solid black;
      border-radius: 100%;
      z-index: -1;
      margin: auto;
      position: absolute;
      left: 4%;
      top: 19%;
    }
    .details_data{
      font-weight: 800;
      color: black;
    }
    .details{
      font-size: 60%;
    }
    td, th{
      border: 1px solid black;
    }
    .design1{
    	font-size: 1.3em;
      padding: 10px;
      max-height: 1600px;
      max-width: 650px;
      border: 2px solid blue;
      border-style: dashed;
      margin: 15px;
      margin: auto;
    }
    .GS{
		font-size:93%;
      	font-weight: 800px;
		margin-top:-15px;
    }
    .head_para{
      z-index: 1;
    }
    .school_name{
    	font-size: 1.2em;
      font-weight:700;
	  	margin:auto;
      text-transform: uppercase;
    }
    .address{
      font-size: 90%;
      font-weight: bold;
    }
    .examination_title{
      font-size: 93%;
      font-weight: bold;
      margin-top: -20px;
  	}
		.grade_sheet_table{
			font-size:1em;
			margin:auto;
		}
    .signature{
      max-height: 10%;
      max-width: 30%;
    }
    #grade_sheet{
        margin:10px;
    }
    .note{
    	border-top: 1px solid black;
    }
	</style>
	<div class="design1 d-flex justify-contents-center" id="design1">
		<div class="row" style="width:100%; margin:0px;">
		  <div class="text-center header" style="width:100%">
			<img src="../../../images/slogo.png" class="logo">
			<div class="head_para" style="width:100%">
			  <p class="text-primary school_name">Shree Shanti Bhagwati Secondary School</p>
			  <p class="address">LETANG-4, MORANG<br>ESTD 2009</p>
			  <p class="examination_title"><?php echo $term; ?></p>
			  <p class="GS text-danger">GRADE SHEET</p>
			</div>
		  </div>
		  <div class="details">
			<div class="row">
			  <div class="col-sm-5">
				Name : <span class="details_data"><?php echo $name; ?></span><br>
			  </div>
			  <div class="col-sm-4">
				Grade : <span class="details_data"><?php echo $grade; ?></span>
			  </div>
			  <div class="col-sm-3">
				Symbol No : <span class="details_data"><?php echo $symbol_no; ?></span>
			  </div>
			</div>
			<table border="1"  cellspacing="0" cellpadding="5" class="text-center grade_sheet_table" style="margin:auto; width:100%;">
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
			  <?php echo $marks_row;?>
			  <tr class="text-primary">
				<th></th>
				<th colspan="4" style="text-align:left;">GPA: <span class="details_data"><?php echo $gpa; ?></span></th>
				<th colspan="4" style="text-align:left;">Rank :<span class="details_data"><?php echo $rank; ?></span> </th>
			  </tr>
			</table>
			<div class="result_conclusion row row-cols-2">
			  <div class="col gy-2 gx-5">
				<p class="total_students">TOTAL STUDENTS :<span class="details_data">10</span></p>
				<p class="remarks">RESULT :<span class="details_data"><?php echo $res; ?></span></p>
			  </div>
			  <div class="col gy-2 gx-5">
				<p class="attendance">ATTENDANCE : <span class="details_data"><?php echo $att; ?></span></p>
				<p class="date_of_issue">DATE OF ISSUE :<span class="details_data"><?php echo $date; ?></span></p>
			  </div>
			</div>
			<div class="result_footer row row-cols-2">
			  <div class="col gy-0 gx-5">
					<p class="class_teacher">CLASS TEACHER : </p>
			  </div>
			  <div class="col gy-2 gx-5" style="margin-top:-5px;">
					<p class="head_teacher">HEAD TEACHER : 
					  <img src="../../../images/head_teacher_signature.png" class="signature">
					<p>
			  </div>
			</div>
			<div class="note row row-cols-1">
			  <p class="result_notes col gx-5">
				NOTE: PM = Pass Marks, FM = Full Marks, F = Fail, TH = Theory, IN = Internal
			  </p>
			</div>
		  </div>
		</div>
	  </div>
<?php
}
?>