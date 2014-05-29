<!DOCTYPE HTML>

<html>
	<head>
			<meta charset="utf-8">
			
			<title>EuroSanteh.by</title>

	        <link href="/css/main.css" rel="stylesheet" type="text/css">
			<link href="/css/cart.css" rel="stylesheet" type="text/css">
			<link href="/css/navigation.css" rel="stylesheet" type="text/css">
			<link href="/css/product_list.css" rel="stylesheet" type="text/css">
			<link href="/css/about.css" rel="stylesheet" type="text/css">
			<link href="/css/dostavka.css" rel="stylesheet" type="text/css">
			<link href="/css/table.css" rel="stylesheet" type="text/css">
			<link href="/css/clients.css" rel="stylesheet" type="text/css">	
			<link href="/css/admin.css" rel="stylesheet" type="text/css">
			
			
			<?	if ($_controller_name=="product"){ // чтоб подключать только для продукта ?>
			
				<link href="/css/product.css" rel="stylesheet" type="text/css">		
					
				<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
				<script type="text/javascript" src="/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
				<script type="text/javascript" src="/fancybox/jquery.easing-1.4.pack.js"></script>
				<script type="text/javascript" src="/fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
				<link rel="stylesheet" href="/fancybox/jquery.fancybox-1.3.4.css" type="text/css" media="screen" />
				
				<script type="text/javascript">
					$(document).ready(function() {			
						$("a#show_picture").fancybox();
					});
				</script>
			<? } ?>

			
			<?	if($_controller_name=="cart2"){ // чтоб подключать только для корзины ?>
				<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.3/jquery.min.js"></script>

					<script>
					jQuery(function(){
					    // Сбрасываем значения всех полей на странице
					    $('.text').val('');
					      
					    // Функция срабатывает по событию .blur
					    $('#userName').blur(function(){
					        // Убираем все классы с поля «Ваше имя»
					        $('#userName').removeClass();
					        // Определяем длину значения поля
					        var nameLngth = $('#userName').val().length;
					        
					        // Если значение меньше или равно 1 символу, то выводим предупреждение
					        // Значение поля «Ваше имя» может быть длиной в 2 символа. Например фамилия «Ли»
					        if(nameLngth <= 1){
					            $('#userName').addClass('notValid');
					            $(this).next().text('Введите пожалуйста ваше имя');
					        } else {
					        // Здесь мы пишем что должно быть, если все введено верно
					            $('#userName').addClass('valid');
					            $(this).next().text('');
					        }
					    });
					    
					    // Функция срабатывает по событию .blur
					    $('#phoneNumber').blur(function(){     
					        // Убираем все классы с поля «Ваш номер телефона»
					        $('#phoneNumber').removeClass();
					        // Берем значение поля «Ваш номер телефона»
					        var phoneV = $('#phoneNumber').val();
					        // Определяем длину значения поля
					        var phoneLngth = phoneV.length;
					        
					        // Проверяем чтобы в поле были только цифры
					        if( /[^0-9]/.test(phoneV) ) {
					            $('#phoneNumber').addClass('notValid');
					            $(this).next().text('Номер телефона должен содержать только цифры');
					        } else if (phoneLngth <= 6) {
					        // Проверяем чтобы длина номера телефона была не меньше 6 символов
					            $('#phoneNumber').addClass('notValid');
					            $(this).next().text('Введите пожалуйста ваш номер телефона');
					        } else {
					        // Здесь мы пишем что должно быть, если все введено верно
					            $('#phoneNumber').addClass('valid');
					            $(this).next().text('');
					        }
					    });
					    
					    // Функция срабатывает по событию .blur
					    $('#address').blur(function(){
					        // Убираем все классы с поля «Ваше имя»
					        $('#address').removeClass();
					        // Определяем длину значения поля
					        var nameLngth = $('#address').val().length;
					        
					        // Если значение меньше или равно 1 символу, то выводим предупреждение
					        // Значение поля «Ваше имя» может быть длиной в 2 символа. Например фамилия «Ли»
					        if(nameLngth <= 5){
					            $('#address').addClass('notValid');
					            $(this).next().text('Введите пожалуйста ваш адрес');
					        } else {
					        // Здесь мы пишем что должно быть, если все введено верно
					            $('#address').addClass('valid');
					            $(this).next().text('');
					        }
					    });
					    
					});
					</script>
			<? } ?>
			
			<?	if ($_controller_name=="admin") {
				echo "<script src='/js/classlib.js'> </script>";
				echo "<script src='/js/admin.js'> </script>";
			} ?>
			
	</head>

