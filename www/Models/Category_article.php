<?php

namespace App\Models;

use App\Core\SQL;

class Category_article extends SQL
{
    private $id = 0;
    protected string $category_name;
    protected string $description;

    public function __construct(){
        parent::__construct();
    }

    /**
     * @return Int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
    * @param Int $id
    */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
    * @return String
    */
    public function getCategoryName(): string
    {
        return $this->category_name;
    }

    /**
     * @param String $category_name
     */
    public function setCategoryName(string $category_name): void
    {
        $this->category_name = $category_name;
    }

        /**
    * @return String
    */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param String $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }
}