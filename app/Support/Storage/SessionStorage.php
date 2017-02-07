<?php

namespace App\Support\Storage;

class SessionStorage
{
    public function __construct()
    {
        $this->name = 'cart';

        if(! session()->exists($this->name)) { 
            session([$this->name => []]);
        }        
    }

    public function get($index)
    {
        return session($this->key($index));
    }

    /**
     * Get 'dot' notation for the key.
     * 
     * @param  mixed $key
     * @return string
     */
    protected function key($key) {
        return "{$this->name}.$key";
    }

    public function has($index)
    {
        if(! session()->has($this->name)) {
            return false;
        }

        return array_has(session($this->name), $index);
    }

    public function put($index, $value)
    {
        session()->put($this->key($index), $value);        
    }

    public function forget($index)
    {
        if($this->has($index)) {
            session()->forget($this->key($index));
        }
    }

    public function all()
    {        
        return session($this->name);
    }

    public function count()
    {
        return array_reduce(session($this->name), function($sum, $item) {
            return $sum + $item['quantity'];
        }, 0);
    }
}