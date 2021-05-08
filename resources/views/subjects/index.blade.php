@extends('layouts.app')

@section('content')

<div class="container">
    <div class="list-group">
        @foreach ($subjects as $subject)
            <div class="list-group-item">
                <h5><a href="{{ route('subjects.show', $subject)}}">{{ $subject->title }}</a></h5>
                 <p>{{ $subject->content }}</p>
                 <div class="d-flex justify-content-between align-items-center">
                    <small>Posté le {{ $subject->created_at->format('d/m/Y à H:m')}}</small> 
                    <span class="badge bg-primary">{{ $subject->user->name}}</span>
                </div>
            </div>
        @endforeach
    </div>
    <div class="d-flex justify-content-center mt-3">
        {{ $subjects->links() }}
    </div>
    
</div>
     
@endsection