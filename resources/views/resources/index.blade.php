@extends('layouts.app')
@section('content')
    <div class="container">
        <h1>Community Resources</h1>
        <ul>
            @foreach($resources as $resource)
                <li>{{ $resource->type }}: {{ $resource->amount }} by User {{ $resource->user_id }}
                    @if($resource->hedera_tx_id)
                        (Hedera Tx: {{ $resource->hedera_tx_id }})
                    @endif
                </li>
            @endforeach
        </ul>
        <a href="{{ route('dashboard') }}" class="text-blue-500">Back to Dashboard</a>
    </div>
@endsection