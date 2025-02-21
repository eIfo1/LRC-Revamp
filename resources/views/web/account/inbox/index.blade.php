 
@extends('layouts.default', [
    'title' => 'Inbox'
])

@section('css')
    <style>
        img.user-headshot {
            background: var(--section_bg);
            border-radius: 50%;
            margin: 0 auto;
            display: block;
            width: 70%;
        }
    </style>
@endsection

@section('content')
    <h3>Inbox</h3>
    <div class="card">
        <div class="card-body">
            <ul class="nav nav-pills nav-justified" role="tablist">
                <li class="nav-item">
                    <a href="{{ route('account.inbox.index', 'incoming') }}" class="nav-link @if ($category == 'incoming') active @endif">Incoming</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('account.inbox.index', 'sent') }}" class="nav-link @if ($category == 'sent') active @endif">Sent</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('account.inbox.index', 'history') }}" class="nav-link @if ($category == 'history') active @endif">History</a>
                </li>
            </ul>
        </div>
    </div>
    <div class="card">
        <div class="card-body" @if ($messages->count() > 0) style="padding-bottom:0;" @endif>
            @forelse ($messages as $message)
                <div class="card has-bg">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-2 hide-sm">
                                <a href="{{ route('users.profile', ($message->receiver->id == Auth::user()->id) ? $message->sender->username : $message->receiver->username) }}">
                                    <img class="user-headshot" src="{{ ($message->receiver->id == Auth::user()->id) ? $message->sender->headshot() : $message->receiver->headshot() }}">
                                </a>
                            </div>
                            <div class="col-md-10 align-self-center">
                                <h4 class="text-truncate" style="font-weight:600;">
                                    <a href="{{ route('account.inbox.message', $message->id) }}" style="color:inherit;">{{ $message->title }}</a>
                                    @if ($message->receiver->id == Auth::user()->id)
                                        <h5>Sent by <a href="{{ route('users.profile', $message->sender->username) }}">{{ $message->sender->username }}</a></h5>
                                    @else
                                        <h5>Sent to <a href="{{ route('users.profile', $message->receiver->username) }}">{{ $message->receiver->username }}</a></h5>
                                    @endif
                                </h4>
                                <h5 style="margin-bottom:0;">{{ $message->created_at->format('M d, Y h:i A') }}</h5>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <p>{{ $error }}</p>
            @endforelse
        </div>
    </div>
    {{ $messages->onEachSide(1) }}
@endsection
