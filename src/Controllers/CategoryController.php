<?php
require_once __DIR__ . '/../../src/Models/Category.php';
use Models\Category;
class CategoryController {
    private $db;

    public function __construct($db) {
        $this->db = $db;
        
    }
    
    
    
    public function getAllCategories() {
        $stmt = $this->db->query("SELECT * FROM categories");
        
        
        return $stmt->fetchAll(\PDO::FETCH_CLASS, Category::class);
        
    }
    
}