<?php

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// this is calling the Blade template welcome.blade.php in the /resources/views
Route::get('/', function () {
    return view('welcome');
});

// access a Blade template
Route::get('/blade', function () {

    return view('list', [
        // get all records from the database that were completed.
        // To get all records use Task::all() or Task::get(); the latter is intended for custom queries.
        'tasks' => Task::where('completed', true)->get(),
    ]);

})->name('tasks.list');

// form page; note that routes are initialised in the same order presented here (place this before /blade/{id})
Route::view('/blade/create', 'create');

Route::get('/blade/{id}', function ($id) {

    // attempt to return the entity, or return a 404 if null
    return view('show', ['task' => Task::findOrFail($id)]);

})->name('tasks.index');

Route::post('/blade', function (Request $request) {
    // dump and die (dump data to a web browser view)
    dd('POST create task route invoked', $request->all());
})->name('tasks.store');

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
