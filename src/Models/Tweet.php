<?php
namespace Models;

class Tweet {
    private $id;
    private $categoryId;
    private $username;
    private $content;
    private $createdAt;

    public function __construct($id, $categoryId, $username, $content, $createdAt) {
        $this->id = $id;
        $this->categoryId = $categoryId;
        $this->username = $username;
        $this->content = $content;
        $this->createdAt = $createdAt;
    }

    public function getId() {
        return $this->id;
    }

    public function getCategoryId() {
        return $this->categoryId;
    }

    public function getUsername() {
        return $this->username;
    }

    public function getContent() {
        return $this->content;
    }

    public function getCreatedAt() {
        return $this->createdAt;
    }
}