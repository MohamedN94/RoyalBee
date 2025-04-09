<div class="subscribe-right">
    <div class="input-group">
        <form action="{{route('web.newsletter')}}" method="post">
            <div class="input-group">
                <input class="form-control" name="email" required type="email"
                       placeholder="{{__('Enter Your Email')}}">
                @csrf
                @method('POST')
                <button style="padding: 12px" type="submit"
                        class="input-group-text">{{__('subscribe')}}</button>
            </div>
        </form>
    </div>
</div>

@if (session('news_success'))

    <script>
        new Noty({
            layout: 'topRight',
            text: "{{ session('news_success') }}",
            theme: 'relax',
            type: 'success',
            timeout: 3000,
            killer: true
        }).show();
    </script>

@endif

@if(session('news_error'))

    <script>
        new Noty({
            layout: 'topRight',
            text: "{{ session('news_error') }}",
            theme: 'relax',
            type: 'error',
            timeout: 3000,
            killer: true
        }).show();
    </script>

@endif
