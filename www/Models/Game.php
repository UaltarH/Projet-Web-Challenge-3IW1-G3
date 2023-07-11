<?php

namespace App\Models;

use App\Core\SQL;

class Game extends AbstractModel
{
    private string $id = "0";
    protected string $title;
    protected string $category_id = "0";

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
     * @return string
     */
    public function getCategory_id(): string
    {
        return $this->category_id;
    }

    /**
    * @param string $category_id
    */
    public function setCategory_id(string $category_id): void
    {
        $this->category_id = $category_id;
    }
}
