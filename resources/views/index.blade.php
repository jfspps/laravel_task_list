<div>
    <h2>
        Custom blade template
    </h2>
</div>

<div>
    {{--Check that the variable is defined with isset directive--}}
    @isset($name)
        {{--Only printed if the directive passed--}}
        The name passed: {{$name}}
    @endisset
</div>

<br/>

<div>
    @if(count($tasks))
        <div>Tasks presented: {{count($tasks)}}</div>
        <br/>
        @foreach($tasks as $task)
            <div>
                <li>{{$task->title}}</li>
            </div>
        @endforeach
    @else
        <div>No tasks presented</div>
    @endif
</div>

<br/>

{{--An alternative approach with forelse--}}
@forelse($tasks as $theTask)
    <li>{{$theTask->title}}</li>
@empty
    <div>No tasks presented</div>
@endforelse

<br/>

@forelse($tasks as $theTask)
    {{--route() generates a URL; pass a key-value pair "task":"theTasksId" to the route with name tasks.show--}}
    <li><a href="{{ route('tasks.show', ['task' => $theTask->id]) }}">{{ $theTask->title }}</a></li>
@empty
    <div>No tasks presented</div>
@endforelse
