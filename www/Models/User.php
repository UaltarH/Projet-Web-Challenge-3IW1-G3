<?php

namespace App\Models;

use App\Core\SQL;

class User extends SQL
{
    //private $db_connexion;

    private Int $id = 0;
    protected String $pseudo;
    protected String $first_name;
    protected String $last_name;
    protected String $email;
    protected String $password;
    protected bool $email_confirmation = false;
    protected Int $phone_number;
    protected String $date_inscription;
    protected Int $role_id = 1; // 1 represente un utilisateur normal ; 2 represente un admin
    protected String $confirmToken;
    

    public function __construct(){
        //de base 
        parent::__construct();

        //$this->db_connexion = SQL::getInstance()->getConnection();
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
    public function getPseudo(): string
    {
        return $this->pseudo;
    }

    /**
     * @param String $pseudo
     */
    public function setPseudo(string $pseudo): void
    {
        $this->pseudo = trim($pseudo);
    }

    /**
     * @return String
     */
    public function getFirstname(): string
    {
        return $this->first_name;
    }

    /**
     * @param String $firstname
     */
    public function setFirstname(string $firstname): void
    {
        $this->first_name = ucwords(strtolower(trim($firstname)));
    }

    /**
     * @return String
     */
    public function getLastname(): string
    {
        return $this->last_name;
    }

    /**
     * @param String $lastname
     */
    public function setLastname(string $lastname): void
    {
        $this->last_name = strtoupper(trim($lastname));
    }

    /**
     * @return String
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param String $email
     */
    public function setEmail(string $email): void
    {
        $this->email = strtolower(trim($email));
    }

    /**
     * @return String
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param String $password
     */
    public function setPassword(string $password): void
    {
        $this->password = password_hash($password, PASSWORD_DEFAULT);
    }


    public function getEmailConfirmation(): bool
    {
        return $this->email_confirmation;
    }


    public function setEmailConfirmation(bool $emailConfirmation): void
    {
        $this->email_confirmation = $emailConfirmation;
    }

    /**
     * @return Int
     */
    public function getPhoneNumber(): int
    {
        return $this->phone_number;
    }

    /**
     * @param Int $phone_number
     */
    public function setPhoneNumber(int $phoneNumber): void
    {
        $this->phone_number = $phoneNumber;
    }

    /**
     * @return String
     */
    public function getDateInscription(): string
    {
        return $this->date_inscription;
    }

    /**
     * @param String $date_inscription
     */
    public function setDateInscription(string $dateInscription): void
    {
        $this->date_inscription = $dateInscription;
    }

    /**
     * @return Int
     */
    public function getRoleId(): int
    {
        return $this->role_id;
    }

    /**
     * @param Int $role_id
     */
    public function setRoleId(int $roleId): void
    {
        $this->role_id = $roleId;
    }

        /**
     * @return String
     */
    public function getConfirmToken(): string
    {
        return $this->confirmToken;
    }

    /**
     * @param String $confirmToken
     */
    public function setConfirmToken(string $confirmToken): void
    {
        $this->confirmToken = $confirmToken;
    }
    public function userFaker(): string
    {
        $query = "INSERT INTO carte_chance_user (pseudo, first_name, last_name, email, password, email_confirmation, phone_number, date_inscription, role_id) VALUES";
        for($i = 0; $i < 100; $i++) {
            $query .= "('pseudo$i', 'firstname$i', 'lastname$i', 'email$i@email.com', 'Test$i', true, '0123456789', '".date("Y-m-d H:i:s")."', 1)";
            if($i !== 99) $query.= ",";
        }
        $query .= ";";
        return $query;
    }
}
