<?php
// src\core\Model.php

namespace App\Core;

use App\Core\Database;


abstract class Model {
    protected $db;
    protected $table;
    protected $primaryKey = 'id';

    public function __construct() {
        $this->db = Database::getInstance();
    }

    // Opérations CRUD
    public function find($id) {
       return $this->db->query("SELECT * FROM {$this->table} WHERE {$this->primaryKey} = :id LIMIT 1", ['id' => $id])->fetch();
        
    }

    public function all() {
       return $this->db->query("SELECT * FROM {$this->table}")->fetchAll();
    }

    // Insert a new record @param array $data Associative array of column => value
    public function create(array $data) {
        $columns = implode(", ", array_keys($data));
        $placeholders = ":" . implode(", :", array_keys($data));

        $sql = "INSERT INTO {$this->table} ({$columns}) VALUES ({$placeholders})";
        
        $this->db->query($sql, $data);
        return $this->db->lastInsertId();
    }

    public function update($id, array $data) {
        $fields = "";
        foreach ($data as $key => $value) {
            $fields .= "{$key} = :{$key}, ";
        }
        $fields = rtrim($fields, ", ");

        $sql = "UPDATE {$this->table} SET {$fields} WHERE {$this->primaryKey} = :id";
        
        $data['id'] = $id;
        
       return $this->db->query($sql, $data);
        
    }

    public function delete($id) {
       return $this->db->query("DELETE FROM {$this->table} WHERE {$this->primaryKey} = :id", ['id' => $id]);
    }

    // Custom Query Helper    
    public function where($column, $value) {
      return  $stmt = $this->db->query("SELECT * FROM {$this->table} WHERE {$column} = :val", ['val' => $value])->fetchAll();        
    }
}