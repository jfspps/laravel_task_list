<?php

use App\Http\Requests\TaskRequest;
use App\Models\Task;
use Illuminate\Support\Facades\Route;

// this is calling the Blade template welcome.blade.php in the /resources/views
Route::get('/', function () {
    return view('welcome');
});

// access a Blade template
Route::get('/blade', function () {

    return view('list', [
        // get all records from the database (entities created recently coming first) and paginate, optionally, in blocks of ten
        'tasks' => Task::latest()->paginate(10),
    ]);

})->name('tasks.list');

// form page; note that routes are initialised in the same order presented here (place this before /blade/{id})
Route::view('/blade/create', 'create')->name('tasks.create');

Route::get('/blade/{task}/edit', function (Task $task) {

    // attempt to return the entity, or return a 404 if null;
    // Apply route model binding: inject the entity by some parameter (in this case primary key) and let Laravel
    // find the entity automatically. By default, will still expect the primary key of the entity, so we
    // can replace the literal ID and let Laravel imply through defaults
    return view('edit', ['task' => $task]);

})->name('tasks.edit');

Route::get('/blade/{task}', function (Task $task) {
    return view('show', [
        'task' => $task
    ]);
})->name('tasks.show');

Route::post('/blade', function (TaskRequest $request) {
    $validatedData = $request->validated();

    // instantiates and commits a new Task based on the array
    $task = Task::create($validatedData);

    // save key-value "success":"Task created!" to session, flash as message, and then remove the key-value pair from
    // the session
    return redirect()->route('tasks.show', ['task' => $task->id])
        ->with('success', 'Task created!');

})->name('tasks.store');

Route::put('/blade/{task}', function (TaskRequest $request, Task $task) {
    $validatedData = $request->validated();

    // updates the Task based on the array
    $task->update($validatedData);

    // save key-value "success":"Task created!" to session, flash as message, and then remove the key-value pair from
    // the session
    return redirect()->route('tasks.show', ['task' => $task->id])
        ->with('success', 'Task updated!');

})->name('tasks.update');

Route::delete('/blade/{task}', function (Task $task) {
    // HTTP 404 would be automatically returned if task not found

    $title = $task->title;

    // hard-delete
    $task->delete();

    return redirect()->route('tasks.list')
        ->with('success', 'Task, ' . $title . ', deleted!');

})->name('tasks.destroy');

Route::put('/blade/{task}/toggle-complete', function (Task $task) {
    $task->toggleCompleted();

    return redirect()->back()
        ->with('success', 'Task completion toggled!');
})->name('tasks.toggle-complete');


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
