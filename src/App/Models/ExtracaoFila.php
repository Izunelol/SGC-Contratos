<?php
declare(strict_types=1);

namespace Src\App\Models;

use Ramsey\Uuid\Uuid;

class ExtracaoFila
{
    private ?string $id;
    private ?string $id_usuario_fk;
    private string $nome_original;
    private string $caminho;
    private ?string $status;
    private ?string $resultado;
    private string $erro;
    private ?string $created_at;
    private ?string $updated_at;

    public function __construct
    (
        ?string $id = null,
        ?string $id_usuario_fk = null,
        string $nome_original = null,
        string $caminho = null,
        ?string $status = null,
        ?string $resultado = null,
        string $erro = null,
        ?string $created_at = null,
        ?string $updated_at = null,
        
    )
    {
        $this->setId($id);
        $this->setId_usuario_fk($id_usuario_fk);
        $this->setNome_original($nome_original);
        $this->setCaminho($caminho);
        $this->setStatus($status);
        $this->setResultado($resultado);
        $this->setErro($erro);
        $this->setCreated_at($created_at);
        $this->setUpdated_at($updated_at);
    }

    public static function fromArray(array $data): self
    {
        return new self
        (
            $data['id'] ?? null,
            $data['id_usuario_fk'] ?? null,
            $data['nome_original'] ?? null,
            $data['caminho'] ?? null,
            $data['status'] ?? null,
            $data['resultado'] ?? null,
            $data['erro'] ?? null,
            $data['created_at'] ?? null,
            $data['updated_at'] ?? null,
        );
    }


    public function getId(): string
    {
        return $this->id;
    }


    public function setId(?string $id): void
    {
        $this->id = $id ?? Uuid::uuid7()->toString();
    }


    public function getId_usuario_fk(): string
    {
        return $this->id_usuario_fk;
    }

 
    public function setId_usuario_fk(?string $id_usuario_fk): void
    {
        $this->id_usuario_fk = $id_usuario_fk;
    }


    public function getNome_original(): string
    {
        return $this->nome_original;
    }

 
    public function setNome_original(string $nome_original): void
    {
        $this->nome_original = $nome_original;
    }

    public function getCaminho(): string
    {
        return $this->caminho;
    }


    public function setCaminho(string $caminho): void
    {
        $this->caminho = $caminho;
    }

    public function getStatus(): string
    {
        return $this->status;
    }


    public function setStatus(?string $status): void 
    {
        $this->status = $status;
    }


    public function getResultado(): ?string
    {
        return $this->resultado;
    }


    public function setResultado(string $resultado): void
    {
        $this->resultado = $resultado;
    }

    public function getErro(): string
    {
        return $this->erro;
    }

  
    public function setErro(string $erro): void 
    {
        $this->erro = $erro;
    }

    public function getCreated_at(): ?string 
    {
        return $this->created_at;
    }

  
    public function setCreated_at(?string $created_at): void
    {
        $this->created_at = $created_at;
    }

    public function getUpdated_at(): ?string
    {
        return $this->updated_at;
    }


    public function setUpdated_at(?string $updated_at): void
    {
        $this->updated_at = $updated_at;
    }
}




?>