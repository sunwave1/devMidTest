<?php

class Storage {
    private array $storages = [];

    public function __construct(){}
    
    public function set(string $key, mixed $value, \Closure $callback = null) : Storage
    {
        $this->storages[ $key ][ 'value' ] = $value;
        $this->storages[ $key ][ 'operator_delete' ] = $callback($value);

        return $this;
    }

    public function all() : array {
        
        return $this->storages;
    }

    public function get(string $key) : mixed {

        return isset($this->storages[ $key ]) ? array_merge($this->storages[ $key ], ['reference' => $key]) : null;
    }

    public function has(string $key) : bool {

        return $this->get($key) !== NULL;
    }

    public function erase(string $key) : Storage {

        $sto = $this->storages[ $key ];

        if(!empty( $sto ) && is_callable( $sto['operator_delete'] )){
            $sto['operator_delete']();
        }

        unset($this->storages[ $key ]);

        return $this;
    }

    public function clear() : Storage {

        foreach ($this->storages as $key => $value) {
            if(is_callable( $value['operator_delete'] )){
                $value['operator_delete']();
            }
        }

        $this->storages = [];

        return $this;
    }
}