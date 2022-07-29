<?php

namespace App\Blog;

class Blog
{
    public function greet(string $name): string
    {
        return 'Hallo, ' . $name;
    }
}
