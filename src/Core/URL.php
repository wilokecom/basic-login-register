<?php

namespace Wiloke\Core;

class URL
{
    public function url($path)
    {
        return App::get('config/app')['homeURL'].rtrim($path, '/');
    }
}