<body>
	<div id="top">	<!-- верхняя полоса-->
		<div id="top_menu">		
			<ul>
				<li><a href="/">ГЛАВНАЯ</a></li>
				<li><a href="/about">О КОМПАНИИ</a></li>
				<li class="dotted_item"><a href="/clients">КЛИЕНТАМ</a></li>					
			</ul>
		</div>
		
		
		<div id="div_contacts">
			
			 <div style="margin-top:10px; margin-left:85px">	
				<a href="/contacts" >КОНТАКТЫ</a>
			</div>
			
			<div id="HiddenText" style="color:#ccc;  font: 14px Arial, Helvetica;">
				<div style="margin-left:25px; margin-top:30px;">
					Телефоны для связи:
				</div>
				<div style="margin-left:25px; margin-top:10px;">
					+375 (29) 391-81-61 &nbsp; (Velcom)
				</div>
				<div style="margin-left:25px; margin-top:10px;">
					+375 (29) 155-65-95 &nbsp; (Velcom)
				</div>
				<div style="margin-left:25px; margin-top:30px;">
					Электронная почта:
				</div>
				<div style="margin-left:25px; margin-top:10px;">
					eurosanteh@gmail.com
				</div>
			</div>
		</div>
	</div>
	
	
	<div id="header">
		<div id="logo">
			<!--<a href="/"> <img src="/images/logo5.png"> </a>-->
			<a href="/" 
			onmouseover="document.getElementById('img_logo').src='/images/logo_hover1.png';" 
			onmouseout="document.getElementById('img_logo').src='/images/logo3.png';">
				<img id="img_logo" src="/images/logo3.png" alt="Eurosanteh">
			</a>		
		</div>

		<a href="/cart">		<!-- малая корзина -->
			<div id="smalcart">
				<h3 style="margin-left:20px;">Корзина</h3>
				<strong>Товаров в корзине:</strong>  <span style="color:#fff;"><?=$smal_cart['cart_count']?></span>
				 <br/><strong>На сумму:</strong> <span style="color:#fff;"><?=$smal_cart['cart_price']?></span> руб.    
				
			</div>
		</a>
	</div>
	
	
	
<!-- ------------------------------------------------------------------- -->
<!--		 Основное меню сайта -->
<!-- ------------------------------------------------------------------- -->

<ul id="menu">
	<li style="padding-left:12%;"> <a> </a> 
	</li>
	<li><a href="/catalog">Каталог</a>
		<ul>
			<li><a href="/catalog/truby">Трубы </a>
				<ul>
					<li> <a href="/catalog/truby-metal">Металлопластиковые</a> </li>
					<li><a href="/catalog/truby-propilen">Полипропиленовые</a></li>
					<li><a href="/catalog/truby-kanalizaciya">Канализационные</a></li>
					<li><a href="/catalog/fitting-metal">Фитинги для металлопластика</a></li>
					<li><a href="/catalog/fitting-polipropilen">Фитинги для полипропилена</a></li>
					<li><a href="/catalog/fitting-kanalizaciya">Фитинги для канализации</a></li>
				</ul>				
			</li>
			
			<li><a href="/catalog/vanny">Ванны </a>
				<ul>
					<li><a href="/catalog/akrilovye-vanny">Акриловые ванны</a></li>			
				</ul>				
			</li>
			
			<li><a href="/catalog/smesiteli">Смесители </a>
				<ul>

					<li><a href="/catalog/smesiteli-vanny">Смесители для ванны</a></li>
					<li><a href="/catalog/smesiteli-umyvalnik">Смесители для умывальника</a></li>
					<li><a href="/catalog/smesiteli-kuhni">Смесители для кухни</a></li>								
					<li><a href="/catalog/smesiteli-moiki">Смесители для мойки</a></li>
					
				</ul>				
			</li>

			<li><a href="/catalog/sanfayans">Санфаянс </a>
				<ul>
					<li> <a href="/catalog/unitazy">Унитазы</a> </li>
				</ul>				
			</li>

			<li><a href="/catalog/mojki">Мойки</a>
				<ul>
					<li> <a href="/catalog/mojki-nerzhavejka"> Мойки нержавейка </a> </li>
					<li> <a href="/catalog/mojki-granitnye"> Мойки гранитные </a> </li>	
				</ul>				
			</li>
			<li><a href="/catalog/dush">Всё для душа</a>
				<ul>
					<li> <a href="/catalog/dushevye-kabiny">Душевые кабины</a> </li>				
				</ul>				
			</li>
			
		</ul>
	</li>
	
	
	<li>
		<a href="/dostavka">Доставка и оплата</a>	
	</li>
	<li>
		<a href="/contacts">Контакты</a>	
	</li>
       
</ul>
<!--  Закончили работать с меню-->	


	<div id="background">
		<div id="container">