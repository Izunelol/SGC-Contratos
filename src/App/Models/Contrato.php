<?php 

declare(strict_types=1);

namespace Src\App\Models;

use Ramsey\Uuid\Uuid;

Class Contrato
{

    private ?string $id;
    private ?string $fornecedor;
    private ?string $sei;
    private ?string $startGov;
    private ?string $contrato;
    private ?string $objeto;
    private ?string $vigencia_inico;
    private ?string $vigencia_fim;
    private ?string $created_at;
    private ?bool $status;
    private ?string $updated_at;

    public function __construct
    (
        ?string $id = null,
        ?string $fornecedor = null,
        ?string $sei = null,
        ?string $startGov = null,
        ?string $contrato = null,
        ?string $objeto = null,
        ?string $vigencia_inico = null,
        ?string $vigencia_fim = null,
        ?string $created_at = null,
        ?bool $status = null,
        ?string $updated_at,
    )
    {
        $this->setId($id);
        $this->setFornecedor($fornecedor);
        $this->setSei($sei);
        $this->setStartGov($startGov);
        $this->setContrato($contrato);
        $this->setObjeto($objeto);
        $this->setVigencia_inico($vigencia_inico);
        $this->setVigencia_fim($vigencia_fim);
        $this->setCreated_at($created_at);
        $this->setStatus($status);
        $this->setUpdated_at($updated_at);
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['id'] ?? null,
            $data['fornecedor'],
            $data['sei'] ?? null,
            $data['startGov'] ?? null,
            $data['contrato'] ?? null,
            $data['objeto'] ?? null,
            $data['vigencia_inico'] ?? null,
            $data['vigencia_fim'] ?? null,
            $data['created_at'] ?? null,
            $data['status'] ?? null,
            $data['updated_at'] ?? null,
            
            
        );
    }
    
    public function setId(?string $id): void
    {
        $this->id = $id ?? Uuid::uuid7()->toString();
    }
    
    public function getId()
    {
        return $this->id;
    }

    public function getFornecedor()
    {
        return $this->fornecedor;
    }

    public function setFornecedor(?string $fornecedor): void
    {
        $this->fornecedor = $fornecedor;
    }

    public function getSei()
    {
        return $this->sei;
    }

    public function setSei(?string $sei): void
    {
        $this->sei = $sei;
    }

    public function getStartGov()
    {
        return $this->startGov;
    }

    public function setStartGov(?string $startGov): void
    {
        $this->startGov = $startGov;
    }

    public function getContrato()
    {
        return $this->contrato;
    }


    public function setContrato(?string $contrato): void
    {
        $this->contrato = $contrato;
    }

    public function getObjeto()
    {
        return $this->objeto;
    }


    public function setObjeto(?string $objeto): void 
    {
        $this->objeto = $objeto;
    }

    public function getVigencia_inico()
    {
        return $this->vigencia_inico;
    }

    public function setVigencia_inico(?string $vigencia_inico): void 
    {
        $this->vigencia_inico = $vigencia_inico;
    }

    public function getVigencia_fim()
    {
        return $this->vigencia_fim;
    }

    public function setVigencia_fim(?string $vigencia_fim): void
    {
        $this->vigencia_fim = $vigencia_fim;
    }


    public function getCreated_at()
    {
        return $this->created_at;
    }

    public function setCreated_at(?string $created_at): void
    {
        $this->created_at = $created_at;
    }

    public function getStatus(): bool
    {
        return $this->status;
    }

 
    public function setStatus(?bool $status): void
    {
        $this->status = $status;
    }


    public function getUpdated_at()
    {
        return $this->updated_at;
    }

    public function setUpdated_at(?string $updated_at): void
    {
        $this->updated_at = $updated_at;
    }
}




?>