@inject('systemPresenter', 'App\Presenters\SystemPresenter')

@extends('layouts.app')

@section('title', $systemPresenter->checkReturnValue('title', $article->title))

@section('description', $systemPresenter->checkReturnValue('seo_desc', $article->desc))

@section('keywords', $systemPresenter->checkReturnValue('seo_keyword', $article->keyword))

@section('style')
    <link rel="stylesheet" href="{{ asset('editor.md/css/editormd.preview.min.css') }}">
    <link rel="stylesheet" href="{{ asset('share.js/css/share.min.css') }}">
@endsection

@section('header-text')
    <div class="text-inner">
        <div class="row">
            <div class="col-md-12 to-animate fadeInUp animated">
                <h3 class="color-white">
                    {{ $article->title }}
                </h3>

                <p class=" m-t-25 color-white">
                    <i class="glyphicon glyphicon-calendar"></i>{{ $article->created_at }}
                    &nbsp;
                    @if($article->category)
                        <i class="glyphicon glyphicon-th-list"></i>
                        <a href="{{ route('category', ['id' => $article->cate_id]) }}" target="_blank">
                            {{ $article->category->name }}
                        </a>
                    @endif
                </p>
                <p class="color-white">
                    <i class="glyphicon glyphicon-tags"></i>&nbsp;
                    @foreach ($article->tag as $tag)
                        <a href="{{ route('tag', ['id' => $tag->id]) }}" target="_blank">
                            {{ $tag->tag_name }}
                        </a>
                        &nbsp;
                    @endforeach
                </p>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="markdown-body editormd-html-preview" style="padding:0;">
        {!! $article->html_content !!}
    </div>

    <!-- 代码1：放在页面需要展示的位置  -->
    <!-- 如果您配置过sourceid，建议在div标签中配置sourceid、cid(分类id)，没有请忽略  -->
    <div id="cyReward" role="cylabs" data-use="reward"></div>
    <!-- 代码2：用来读取评论框配置，此代码需放置在代码1之后。 -->
    <!-- 如果当前页面有评论框，代码2请勿放置在评论框代码之前。 -->
    <!-- 如果页面同时使用多个实验室项目，以下代码只需要引入一次，只配置上面的div标签即可 -->
    <script type="text/javascript" charset="utf-8" src="https://changyan.itc.cn/js/lib/jquery.js"></script>
    <script type="text/javascript" charset="utf-8" src="https://changyan.sohu.com/js/changyan.labs.https.js?appid=cytc1F6Fo"></script>

    <div id="share" class="social-share m-t-25"></div>
    <!--PC版-->
    <div id="SOHUCS" sid="{{$article->id}}"></div>
    <script charset="utf-8" type="text/javascript" src="https://changyan.sohu.com/upload/changyan.js" ></script>
    <script type="text/javascript">
        window.changyan.api.config({
            appid: 'cytc1F6Fo',
            conf: 'prod_addae95c4b367221acec9d5c64ba3008'
        });
    </script>
    <!-- 评论插件 -->
    @include('default.comment.index', [
        'commentId' => $article->id,
        'commentTitle' => $article->title,
        'commentUrl' => Request::getUri()
    ])
@endsection

@section('script')
    <script src="{{ asset('share.js/js/jquery.share.min.js') }}"></script>

    <script>
        $(function(){
            $('#share').share({sites: ['qzone', 'qq', 'weibo','wechat']});
        });
    </script>

@endsection
