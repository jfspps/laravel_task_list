Custom blade template:
<br/>
<br/>

{{--Check that the variable is defined with isset directive--}}
@isset($name)
{{--Only printed if the directive passed--}}
The name passed: {{$name}}
@endisset

<br/>
