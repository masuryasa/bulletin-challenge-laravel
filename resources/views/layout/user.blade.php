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
                            <li><a href="{{ url('login') }}">Login</a></li>
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

        <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span
                                aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title" id="myModalLabel">Edit Item</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" value="Yutaka Tokunaga">
                        </div>
                        <div class="form-group">
                            <label>Title</label>
                            <input type="text" class="form-control" value="Here is your title">
                            <p class="small text-danger mt-5">*Your title must be 3 to 16 characters long</p>
                        </div>
                        <div class="form-group">
                            <label>Body</label>
                            <textarea rows="5"
                                class="form-control">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed laoreet, risus nec suscipit luctus, tortor nibh scelerisque est, nec suscipit justo odio id arcu. Nulla nec sagittis ante, non luctus nulla. Sed imperdiet ullamcorper tortor, ac vulputate mauris. In pulvinar metus eget imperdiet ullamcorper. Vivamus a dolor tempor diam sollicitudin interdum.</textarea>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-4">
                                <img class="img-responsive" alt="" src="https://via.placeholder.com/500x500">
                            </div>
                            <div class="col-md-8 pl-0">
                                <label>Choose image from your computer :</label>
                                <div class="input-group">
                                    <input type="text" class="form-control upload-form" value="No file chosen" readonly>
                                    <span class="input-group-btn">
                                        <span class="btn btn-default btn-file">
                                            <i class="fa fa-folder-open"></i>&nbsp;Browse <input type="file" name="image"
                                                multiple>
                                        </span>
                                    </span>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox">Delete image
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
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
                        <button type="button" class="btn btn-danger">Delete</button>
                    </div>
                </div>
            </div>
        </div>

        <script>
            // INPUT TYPE FILE
            $(document).on('change', '.btn-file :file', function() {
                var input = $(this),
                    numFiles = input.get(0).files ? input.get(0).files.length : 1,
                    label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
                input.trigger('fileselect', [numFiles, label]);
            });

            $(document).ready(function() {
                $('.btn-file :file').on('fileselect', function(event, numFiles, label) {
                    var input = $(this).parents('.input-group').find(':text'),
                        log = numFiles > 1 ? numFiles + ' files selected' : label;

                    if (input.length) {
                        input.val(log);
                    } else {
                        if (log) alert(log);
                    }
                });
            });
        </script>
    </body>
@endsection
