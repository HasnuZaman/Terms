@extends('layouts.app')


@section('content')
<h1>Create Terms</h1>
          {!! Form::open(['action'=> 'TermsController@store', 'method'=> 'POST']) !!}

               <div class="form-group">
                   {{Form::label('termTitle','Title')}}
                   {{Form::text('termTitle','',['class'=>'form-control','placeholder'=>'Title'])}}
               </div>

               <div class="form-group">
                    {{Form::label('termCondition','Body')}}
                    {{Form::textarea('termCondition','',['id'=>'article-ckeditor','class'=>'form-control','placeholder'=>'Body Text'])}}
                </div>
              {{Form::submit('Submit',['class'=>'btn btn-primary'])}}

          {!! Form::close() !!}
@endsection
