<?php 

class Shortener
{
	protected $db;
	
	function __construct()
	{
		$host = 'localhost'; // адрес сервера 
		$database = 'wm08927_krv'; // имя базы данных
		$user = 'wm08927_krv'; // имя пользователя
		$password = 'ZQrz2XiX'; // пароль
		$this->db = new mysqli($host, $user, $password, $database);
	}

	protected function generateCode($num){
		return base_convert($num, 10, 36);
	}

	public function makeCode($url){
		$url = trim($url);
		if (!filter_var($url, FILTER_VALIDATE_URL)) {
			return '';
		}

		$url = $this->db->escape_string($url);
			$exists = $this->db->query("SELECT code FROM links WHERE url = '{$url}'");
	
		if ($exists->num_rows) {
			return $exists->fetch_object()->code;
			//выволдим код урл уже существующего в базе
		} else {
			//добавляем урл в базу
			$insert = $this->db->query("INSERT INTO links (url, created) VALUES ('{$url}', NOW())"); //генерация кода урла
			$code = $this->generateCode($this->db->insert_id); //обновление кода
			$this->db->query("UPDATE links SET code = '{$code}' WHERE url = '{$url}'");
			return $code;
		}
	}

	public function getUrl($code){
		$code = $this->db->escape_string($code);
		$code = $this->db->query("SELECT url FROM links WHERE code = '$code'");
		if ($code->num_rows) {
			return $code->fetch_object()->url;
		}
		return '';
	}
}
?>
