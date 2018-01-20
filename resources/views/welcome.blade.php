@extends('layouts.app')

@section('content')
@guest
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <h1><span class="text-danger">
                        <strong>Register or login</strong>
                    </span> to your zen home.
                </h1>
            </div>
        </div>
    </div>
@else
    <tasks></tasks>
@endguest
@endsection