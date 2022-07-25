<?php

class Route
{
    private string $url;
    private string $controller;
    private string $name;

    public function get(string $url, string $controller): static
    {
        $this->url = $url;
        $this->controller = $controller;

        return $this;
    }

    public function name(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function show()
    {
        return $this->url. ' - ' . $this->controller . ' - ' . $this->name;
    }
}

$route = new Route();

$route->get('/kontakt', 'Kontaktcontroller')->name('kontaktFormular');

echo $route->show();
