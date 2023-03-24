<?php

namespace Core\Config\QueryBuilderTraits;

trait LikeTrait{

    public function like(String $where, String $value, String $wild = 'all'): static
    {
        $this->where[] = match ($wild) {
            'before' => "AND {$where} LIKE '%{$value}'",
            'after' => "AND {$where} LIKE '{$value}%'",
            default => "AND {$where} LIKE '%{$value}%'",
        };
        return $this;
    }

    public function orLike(String $where, String $value, String $wild = 'all'): static
    {
        $this->where[] = match ($wild) {
            'before' => "OR {$where} LIKE '%{$value}'",
            'after' => "OR {$where} LIKE '{$value}%'",
            default => "OR {$where} LIKE '%{$value}%'",
        };
        return $this;
    }

    public function notLike(String $where, String $value, String $wild = 'all'): static
    {
        $this->where[] = match ($wild) {
            'before' => "AND {$where} NOT LIKE '%{$value}'",
            'after' => "AND {$where} NOT LIKE '{$value}%'",
            default => "AND {$where} NOT LIKE '%{$value}%'",
        };
        return $this;
    }

    public function orNotLike(String $where, String $value, String $wild = 'all'): static
    {
        $this->where[] = match ($wild) {
            'before' => "OR {$where} NOT LIKE '%{$value}'",
            'after' => "OR {$where} NOT LIKE '{$value}%'",
            default => "OR {$where} NOT LIKE '%{$value}%'",
        };
        return $this;
    }
}