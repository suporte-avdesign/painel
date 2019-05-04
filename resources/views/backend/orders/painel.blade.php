<!DOCTYPE html>
<html class="no-js" lang="{{ app()->getLocale() }}">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

	<title>{{ config('app.name', 'Fabiola Pezzi') }}</title>

	<!-- For all browsers -->
	<link rel="stylesheet" href="{{url('assets/backend/css/reset.css')}}">
	<link rel="stylesheet" href="{{url('assets/backend/css/style.css')}}">
	<link rel="stylesheet" href="{{url('assets/backend/css/colors.css')}}">
	<link rel="stylesheet" media="print" href="{{url('assets/backend/css/print.css')}}">
	<!-- For progressively larger displays -->
	<link rel="stylesheet" media="only all and (min-width: 480px)" href="{{url('assets/backend/css/480.css')}}">
	<link rel="stylesheet" media="only all and (min-width: 768px)" href="{{url('assets/backend/css/768.css')}}">
	<link rel="stylesheet" media="only all and (min-width: 992px)" href="{{url('assets/backend/css/992.css')}}">
	<link rel="stylesheet" media="only all and (min-width: 1200px)" href="{{url('assets/backend/css/1200.css')}}">


	<!-- For Retina displays -->
	<link rel="stylesheet" media="only all and (-webkit-min-device-pixel-ratio: 1.5), only screen and (-o-min-device-pixel-ratio: 3/2), only screen and (min-device-pixel-ratio: 1.5)" href="{{url('assets/backend/css/2x.css')}}">

	<!-- Webfonts -->
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:300' rel='stylesheet' type='text/css'>
	
	<link rel="stylesheet" href="{{url('assets/backend/css/font-awesome/css/font-awesome.css')}}">


	<!-- Additional styles -->
	<link rel="stylesheet" href="{{url('assets/backend/css/styles/agenda.css')}}">
	<link rel="stylesheet" href="{{url('assets/backend/css/styles/dashboard.css')}}">
	<link rel="stylesheet" href="{{url('assets/backend/css/styles/form.css')}}">
	<link rel="stylesheet" href="{{url('assets/backend/css/styles/modal.css')}}">
	<link rel="stylesheet" href="{{url('assets/backend/css/styles/progress-slider.css')}}">
	<link rel="stylesheet" href="{{url('assets/backend/css/styles/switches.css')}}">
	<link rel="stylesheet" href="{{url('assets/backend/css/styles/files.css')}}">
	<link rel="stylesheet" href="{{url('assets/backend/css/styles/table.css')}}">
	<!-- iOS web-app metas -->
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">

	<script src="{{url('assets/backend/js/libs/DataTables/jquery.dataTables.js')}}"></script>


</head>

<body class="clearfix with-menu with-shortcuts">

<div class="wrapped margin-bottom">
	<h4 class="no-margin-bottom">
		<span class="float-right">Pedido: 1234556 </span>
		<img src="{{asset('assets/backend/img/logo/logo-pdf.png')}}" width="50px">
	</h4>
	{{env('DT_ADDRESS')}} - {{env('DT_DISTRICT')}} - {{env('DT_CITY')}}-{{env('DT_STATE')}}
	<span class="float-right"> Data: 07/07/2018 14:35</span>
	<div class="underline"></div>
	<h4 class="no-margin-bottom">{{env('DT_NAME')}}  </h4>
	{{env('DT_ADDRESS')}} - {{env('DT_DISTRICT')}} - {{env('DT_CITY')}}-{{env('DT_STATE')}}
	<span class="float-right"> Data: 07/07/2018 14:35</span>
</div>
<table class="table responsive-table" id="datatables">

	<thead>
	<tr>
		<th scope="col"width="10%"></th>
		<th scope="col">Descrição</th>
		<th scope="col" width="10%" class="align-center">qtd</th>
		<th scope="col" width="30%" class="align-right">SubTotal</th>
	</tr>
	</thead>

	<tbody>
	<tr>
		<td></td>
		<td>
			Name: John Doe<br>
			Account: admin
		</td>
		<td class="align-center">28</td>
		<td class="align-right">$9.99</td>
	</tr>
	<tr>
		<td></td>
		<td>
			Name: John Doe<br>
			Account: admin
		</td>
		<td class="align-center">28</td>
		<td class="align-right">$9.99</td>
	</tr>
	<tr>
		<td></td>
		<td>
			Name: John Doe<br>
			Account: admin
		</td>
		<td class="align-center">28</td>
		<td class="align-right">$9.99</td>
	</tr>
	<tr>
		<td></td>
		<td>
			Name: John Doe<br>
			Account: admin
		</td>
		<td class="align-center">28</td>
		<td class="align-right">$9.99</td>
	</tr>
	<tr>
		<td></td>
		<td>
			Name: John Doe<br>
			Account: admin
		</td>
		<td class="align-center">28</td>
		<td class="align-right">$9.99</td>
	</tr>

	<tr>
		<td colspan="3"></td>
		<td class="align-right">
			<p><b>SubToral:</b> R$ 123,00</p>
			<p><b>Frete:</b> R$ 123,00</p>


		</td>
	</tr>


	</tbody>

</table>

</body>
</html>