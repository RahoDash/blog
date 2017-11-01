@extends('layouts.app')

@section('content')

<div class="modal fade" id="addModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="InputFile">Images à ajouter</label>
                    <input type="file" class="form-control-file" id="imgContent" name="imgContent[]" multiple aria-describedby="fileHelp" accept="image/*" value="{{ old('imgContent.*') }}" required>
                    <small id="fileHelp" class="form-text text-muted">Maintenez Ctrl. pour selectionner plusieurs images à la fois</small>
                </div>            </div>
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
                            <div class="img-wrap col-sm-4">
                                <form action="{{ url('/photo',$photo) }}" method="POST">
                                    {!! csrf_field() !!}
                                    <input type="hidden" name="_method" value="delete">
                                    <button type="submit" class="close rounded no_padding"><span type="submit" class="close pull-right">&times;</span></button>
                                </form>

                                <a class="thumbnail" data-fancybox="gallery" rel="ligthbox" href="/storage/{{ $photo->photo_path }}">
                                    <img src="{{asset('/storage/'.$photo->photo_path)}}" class="">
                                </a>
                            </div>
                        @endif
                    @endforeach
                <!-- Button trigger modal -->

                </div>
                <div class="panel-body">
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
