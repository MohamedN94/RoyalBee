<div class="col-12">
    @foreach($blogs as $blog)
        <div class="row blog-media">
            <div class="col-xl-6 ">
                <div class="blog-left">
                    <a href="{{route('web.blogDetail',$blog->slug)}}"><img src="{{asset($blog->image)}}" class="img-fluid"
                                                      alt="blog"></a>
                    <div class="date-label">
                        {{\Carbon\Carbon::parse($blog->created_at)->format('d M Y')}}
                    </div>
                </div>
            </div>
            <div class="col-xl-6 ">
                <div class="blog-right">
                    <div>
                        <a href="{{route('web.blogDetail',$blog->slug)}}">
                            <h4>{{app()->getLocale() == 'ar' ? $blog->title_ar : $blog->title_en}}
                            </h4></a>
                        <ul class="post-social">
                            {{--                            <li>{{__('Posted By')}} : Admin Admin</li>--}}
                            {{--                            <li><i class="fa fa-heart"></i> 5 Hits</li>--}}
                            {{--                            <li><i class="fa fa-comments"></i> 10 Comment</li>--}}
                        </ul>
                        {!! substr(app()->getLocale() == 'ar' ? $blog->content_ar : $blog->content_en, 0, 300) !!}
                        {{ strlen(app()->getLocale() == 'ar' ?
                                        $blog->content_ar : $blog->content_en) > 300 ? '...' : '' }}
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    {!! $blogs->links() !!}
</div>
