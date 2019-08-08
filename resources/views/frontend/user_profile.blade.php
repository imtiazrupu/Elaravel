@extends('layout')
@section('title','Profile')
@section('content')
<li>
    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
     document.getElementById('logout-form').submit();">
       <i class="icon-tasks"></i><span>Log Out</span>
    </a>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
     @csrf
    </form>

</li>

@endsection
