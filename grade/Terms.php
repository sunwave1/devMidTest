<?php

class Terms {
    public function __construct(public array $terms = []){}

    public function get(int $id) : mixed {

        return $this->hasId( $id ) ? $this->terms[ $id ] : NULL;
    }

    public function find(int $id) : array|null {
        return $this->hasId( $id ) ? [
            "id" => $id,
            "name" => $this->get( $id )
        ] : NULL;
    }

    public function has(string $key) : bool {
        
        return !!array_filter( $this->terms, fn($it) => $it === $key );
    }

    public function hasId(int $id) : bool {
        
        return isset( $this->terms[ $id ] );
    }

    public function all() : array {
        
        return $this->terms;
    }

    public function erase(string $key) : Terms {

        unset( $this->terms[ $key ] );

        return $this;
    }

    public function clear() : Terms {

        $this->terms = [];

        return $this;
    }

    public function add(string $term) : Terms {

        $this->terms[ count( $this->terms ) + 1 ] = $term;

        return $this;
    }
}