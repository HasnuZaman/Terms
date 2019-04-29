@extends('layouts.app')


@section('content')
<a href="{{ url('terms')}}" class="btn btn-default">Go Back</a>
<h1>{{$term->term_title}}</h1>

<div>
   {!!$term->term_condition!!}
</div>
<hr>
<small>{{$term->created_at}}</small>
<hr>
<small>{{$term->status}}</small>   
<hr/>
&nbsp;
@if(Session::get('SESS_USER_TYPE')=="admin")
<a href="{{ url('terms') }}/{{$term->term_id}}/edit" class="btn btn-warning">Edit</a>
{{-- <a href="{{ url('terms') }}/{{$term->term_id}}/delete" class="btn btn-danger">Delete</a> --}}
          {!! Form::open(['action'=> ['TermsController@destroy',$term->term_id], 'method'=> 'POST','class'=>'float-left']) !!}
          {{Form::hidden('_method','DELETE')}}
          {{Form::submit('Delete',['class'=>'btn btn-danger'])}}
          {!! Form::close() !!}
@elseif(Session::get('SESS_USER_TYPE')=="agent")
<a href="{{ url('approve') }}/{{$term->term_id}}" class="btn btn-success">Accept</a>

@endif
@endsection
