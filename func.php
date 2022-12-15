<?php
namespace Home;

abstract class Farm 
		{
			public $table;
			public $regNum;
			public $product;
			public $page;
		    protected $properties;

			function __construct($table, $page)
			{
		    	$this->page = $page;
       			$result = mysqli_query(mysqli_connect, 'SELECT COUNT(*) FROM `'.$table.'`');
        		$this->properties = mysqli_fetch_assoc($result);
			}

		    // абстрактный метод, чисто ради различия слов
    		abstract public function do_print();

			public function addAnimal($table, $regNum, $product) {
				try {	
					$this->product = $product;
					$this->regNum = $regNum;
					$result = mysqli_query(mysqli_connect, "INSERT INTO `".$table."` (`id`, `regNum`, `product`) VALUES (NULL, '".$regNum."', '".$product."');") or die("Запрос не прошел");
					header("Location: ".$this->page."");
				} catch (Exception $e) {
					echo $e->getMessage("Добавление не удалось");
				}
			}

			public function showProducts($prod) {
				try {	
					$result = mysqli_query(mysqli_connect, "SELECT * FROM `products` WHERE `products`.`id` = {$prod}") or die("Запрос не прошел");
					while ($row = mysqli_fetch_array($result)) {
						echo $row["name"].": ".$row["num"]."<br>";
			   		}
				} catch (Exception $e) {
					echo $e->getMessage("Добавление не удалось");
				}
			}

			public function collectProducts($table, $prod) {
				try {
					// суммирую сколько возможно получить продукта с каждого животного
					$result = mysqli_query(mysqli_connect, "SELECT SUM(`product`) FROM `".$table."`") or die("Запрос не прошел");
					$element = mysqli_fetch_array($result);
					// число полученной продукции
					$element = $element["SUM(`product`)"];

					// выбираю текущее число продукции "на складе"
					$result = mysqli_query(mysqli_connect, "SELECT `num` FROM `products` WHERE `products`.`id` = {$prod}") or die("Запрос не прошел");
					$allEl = mysqli_fetch_array($result);
					// суммирую
					$allEl = $allEl["num"] + $element;

					// обновляю число продукции "на складе"
					$result = mysqli_query(mysqli_connect, "UPDATE `products` SET `num` = {$allEl} WHERE `products`.`id` = {$prod}");

					header("Location: ".$this->page."");
				} catch (Exception $e) {
					echo $e->getMessage("Добавление не удалось");
				}
			}
		}

		class Covs extends Farm
		{
			
			public $table = 'covs';
			public $prod = 2;

		    public function __construct($page)
		    {
		    	$this->page = $page;
		        // вызываем конструктор родительского класса
		        parent::__construct($this->table, $page);
		    }
		    
		    // переопределяем абстрактный метод печати
		    public function do_print()
		    {
		    	echo "Количество коровок: ";
		        echo $this->properties['COUNT(*)'];
		        echo '<br />';
		        echo '<br />';
		    }

		    public function addAnimal($table, $regNum, $product)
		    {
		    	parent::addAnimal($this->table, date("YmdHms"), mt_rand(8, 12));
		    }

		    public function collectProducts($table, $prod)
		    {
		    	parent::collectProducts($this->table, $this->prod);
		    }

		    public function showProducts($prod)
		    {
		    	$this->prod = $prod;
		    	parent::showProducts($this->prod);
		    }
		}

		class Chickens extends Farm
		{
			
			public $table = 'chickens';
			public $prod = 1;

		    public function __construct($page)
		    {
		    	$this->page = $page;
		        // вызываем конструктор родительского класса
		        parent::__construct($this->table, $page);
		    }
		    
		    // переопределяем абстрактный метод печати
		    public function do_print()
		    {
		        echo "Количество цыплят: ";
		        echo $this->properties['COUNT(*)'];
		        echo '<br />';
		        echo '<br />';
		    }

		    public function collectProducts($table, $prod)
		    {
		    	parent::collectProducts($this->table, $this->prod);
		    }

		    public function addAnimal($table, $regNum, $product)
		    {
		    	parent::addAnimal($this->table, date("YmdHms"), mt_rand(0, 1));
		    }

		    public function showProducts($prod)
		    {
		    	$this->prod = $prod;
		    	parent::showProducts($this->prod);
		    }
		}