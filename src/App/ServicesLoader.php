<?php

namespace App;

use Silex\Application;

class ServicesLoader
{
    protected $app;

    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    public function bindServicesIntoContainer()
    {
        $this->app['games.service'] = $this->app->share(function () {
            return new Services\GamesService($this->app["db"]);
        });
    }
}

