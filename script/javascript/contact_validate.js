  $(document).ready(()=>{
      var name = $("#name");
      var email = $("#emailaddress");
      var message = $("#message");
    $("#message_form").on("submit",function(e){
      e.preventDefault();
      var error_count  = 0;
      if(name.val()==""){
        $("#nameHelp").addClass("text-danger");
        name.addClass("border-danger");
        $("#nameHelp").html("नाम अनिवायर्य छ ।");
        error_count++;
      }

      if(email.val()==""){
        $("#emailHelp").addClass("text-danger");
        email.addClass("border-danger");
        $("#emailHelp").html("इमेल ठेगाना अनिवायर्य छ ।");
        error_count++;
      }

      if(message.val()==""){
        $("#messageHelp").addClass("text-danger");
        message.addClass("border-danger");
        $("#messageHelp").html("सन्देश अनिवायर्य छ ।");
        error_count++;
      }

      if(error_count==0){
				$.ajax({
					url:"../admin/action/header_and_footer/data_inserter.php?mode=message_send",
					type:"POST",
					data:new FormData(this),
					contentType: false,
					cache:false,
					processData:false,
					success:function(data){
							alert(data);
					}	
				});
      }else{
        alert("Due to an error You can't send message");
      }
    });

    name.on("input",function(){
      if(name.val()!=""){
        $("#nameHelp").removeClass("text-danger");
        name.removeClass("border-danger");
        $("#nameHelp").html("नाम");
      }
    });

    message.on("input",function(){
      if(message.val()!=""){
        $("#messageHelp").removeClass("text-danger");
        message.removeClass("border-danger");
        $("#messageHelp").html("तपाँइकेा सन्देश");
      }
    });

    email.on("input",function(){
      if(email.val()!=""){
        $("#emailHelp").removeClass("text-danger");
        email.removeClass("border-danger");
        $("#emailHelp").html("इमेल ठेगाना");
      }
    });

  });