@extends('layouts.app')

@section('content')
<div class="card" style="width: 18rem;">
  <img class="card-img-top" src="https://i.pinimg.com/originals/0a/f8/0f/0af80f86eee9150f4443bfe871dbd99a.jpg" alt="Card image cap">
  <div class="card-body">
    <h5 class="card-title">{{ $task->title }}</h5>
    <p class="card-text">{{ $task->descriptions }}</p>
    <a href="{{ route('home') }}" class="btn btn-primary">Go home</a>
  </div>
</div>
@endsection