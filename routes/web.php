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

Route::get('/blade/{task}', function (Task $task) {
    return view('show', [
        'task' => $task
    ]);
})->name('tasks.show');

Route::get('/blade/{id}', function ($id) {

    // attempt to return the entity, or return a 404 if null
    return view('show', ['task' => Task::findOrFail($id)]);

})->name('tasks.index');

Route::post('/blade', function (Request $request) {
    // dump and die (dump data to a web browser view)
//    dd('POST create task route invoked', $request->all());

    // if validation fails, then the user is redirected back to this view with a list of errors (under {{ $errors }}
    // in the template).
    $data = $request->validate([
        'title' => 'required|max:255',
        'description' => 'required',
        'long_description' => 'required',
    ]);

    // Errors are saved to the User's session (browser gets a copy as a cookie) and can be saved to
    // /storage/framework/sessions, or saved to the sessions db table (see .env for SESSION_DRIVER), the JSON payload
    // is base64 encoded

    $task = new Task;

    // still don't need the Model definition
    $task->title = $data['title'];
    $task->description = $data['description'];
    $task->long_description = $data['long_description'];

    $task->save();

    // save key-value "success":"Task created!" to session, flash as message, and then remove the key-value pair from
    // the session
    return redirect()->route('tasks.show', ['task' => $task])
        ->with('success', 'Task created!');

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
