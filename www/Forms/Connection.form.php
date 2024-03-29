<?php
namespace App\Forms;
use App\Core\Validator;

class Connection extends Validator
{
    public $method = "POST";
    protected array $config = [];
    public function getConfig(): array
    {
        $this->config = [
                "config"=>[
                    "method"=>$this->method,
                    "action"=>"", 
                    "id"=>"connection-form",
                    "class"=>"form",
                    "enctype"=>"",
                    "submitLabel"=>"Se connecter",
                    "submitName"=>"submit",
                    "reset"=>"Annuler"
                ],
                "inputs"=>[
                    "pseudo"=>[
                        "id"=>"connection-form-pseudo",
                        "class"=>"form-input",
                        "label"=>"Pseudo",
                        "placeholder"=>"Votre pseudo",
                        "type"=>"text",
                        "error"=>"Votre pseudo n'existe pas",
                        "required"=>true
                    ],
                    "password"=>[
                        "id"=>"connection-form-pwd",
                        "class"=>"form-input",
                        "label"=>"Mont de passe",
                        "placeholder"=>"Votre mot de passe",
                        "type"=>"password",
                        "error"=>"Votre mot de passe ne correspond pas",
                        "required"=>true
                    ]
                ]
        ];
        return $this->config;
    }
}