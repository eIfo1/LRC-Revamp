 @extends('layouts.default', [
     'title' => $topic->name,
 ])

@section('css')
    <style>
        .topic {
            padding-top: 15px;
            padding-bottom: 15px;
            transition: 125ms ease all;
            background: var(--section_bg);
        }

        .topic {
            border-bottom: 1px solid var(--divider_color);
        }

        .topic:hover {
            background: var(--section_bg_hover);
        }
    </style>
    <style>
        .thread {
            padding-top: 15px;
            padding-bottom: 15px;
            transition: 125ms ease all;
            background: var(--section_bg);
        }

        .thread {
            border-bottom: 1px solid var(--divider_color);
        }


        .thread:hover {
            background: var(--section_bg_hover);
        }

        .topic .user-headshot {
            width: 50px;
            height: 50px;
            float: left;
            position: relative;
            overflow: hidden;
        }

        .topic .user-headshot img {
            background: var(--headshot_bg);
            border-radius: 50%;
        }

        .topic .details {
            padding-left: 25px;
        }

        .topic .status {
            font-size: 11px;
            border-radius: 4px;
            margin-top: -2px;
            margin-right: 5px;
            padding: 0.5px 5px;
            font-weight: 600;
            display: inline-block;
        }

        .topic .status i {
            font-size: 10px;
            vertical-align: middle;
        }

        .topic .status i.fa-lock {
            margin-top: -1px;
        }
    </style>
@endsection


 @section('css')
     <style>
         .thread {
             padding-top: 15px;
             padding-bottom: 15px;
         }

         .thread:not(:last-child) {
             border-bottom: 1px solid var(--divider_color);
         }

         .thread:hover {
             background: var(--section_bg_hover);
         }

         .thread .user-headshot {
             width: 50px;
             height: 50px;
             float: left;
             position: relative;
             overflow: hidden;
         }

         .thread .user-headshot img {
             background: var(--headshot_bg);
             border-radius: 50%;
         }

         .thread .details {
             padding-left: 25px;
         }

         .thread .status {
             font-size: 11px;
             border-radius: 4px;
             margin-top: -2px;
             margin-right: 5px;
             padding: 0.5px 5px;
             font-weight: 600;
             display: inline-block;
         }

         .thread .status i {
             font-size: 10px;
             vertical-align: middle;
         }

         .thread .status i.fa-lock {
             margin-top: -1px;
         }
     </style>
 @endsection

 @section('content')
     <h3>Forum</h3>
     <ul class="breadcrumb bg-white">
         <li class="breadcrumb-item"><a href="{{ route('forum.index') }}">Forum</a></li>
         <li class="breadcrumb-item active">{{ $topic->name }}</li>
     </ul>
     <div class="row">
         @include('web.forum._sidebar', ['mobile' => true])
         <div class="col-md">
             @if ($topic->threads()->count() == 0)
                 <p>There are no threads in this topic. Maybe <a
                         href="{{ route('forum.new', ['thread', $topic->id]) }}">create one?</a></p>
             @else
                 <div class="p-2 px-4 bg-primary text-white rounded">
                     <div class="row">
                         <div class="col-md-6">Thread</div>
                         <div class="col-md-3 text-center hide-sm">Replies</div>
                         <div class="col-md-3 text-center hide-sm">Last Reply</div>
                     </div>
                 </div>
                 <div class="mb-2"></div>
                 <div class="card-body" style="padding-top:0;padding-left:15px;padding-right:15px;padding-bottom:0;">
                     @foreach ($topic->threads() as $thread)
                         <div class="row topic rounded" @if ($thread->is_deleted) style="opacity:.5;" @endif>
                             <div class="col-md-6">
                                 <div class="user-headshot">
                                     <img src="{{ $thread->creator->headshot() }}">
                                 </div>
                                 <div class="details text-truncate">
                                     <a href="{{ route('forum.thread', $thread->id) }}"
                                         style="color:inherit;font-size:18px;font-weight:600;text-decoration:none;">{{ $thread->title }}</a>
                                     <div class="text-muted" style="margin-top:-3px;">
                                         @if ($thread->is_pinned)
                                             <span class="status bg-danger text-white"><i class="fas fa-thumbtack mr-1"></i>
                                                 Pinned</span>
                                         @elseif ($thread->is_locked)
                                             <span class="status text-white" style="background:#000;"><i
                                                     class="fas fa-lock mr-1"></i> Locked</span>
                                         @endif

                                         <span class="hide-sm">Posted by</span>
                                         <a href="{{ route('users.profile', $thread->creator->username) }}"
                                             @if ($thread->creator->isStaff()) class="text-danger" @endif>{{ $thread->creator->username }}</a>
                                         <span>- {{ $thread->created_at->diffForHumans() }}</span>
                                     </div>
                                 </div>
                             </div>
                             <div class="col-md-3 text-center align-self-center hide-sm">
                                 {{ number_format($thread->replies(false)->count()) }}</div>
                             <div class="col-md-3 text-center align-self-center text-truncate hide-sm">
                                 @if ($thread->lastReply())
                                     <a href="{{ route('users.profile', $thread->lastReply()->creator->username) }}"
                                         @if ($thread->lastReply()->creator->isStaff()) class="text-danger" @endif>{{ $thread->lastReply()->creator->username }}</a>
                                     <div>{{ $thread->lastReply()->created_at->diffForHumans() }}</div>
                                 @else
                                     <a href="{{ route('users.profile', $thread->creator->username) }}"
                                         @if ($thread->creator->isStaff()) class="text-danger" @endif>{{ $thread->creator->username }}</a>
                                     <div>{{ $thread->created_at->diffForHumans() }}</div>
                                 @endif
                             </div>
                         </div>
                         <div class="mb-1"></div>
                     @endforeach
                 </div>
                 {{ $topic->threads()->onEachSide(1) }}
             @endif
         </div>
         @include('web.forum._sidebar', ['mobile' => false])
     </div>
 @endsection
