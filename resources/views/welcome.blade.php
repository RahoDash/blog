@extends('layouts.app')

@section('content')

<div class="modal fade" id="addModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ajouter une image</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="InputFile">Images à ajouter</label>
                    <input type="file" class="form-control-file" id="imgContent" name="imgContent[]" multiple aria-describedby="fileHelp" accept="image/*" value="{{ old('imgContent.*') }}" required>
                    <small id="fileHelp" class="form-text text-muted">Maintenez Ctrl. pour selectionner plusieurs images à la fois</small>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary">Save changes</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


@foreach ($articles->sortByDesc('id') as $article)
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
                    <p>{{$article->description}}<p>
                </div>
                <div class="panel-body">
                    @foreach ($photos as $photo)
                        @if ($article->id == $photo->article_id)
                            <div class="img-wrap col-sm-3">
                                <form action="{{ url('/photo',$photo) }}" method="POST">
                                    {!! csrf_field() !!}
                                    <input type="hidden" name="_method" value="delete">
                                    <button type="submit" class="close rounded no_padding"><span type="submit" class="close pull-right">&times;</span></button>
                                </form>

                                <a class="thumbnail" data-fancybox="gallery{{$photo->article_id}}" rel="ligthbox" href="/storage/{{ $photo->photo_path }}">
                                    <img src="{{asset('/storage/'.$photo->photo_path)}}" class="">
                                </a>
                            </div>
                        @endif
                    @endforeach
                <!-- Button trigger modal -->

                </div>
                <div class="panel-body panel-footer">
                    <button type="button" class="btn btn-primary pull-left" data-toggle="modal" data-target="#addModal">
                        Ajouter des photos
                    </button>
                    <form class="pull-left" action="{{ url('/',$article) }}" method="POST">
                        {!! csrf_field() !!}
                        <input type="hidden" name="_method" value="delete">
                        <button type="submit" class="btn btn-default btn-md float-right"><span class="glyphicon glyphicon-trash"></span></button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endforeach                     
@endsection
