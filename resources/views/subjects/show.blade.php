@extends('layouts.app')

@section('extra-js')
    <script>
      function toggleReplyComment(id){
        let element = document.getElementById('replyComment-' + id);
        element.classList.toggle('d-none');
      }
    </script>
@endsection

@section('content')

<div class="container">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $subject->title }}</h5>
            <p>{{ $subject->content }}</p>
            <div class="d-flex justify-content-between align-items-center">
                <small>Posté le {{ $subject->created_at->format('d/m/Y à H:m')}}</small> 
                <span class="badge bg-primary">{{ $subject->user->name}}</span>
            </div>
            <div class="d-flex justify-content-between align-items-center mt-3">
             
              @can('update', $subject)
              <a href="{{ route('subjects.edit', $subject) }}" class="btn btn-warning">Editer ce sujet</a>
              @endcan
              
              @can('delete', $subject)
              <form action=" {{ route('subjects.destroy', $subject)}} " method="post">
                @csrf
                @method('DELETE')
              <button type="submit" class="btn btn-danger">Supprimer</button>
            </form>
             @endcan
            </div>
        </div>
    </div>

    <hr>
    <h5>Commentaires</h5>

    @forelse ($subject->comments as $comment)
        <div class="card mt-2">
          <div class="card-body d-flex">
            <div> 
              {{ $comment->content}}
            <div class="d-flex justify-content-between align-items-center">
              <small>Posté le {{ $comment->created_at->format('d/m/Y')}}</small> 
              <span class="badge bg-primary">{{ $comment->user->name}}</span>
            </div>
          </div>
        <div>
          @auth
          @if (!$subject->solution && auth()->user()->id === $subject->user_id)
              <solution-button subject-id="{{ $subject->id }}" comment-id="{{ $comment->id }}"></solution-button>
          @else
              @if ($subject->solution === $comment->id)
                  <span class="badge badge-success">Marqué comme solution</span>
              @endif
          @endif
      @endauth
        </div>
          </div>
        </div>
        @foreach ($comment->comments as $replayComment)
        <div class="card mt-2 ms-5">
          <div class="card-body">
            {{ $replayComment->content}}
            <div class="d-flex justify-content-between align-items-center">
              <small>Posté le {{ $replayComment->created_at->format('d/m/Y')}}</small> 
              <span class="badge bg-primary">{{ $replayComment->user->name}}</span>
            </div>
          </div>
        </div> 
        @endforeach
        @auth
            
          <button class="btn btn-info mt-3" onclick="toggleReplyComment({{ $comment->id}})">Répondre</button>

          <form action="{{ route('comments.storeReplay', $comment)}}" method="POST" class="ms-5 d-none mt-3" id="replyComment-{{ $comment->id }}">
            @csrf
            <div class="form-group">
                  <label for="replayComment">Ma réponse</label>
                  <textarea name="replayComment" class="form-control @error('replayComment') is-invalid @enderror" id="replayComment"  rows="5"></textarea>
                  @error('replayComment')  
                     <div class="invalid-feedback">
                      {{ $errors->first('replayComment') }} 
                     </div>
                  @enderror
                </div>
            <button type="submit" class="btn btn-primary mt-3">Répondre à ce commentaire</button>
          </form>
        @endauth
    @empty
      <div class="alert alert-info">Aucun commentaire pour ce sujet</div> 
    @endforelse
    @auth
    <form action=" {{ route('comments.store', $subject)}} " method="POST" class="mt-3">
      @csrf
      <div class="form-group">
        <label for="content">Votre commentaire</label>
        <textarea class="form-control  @error('content') is-invalid @enderror" name="content" id="content"  rows="5"></textarea>
        @error('content')
          <div class="invalid-feedback">
            {{ $errors->first('content') }}  
          </div> 
      @enderror
      </div>
     <br> <button type="submit" class="btn btn-primary">Soumettre mon commentaire</button>
    </form>
    @else
       <div class="alert alert-info"><a href="{{ route('login') }}">Connectez-vous</a> pour participer au sujet ;)</div>
     @endauth
</div>
     
@endsection