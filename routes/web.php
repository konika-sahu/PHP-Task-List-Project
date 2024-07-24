<?php

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Route;
use League\CommonMark\Extension\DescriptionList\Node\Description;

Route::get('/', function(){
    return redirect()-> route('tasks.index');
});

Route::get('/tasks', function() {
    return view('index', [
        'tasks' => Task::latest()->where('completed', false)->get()
    ]);
})-> name('tasks.index');

Route::view('/tasks/create', 'create')->name('tasks.create');

Route::get('/tasks/{task}/edit', function(Task $task) {
    return view('edit', [
      'task'=> $task
    ]);
})-> name('tasks.show');

Route::get('/tasks/{task}', function(Task $task) {
    return view('show', [
      'task'=> $task
    ]);
})-> name('tasks.show');

Route::post('/tasks', function(Request $request){
  $data = $request->validate([
      'title' => 'required|max:255',
      'description' => 'required',
      'long_description' => 'required'
  ]);

  $task = new Task;
  $task->title = $data['title'];
  $task->description = $data['description'];
  $task->long_description = $data['long_description'];
  $task->save();

  return redirect()->route('tasks.show', ['id' => $task->id])
  ->with('success', 'Task created successfully!');

})->name('tasks.store');

Route::put('/tasks/{task}', function(Task $task, Request $request){
    $data = $request->validate([
        'title' => 'required|max:255',
        'description' => 'required',
        'long_description' => 'required'
    ]);
  
    $task->title = $data['title'];
    $task->description = $data['description'];
    $task->long_description = $data['long_description'];
    $task->save();
  
    return redirect()->route('tasks.show', ['id' => $task->id])
    ->with('success', 'Task updated successfully!');
  
  })->name('tasks.update');

Route::fallback( function(){
    return 'Still got somewhere!';
});



// Route::get('/hello', function(){
//     return 'Hello';
// })-> name('hello');

// Route::get('/hi', function(){
//     return redirect()-> route('hello');
// });

// Route::get('/greet/{name}', function($name){
//     return 'Hello '. $name . ' !';
//});