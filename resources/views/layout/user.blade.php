@extends('layout.template')

@section('body')

    <body class="bg-lgray">
        <header>
            <nav class="navbar navbar-default" role="navigation">
                <div class="container">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                            data-target="#bs-example-navbar-collapse-1">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <h2 class="font16 text-green mt-15"><b>Timedoor 30 Challenge Programmer</b></h2>
                    </div>

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav navbar-right">
                            @auth
                                {{-- <li><a href="{{ route('logout') }}">Logout</a></li> --}}
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf

                                        <a href={{ route('logout') }} id="logout"
                                            onclick="event.preventDefault(); this.closest('form').submit();">
                                            {{ __('Logout') }}
                                        </a>
                                    </form>
                                </li>
                            @endauth

                            @guest
                                <li><a href="{{ route('login') }}">Login</a></li>
                                <li><a href="{{ route('register') }}">Register</a></li>
                            @endguest
                        </ul>
                    </div><!-- /.navbar-collapse -->
                </div><!-- /.container-fluid -->
            </nav>
        </header>
        <main>
            <div class="section">
                <div class="container">
                    @yield('main-container')
                </div>
            </div>
        </main>

        <footer>
            <p class="font12">Copyright &copy; {{ date('Y') }} by <a href="https://timedoor.net"
                    class="text-green">PT. TIMEDOOR INDONESIA</a>
            </p>
        </footer>

        {{-- Edit Modal --}}
        <div class="modal modal-edit fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="alert alert-dismissible" id="updateAlert" role="alert" style="display: none">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <p>
                        <b id="alertStatus"></b>
                        <span id="alertMessage"></span>
                    </p>
                </div>
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span
                                aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title" id="myModalLabel">Edit Item</h4>
                    </div>
                    <form enctype="multipart/form-data" id="formEdit">
                        @method('put')
                        @csrf
                        <div class="modal-body">
                            <input type="hidden" name="id" id="idEdit">
                            <input type="hidden" name="oldImagePath" id="oldImagePath">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" class="form-control @error('nameEdit') is-invalid @enderror"
                                    id="nameEdit" name="nameEdit">
                                @error('nameEdit')
                                    <div class="invalid-input">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Title</label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror" id="titleEdit"
                                    name="titleEdit">
                                @error('title')
                                    <div class="invalid-input">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Body</label>
                                <textarea rows="5" class="form-control @error('body') is-invalid @enderror" id="bodyEdit" name="bodyEdit"></textarea>
                                @error('body')
                                    <div class="invalid-input">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group row">
                                <div class="col-md-4">
                                    <img class="img-responsive" alt="uploaded-image-display" id="imageDisplay">
                                </div>
                                <div class="col-md-8 pl-0">
                                    <label>Choose image from your computer :</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control upload-form" id="imageNameEdit" readonly>
                                        <span class="input-group-btn">
                                            <span class="btn btn-default btn-file">
                                                <i class="fa fa-folder-open"></i>&nbsp;Browse <input type="file"
                                                    id="imageEdit" name="imageEdit" onchange="previewImage()" multiple>
                                                <span class="text-danger" id="image-input-error"></span>
                                            </span>
                                        </span>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" id="deleteImage" name="deleteImage"> Delete image
                                        </label>
                                    </div>
                                </div>
                            </div>
                            @guest
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                                        id="passwordEdit" name="password">
                                    @error('password')
                                        <div class="invalid-input">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            @endguest
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- Delete Modal --}}
        <div class="modal modal-delete fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ route('messages.destroy') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" id="idDelete">
                        <input type="hidden" name="password" id="passwordDelete">
                        <input type="hidden" name="image" id="oldImagePathDelete">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span
                                    aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                            <h4 class="modal-title" id="myModalLabel">Delete Data</h4>
                        </div>
                        <div class="modal-body pad-20">
                            <p>Are you sure want to delete this item?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
@endsection
