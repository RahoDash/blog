@extends('layouts.app')

@section('content')
<div class="container">
    
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">    
                    titre
                </div>
                <div class=" panel-body">
                    Description
                </div>
                <div class=" panel-body">
                    <img src="{{url('/img/backgournd.jpg')}}" class="img-responsive img-thumbnail col-md-3">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
