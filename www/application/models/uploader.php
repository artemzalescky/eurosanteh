<?php

	// загрузчик файлов на сервер

	//	$uploader = new Application_Models_Uploader;
	//	$uploader->createFolder('images/1/1/1/1/1');

	class Application_Models_Uploader {


        function createFolder($directory) {  // создать папку на сервере
            if (!is_dir($directory)) {  // директории еще нет
                $arr_dir = explode('/', $directory); // тк папка создается только в сущеструющей директории, то разбиваем путь (пошагово)

                $tmp_dir = $arr_dir[0];
                if (!is_dir($tmp_dir))
                    mkdir($tmp_dir);

                for ($i = 1; $i < count($arr_dir); $i++) {
                    $tmp_dir = $tmp_dir . '/' . $arr_dir[$i];
                    if (!is_dir($tmp_dir))
                        mkdir($tmp_dir);
                }

                return true;
            }

            return false;
        }
		
	}
?>