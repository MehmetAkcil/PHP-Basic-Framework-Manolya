<?php

namespace Core\Config\QueryBuilderTraits;


trait WhereTrait
{

    public function where($where = null, $value = null): static
    {
        if (stristr($where, " ")) {
            $this->where[] = "AND {$where} {$value}";
        } elseif ($where === null) {
            $this->where[] = " 1";
        } else {
            $this->where[] = "AND {$where} = {$value}";
        }

        return $this;
    }

    public function orWhere($where, $value): static
    {
        if (stristr($where, " ")) {
            $this->where[] = "OR {$where} {$value}";
        } else {
            $this->where[] = "OR {$where} = {$value}";
        }
        return $this;
    }

    public function orWhereIn(string $where, array $value): static
    {
        $value = implode(',', $value);
        $this->where[] = "OR {$where} IN {$value}";
        return $this;
    }

    public function orWhereNotIn(string $where, array $value): static
    {
        $value = implode(',', $value);
        $this->where[] = "OR {$where} NOT IN {$value}";
        return $this;
    }

    public function whereNotIn(string $where, array $value): static
    {
        $value = implode(',', $value);
        $this->where[] = "AND {$where} NOT IN {$value}";
        return $this;
    }

    public function whereIn(string $where, array $value): static
    {
        $value = implode(',', $value);
        $this->where[] = "AND {$where} IN {$value}";
        return $this;
    }
}