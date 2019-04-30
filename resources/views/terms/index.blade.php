@extends('layouts.app')


@section('content')

<h1>{{ $terms['termStatus'] == "not_active" ? "Pending Terms" : "Terms & Conditions" }}</h1>
   @if(count($terms['termsData']) >0)
   @foreach($terms['termsData'] as $term)
          <div class="card">
          <h3><a href="{{ url('terms') }}/{{$term->term_id}}">{{$term->term_title}}</a></h3>
          <small>Created at: {{$term->created_at}}</small>
          

          </div>
          <br>
   @endforeach

     {{-- {{$terms->links()}} --}}
   @else
   <p>No Terms Found</p>
   @endif


@endsection
