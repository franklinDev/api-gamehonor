<?php

namespace App;

use Silex\Application;

class RoutesLoader
{
    private $app;

    public function __construct(Application $app)
    {
        $this->app = $app;
        $this->instantiateControllers();

    }

    private function instantiateControllers()
    {
        $this->app['games.controller'] = $this->app->share(function () {
            return new Controllers\GamesController($this->app['games.service']);
        });
    }

    public function bindRoutesToControllers()
    {
        $api = $this->app["controllers_factory"];

        $api->get('/games', "games.controller:getAll");
        $api->get('/games/{id}', "games.controller:getGameById");
        $api->post('/games', "games.controller:save");
        //$api->put('/notes/{id}', "notes.controller:update");
        //$api->delete('/notes/{id}', "notes.controller:delete");

        $this->app->mount($this->app["api.endpoint"].'/'.$this->app["api.version"], $api);
    }
}

