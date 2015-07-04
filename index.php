<!DOCTYPE html>

<html>

<head>
	<!-- Bootstrap for css -->
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	
	<!-- Jquery for data extarction -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

	<title>Shipment Details</title>

</head>

<body>

<style type="text/css">
	.pad70{
		padding-top: 70px;
	}
	.mar15{
		margin-bottom: 15px;
		margin-top: 15px;
	}

</style>


	<div class="container pad70">
	<h2>Shipment Details</h2>
		<div class="row">
			<div class="col-xs-4"></div>
			<div class="col-xs-4">	
				<form>
			  
				  Select Provider: <select class="btn-default btn form-control mar15" name="provider" id="provider">
					  <option value="fedex">FedEx</option>
				  
				  Track Number: <input type="text" name="submit" class="btn-default mar15 form-control" id="num"><br>
				  
				  <input type="submit" value="Submit" class="btn btn-md btn-success form-group button" id="findDetails">

				</form>

				 <div id="success" class="alert alert-success"></div>
		         <div id="fail" class="alert alert-danger">Could not find details</div>
		         <div id="noNumber" class="alert alert-danger">enter a number </div>

			</div>	
			<div class="col-xs-4"></div>
		</div>	
	</div>	

</body>

<script type="text/javascript">
	$(document).ready(function(){
		$(".alert").hide();
	});

	 $("#findDetails").click(function(event){
      event.preventDefault();

      if($("#provider").val()!="")
      {
        $.get("shipment.php?provider="+$("#provider").val()+"&num="+$("#num").val(), function( data ){
          if(data == "")
          {
            $("#fail").fadeIn();
          }
          else
          {
            $("#success").html(data).fadeIn();
          }
        });
      }
      else
      {
        $("#noNumber").fadeIn();
      }
   });
</script>

</html>