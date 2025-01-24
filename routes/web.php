<?php

use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class Task
{
    public function __construct(
        public int     $id,
        public string  $title,
        public string  $description,
        public ?string $long_description,
        public bool    $completed,
        public string  $created_at,
        public string  $updated_at
    )
    {
    }
}

$tasks = [
    new Task(
        1,
        'Buy groceries',
        'Task 1 description',
        'Task 1 long description',
        false,
        '2023-03-01 12:00:00',
        '2023-03-01 12:00:00'
    ),
    new Task(
        2,
        'Sell old stuff',
        'Task 2 description',
        null,
        false,
        '2023-03-02 12:00:00',
        '2023-03-02 12:00:00'
    ),
    new Task(
        3,
        'Learn programming',
        'Task 3 description',
        'Task 3 long description',
        true,
        '2023-03-03 12:00:00',
        '2023-03-03 12:00:00'
    ),
    new Task(
        4,
        'Take dogs for a walk',
        'Task 4 description',
        null,
        false,
        '2023-03-04 12:00:00',
        '2023-03-04 12:00:00'
    ),
];

// this is calling the Blade template welcome.blade.php in the /resources/views
Route::get('/', function () {
    return view('welcome');
});

// access a Blade template
Route::get('/blade', function () use ($tasks) {
    // pass the sub-phrase that precedes .blade.php i.e. index (of index.blade.php), with variables
    return view('list', [
        'tasks' => $tasks,
    ]);
})->name('tasks.list');

Route::get('/blade/{id}', function ($id) use ($tasks) {
    // users may manually enter the ID, so guard against overflows first
    $task = collect($tasks)->firstWhere('id', $id);

    if (!$task) {
        abort(ResponseAlias::HTTP_NOT_FOUND);
    }

    return view('show', ['task' => $task]);

})->name('tasks.index');

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
