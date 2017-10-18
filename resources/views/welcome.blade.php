@extends('layouts.app')

@section('content')

@foreach ($articles->sortByDesc('id') as $article)
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3>{{$article->title}}</h3>
                </div>
            <div class=" panel-body">
                <p>{{$article->description}}<p>
            </div>
            <div class="panel-body">
                @foreach ($photos as $photo)
                    @if ($article->id == $photo->article_id)
                        <img src="{{asset('/storage/'.$photo->photo_path)}}" class="img-responsive img-thumbnail col-sm-4">
                    @endif
                @endforeach
            </div>
            </div>
        </div>
    </div>
</div>
@endforeach                     
@endsection
