<h1>
    The List of Task !
</h1>

<div>
    {{-- @if (count($tasks)) --}}
    @forelse ($tasks as $task)
            <div> 
                <a href=" {{ route('tasks.show', ['id'=> $task->id ]) }}"> {{$task -> title }} </a>
            </div>            
    @empty
        <div>Oops! There are no Tasks!</div>
    @endforelse
    {{-- @endif --}}
</div>