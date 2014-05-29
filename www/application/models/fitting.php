<?php
		//Модель вывода категории товаров
class Application_Models_Fitting {	
	
	function getCatalogInfo() {
		$info;					// вся инфа о каталоге
								// 'name', 'id', 'url', 'name_rus'	- информация о текущем каталоге
								// 'catalog_image_url' - путь к картинкам подкаталогов
								// 'near_kids' - массив из url и названий ближайших детей  ( напр	$info['near_kids'][$i]['url'] )
								// 'kids' - массив названий таблиц продуктов всех детей
								// 'parents' - массив из url и названий родителей  
		
		$current_url = explode('/',$_GET['route']);
		
		
		// получаем информацию о текущем каталоге
		$sql = "SELECT * FROM catalog WHERE url='{$current_url[1]}'";	// current_url - массив разбитого url
		$result = mysql_query($sql) or die(mysql_error());	// посылаем запрос в БД
		if ($row = mysql_fetch_object($result)) {	// если нашли
			$info['id'] = $row->id;
			$info['name'] = $row->name;
			$info['url'] = $row->url;
			$info['name_rus'] = $row->name_rus;
		}


		// получаем информацию о ближайших детях текущего каталога	(для выбора подкаталога)
		$info['near_kids'] = null;
		$sql = "SELECT * FROM catalog WHERE name LIKE '{$info['name']}\_%' AND name NOT LIKE '{$info['name']}\_%\_%'";	// шаблон (если cur_name = product_1 берем все product_1_% и чтоб больше слешей не было
		$result = mysql_query($sql) or die(mysql_error());	// посылаем запрос в БД
		$i = 0;
		while ($row = mysql_fetch_object($result)) {	// если нашли
			$info['near_kids'][$i]['url'] = $row->url;
			$info['near_kids'][$i]['name_rus'] = $row->name_rus;
			$i++;
		}

		
		// получаем информацию о всех детях (для вывода продуктов)
		$info['kids'] = null;
		$sql = "SELECT * FROM catalog WHERE name LIKE '{$info['name']}\_%'";
		$result = mysql_query($sql) or die(mysql_error());	// посылаем запрос в БД
		while ($row = mysql_fetch_object($result)) {	// если нашли
			$info['kids'][] = $row->id;
		}
		

		// получаем информацию о предках
		$temp_arr = explode('_', $info['name']);
		$info['parents'][0]['url'] = '';
		$info['parents'][0]['name_rus'] = 'Каталог';
		for ( $i = 1; $i < count($temp_arr); $i++) {
			$sql = "SELECT * FROM catalog WHERE id='{$temp_arr[$i]}'";
			$result = mysql_query($sql) or die(mysql_error());	// посылаем запрос в БД
			if ($row = mysql_fetch_object($result)) {	// если нашли
				$info['parents'][$i]['url'] = $row->url;
				$info['parents'][$i]['name_rus'] = $row->name_rus;
			}
		}

		
		$info['catalog_image_url'] = '/images/catalog';
		for ( $i = 1; $i < count($info['parents']); $i++) {
			$info['catalog_image_url'] = $info['catalog_image_url'] . '/' . $info['parents'][$i]['url'];
		}

		return $info;
	}



	function getProducts($id_catalog, $kids) {	// достаем продукты для всех детей и самого каталога (с проверкой существования такой таблицы)
		$products = null;
		
		$sql = "SELECT * FROM fitting_class where id_catalog = $id_catalog";
		$result = mysql_query($sql);
		$picture_url = getProductImagesURLFromId($id_catalog); 		// путь к картинкам данного каталога

		if ($result) {	// если такая таблица есть
		
			while ($row = mysql_fetch_object($result)) {	// если нашли						
				$arr = array(
					"id" => $row->id,
					"id_catalog" => $row->id_catalog,
					"kids" => null,
					"name" => $row->name,
					"picture_url" => $picture_url.'/'.$row->id.'.jpg'			// имя картинки с путем к ней
				);
				
				$sql = "SELECT * FROM fitting where id_class = $row->id";
				$result2 = mysql_query($sql);
				$url = getUrlFromID($id_catalog);
				while ($row = mysql_fetch_object($result2)) {	// если нашли						
					$arr["kids"][] = array(
						"size" => $row->size,
						"id" => $row->id,
						"price" => $row->price,
						"url" => "product/".$url."/".$row->id	// url конкретного продукта
					);						
				}
				
				$products[] = $arr;
			}
		}		
		
		
		// достаем продукты всех подкаталогов
		if ($kids) {
			foreach ($kids as $i => $v) {		// достаем продукты детей текущего каталога	
				$sql = "SELECT * FROM fitting_class where id_catalog = $v";
				$result = mysql_query($sql);
				$picture_url = getProductImagesURLFromId($v); 		// путь к картинкам данного каталога

				if ($result) {	// если такая таблица есть
				
					while ($row = mysql_fetch_object($result)) {	// если нашли						
						$arr = array(
							"id" => $row->id,
							"id_catalog" => $row->id_catalog,
							"kids" => null,
							"name" => $row->name,
							"picture_url" => $picture_url.'/'.$row->id.'.jpg'			// имя картинки с путем к ней
						);
						
						$sql = "SELECT * FROM fitting where id_class = $row->id";
						$result2 = mysql_query($sql);
						$url = getUrlFromID($v);
						while ($row = mysql_fetch_object($result2)) {	// если нашли						
							$arr["kids"][] = array(
								"size" => $row->size,
								"id" => $row->id,
								"price" => $row->price,
								"url" => "product/".$url."/".$row->id	// url конкретного продукта
							);						
						}
						
						$products[] = $arr;
					}
				}
			}
		}
		
		return $products;
	}
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

function getProductImagesURLFromId($id) {		// получить путь к картинкам продуктов каталога с id = $id
	$res = null;
	$sql = "SELECT name FROM catalog where id = '$id'";
	$result = mysql_query($sql);
	if($row = mysql_fetch_object($result)) {
		$res = getProductImagesURL($row->name);
	}

	return $res;
}


function getCatalogURLFromName($name_catalog) {		// 	получить поле url каталога по его имени
	$url = '';
	
	$sql = "SELECT url FROM catalog where name = '$name_catalog'";
	$result = mysql_query($sql);				
	if ($row = mysql_fetch_object($result)) {	// если нашли					
		$url = $row->url;					
	}
			
	return $url;
}

function getUrlFromID($id){
	$sql = "SELECT * FROM catalog where id= $id";
	$result = mysql_query($sql);		
		
	if ($row = mysql_fetch_object($result)) {	// если нашли						
		return $row->url;
	}			
}

function cout($message) {		// ## вывод текста (для отладки)
	echo $message . '<br>';
}

?>