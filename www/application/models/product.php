<?php

class Application_Models_Product {    
 
	function getProduct() {		// получить информацию о конкретном продукте для вывода в View
	
		$route_arr =  explode('/',$_GET['route']);	
		$url_catalog = $route_arr[1];
		$id_product = $route_arr[2];

		$name_table = getCatalogNameFromURL($url_catalog);		// получаем имя таблицы с товаром

		
		if (strpos($route_arr[1],"truby") === 0) {				// для труб своя таблица и свои атрибуты
			$sql = "SELECT * FROM truby WHERE id='$id_product'";
			$result = mysql_query($sql)  or die(mysql_error());

			if ($row = mysql_fetch_object($result)) {	// если такой есть
				$product['diametr']=$row->diametr;
				$product['length']=$row->length;
				$product['thickness']=$row->thickness;
				$product['price']=$row->price;
				$product['id_class']=$row->id_class;	// получаем класс для полной информации
				$product['id']=$id_product;
				
				$sql="SELECT * FROM truby_class WHERE id='{$product['id_class']}'";
				$result=mysql_query($sql) or die(mysql_error());
				if ($row=mysql_fetch_object($result)) {		// есть такой класс соединений
					$product['name']=$row->name;
					$product['garanty']=$row->garanty;			
					$product['material']=$row->material;
					$product['producer']=$row->producer;
					$product['description']=$row->description;
					$product['id_catalog']=$row->id_catalog;
				}
				
				$product['picture_url'] = getProductImagesURL($name_table) . '/' . $product['id_class'] . '.jpg';		// путь к картинке продукта
				$product['catalog_tree'] = getCatalogParents($name_table);										// Каталог > Ванны > ...
			}
		}
		
		
		if (strpos($route_arr[1],"fitting") === 0) {				// для фитингов своя таблица и свои атрибуты
			$sql = "SELECT * FROM fitting WHERE id='$id_product'";
			$result = mysql_query($sql)  or die(mysql_error());

			if ($row = mysql_fetch_object($result)) {	// если такой есть
				$product['size']=$row->size;
				$product['price']=$row->price;
				$product['id_class']=$row->id_class;	// получаем класс соединений для полной информации
				$product['id']=$id_product;
				
				$sql="SELECT * FROM fitting_class WHERE id='{$product['id_class']}'";
				$result=mysql_query($sql) or die(mysql_error());
				if($row=mysql_fetch_object($result)){		// есть такой класс соединений
					$product['name']=$row->name;
					$product['producer']=$row->producer;
					$product['description']=$row->description;
					$product['id_catalog']=$row->id_catalog;
				}

				$product['picture_url'] = getProductImagesURL($name_table) . '/' . $product['id_class'] . '.jpg';		// путь к картинке продукта
				$product['catalog_tree'] = getCatalogParents($name_table);										// Каталог > Ванны > ...
			}
		}
		
		
		if ((strpos($route_arr[1],"truby") !== 0) && (strpos($route_arr[1],"fitting") !== 0)) {	// не трубы и не соединения
			$sql = "SELECT * FROM $name_table WHERE id = '$id_product'";
			$result = mysql_query($sql)  or die(mysql_error());
	
			if($row = mysql_fetch_object($result)){
				foreach ($row as $i => $v) {
					$product["$i"] = $v;			// создаем в результате все атрибуты продукта
				}
			}
			
			$product['picture_url'] = getProductImagesURL($name_table) . '/' . $product['id'] . '.jpg';		// путь к картинке продукта	
			$product['catalog_tree'] = getCatalogParents($name_table);										// Каталог > Ванны > ...
		}
		
		
		$product['eng_rus'] = array (			// ## ассоциативный массив соответствия английских и русских имен аттрибутов
			'producer' => 'Производитель',
			'size' => 'Размер',
			'thickness' => 'Толщина',
			'glubina' => 'Глубина',
			'color' => 'Цвет',
			'diametr' => 'Диаметр',
			'length' => 'Длина',
			'material' => 'Мателиал',
			'description' => '*',			// * - не выводим русское название и двоеточие
			'characteristic' => '*'
		);
			
		return $product;
	}
}
 
 
function getCatalogNameFromURL($url) {		// 	получить поле name каталога по его url
	$name = null;

	$sql = "SELECT name FROM catalog where url = '$url'";
	$result = mysql_query($sql);				
	if($row = mysql_fetch_object($result)) {	// если нашли					
			$name = $row->name;					
	}
			
	return $name;	
}

function getProductImagesURL($name_catalog) {		// получить путь к картинкам продуктов каталога с именем $name_catalog
	$url = 'images';
	$name_catalog = explode('_',$name_catalog);
	
	for ($i = 1; $i < count($name_catalog); $i++) {			
		$sql = "SELECT url FROM catalog where id = '{$name_catalog[$i]}'";
		$result = mysql_query($sql);
			
		if($row = mysql_fetch_object($result)) {	// если нашли					
			$url = $url.'/'.$row->url;					
		}
	}

	return $url;
}

function getCatalogParents($name_table) {		// массив предков данного каталога (массивы из url и русского имени)
	$temp_arr = explode('_', $name_table);
	$res[0]['url'] = 'catalog';
	$res[0]['name_rus'] = 'Каталог';
	for ( $i = 1; $i < count($temp_arr); $i++) {
		$sql = "SELECT * FROM catalog WHERE id='{$temp_arr[$i]}'";
		$result = mysql_query($sql) or die(mysql_error());	// посылаем запрос в БД
		if ($row = mysql_fetch_object($result)) {	// если нашли
			$res[$i]['url'] = 'catalog/' . $row->url;
			$res[$i]['name_rus'] = $row->name_rus;
		}
	}
	
	return $res;
}

?>