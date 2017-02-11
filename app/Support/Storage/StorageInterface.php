<?php

namespace App\Support\Storage;

interface StorageInterface
{
    public function get($index);
    public function has($index);
    public function all();
    public function put($index, $value);
    public function clear();
    public function count();
    public function forget($index);
}