<?php 

declare(strict_types=1);

namespace Src\App\Infrastructure\Repositories;

use PDO;
use Src\App\Infrastructure\IRepositories\IContratoRepository;
use Src\App\Infrastructure\IRepositories\IExemploRepository;
use Src\App\Models\Contrato;
use Src\Core\Database;

Class ContratoRepository implements IContratoRepository
{

    private PDO $conn;

    public function __construct(Database $conn)
    {
        $this->conn = $conn->getConnection();
    }

    public function create(Contrato $contrato): Contrato
    {
        $sql = 'INSERT INTO tb_contrato (id, fornecedor, sei, startGov, contrato, objeto, vigencia_inico, vigencia_fim, created_at, status, updated_at)
                VALUES (:id, :fornecedor, :sei, :startGov, :contrato, :objeto, :vigencia_inico, :vigencia_fim, :created_at, :status, :updated_at)';
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':id', $contrato->getId(), PDO::PARAM_STR);
        $stmt->bindValue(':fornecedor', $contrato->getFornecedor());
        $stmt->bindValue(':sei', $contrato->getSei());
        $stmt->bindValue(':startGov', $contrato->getStartGov(), PDO::PARAM_NULL);
        $stmt->bindValue(':contrato', $contrato->getContrato(), PDO::PARAM_NULL);
        $stmt->bindValue(':objeto', $contrato->getObjeto());
        $stmt->bindValue(':vigencia_inico', $contrato->getVigencia_inico());
        $stmt->bindValue(':vigencia_fim', $contrato->getVigencia_fim());
        $stmt->bindValue(':created_at', $contrato->getCreated_at());
        $stmt->bindValue(':status', $contrato->getStatus(), PDO::PARAM_BOOL);
        $stmt->bindValue(':updated_at', $contrato->getUpdated_at());
        $stmt->execute();
        return $contrato;
    }    

    public function update(Contrato $contrato): Contrato
    {
        $sql = 'UPDATE tb_contrato
                SET status = :status, updated_at = :updated_at
                WHERE id = :id';
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':status', $contrato->getStatus(), PDO::PARAM_BOOL);
        $stmt->bindValue(':updated_at', $contrato->getUpdated_at());
        $stmt->bindValue(':id', $contrato->getId(), PDO::PARAM_STR);
        $stmt->execute();

        return $contrato;
    }

    public function getAll(): array
    {
        $sql = 'SELECT id, fornecedor, sei, startGov, contrato, objeto, vigencia_inico, vigencia_fim, status FROM tb_contrato ORDER BY id DESC';
        $stmt = $this->conn->query($sql);
        $itens = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $itens[] = new Contrato(
                $row['id'],
                $row['fornecedor'],
                $row['sei'],
                $row['startGov'],
                $row['contrato'],
                $row['objeto'],
                $row['vigencia_inico'],
                $row['vigencia_fim'],
                null,
                (bool) $row['status'],
                null,
            );
        }

        return $itens;
    }

    public function getById(string $id): ?Contrato
    {
        $sql = 'SELECT * FROM tb_contrato WHERE id = :id';
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_STR);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            return new Contrato(
                $row['id'],
                $row['fornecedor'],
                $row['sei'],
                $row['startGov'],
                $row['contrato'],
                $row['objeto'],
                $row['vigencia_inico'],
                $row['vigencia_fim'],
                $row['created_at'],
                (bool) $row['status'],
                $row['updated_at'],
            );
        }

        return null;
    }

    public function delete(string $id): bool
    {
        $sql = 'DELETE FROM tb_contrato WHERE id = :id';
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_STR);
        return $stmt->execute();
    }


    public function count(): int
    {
        $stmt = $this->conn->query('SELECT COUNT(*) FROM tb_contrato');
        return (int) $stmt->fetchColumn();
    }



}

?>