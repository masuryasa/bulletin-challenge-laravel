@extends('layout.user')

@section('main-container')
    <div class="row">
        <div class="col-md-6 col-md-offset-3 bg-white p-30 box">
            <div class="text-center">
                <h1 class="text-green mb-30"><b>Level 8 Challenge</b></h1>
            </div>
            <form action="{{ url('insert-message') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control">
                    <p class="small text-danger mt-5">*Your name must be 3 to 16 characters long</p>
                </div>
                <div class="form-group">
                    <label>Title</label>
                    <input type="text" name="title" class="form-control">
                </div>
                <div class="form-group">
                    <label>Body</label>
                    <textarea rows="5" name="body" class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <label>Choose image from your computer :</label>
                    <div class="input-group">
                        <input type="text" class="form-control upload-form" value="No file chosen" readonly>
                        <span class="input-group-btn">
                            <span class="btn btn-default btn-file">
                                <i class="fa fa-folder-open"></i>&nbsp;Browse <input type="file" name="image" multiple>
                            </span>
                        </span>
                    </div>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control">
                </div>
                <div class="text-center mt-30 mb-30">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
            <hr>

            @foreach ($messages as $message)
                <div class="post">
                    <div class="clearfix">
                        <div class="pull-left">
                            <h2 class="mb-5 text-green"><b>{{ $message->title }}</b></h2>
                        </div>
                        <div class="pull-right text-right">
                            <p class="text-lgray">{{ $message->date }}<br /><span
                                    class="small">{{ $message->time }}</span>
                            </p>
                        </div>
                    </div>
                    <h4 class="mb-20">{{ $message->name }} <span
                            class="text-id">{{ $message->id }}</span></h4>
                    <p>{{ $message->body }}</p>
                    @if (isset($message->image_path))
                        <img class="img-responsive img-post my-15"
                            src="{{ asset('storage/images/' . explode('/', $message->image_path)[2]) }}"
                            alt="image-message" />
                    @endif

                    @if (isset($message->pass))
                        <form class="form-inline mt-50">
                            <div class="form-group mx-sm-3 mb-2">
                                <label for="inputPassword2" class="sr-only">Password</label>
                                <input type="password" class="form-control" id="inputPassword2" placeholder="Password">
                            </div>
                            <a type="submit" class="btn btn-default mb-2" data-toggle="modal" data-target="#editModal"><i
                                    class="fa fa-pencil p-3"></i></a>
                            <a type="submit" class="btn btn-danger mb-2" data-toggle="modal" data-target="#deleteModal"><i
                                    class="fa fa-trash p-3"></i></a>
                        </form>
                    @endif
                </div>
            @endforeach

            <div class="text-center mt-30">
                <nav>
                    <ul class="pagination">
                        <li><a href="#">&laquo;</a></li>
                        <li><a href="#">&lsaquo;</a></li>
                        <li class="active"><a href="#">1</a></li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#">4</a></li>
                        <li><a href="#">5</a></li>
                        <li><a href="#">&rsaquo;</a></li>
                        <li><a href="#">&raquo;</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
@endsection
