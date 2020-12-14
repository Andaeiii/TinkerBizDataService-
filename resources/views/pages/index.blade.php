@extends('layouts/main')

@section('main_body')


    <div id="page-title">
        <h2>{{$pg_title}}</h2>
        <p>{{$pg_desc}}</p>
    </div>



    <div class="row">
        <div class="col-md-8">
            <div class="panel">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-6">
                        
                            <h3 class="title-hero">
                                All Users
                            </h3>

                            <div class="example-box-wrapper">
                            









                            </div>


                        </div>
                        
                    </div>
                </div>
            </div>
        </div>


        <div class="col-md-4">
            <div class="panel">
                <div class="panel-body">
                    <h3 class="title-hero">
                        Pager
                    </h3>

                    <div class="example-box-wrapper">

                        <ul class="pager">
                            <li><a href="#">Previous</a></li>
                            <li><a href="#">Next</a></li>
                        </ul>

                    </div>

                    <h3 class="title-hero">
                        Disabled state
                    </h3>

                    <div class="example-box-wrapper">

                        <ul class="pager">
                            <li class="previous disabled"><a href="#">← Older</a></li>
                            <li class="next"><a href="#">Newer →</a></li>
                        </ul>

                    </div>
                </div>
            </div>
        </div>


        
    </div>


@stop