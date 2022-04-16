@extends('layout.user')
@section('main-container')
    @auth
        @php
        $emailVerifiedNull = is_null(auth()->user()->email_verified_at);
        $authUserId = auth()->user()->id;
        $authUserName = auth()->user()->name;
        @endphp
    @endauth

    @if (session()->has('loginStatus'))
        <div class="row" id="rowAlert">
            <div class="col-md-6 col-md-offset-3 p-30">
                <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <b>{{ $authUserName }}</b>{{ session('loginStatus') }}
                    @if ($emailVerifiedNull)
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
                        value="{{ old('title') }}" @auth autofocus {{ $emailVerifiedNull ? 'readonly' : '' }} @endauth
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
                        {{ $emailVerifiedNull ? 'readonly' : '' }} @endauth required>{{ old('body') }}</textarea>
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
                                    {{ $emailVerifiedNull ? 'disabled' : '' }} @endauth multiple>
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
                        @if (!$emailVerifiedNull)
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
                    @php
                        $msgId = $message->id;
                        $msgTitle = $message->title;
                        $msgName = $message->name;
                        $msgUserId = $message->user_id;
                        $msgBody = $message->body;
                        [$date, $time] = explode(' ', $message->created_at);

                        $msgPassword = $message->password ?: null;
                        $msgImageName = $message->image_name ?: null;
                    @endphp

                    @guest
                        <div class="post">
                            <div class="clearfix">
                                <div class="pull-left">
                                    <h2 class="mb-5 text-green wrap-text"><b>{{ $msgTitle }}</b></h2>
                                </div>
                                <div class="pull-right text-right">
                                    <p class="text-lgray">{{ $date }}<br /><span
                                            class="small">{{ $time }}</span>
                                    </p>
                                </div>
                            </div>
                            <h4 class="mb-20">{{ $msgName }} <span class="text-id">
                                    {{ $msgUserId ?: '-' }}
                                </span>
                            </h4>
                            <p class="pre-body">{{ $msgBody }}</p>

                            @if (!is_null($msgImageName))
                                <img class="img-responsive img-post my-15"
                                    src="{{ asset('storage/images/' . $msgImageName) }}" alt="image-message" />
                            @endif

                            @if (!is_null($msgPassword) && !$msgUserId)
                                <form class="form-inline mt-50" id="formPassword">
                                    <div class="form-group mx-sm-3 mb-2">
                                        <label for="inputPassword{{ $msgId }}" class="sr-only">Password</label>
                                        <input type="password" class="form-control" id="inputPassword{{ $msgId }}"
                                            placeholder="Password">
                                    </div>
                                    <a type="submit" class="btn btn-default mb-2 edit-message" data-toggle="modal"
                                        data-target="#editModal" data-id="{{ $msgId }}"><i
                                            class="fa fa-pencil p-3"></i></a>
                                    <a type="submit" class="btn btn-danger mb-2 delete-message" data-toggle="modal"
                                        data-target="#deleteModal" data-id="{{ $msgId }}"><i
                                            class="fa fa-trash p-3"></i></a>
                                </form>
                                <div class="invalid-input" id="invalidPassword{{ $msgId }}"></div>
                            @endif
                        </div>
                    @else
                        @if (!$emailVerifiedNull)
                            <div class="post">
                                <div class="clearfix">
                                    <div class="pull-left">
                                        <h2 class="mb-5 text-green wrap-text"><b>{{ $msgTitle }}</b></h2>
                                    </div>
                                    <div class="pull-right text-right">
                                        <p class="text-lgray">{{ $date }}<br /><span
                                                class="small">{{ $time }}</span>
                                        </p>
                                    </div>
                                </div>
                                <h4 class="mb-20">{{ $msgName }} <span class="text-id">
                                        {{ $msgUserId ?: '-' }}
                                    </span>
                                </h4>
                                <p class="pre-body">{{ $msgBody }}</p>

                                @if (!is_null($msgImageName))
                                    <img class="img-responsive img-post my-15"
                                        src="{{ asset('storage/images/' . $msgImageName) }}" alt="image-message" />
                                @endif

                                @if ($authUserId === $msgUserId)
                                    <form class="form-inline mt-50">
                                        <a type="submit" class="btn btn-default mb-2 edit-message" data-toggle="modal"
                                            data-target="#editModal" data-id="{{ $msgId }}"
                                            data-user-id="{{ $authUserId }}"><i class="fa fa-pencil p-3"></i></a>
                                        <a type="submit" class="btn btn-danger mb-2 delete-message" data-toggle="modal"
                                            data-target="#deleteModal" data-id="{{ $msgId }}"
                                            data-user-id="{{ $authUserId }}"><i class="fa fa-trash p-3"></i></a>
                                    </form>
                                @endif
                            </div>
                        @endif
                    @endguest
                @endforeach
            @endif

            <div class="text-center mt-30">
                {{-- onEachSide(10) does not work --}}
                {{ $messages->onEachSide(10)->links() }}
            </div>
        </div>
    </div>
@endsection
