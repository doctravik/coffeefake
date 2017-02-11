<?php

namespace App\Support\Storage;

use App\Support\Storage\StorageInterface;

class SessionStorage implements StorageInterface
{
    /**
     * Create new instance of the SessionStorage
     */
    public function __construct()
    {
        $this->name = 'cart';

        if(! session()->exists($this->name)) { 
            session([$this->name => []]);
        }        
    }

    /**
     * Get value by key.
     * 
     * @param  string $index
     * @return mixed
     */
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

    /**
     * Whether storage has the key.
     * 
     * @param  string  $index
     * @return boolean
     */
    public function has($index)
    {
        if(! session()->has($this->name)) {
            return false;
        }

        return array_has(session($this->name), $index);
    }

    /**
     * Set value to the item.
     * 
     * @param  string $index
     * @param  mixed $value
     * @return void
     */
    public function put($index, $value)
    {
        session()->put($this->key($index), $value);        
    }

    /**
     * Remove item from storage.
     * 
     * @param  string $index
     * @return void
     */
    public function forget($index)
    {
        if($this->has($index)) {
            session()->forget($this->key($index));
        }
    }

    /**
     * Get all items from the storage.
     * 
     * @return array
     */
    public function all()
    {        
        return session($this->name);
    }

    /**
     * Count all items in the storage.
     * 
     * @return integer
     */
    public function count()
    {
        return count(session($this->name));
    }

    /**
     * Clear storage from all items.
     * 
     * @return void
     */
    public function clear()
    {
        session([$this->name => []]);
    }
}