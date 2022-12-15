<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Document</title>
</head>
<body>
	<?
	require_once "func.php";

	$covs = new \Home\Covs("main.php");
	$chickens = new \Home\Chickens("main.php");

	$farm[] = new \Home\Covs("main.php");
	$farm[] = new \Home\Chickens("main.php");

	for ($i=0; $i < 10; $i++) { 
		$covs->addAnimal(0, 0, 0);
	}

	for ($i=0; $i < 20; $i++) { 
		$chickens->addAnimal(0, 0, 0);
	}

	foreach ($farm as $item) {
	    // если мы работаем с наследниками 
	    if ($item instanceof Farm) {
	        // то печатаем данные
	        $item->do_print(); 
	    } else {
	        error_log("Ошибка");
	    }
	}

	for ($i=0; $i < 7; $i++) { 
		foreach ($farm as $item) {
			$item->collectProducts($item->table, $item->prod);
		}
	}

	foreach ($farm as $item) {
		$item->showProducts($item->prod);
	}

	for ($i=0; $i < 5; $i++) { 
		$chickens->addAnimal($item->table, 0, 0);
	}

	for ($i=0; $i < 1; $i++) { 
		$covs->addAnimal($item->table, 0, 0);
	}

	foreach ($farm as $item) {
	    // если мы работаем с наследниками 
	    if ($item instanceof Farm) {
	        // то печатаем данные
	        $item->do_print(); 
	    } else {
	        error_log("Ошибка");
	    }
	}

	for ($i=0; $i < 7; $i++) { 
		foreach ($farm as $item) {
			$item->collectProducts($item->table, $item->prod);
		}
	}

	foreach ($farm as $item) {
		$item->showProducts($item->prod);
	}
	?>
</body>
</html>