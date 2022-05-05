@extends('admin.template')

@section('body')

    <body class="hold-transition skin sidebar-mini">
        <div class="wrapper">

            <header class="main-header">
                <!-- Logo -->
                <a href="#" class="logo">
                    <!-- mini logo for sidebar mini 50x50 pixels -->
                    <span class="logo-mini"><b>T</b>D</span>
                    <!-- logo for regular state and mobile devices -->
                    <span class="logo-lg"><b>Timedoor</b> Admin</span>
                </a>
                <!-- Header Navbar: style can be found in header.less -->
                <nav class="navbar navbar-static-top">
                    <!-- Sidebar toggle button-->
                    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                        <span class="sr-only">Toggle navigation</span>
                    </a>

                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">
                            <!-- User Account: style can be found in dropdown.less -->
                            <li class="dropdown user user-menu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <span class="hidden-xs">Hello, {{ Auth::guard('admin')->user()->name }} </span>
                                </a>
                                <ul class="dropdown-menu">
                                    <!-- User image -->
                                    <li class="user-header">
                                        <img src="{{ asset('assets/admin/img/user-ico.jpg') }}" class="img-circle"
                                            alt="User-Image">
                                        <p>
                                            Administrator
                                        </p>
                                    </li>
                                    <!-- Menu Footer-->
                                    <li class="user-footer">
                                        <div class="text-right">
                                            <a href="{{ route('admins.logout') }}" class="btn btn-danger btn-flat">Sign
                                                out</a>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="main-sidebar">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu" data-widget="tree">
                        <li class="{{ $page === 'home' ? 'active' : '' }}">
                            <a href="#"><i class="fa fa-dashboard"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Dashboard
                        <small>Control panel</small>
                    </h1>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <!-- /.col-xs-12 -->
                            <div class="box box-success">
                                <div class="box-header with-border">
                                    <h1 class="font-18 m-0">Timedoor Challenge - Level 9</h1>
                                </div>
                                <form method="" action="">
                                    <div class="box-body">
                                        <div class="bordered-box mb-20">
                                            <form class="form" role="form" action="search">
                                                <table class="table table-no-border mb-0">
                                                    <tbody>
                                                        <tr>
                                                            <td width="80"><b>Title</b></td>
                                                            <td>
                                                                <div class="form-group mb-0">
                                                                    <input type="text" class="form-control" name="title"
                                                                        value="{{ request('title') }}">
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td><b>Body</b></td>
                                                            <td>
                                                                <div class="form-group mb-0">
                                                                    <input type="text" class="form-control" name="body"
                                                                        value="{{ request('body') }}">
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <table class="table table-search">
                                                    <tbody>
                                                        <tr>
                                                            <td width="80"><b>Image</b></td>
                                                            <td width="60">
                                                                <label class="radio-inline">
                                                                    <input type="radio" name="imageOption" id="inlineRadio1"
                                                                        value="with"
                                                                        @if (request('imageOption') === 'with') checked @endif>
                                                                    with
                                                                </label>
                                                            </td>
                                                            <td width="80">
                                                                <label class="radio-inline">
                                                                    <input type="radio" name="imageOption" id="inlineRadio2"
                                                                        value="without"
                                                                        @if (request('imageOption') === 'without') checked @endif>
                                                                    without
                                                                </label>
                                                            </td>
                                                            <td>
                                                                <label class="radio-inline">
                                                                    <input type="radio" name="imageOption" id="inlineRadio3"
                                                                        value="unspecified"
                                                                        @if (request('imageOption') === 'unspecified') checked @endif>
                                                                    unspecified
                                                                </label>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td width="80"><b>Status</b></td>
                                                            <td>
                                                                <label class="radio-inline">
                                                                    <input type="radio" name="statusOption"
                                                                        id="inlineRadio1" value="on"
                                                                        @if (request('statusOption') === 'on') checked @endif> on
                                                                </label>
                                                            </td>
                                                            <td>
                                                                <label class="radio-inline">
                                                                    <input type="radio" name="statusOption"
                                                                        id="inlineRadio2" value="deleted"
                                                                        @if (request('statusOption') === 'deleted') checked @endif>
                                                                    delete
                                                                </label>
                                                            </td>
                                                            <td>
                                                                <label class="radio-inline">
                                                                    <input type="radio" name="statusOption"
                                                                        id="inlineRadio3" value="unspecified"
                                                                        @if (request('statusOption') === 'unspecified') checked @endif>
                                                                    unspecified
                                                                </label>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td><button type="submit" class="btn btn-default mt-10"><i
                                                                        class="fa fa-search"></i>
                                                                    Search</button></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </form>
                                        </div>

                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th><input type="checkbox" id="checkboxAll"></th>
                                                    <th>ID</th>
                                                    <th>Title</th>
                                                    <th>Body</th>
                                                    <th width="200">Image</th>
                                                    <th>Date</th>
                                                    <th width="50">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($messages as $message)
                                                    <tr class="{{ $message->trashed() ? 'bg-gray-light' : '' }}">
                                                        <td>
                                                            @if (!$message->trashed())
                                                                <input type="checkbox" name="checkboxItem"
                                                                    class="checkboxItem" data-id="{{ $message->id }}">
                                                            @else
                                                                {!! '&nbsp;' !!}
                                                            @endif
                                                        </td>
                                                        <td>{{ $message->id }}</td>
                                                        <td>{{ $message->title }}</td>
                                                        <td>
                                                            <p class="pre-body">{{ $message->body }}</p>
                                                        </td>
                                                        <td>
                                                            @if (!$message->trashed() && !is_null($message->image_name))
                                                                <img class="img-prev"
                                                                    src="{{ asset('storage/images/' . $message->image_name) }}"
                                                                    style="max-width: 100px">
                                                                <a href="#" data-toggle="modal" data-target="#deleteModal"
                                                                    data-id="{{ $message->id }}" data-button="image"
                                                                    class="btn btn-danger ml-10 btn-img admin-delete-message"
                                                                    rel="tooltip" title="Delete Image"><i
                                                                        class="fa fa-trash"></i></a>
                                                            @endif
                                                        </td>

                                                        <td>
                                                            {{ explode(' ', $message->created_at)[0] }}<br>
                                                            <span
                                                                class="small">{{ explode(' ', $message->created_at)[1] }}</span>
                                                        </td>
                                                        <td>
                                                            @if ($message->trashed())
                                                                <a href="#" class="btn btn-default btn-recover"
                                                                    data-id="{{ $message->id }}" rel="tooltip"
                                                                    title="Recover"><i class="fa fa-repeat"></i></a>
                                                            @else
                                                                <a type="submit" href="#" data-toggle="modal"
                                                                    data-target="#deleteModal"
                                                                    data-id="{{ $message->id }}" data-button="message"
                                                                    class="btn btn-danger admin-delete-message"
                                                                    rel="tooltip" title="Delete"><i
                                                                        class="fa fa-trash"></i></a>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>

                                        <a href="#" class="btn btn-default mt-5" id="deleteAllButton" data-toggle="modal"
                                            data-target="#deleteModal">Delete Checked Items</a>
                                        <div class="text-center">
                                            {{ $messages->links() }}
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div><!-- /.col-xs-12 -->
                    </div>
                </section>
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->
            <footer class="main-footer">
                <div class="pull-right hidden-xs">
                    <b>Version</b> 0.1.0
                </div>
                <strong>Copyright &copy; {{ date('Y') }} <a href="https://timedoor.net" class="text-green">Timedoor
                        Indonesia</a>.</strong> All rights reserved.
            </footer>

            <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="{{ route('admins.destroy') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" id="idMessage">
                            <input type="hidden" name="button" id="buttonType">

                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal"><span
                                        aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                <div class="text-center">
                                    <h4 class="modal-title" id="myModalLabel">Delete Data</h4>
                                </div>
                            </div>
                            <div class="modal-body pad-20">
                                <p>Are you sure want to delete this item(s)?</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
@endsection
