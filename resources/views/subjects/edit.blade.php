@extends('layouts.app')

@section('content')

<div class="container">
    <h1>{{ $subject->title}}</h1>
    <hr>

    <form action="{{ route('subjects.update', $subject) }}" method="post">
      @csrf
      @method('PATCH')
      <div class="form-group">
          <label for="title">Titre du sujet</label>
          <input type="text" class="form-control @error('title') is-invalid @enderror"  name="title" id="title" value="{{$subject->title}}">
            @error('title')
                <div class="invalid-feedback">{{ $errors->first('title')}}</div>    
            @enderror
      </div>
      <div class="form-group">
           <label for="content">Votre sujet</label>
           <textarea name="content" id="content" class="form-control @error('content') is-invalid  @enderror"  rows="5">{{$subject->content}}</textarea>
           @error('content')
                <div class="invalid-feedback">{{ $errors->first('content')}}</div>    
            @enderror
      </div>
      <button type="submit" class="btn btn-primary">Modifier mon sujet</button>
    </form>
    
</div>
     
@endsection