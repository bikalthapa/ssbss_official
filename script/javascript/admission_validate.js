$(document).ready(function(){
    $("#admission_form").on("submit",function(e){
        e.preventDefault();
        if($("#admission_policy").is(":checked")){
            if(admission_validation()){//Can upload
                alert("You Can Upload");
            }else{// Can't Upload
                alert("Please Fill All Fields Correctly");
            }
        }else{
            alert("Your must agree our admission policy to admit.");
        }
    });

    var fields = [$("#name"),$("#dob"),$("#temp_address"),$("#permanent_address"),
    $("#phoneOrEmail"),$("#father_name"),$("#mother_name"),$("#father_contact"),$("#mother_contact")
    ,$("#pre_school")];
    var total_validation = fields.length;

    var file_fields = [$("#birth_certificate"),$("#certificate")];


    // This function will find the description of inputs
    function descr_of(input_field){
        var attr = input_field.attr("aria-describedby");
        return $("#"+attr);
    }
    // This will validate whether input field is empty or not 
    function validate_inputs(message, input, describeby){
        if(input.val()==""){
            describeby.html(message);
            input.addClass(" border-danger");
            describeby.addClass(" text-danger");
            return false;
        }else{
            return true;
        }
    }
    // This function will validate files inputs
    function validate_files(){
        var error_count = 0;
        for(i = 0; i<file_fields.length; i++){// checks each file type
            file_field = file_fields[i];
            if(file_field[0].files.length!=0){
                var file = file_field[0].files;
                var f_type = file[0].type;
                var allowed_types = "image/jpeg";
                if(f_type!=allowed_types){
                    error_count++;
                    file_field.addClass(" border-danger");
                    file_field.attr("description",descr_of(file_field).html());
                    descr_of(file_field).addClass(" text-danger");
                    descr_of(file_field).html("Only jpeg format allowed");
                }
            }else{
                error_count++;
                    file_field.addClass(" border-danger");
                    file_field.attr("description",descr_of(file_field).html());
                    descr_of(file_field).addClass(" text-danger");
                    descr_of(file_field).html("Field Required");
            }
        }
        if(error_count==0){
            return true;
        }
        return false;
    }
    // This function will remove red colour from the input if it is not empty
    function field_oninput(input, describeby){
            if(input.hasClass("border-danger")){
                input.removeClass("border-danger");
                describeby.removeClass("text-danger");
                describeby.html(input.attr("description"));
                return true;
            }else{
                return false;
            }
    }
    // This function can be use to validate whole admission form fields except file inputs//
    function admission_validation(){
        var validation_error = 0;
        for(i = 0; i<total_validation; i++){
            var description_field = descr_of(fields[i]);
            fields[i].attr("description",description_field.html());
            var each_validation = validate_inputs("Field Required", fields[i], description_field);
            if(!each_validation){
                validation_error++;
            }
        }
        var file_validation = validate_files();
        if(validation_error==0 && file_validation){
            return true;
        }
        return false;
    }

    
    // This block will add events to each input fields when input
    var admission_inputs = document.getElementsByClassName("admit_field");
    var i = 0;
    for(admission_input of admission_inputs){
        admission_input.addEventListener("input",(e)=>{
            var choosen_element = $("#"+e.target.id);
            field_oninput(choosen_element , descr_of(choosen_element));
        });
    };
});