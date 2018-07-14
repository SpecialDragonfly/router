#Router

A very very simple Router which compares against a regex but nothing more.

## Usage

```$php
$route = Route::get(
    '~/foo/bar$~',
    function() {
        // Replace with the class that will handle the request
        return 'controller'; 
    },
    'action' // The method to call on the afore-mentioned controller
);

$router = new Router();
$router->add($route);

$routeManager = new RouteManager($router);

// $request needs to be a PSR7 compatible object
$routeManager->routeRequest($request);
```