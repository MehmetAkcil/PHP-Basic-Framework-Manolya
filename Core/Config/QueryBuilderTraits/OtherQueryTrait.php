<?php
namespace Core\Config\QueryBuilderTraits;

trait OtherQueryTrait{
    public function orderBy($orderBy, $dist): static
    {
        $this->orderBy[] = "{$orderBy} {$dist}";
        return $this;
    }

    public function groupBy($groupBy): static // "title DESC, name ASC"
    {
        $items = implode(', ', (array) $groupBy);
        $this->groupBy[] = $groupBy;
        return $this;
    }

    public function having($having, $value): static
    {
        if(stristr($having, " ")){
            $this->having[] = "AND {$having} {$value}";
        }else{
            $this->having[] = "AND {$having} = {$value}";
        }
        return $this;
    }


    public function join($table, $join, $position = 'INNER'): static
    {
        $this->join[] = "{$position} JOIN {$table} ON {$join}";
        return $this;
    }

    public function limit($limit, $offset = null): static
    {
        $this->limit = $limit;
        if($offset !== null){
            $this->limit .= " OFFSET {$offset}";
        }
        return $this;
    }
}