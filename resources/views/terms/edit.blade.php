@extends('layouts.app')


@section('content')
<h1>Create Terms</h1>
          {!! Form::open(['action'=> ['TermsController@update',$term->term_id], 'method'=> 'POST']) !!}

               <div class="form-group">
                   {{Form::label('termTitle','Title')}}
                   {{Form::text('termTitle',$term->term_title,['class'=>'form-control','placeholder'=>'Title'])}}
               </div>

               <div class="form-group">
                    {{Form::label('termCondition','Body')}}
                    {{Form::textarea('termCondition',$term->term_condition,['id'=>'article-ckeditor','class'=>'form-control','placeholder'=>'Body Text'])}}
                </div>
                {{Form::hidden('_method','PUT')}}
              {{Form::submit('Submit',['class'=>'btn btn-primary'])}}

          {!! Form::close() !!}
@endsection
