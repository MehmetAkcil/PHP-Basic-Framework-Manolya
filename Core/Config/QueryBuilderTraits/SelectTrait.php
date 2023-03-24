<?php

namespace Core\Config\QueryBuilderTraits;

trait SelectTrait
{

    public function select($select): static
    {
        $this->select[] = implode(', ', (array)$select);
        return $this;
    }

    public function selectCount($select, $as = null): static
    {
        $as = $as ?: $select;
        $this->select[] = "COUNT({$select}) as {$as}";
        return $this;
    }

    public function selectSum($select, $as = null): static
    {
        $as = $as ?: $select;
        $this->select[] = "SUM({$select}) as {$as}";
        return $this;
    }

    public function selectAvg($select, $as = null): static
    {
        $as = $as ?: $select;
        $this->select[] = "AVG({$select}) as {$as}";
        return $this;
    }

    public function selectMin($select, $as = null): static
    {
        $as = $as ?: $select;
        $this->select[] = "MIN({$select}) as {$as}";
        return $this;
    }

    public function selectMax($select, $as = null): static
    {
        $as = $as ?: $select;
        $this->select[] = "MAX({$select}) as {$as}";
        return $this;
    }
}