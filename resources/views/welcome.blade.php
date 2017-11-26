@extends('layouts.app')

@section('content')



@foreach ($articles->sortByDesc('id') as $article)
    <div class="modal fade" id="updateDescModal{{$article->id}}">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modifier la description</h5>
                    <button type="button" class="btn-close btn btn-link" data-dismiss="modal" aria-label="Close">
                        <span class="btn-close-icone"></span>
                    </button>
                </div>
                <form action="{{ action('ArticleController@updateDesc',$article->id) }}" method="POST" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="descritpion">Description des images</label>
                            <textarea class="form-control" id="description" name="description" rows="5" value="{{ old('descritpion') }}">{{$article->description}}</textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-primary">Modifier la descritpion</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div class="modal fade" id="addModal{{$article->id}}">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Ajouter une image</h5>
                    <button type="button" class="btn-close btn btn-link" data-dismiss="modal" aria-label="Close">
                        <span class="btn-close-icone"></span>
                    </button>
                </div>
                <form action="{{ action('PhotoController@addPicture',$article->id) }}" method="POST" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="InputFile">Images à ajouter</label>
                            <input type="file" class="form-control-file" id="imgContent" name="imgContent[]" multiple aria-describedby="fileHelp" accept="image/*" value="{{ old('imgContent.*') }}" required>
                            <small id="fileHelp" class="form-text text-muted">Maintenez Ctrl. pour selectionner plusieurs images à la fois</small>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-primary">Ajouter les photos</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="container">
    <div class="row">

        <div class="col-sm-3">
            <div class="panel panel-default title">
                <img class="img-responsive" src="/img/background.jpg">
                <div class="panel-heading">
                    <h4 class="text-left">{{$article->title}}</h4>
                </div>
            </div>
        </div>
        <div class="col-sm-9">
            <div class="panel panel-default">
                <div class=" panel-heading">
                    <div>
                    <span><h5>{{$article->description}}</h5></span>
                        @if((Auth::check()) && (Auth::user()->id == $article->user_id))
                            <button type="button" class="btn btn-primary pull-right button-modif-top" data-toggle="modal" data-target="#updateDescModal{{$article->id}}">
                                <span class="btn-modify"></span>
                            </button>
                        @endif
                    </div>
                </div>
                <div class="panel-body">
                    @foreach ($photos as $photo)
                        @if ($article->id == $photo->article_id)
                        <div class="col-sm-3">
                            @if((Auth::check()) && (Auth::user()->id == $article->user_id))
                                <form action="{{ url('/photo',$photo) }}" method="POST">
                                    {!! csrf_field() !!}
                                    <input type="hidden" name="_method" value="delete">
                                    <button type="submit" class="close rounded no_padding"><span class="btn-close-icone"></span></button>
                                </form>
                            @endif
                            <div class="image-wrap ">
                                <a class="thumbnail" data-fancybox="gallery{{$photo->article_id}}" rel="ligthbox" href="/storage/{{ $photo->photo_path }}">
                                    <img src="{{asset('/storage/'.$photo->photo_path)}}" class="">
                                </a>
                            </div>
                        </div>
                        @endif
                    @endforeach
                <!-- Button trigger modal -->

                </div>
                @if((Auth::check()) && (Auth::user()->id == $article->user_id))
                    <div class="panel-body panel-footer">
                        <button type="button" class="btn btn-primary pull-left btn-add-pic" data-toggle="modal" data-target="#addModal{{$article->id}}">
                            <span class="add-pic"></span>
                        </button>
                        <form class="pull-left" action="{{ url('/',$article) }}" method="POST">
                            {!! csrf_field() !!}
                            <input type="hidden" name="_method" value="delete">
                            <button type="submit" class="btn btn-danger float-right trash"><span class="btn-trash"></span></button>
                        </form>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endforeach                     
@endsection
