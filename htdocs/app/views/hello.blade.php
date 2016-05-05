<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<title>Queue App</title>

	<!-- Bootstrap -->
	<link href="css/bootstrap.min.css" rel="stylesheet">

	<!-- Style -->
	<link href="css/style.css" rel="stylesheet">

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body>
<h1>Queue App</h1>

<div class="container-fluid">
    <div class="row-fluid">
        <div class="alert alert-success col-md-12" role="alert">You have joined the queue successfully.</div>
        <div class="alert alert-danger col-md-12" role="alert">Error.</div>
    </div>
	<div class="row-fluid">
		<div class="col-md-6">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">New Customer</h3>
				</div>
				<div class="panel-body">
					<form id="form">
                        @foreach ($services as $service)
						<div class="radio">
							<label>
								<input type="radio" name="service" id="{{str_replace(" ", "-", $service->service_name)}}" value="{{$service->id}}" @if($service->id == 1) {{"checked"}} @endif>
								{{ucwords($service->service_name)}}
							</label>
						</div>
					    @endforeach

						<div class="btn-group" data-toggle="buttons">
							<label class="btn btn-primary active">
								<input type="radio" name="customerType" id="citizen" autocomplete="off" checked value="citizen"> Citizen
							</label>
							<label class="btn btn-primary">
								<input type="radio" name="customerType" id="organisation" autocomplete="off" value="organisation"> Organisation
							</label>
							<label class="btn btn-primary">
								<input type="radio" name="customerType" id="anonymous" autocomplete="off" value="anonymous"> Anonymous
							</label>
						</div>

						<fieldset class="form-group">
							<label for="title">Title</label>
							<select class="form-control" id="title" name="title">
								<option>Mr.</option>
								<option>Mrs.</option>
								<option>Miss</option>
								<option>Ms.</option>
								<option>Dr.</option>
							</select>
						</fieldset>

						<fieldset class="form-group">
							<label for="firstName">First Name</label>
							<input type="text" class="form-control" id="firstName" name="firstName" placeholder="First Name">
						</fieldset>

						<fieldset class="form-group">
							<label for="lastName">Last Name</label>
							<input type="text" class="form-control" id="lastName" name="lastName" placeholder="Last Name">
						</fieldset>

                        <fieldset class="form-group" id="organisation-section">
                            <label for="organisation">Organisation</label>
                            <input type="text" class="form-control" id="organisation" name="organisation" placeholder="Organisation">
                        </fieldset>

						<button type="submit" class="btn btn-primary">Submit</button>
					</form>
				</div>
			</div>
		</div>

		<div class="col-md-6">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Queue</h3>
				</div>
				<div class="panel-body">
					<div class="bs-example" data-example-id="simple-table">
						<table class="table">
							<caption>
								List of customers being queued
							</caption>
							<thead>
							<tr>
								<th>#</th>
								<th>Type</th>
								<th>Name</th>
								<th>Service</th>
								<th>Queued at</th>
							</tr>
							</thead>
							<tbody>
                            @foreach ($customerQueues as $customerQueue)
							<tr>
								<th scope="row">{{$customerQueue['id']}}</th>
								<td>{{ucwords($customerQueue['customer_type'])}}</td>
								<td>{{$customerQueue['name']}}</td>
								<td>{{ucwords($customerQueue['service_name'])}}</td>
								<td>{{date('h:i', strtotime($customerQueue['queued_at']))}}</td>
							</tr>
                            @endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>
<script src="js/app.js"></script>
</body>
</html>
