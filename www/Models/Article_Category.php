<?php

namespace App\Models;

class Article_Category extends AbstractModel
{
    private string $id = "0";
    protected string $category_name;
    protected string $description;

    public function __construct(){
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
    * @param string $id
    */
    public function setId(string $id): void
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