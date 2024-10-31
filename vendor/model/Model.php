<?php 

namespace Vendor\model;

require __DIR__ . '/../autoload.php';

use Config\DataBase;
use PDO;

abstract class Model implements IModel
{
    public ?PDO $conn;
    public string $table_name;
    public array $fields;
    
    public function __construct()
    {
        $this->conn = DataBase::conn();
    }

    /**
     * @param array $fields Deve ter o seguinte padrão: ['id', 'nome', 5, '*'] ou ['id as codigo', 'nome'] ou ['tabela.descricao']
     * @param array $join Deve ter o seguinte padrão: ['nome_tabela', 'campo_referencia', 'tipo_join', 'alias_campo_referencia'] ou [['nome_tabela', 'campo_referencia', 'tipo_join', 'alias_campo_referencia'], ['nome_tabela', 'campo_referencia', 'tipo_join', 'alias_campo_referencia']]
     * @param array $where Deve ter o seguinte padrão: ['id', '=', 5, 'ORDER...DESC'] ou ['status', 'in', '(1,2,3)', 'ORDER...DESC']
     */
    public function select(array $fields = ['*'], array $join = null, array $where = null): array
    {
        $fields = rtrim(implode(',', $fields), ',');

        if ($join) {
            if (!is_array($join[0])) {
                $join = "{$join[2]} JOIN {$join[0]} ON {$join[0]}.{$join[1]} = {$this->table_name}.{$join[1]}";
            }

            if (is_array($join[0])) {
                $join = array_reduce($join, function ($return, $value): string {
                    $return .= "{$value[2]} JOIN {$value[0]} ON {$value[0]}.{$value[1]} = {$this->table_name}.({$value[3]} ?? {$value[1]}) ";

                    return $return;
                });
            }
        }

        $where = $where 
            ? "WHERE {$this->table_name}.{$where[0]} {$where[1]} {$where[2]} $where[3]"
            : '';

        $stmt = $this->conn->prepare(<<<SQL
            SELECT {$fields} 
            FROM {$this->table_name} 
            {$join} 
            {$where}
        SQL);

        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * @param array $data Recomenda-se receber um dto.
     */
    public function insert(array $data): bool
    {
        $fields = implode(', ', $this->fields);

        foreach ($this->fields as $key => $value) {
            $values[] = $key;
        }

        $values = array_reduce($values, function ($return, $value): string {
            $return .= ":{$value},";
            return $return;
        });

        $values = rtrim($values, ',');

        $stmt = $this->conn->prepare(<<<SQL
            INSERT INTO {$this->table_name} ({$fields})
            VALUES ({$values})
        SQL);

        foreach ($this->fields as $key => $value) {
            $stmt->bindValue(":{$key}", $data["$value"], match (true) {
                empty($data["$value"])            => PDO::PARAM_NULL,
                is_int($data["$value"])    => PDO::PARAM_INT,
                is_float($data["$value"])  => PDO::PARAM_STR,
                is_bool($data["$value"])   => PDO::PARAM_BOOL,
                is_string($data["$value"]) => PDO::PARAM_STR,
                default => PDO::PARAM_STR
            });
        }

        return $stmt->execute();
    }

    public function update(array $data, int $id = null): bool
    {
        array_walk($data, function ($value, $key) use (&$values): string {
            $values .= "{$key} = :{$key},";

            return $values;
        });

        $values = rtrim($values, ',');
        $where = $id 
            ? 'WHERE id = :id' 
            : '';

        $stmt = $this->conn->prepare(<<<SQL
            UPDATE {$this->table_name} 
            SET 
                {$values} 
            {$where}
        SQL);

        if ($id) $stmt->bindValue(":id", $id, PDO::PARAM_INT);

        foreach ($data as $key => $value) {
            $stmt->bindValue(":{$key}", $value, match (true) {
                empty($value)            => PDO::PARAM_NULL,
                is_int($value)    => PDO::PARAM_INT,
                is_float($value)  => PDO::PARAM_STR,
                is_bool($value)   => PDO::PARAM_BOOL,
                is_string($value) => PDO::PARAM_STR,
                default => PDO::PARAM_STR
            });
        }

        return $stmt->execute();
    }

    public function delete(int $id): bool
    {
        $where = 'WHERE id = :id';

        $stmt = $this->conn->prepare(<<<SQL
            DELETE FROM {$this->table_name} 
            {$where}
        SQL);

        $stmt->bindValue(':id', $id, PDO::PARAM_INT);

        return $stmt->execute();
    }

    public function begin(): bool
    {
        return $this->conn->beginTransaction();
    }

    public function rollback(): bool
    {
        return $this->conn->rollBack();
    }

    public function commit(): bool
    {
        return $this->conn->commit();
    }
    
    public function __destruct()
    {
        $this->conn = null;
    }
}
