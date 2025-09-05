@extends('layouts.app')
@section('content')
    <div class="container">
        <h1>AI Resource Prediction</h1>
        <p>Prediction: {{ $prediction }}</p>
        <a href="{{ route('dashboard') }}" class="text-blue-500">Back to Dashboard</a>
    </div>
@endsection