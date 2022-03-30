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
                                <li>
                                    <form action="{{ url('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="logout">Logout</button>
                                    </form>
                                </li>
                            @else
                                <li><a href="{{ url('login') }}">Login</a></li>
                            @endauth
                            <li><a href="{{ url('register') }}">Register</a></li>
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
            <p class="font12">Copyright &copy;
                <script>
                    document.write(new Date().getFullYear());
                </script> by <a href="https://timedoor.net" class="text-green">PT. TIMEDOOR
                    INDONESIA</a>
            </p>
        </footer>

        {{-- Edit Modal --}}
        <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span
                                aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title" id="myModalLabel">Edit Item</h4>
                    </div>
                    <form enctype="multipart/form-data" id="formEdit">
                        {{-- action="{{ url('edit-message') }}" method="POST" --}}
                        @csrf
                        <div class="modal-body">
                            <input type="hidden" name="idEdit" id="idEdit">
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
                                {{-- <p class="small text-danger mt-5">*Your title must be 3 to 16 characters long</p> --}}
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
                                    <img class="img-responsive" alt="" id="imageDisplay">
                                </div>
                                <div class="col-md-8 pl-0">
                                    <label>Choose image from your computer :</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control upload-form" id="imageNameEdit" readonly>
                                        <span class="input-group-btn">
                                            <span class="btn btn-default btn-file">
                                                <i class="fa fa-folder-open"></i>&nbsp;Browse <input type="file"
                                                    id="imageEdit" name="imageEdit" multiple>
                                                <span class="text-danger" id="image-input-error"></span>
                                            </span>
                                        </span>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" id="deleteImage">Delete image
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                    id="passwordEdit" name="passwordEdit">
                                @error('password')
                                    <div class="invalid-input">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
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
        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ url('delete-message') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" id="idDelete">
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
