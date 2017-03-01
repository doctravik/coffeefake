<?php

namespace App\Queries;

interface RawQuery
{
    public function prepareBindings();
    public function prepareStatement();
    public function execute();
}