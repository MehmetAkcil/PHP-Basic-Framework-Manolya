<?php

namespace Core\Config;

use Core\Config\QueryBuilderTraits\LikeTrait;
use Core\Config\QueryBuilderTraits\OtherQueryTrait;
use Core\Config\QueryBuilderTraits\SelectTrait;
use Core\Config\QueryBuilderTraits\WhereTrait;

class QueryBuilder extends Database
{

    use WhereTrait, SelectTrait, LikeTrait, OtherQueryTrait;

    private string $sql = '';

    private string $table;
    private array $select = [];
    private array $where = [];
    private array $orderBy = [];
    private string $limit;
    private array $join = [];
    private array $groupBy;
    private array $having = [];

    public function table($table): static
    {
        $this->table = $table;
        return $this;
    }

    private function builder(): string // metni olustur
    {
        $sql = 'SELECT ';

        if (!empty($this->select)) {
            $sql .= implode(', ', $this->select);
        }

        if (!empty($this->table)) {
            $sql .= " FROM {$this->table}";
        }

        if (!empty($this->join)) {
            $sql .= " " . implode(' ', $this->join);
        }

        $sql .= " WHERE ";

        if (!empty($this->where)) {
            $sql .= $this->removeLeadingAnd(implode(' ', $this->where));
        }

        if (count($this->where) <= 0) {
            $sql .= "1";
        }

        if (!empty($this->groupBy)) {
            $sql .= " GROUP BY " . implode(", ", $this->groupBy);
            if (!empty($this->having)) {
                $sql .= " HAVING " . $this->removeLeadingAnd(implode(' ', $this->having));
            }
        }

        if (!empty($this->orderBy)) {
            $sql .= " ORDER BY " . implode(", ", $this->orderBy);
        }

        if (!empty($this->limit)) {
            $sql .= " LIMIT " . $this->limit;
        }

        return $sql;
    }

    public function get(): false|array //verileri getir
    {
        $sql = $this->builder();
        return $this->getRows($sql);
    }

    public function first() //veri getir
    {
        $sql = $this->builder();
        return $this->getRow($sql);
    }


    public function countAll(): int
    {
        $sql = $this->builder();
        return count($this->getRows($sql));
    }


    private function removeLeadingAnd($str)
    {
        // Başlangıçtaki boşlukları sil
        $str = ltrim($str);

        // Eğer başlangıçta AND varsa, ikinci kelimeye kadar kes
        if (strpos($str, 'AND') === 0) {
            $str = substr($str, strpos($str, ' ') + 1);
        }

        // Eğer başlangıçta AND varsa, ikinci kelimeye kadar kes
        if (strpos($str, 'OR') === 0) {
            $str = substr($str, strpos($str, ' ') + 1);
        }

        return $str;
    }

}
