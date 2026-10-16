<?php
declare(strict_types=1);

use DomainException; // Impor da biblioteca do PHP de erros chamados DomainException

// Classe base para erros das regras de negócio
class ContaException extends DomainException{// Herança da base de erro do sistema
    // Declaração do contrutor usando property promotion
    #[Override] // Reescrevendo o construtor
    public function __construct(string $message = "Falha na Operação Bancaria")
    {
         parent::__construct($message);
    }

}