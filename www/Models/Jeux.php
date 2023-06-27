<?php

namespace App\Models;

use App\Core\SQL;

class Jeux extends SQL
{
    private $id = 0;
    protected string $title;
    protected int $category_id = 1;

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
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param String $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return Int
     */
    public function getCategory_id(): int
    {
        return $this->category_id;
    }

    /**
    * @param Int $category_id
    */
    public function setCategory_id(int $category_id): void
    {
        $this->category_id = $category_id;
    }
}
