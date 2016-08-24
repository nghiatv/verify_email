@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Dashboard</div>

                    <div class="panel-body">
                        @if (Session::has('message'))
                            <div class="alert alert-info">{{ Session::get('message') }}</div>
                        @endif

                        <div class="callout callout-info">
                            <h4>Vui lòng check mail nhá</h4>

                            <p>Chúng tôi đã gửi 1 thư đến hòm thư của bạn.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
