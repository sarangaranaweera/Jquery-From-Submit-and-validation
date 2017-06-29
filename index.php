<!DOCTYPE html>
<html>
<head>
	<title></title>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script type="text/javascript" src="jquery.validate.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" ></script>


	<style type="text/css">
		
		
		.error {
		    /*color: #d9534f;*/
		    color: #a94442;
    		background-color: #f2dede;
    		border: 1px solid #ebccd1;
    		display: block;
    		padding: 5px;
    		width: 100%;

		}

		label{
			
			display: inline-block;
		    max-width: 100%;
		    margin-bottom: 5px;
		    font-weight: bold;
		}
		label.error {
    		font-size: 10px;
    		padding-top: 3px;
		}
		input.txtBox {
		  border:2px solid red;
		}

	</style>
</head>
<body>

<form action="response.php" method="POST" id="myForm">

<div class="row">
<div class="col-md-2 form-element">
        <div class="form-group">
	Name: <input type="text" name="name[]"  >
	</div>
</div>
<div class="col-md-2 form-element">
        <div class="form-group">
	Name: <input type="text" name="name[]"  >
	</div>
</div>
<div class="col-md-2 form-element">
        <div class="form-group">
	Name: <input type="text" name="name[]"  >
	</div>
</div>


<div class="col-md-2 form-element">
        <div class="form-group">
	Age: <input type="number" name="age" id="age">
	</div>
</div>
</div>
	<input type="submit" >
</form>
<script type="text/javascript">
	$(document).ready(function () {
		$("#loading").hide();

     $("#myForm").validate({
         ignore: ":hidden",
         rules: {
             "name[]": {
                 required: true,
                 minlength: 3,
                 number:true
             },
             age: {
                 required: true,
                 remote: {
                 	url:"validate.php",
                 	method:"post",
                 	data:{
                 		age: function(){
                 			return $('#age').val();
                 		}

                 	}
                 }
          
             }
         },
         messages:
             {
                 age:
                 {
                    // required: "Please enter your email address.",
                    // email: "Please enter a valid email address.",
                    remote: jQuery.validator.format("{0} is already taken.")
        }
        },
        errorPlacement: function(label, element) {
        	label.addClass('arrow');
        	label.insertAfter(element);
    	},
         submitHandler: function (form) {
         	//form.prevenDefault();
             $.ajax({
                 type: "POST",
                 url: $( '#myForm' ).attr( 'action' ),
                 data: $(form).serialize(),
                beforeSend: function(){
     				$("#loading").show();
   				 },
				complete: function(){
				     $("#loading").hide();
				},
                 success: function (data) {
                    $('#insert').html(data);
                 }
             });
             return false; // required to block normal submit since you used ajax
         }
     });
    //   $("[name^=name]").each(function () {
    //     $(this).rules("add", {
    //         required: true
           
    //     });
    // });
   
// jQuery.validator.setDefaults({
//     errorPlacement: function(error, element) {
//         error.appendTo(element.prev());
//     }
// });


 });
</script>
<div id="loading">Loading...</div>
<div id="insert">Loading...</div>
</body>

</html>


      <!--       <label class="control-label">First Name</label>
            <input type="text" class="form-control error" name="first_name" value="" aria-required="true" aria-invalid="true">
        <label id="first_name-error" class="error" for="first_name">This field is required.</label></div>
    </div> -->