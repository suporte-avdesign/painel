<!DOCTYPE html>
<html class="no-js" lang="{{ app()->getLocale() }}">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

	<title>{{ config('app.name', 'Fabiola Pezzi') }}</title>
	<meta name="description" content="">
	<meta name="author" content="">
    <meta name="avdUrl" content="{{url('')}}">
    <meta name="base" content="{{url('')}}">

	<!-- http://davidbcalhoun.com/2010/viewport-metatag -->
	<meta name="HandheldFriendly" content="True">
	<meta name="MobileOptimized" content="320">

	<!-- http://www.kylejlarson.com/blog/2012/iphone-5-web-design/ and http://darkforge.blogspot.fr/2010/05/customize-android-browser-scaling-with.html -->
	<meta name="viewport" content="user-scalable=0, initial-scale=1.0, target-densitydpi=115">

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
	
	<!-- Color Picker group_colors-->
	<link rel="stylesheet" href="{{url('assets/backend/css/styles/avd.colorpicker.css')}}">





	<!-- JavaScript at bottom except for Modernizr -->
	</script><script src="{{url('assets/backend/js/libs/modernizr.custom.js')}}"></script>

	<!-- For Modern Browsers -->
	<link rel="shortcut icon" href="{{url('assets/backend/img/favicons/favicon.png')}}">
	<!-- For everything else -->
	<link rel="shortcut icon" href="{{url('assets/backend/img/favicons/favicon.ico')}}">

	<!-- iOS web-app metas -->
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">

	<!-- iPhone ICON -->
	<link rel="apple-touch-icon" href="{{url('assets/backend/img/favicons/apple-touch-icon.png')}}" sizes="57x57">
	<!-- iPad ICON -->
	<link rel="apple-touch-icon" href="{{url('assets/backend/img/favicons/apple-touch-icon-ipad.png')}}" sizes="72x72">
	<!-- iPhone (Retina) ICON -->
	<link rel="apple-touch-icon" href="{{url('assets/backend/img/favicons/apple-touch-icon-retina.png')}}" sizes="114x114">
	<!-- iPad (Retina) ICON -->
	<link rel="apple-touch-icon" href="{{url('assets/backend/img/favicons/apple-touch-icon-ipad-retina.png')}}" sizes="144x144">

	<!-- iPhone SPLASHSCREEN (320x460) -->
	<link rel="apple-touch-startup-image" href="{{url('assets/backend/img/splash/iphone.png')}}" media="(device-width: 320px)">
	<!-- iPhone (Retina) SPLASHSCREEN (640x960) -->
	<link rel="apple-touch-startup-image" href="{{url('assets/backend/img/splash/iphone-retina.png')}}" media="(device-width: 320px) and (-webkit-device-pixel-ratio: 2)">
	<!-- iPhone 5 SPLASHSCREEN (640×1096) -->
	<link rel="apple-touch-startup-image" href="{{url('assets/backend/img/splash/iphone5.png')}}" media="(device-height: 568px) and (-webkit-device-pixel-ratio: 2)">
	<!-- iPad (portrait) SPLASHSCREEN (748x1024) -->
	<link rel="apple-touch-startup-image" href="{{url('assets/backend/img/splash/ipad-portrait.png')}}" media="(device-width: 768px) and (orientation: portrait)">
	<!-- iPad (landscape) SPLASHSCREEN (768x1004) -->
	<link rel="apple-touch-startup-image" href="{{url('assets/backend/img/splash/ipad-landscape.png')}}" media="(device-width: 768px) and (orientation: landscape)">
	<!-- iPad (Retina, portrait) SPLASHSCREEN (2048x1496) -->
	<link rel="apple-touch-startup-image" href="{{url('assets/backend/img/splash/ipad-portrait-retina.png')}}" media="(device-width: 1536px) and (orientation: portrait) and (-webkit-min-device-pixel-ratio: 2)">
	<!-- iPad (Retina, landscape) SPLASHSCREEN (1536x2008) -->
	<link rel="apple-touch-startup-image" href="{{url('assets/backend/img/splash/ipad-landscape-retina.png')}}" media="(device-width: 1536px)  and (orientation: landscape) and (-webkit-min-device-pixel-ratio: 2)">

	<!-- Microsoft clear type rendering -->
	<meta http-equiv="cleartype" content="on">

	<!-- IE9 Pinned Sites: http://msdn.microsoft.com/en-us/library/gg131029.aspx -->
	<meta name="application-name" content="Developr Admin Skin">
	<meta name="msapplication-tooltip" content="Cross-platform admin template.">
	<meta name="msapplication-starturl" content="http://www.display-inline.fr/demo/developr">
	<!-- These custom tasks are examples, you need to edit them to show actual pages -->
	<meta name="msapplication-task" content="name=Agenda;action-uri=http://www.display-inline.fr/demo/developr/agenda.html;icon-uri=http://www.display-inline.fr/demo/developr/img/favicons/favicon.ico">
	<meta name="msapplication-task" content="name=My profile;action-uri=http://www.display-inline.fr/demo/developr/profile.html;icon-uri=http://www.display-inline.fr/demo/developr/img/favicons/favicon.ico">
