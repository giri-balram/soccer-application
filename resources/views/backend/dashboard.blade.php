@extends('layouts.app')

@include('backend.partial.navpartial')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Dashboard</div>

                    <div class="panel-body">
                        Wellcome {{ Auth::user()->name }}
                    </div>
                </div>
            </div>
           
        </div>
    </div>
@endsection
