<?php

use Illuminate\Support\Facades\Route;

// this is calling the Blade template welcome.blade.php in the /resources/views
Route::get('/', function () {
    return view('welcome');
});

// access a Blade template
Route::get('/blade', function () {
    // pass the sub-phrase that precedes .blade.php i.e. index (of index.blade.php), with variables
    return view('index', [
        // note that the HTML elements are escaped and displayed as literally given, blocking cross-site scripting attacks;
        // HTML elements would have to be defined in the template instead
        'name' => 'JimJom<script></script>',
    ]);
});

$routeList = 'To list all routes defined here (and a few others defined by Laravel), enter: php artisan route:list' . PHP_EOL;

// path parameters (note we are passing an anonymous function so need to give it access to $routeList)
Route::get('/greet/{name}', function ($name) use ($routeList) {
    return 'Greeting ' . $name . "<br/><br/>" . $routeList;
});

// handling redirects
Route::get('/goto/{name?}', function ($page) use ($routeList) {
    if ($page == 'welcome') {
        return redirect('/');
    }

    if ($page == 'named') {
        // this redirect ignores the URL path (defined by namedRoute) and instead refers to the name of the Route instance
        return redirect()->route('namedRoute');
    }

    return 'Go to page ' . $page . "<br/><br/>" . $routeList;
});

$namedRoutes = "Note that Route::get returns an instance of Route, so one can set the name of the route and have it
 listed on entering php artisan route:list<br/><br/>";

Route::get('/named', function () use ($namedRoutes) {
    return $namedRoutes . "<br/><br/>";
})->name('namedRoute');

// a fallback route
Route::fallback(function () use ($routeList) {
    return "This is the fallback route<br/><br/>" . $routeList;
});
