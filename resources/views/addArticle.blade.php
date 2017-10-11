@extends('layouts.app')

@section('content')
<section class="jumbotron img-background personal-jumotron">
    <h1 class="text-center">title</h1>
</section>
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
