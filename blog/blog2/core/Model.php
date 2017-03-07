<?php

namespace core;

class Model extends \vendor\PDOWrapper
{
    public function __construct()
    {
        parent::__construct(Application::$config['database']);
    }

    public function findAll($where = '2 > 1')
    {
       $sql = "SELECT * FROM `{$this->table}` WHERE {$where}";
        return  $this->getAll($sql);
    }

    public function findOneById($id)
    {
        $sql = "SELECT * FROM `{$this->table}` WHERE id = {$id}";
        return $this->getOne($sql);
    }

    public function findOneBy($where = '2 > 1')
    {
        $sql = "SELECT * FROM `{$this->table}` WHERE {$where} LIMIT 1";
        return $this->getOne($sql);
    }

    public function deleteById($id)
    {
       $sql = "DELETE FROM `{$this->table}` WHERE id = {$id}";
       return  $this->exec($sql);
    }

    public function add($data)
    {
        //pro_name,protype_id,price,pinpai,chandi
        //'{$data['pro_name']}','{$data['protype_id']}','{$data['price']}','{$data['pinpai']}''{$data['chandi']}'
        $columns = '';
        $values = '';
        foreach($data as $key => $value) {
            $columns = $columns . "`" . $key . "`" .',';
            $values = $values . "'" . $value . "'" .',';
        }
        $columns = rtrim($columns, ',');//rtrim($str,'$x')是在字符串$str最右边削减$x
        $values = rtrim($values,',');
        $sql = "INSERT INTO `{$this->table}` ($columns) VALUES ($values)";
        //echo $sql;die;
        return $this->exec($sql);
    }
    public function updateById($id , $data , $primaryKey = 'id')
    {
        $sets = "";
        //username = '{$_POST['username']}',nickname = '{$_POST['nickname']}', email = '{$_POST['email']}'
        foreach($data as $key => $value) {
            $sets = $sets . "{$key} = '{$value}',";
        }
        $sets = rtrim($sets,',');
        $sql = "UPDATE `{$this->table}` SET {$sets} WHERE {$primaryKey} = {$id}";
        return $this->exec($sql);
    }

	public static function create($modelClassName)
	{
		static $models = array();
		if (isset($models[$modelClassName])) {
			return $models[$modelClassName];
		} else {
			$xxx = new $modelClassName;// new Product
			return $models[$modelClassName] = $xxx;// $models['Product']
		}
	}
}