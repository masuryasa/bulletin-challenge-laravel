@extends('layout.user')
@section('main-container')

    @if (session()->has('loginStatus'))
        <div class="row" id="rowAlert">
            <div class="col-md-6 col-md-offset-3 p-30">
                <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <b>{{ $authUserName }}</b>{{ session('loginStatus') }}
                    @if (!$isEmailVerified)
                        <div id="sentMessage">
                            <form action="{{ route('verification.send') }}" method="POST" class="d-inline">
                                @csrf
                                Please click this
                                <button type="submit" class="d-inline btn btn-link p-0" id="resend-verification">
                                    link
                                </button> to verificate your email first to see messages data!.
                            </form>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    @endif

    <div class="row" id="rowAlert2" style="display: none">
        <div class="col-md-6 col-md-offset-3 p-30">
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <b>Verify your email!</b> To be able to post a message.
                <div id="sentMessage">
                    <form action="{{ route('verification.send') }}" method="POST" class="d-inline">
                        @csrf
                        Please click this
                        <button type="submit" class="d-inline btn btn-link p-0" id="resend-verification">
                            link
                        </button> to verificate your email!.
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 col-md-offset-3 bg-white p-30 box">
            <div class="text-center">
                <h1 class="text-green mb-30"><b>Level 8 Challenge</b></h1>
            </div>

            <form action="{{ route('store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                @auth
                    <input type="hidden" name="user_id" value="{{ $authUserId }}">
                @endauth

                <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                        value="{{ $authUserName ?? old('name') }}" {{ auth()->user() ? 'readonly' : 'autofocus' }}
                        required>
                    @error('name')
                        <div class="invalid-input">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Title</label>
                    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                        value="{{ old('title') }}" @auth autofocus {{ !$isEmailVerified ? 'readonly' : '' }} @endauth
                        required>
                    @error('title')
                        <div class="invalid-input">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Body</label>
                    <textarea rows="5" name="body" class="form-control @error('body') is-invalid @enderror" @auth
                        {{ !$isEmailVerified ? 'readonly' : '' }} @endauth required>{{ old('body') }}</textarea>
                    @error('body')
                        <div class="invalid-input">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Choose image from your computer :</label>
                    <div class="input-group">
                        <input type="text" class="form-control upload-form @error('image') is-invalid @enderror"
                            value="No file chosen" readonly>
                        <span class="input-group-btn">
                            <span class="btn btn-default btn-file">
                                <i class="fa fa-folder-open"></i>&nbsp;Browse <input type="file" name="image" @auth
                                    {{ !$isEmailVerified ? 'disabled' : '' }} @endauth multiple>
                            </span>
                        </span>
                    </div>
                    @error('image')
                        <div class="invalid-input">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                @guest
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror">
                        @error('password')
                            <div class="invalid-input">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="text-center mt-30 mb-30">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                @endguest

                @auth
                    <div class="text-center mt-30 mb-30">
                        @if ($isEmailVerified)
                            <button type="submit" class="btn btn-primary">Submit</button>
                        @else
                            <div id="unverified_submit" class="btn btn-primary" disabled>Submit</div>
                        @endif
                    </div>
                @endauth

            </form>
            <hr>
            @if (count($messages) > 0)
                @foreach ($messages as $message)
                    @if (!(auth()->user() && !$isEmailVerified))
                        <div class="post">
                            <div class="clearfix">
                                <div class="pull-left">
                                    <h2 class="mb-5 text-green wrap-text"><b>{{ $message->title }}</b></h2>
                                </div>
                                <div class="pull-right text-right">
                                    <p class="text-lgray">{{ $message->date }}<br /><span
                                            class="small">{{ $message->time }}</span>
                                    </p>
                                </div>
                            </div>
                            <h4 class="mb-20">{{ $message->name }} <span class="text-id">
                                    {{ $message->user_id ?: '-' }}
                                </span>
                            </h4>
                            <p class="pre-body">{{ $message->body }}</p>

                            @if (!is_null($message->image_name))
                                <img class="img-responsive img-post my-15" src="{{ asset($message->image_path) }}"
                                    alt="image-message" />
                            @endif

                            @if (!auth()->user() && !is_null($message->password) && !$message->user_id)
                                <form class="form-inline mt-50" id="formPassword">
                                    <div class="form-group mx-sm-3 mb-2">
                                        <label for="inputPassword{{ $message->id }}"
                                            class="sr-only">Password</label>
                                        <input type="password" class="form-control"
                                            id="inputPassword{{ $message->id }}" placeholder="Password">
                                    </div>
                                    <a type="submit" class="btn btn-default mb-2 edit-message" data-toggle="modal"
                                        data-target="#editModal" data-id="{{ $message->id }}"><i
                                            class="fa fa-pencil p-3"></i></a>
                                    <a type="submit" class="btn btn-danger mb-2 delete-message" data-toggle="modal"
                                        data-target="#deleteModal" data-id="{{ $message->id }}"><i
                                            class="fa fa-trash p-3"></i></a>
                                </form>
                                <div class="invalid-input" id="invalidPassword{{ $message->id }}"></div>
                            @elseif (auth()->user() && $isEmailVerified && $authUserId === $message->user_id)
                                <form class="form-inline mt-50">
                                    <a type="submit" class="btn btn-default mb-2 edit-message" data-toggle="modal"
                                        data-target="#editModal" data-id="{{ $message->id }}"
                                        data-user-id="{{ $authUserId }}"><i class="fa fa-pencil p-3"></i></a>
                                    <a type="submit" class="btn btn-danger mb-2 delete-message" data-toggle="modal"
                                        data-target="#deleteModal" data-id="{{ $message->id }}"
                                        data-user-id="{{ $authUserId }}"><i class="fa fa-trash p-3"></i></a>
                                </form>
                            @endif
                        </div>
                    @endif
                @endforeach
            @endif

            <div class="text-center mt-30">
                {{-- onEachSide(10) does not work --}}
                {{ $messages->onEachSide(10)->links() }}
            </div>
        </div>
    </div>
@endsection
