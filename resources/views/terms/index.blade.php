@extends('layouts.app')


@section('content')

<h1>{{ $terms[0]->term_status == "not_active" ? "Pending Terms" : "Terms & Conditions" }}</h1>
   @if(count($terms) >0)
   @foreach($terms as $term)
          <div class="card">
          <h3><a href="{{ url('terms') }}/{{$term->term_id}}">{{$term->term_title}}</a></h3>
          <small>Created at: {{$term->created_at}}</small>
          

          </div>
          <br>
   @endforeach
   {{ $terms[0]->term_status == "not_active" ? "" : $terms->links()}}
     {{-- {{$terms->links()}} --}}
   @else
   <p>No Terms Found</p>
   @endif


@endsection
