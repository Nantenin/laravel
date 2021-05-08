@extends('layouts.app')

@section('extra-js')
   {!! NoCaptcha :: renderJs () !!}
@endsection
@section('content')

<div class="container">
    <h1>Crée un sujet</h1>
    <hr>

    <form action="{{ route('subjects.store') }}" method="post">
      @csrf

      <div class="form-group">
          <label for="title">Titre du sujet</label>
          <input type="text" class="form-control @error('title') is-invalid @enderror"  name="title" id="title">
            @error('title')
                <div class="invalid-feedback">{{ $errors->first('title')}}</div>    
            @enderror
      </div>
      <div class="form-group">
           <label for="content">Votre sujet</label>
           <textarea name="content" id="content" class="form-control @error('content') is-invalid  @enderror"  rows="5"></textarea>
           @error('content')
                <div class="invalid-feedback">{{ $errors->first('content')}}</div>    
            @enderror
      </div>
      <div class="form-group">
        {!! NoCaptcha :: display () !!}
      </div>
      <button type="submit" class="btn btn-primary">Crée mon sujet</button>
    </form>
    
</div>
     
@endsection