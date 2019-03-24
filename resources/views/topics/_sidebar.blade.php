<div class="panel panel-default">
    <div class="panel-body">
        <a href="{{ route('topics.create') }}" class="btn btn-success btn-block" aria-label="Left Align">
            <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> 新建帖子
        </a>
    </div>
</div>
@if(Auth::check())
<div class="panel panel-default">
    <div class="panel-body">
        @if($signStatus == 0)
            <form action="{{ route('sign_in') }}" method="POST" accept-charset="UTF-8" id="signForm">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <a class="btn btn-success btn-block" aria-label="Left Align" onclick="document:signForm.submit()">
                    <span class="glyphicon glyphicon-heart" type="submit" aria-hidden="true"></span> 签到
                </a>
            </form>

        @elseif($signStatus == 1)
            <a class="btn btn-success btn-block" aria-label="Left Align">
                <span class="glyphicon glyphicon-ok" aria-hidden="true"></span> 已签到
            </a>
        @endif
    </div>
</div>
@endif


@if (count($active_users))
    <div class="panel panel-default">
        <div class="panel-body active-users">

            <div class="text-center">活跃用户</div>
            <hr>
            @foreach ($active_users as $active_user)
                <a class="media" href="{{ route('users.show', $active_user->id) }}">
                    <div class="media-left media-middle">
                        <img src="{{ $active_user->avatar }}" width="24px" height="24px" class="img-circle media-object">
                    </div>

                    <div class="media-body">
                        <span class="media-heading">{{ $active_user->name }}</span>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
@endif





@if (count($links))
    <div class="panel panel-default">
        <div class="panel-body active-users">

            <div class="text-center">资源推荐</div>
            <hr>
            @foreach ($links as $link)
                <a class="media" href="{{ $link->link }}">
                    <div class="media-body">
                        <span class="media-heading">{{ $link->title }}</span>
                    </div>
                </a>
            @endforeach

        </div>
    </div>
@endif