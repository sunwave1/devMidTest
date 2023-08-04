<?php 

trait QueryString {
  
  public array $params = [];
  
    public function query() : self {
        
        parse_str($_SERVER['QUERY_STRING'], $this->params);
        
        return $this;
    }
    
    public function only(mixed $keys) : mixed {

        if (!is_array($keys)) {
            $keys = func_get_args();
        }

        return array_intersect_key($this->params, array_flip($keys));
    }

    public function has(string $key) : bool {

        return array_search($key, array_keys($this->params)) !== false;
    }

    public function get(string $key) : mixed {

        $var = $this->only($key);
        
        return !empty($var) ? $var[ $key ] : null;
    }
}

trait Flash {
    public function flash($message, $type = "success", $identify = "alert") : self {

        $_SESSION['flash'][ $identify ] = [
            'flash_message' => $message,
            'flash_type' => $type
        ];

        return $this;
    }

    public function hasFlash(string $identify = "alert") : bool {
        
        return !empty( $_SESSION['flash'][ $identify ] );
    }

    public function getType(string $identify = "alert") : string {
        return $_SESSION['flash'][ $identify ]['flash_type'];
    }

    public function show(string $identify = "alert") : void {

        echo $_SESSION['flash'][ $identify ]['flash_message'];
        unset($_SESSION['flash'][ $identify ]);

    }
}

class Http {

    use QueryString, Flash;
  
    public function __construct(){}

    public function redirect(string $url) : void {
      
        header("Location: $url");
        
		exit();
    }

    public function method() : string {

        return $_SERVER['REQUEST_METHOD'];
    }

    public function methodPost(string $key) : null|string|array {

        return isset($_POST[ $key ]) ? $_POST[ $key ] : NULL;
    }

    public function methodGet(string $key) : null|string|array {

        return isset($_GET[ $key ])? $_GET[ $key ] : NULL;
    }

    public function view(string $dir, $data = []) : mixed {

        if(!file_exists($dir)){
			throw new \Exception("Arquivo '{$dir}' não encontrada.");
		}
		
		if(!is_file($dir)){
			throw new \Exception("Caminho não corresponde a um arquivo valido.");
		}
		
		if(gettype($data) != "array"){
			throw new \Exception("Dado passado deve ser apenas do tipo array.");
		}
		
		extract($data);
		
		ob_start();

		include $dir;

		return ob_get_clean();
    }
}
