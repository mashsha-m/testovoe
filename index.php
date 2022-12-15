<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Document</title>
</head>
<body>
	<h1>Добро пожаловать на ферму</h1>
	<form method="post" action="index.php">
		<input type="submit" name="add" value="Добавить по 1 животному">
	</form>
	<form method="post" action="index.php">
		<input type="submit" name="collect" value="Собирать продукцию у всех животных">
	</form>
	<form method="post" action="index.php">
		<input type="submit" name="show" value="Подсчитывать общее кол-во собранной продукции">
	</form>
	<br>
	<?php
		require_once "func.php";

		// для каждого объекта присваивается текущая страница, чтобы запросы работали и на index, и на main
		$farm[] = new \Home\Covs("index.php");
		$farm[] = new \Home\Chickens("index.php");

		// запрос на сбор продукции
		if (isset($_POST['collect'])) {
			foreach ($farm as $item) {
				$item->collectProducts($item->table, $item->prod);
			}
		}
		// запрос на добавление животных
		if (isset($_POST['add'])) {
			foreach ($farm as $item) {
				$item->addAnimal($item->table, 0, 0);
			}
		}
		// запрос на вывод всей продукции
		if (isset($_POST['show'])) {
			foreach ($farm as $item) {
				$item->showProducts($item->prod);
			}
		}

		// вывод количества животных абстрактной функцией (для наглядности)
		foreach ($farm as $item) {
		    if ($item instanceof Farm) {
		        $item->do_print(); 
		    } else {
		        error_log("Ошибка");
		    }
		}

	?>
</body>
</html>