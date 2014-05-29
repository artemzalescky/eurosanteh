<?php

	// контроллер труб
	
	class Application_Controllers_Truby  extends Lib_BaseController {
		function index() {  
			$model=new Application_Models_Truby;

			$info = $model->getCatalogInfo();		// получаем информацию о каталоге
			$this->info = $info;					// пишем в member  (переопределенные ф-ии __set() __get()  для member в BaseController)

			if (!empty($info['name'])) {	// не самый верхний каталог 
			$this->products = $model->getProducts($info['id'], $info['kids']);	// список всех продуктов каталога и всех его детей
			}
		}
	}
?>