</head>

<body class="clearfix with-menu with-shortcuts">


	<!-- Title bar -->
	<header role="banner" id="title-bar">
		<h2>Admin</h2>
	</header>

	<!-- Button to open/hide menu -->
	<a href="javascript:void(0)" id="open-menu"><span>Menu</span></a>

	<!-- Button to open/hide shortcuts -->
	<a href="javascript:void(0)" id="open-shortcuts"><span class="icon-thumbs"></span></a>

	<!-- Main content -->
	<section role="main" id="main">
		@yield('content')
	</section>
	<!-- End main content -->

	<!-- Side tabs shortcuts -->
	@include('backend.includes.shortcuts.index')
	<!-- Sidebar/drop-down menu -->
	@include('backend.includes.sidebar.index')

	<!-- Scripts -->
	<script src="{{url('assets/backend/js/libs/jquery/jquery-3.2.1.min.js')}}"></script>
	<script src="{{url('assets/backend/js/setup.js')}}"></script>
	<!-- functions models -->
	<script src="{{url('assets/backend/js/avd.functions.js')}}?{{time()}}"></script>

	<!-- Template functions -->
	<script src="{{url('assets/backend/js/avd.input.js')}}"></script>
	<script src="{{url('assets/backend/js/avd.message.js')}}"></script>
	<script src="{{url('assets/backend/js/avd.modal.js')}}"></script>
	<script src="{{url('assets/backend/js/avd.navigable.js')}}"></script>
	<script src="{{url('assets/backend/js/avd.notify.js')}}"></script>
	<script src="{{url('assets/backend/js/avd.scroll.js')}}"></script>
	<script src="{{url('assets/backend/js/avd.accordions.js')}}"></script>
	<script src="{{url('assets/backend/js/avd.progress-slider.js')}}"></script>
	<script src="{{url('assets/backend/js/avd.tooltip.js')}}"></script>
	<script src="{{url('assets/backend/js/avd.confirm.js')}}"></script>
	<script src="{{url('assets/backend/js/avd.agenda.js')}}"></script>
	<script src="{{url('assets/backend/js/avd.content-panel.js')}}"></script>
	<!-- Deve ser carregado por último -->
	<script src="{{url('assets/backend/js/avd.tabs.js')}}"></script>

	<!-- Color Picker group_colors-->
	<script src="{{url('assets/backend/js/avd.colorpicker.js')}}"></script>

	<!-- Tinycon -->
	<script src="{{url('assets/backend/js/libs/tinycon.min.js')}}"></script>
	<!-- Hashchange '#' polyfill -->
	<script src="{{url('assets/backend/js/libs/jquery.ba-hashchange.js')}}"></script>
	<!-- Handlebars template-script -->
	<script src="{{url('assets/backend/js/libs/Handlebars/handlebars.js')}}"></script>


	<!-- DataTables -->
	<script src="{{url('assets/backend/js/libs/DataTables/jquery.dataTables.js')}}"></script>
	<script src="{{url('assets/backend/js/libs/DataTables/extensoes/dataTables.buttons.js')}}"></script>
	<script src="{{url('assets/backend/js/libs/DataTables/extensoes/buttons.colVis.js')}}"></script>
	<script src="{{url('assets/backend/js/libs/DataTables/extensoes/buttons.server-side.js')}}"></script>

	@stack('javascript')

	<script>

		// Iniciação do template de chamada (opcional, mais rápido se for chamado manualmente)
		$.template.init();

		// Favicon count
		Tinycon.setBubble(2);

		// Se o navegador suportar a API de notificação, peça permissão ao usuário (Com um pouco de delay)
		if (notify.hasNotificationAPI() && notify.isNotificationPermissionSet())
		{
			setTimeout(function()
			{
				notify.showNotificationPermission('Seu navegador suporta notificações na área de trabalho, clique aqui para habilitá-las.', function()
				{
					// Mensagem de confirmação
					if (notify.hasNotificationPermission())
					{
						notify('API de notificações ativada!', 'Agora você pode ver notificações mesmo quando o aplicativo está em segundo plano', {
							icon: "{{url('assets/backend/img/demo/icon.png')}}",
							system: true
						});
					}
					else
					{
						notify('Notifications API disabled!', 'Desktop notifications will not be used.', {
							icon: "{{url('assets/backend/img/demo/icon.png')}}"
						});
					}
				});

			}, 2000);
		}
	</script>

	<!-- Javascript Deflaut -->
	<script>
		/**
		 * Hash Change dos menus
		 * @attr navigable, collapsible
		 * @return win.hashchange()
		*/
		var win = $(window),
		    bod = $(document.body),
		    main = $('#main'),
		    init = false;

		    bod.removeClass('current navigable-current');
		// Ajax navigation
		$(document).on('click', 'a', function(event){
		    var link = $(this),
		        href = link.attr('href'),
		        docmenu,
		        shortcuts;

		    // Alguns elementos do doc não deve ser processado
		    if (link.closest('#main').length > 0 && link.closest('.navigable, .collapsible').length > 0){
		        return;
		    }
		    // Se o link é local
		    if (href && !href.match(/^(https?:|#|\.\/|javascript:)/)){
		        event.preventDefault();
		        window.location.hash = '#'+href;
		        // Se clicar no menu adicionar indicador
		        docmenu = link.closest('#doc-menu');
		        shortcuts = link.closest('#shortcuts');
		        if (docmenu.length > 0){
		            docmenu.find('.current').removeClass('current');
		            link.addClass('current');
		        }
		        if (shortcuts.length > 0){
		            shortcuts.find('.current').removeClass('current');
		            link.parent().addClass('current');
		        }

		    }


		});


		// Listen para hash changes
		win.hashchange(function(event){
		    var hash = $.trim(window.location.hash || '');
		    if (hash.length > 1){
		        main.load(hash.substring(1), function(){
		            //prettyPrint();
		            if (init){
		                bod.animate({scrollTop: 0});
		            }
		        });
		    } else {
		        window.location.reload();
		    }
		});
		// Init
		if (window.location.hash && window.location.hash.length > 1){
		    win.hashchange();
		}

		init = true; 
	</script>

	<!-- Verificar  versão -->
    <script src="{{url('assets/backend/js/version.js')}}"></script>
	<script>
		// Versão Atual
		var thisVersion = 1.71;
		if (currentVersion)
		{
			if (currentVersion > thisVersion)
			{
				$('#intro').message('Uma nova versão do modelo está disponível! Clique aqui para ir para a sua página de download &raquo;', {
					node:		'a',
					link:		'https://www.avdesign.com.br/',
					classes:	['align-center', 'blue-gradient'],
					position:	'bottom',
					append:		false
				});
			}
			else
			{
				$('#intro').message('Você possui a versão mais recente do sistema', {
					classes:	['align-center', 'green-gradient'],
					position:	'bottom',
					append:		false
				});
			}
		}
		else
		{
			$('#intro').message('Erro ao verificar a versão atual do sistema', {
				classes:	['align-center', 'red-gradient'],
				position:	'bottom',
				append:		false
			});
		}
	</script>

</body>
</html>