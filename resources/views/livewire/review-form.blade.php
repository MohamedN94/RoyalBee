<div class="tab-pane fade {{ $show ? 'show active' : '' }}" id="top-review" role="tabpanel"
         aria-labelledby="review-top-tab">
        <div class="mt-2">
            @if (session()->has('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif
        </div>
        <form wire:submit.prevent="submitReview" class="theme-form">
            <div class="row">
                <div class="col-md-12">
                    <div class="media-body ms-3">
                        <label>{{__('Rating')}}</label>
                        <div style="font-size: 24px">
                            @for ($i = 1; $i <= 5; $i++)
                                {{-- Full Star --}}
                                @if($rating >= $i)
                                    <i class="fa fa-star text-warning" wire:click="setRating({{ $i - 0.5 }})"
                                       style="cursor: pointer;"></i>
                                    {{-- Half Star --}}
                                @elseif($rating >= ($i - 0.5) && $rating < $i)
                                    <i class="fa fa-star-half-alt text-warning" wire:click="setRating({{ $i }})"
                                       style="cursor: pointer;"></i>
                                    {{-- Empty Star --}}
                                @else
                                    <i class="fa fa-star" wire:click="setRating({{ $i - 0.5 }})"
                                       style="cursor: pointer; color: #e4e5e9;"></i>
                                @endif
                            @endfor
                        </div>

                    </div>


                </div>

                {{--            <div class="col-md-6">--}}
                {{--                <label for="name">Name</label>--}}
                {{--                <input type="text" class="form-control" id="name" placeholder="Enter Your name" wire:model="name" required>--}}
                {{--                @error('name') <span class="text-danger">{{ $message }}</span> @enderror--}}
                {{--            </div>--}}
                {{--            <div class="col-md-6">--}}
                {{--                <label for="email">Email</label>--}}
                {{--                <input type="text" class="form-control" placeholder="Email" wire:model="email" required>--}}
                {{--                @error('email') <span class="text-danger">{{ $message }}</span> @enderror--}}
                {{--            </div>--}}
                {{--            <div class="col-md-12">--}}
                {{--                <label for="reviewTitle">Review Title</label>--}}
                {{--                <input type="text" class="form-control" placeholder="Enter your Review Subjects" wire:model="reviewTitle" required>--}}
                {{--                @error('reviewTitle') <span class="text-danger">{{ $message }}</span> @enderror--}}
                {{--            </div>--}}
                <div class="col-md-12">
                    <label for="reviewContent">{{__('Review Content')}}</label>
                    <textarea class="form-control" placeholder="Write Your Testimonial Here" wire:model="review_text"
                              rows="6"></textarea>
                    @error('review_text') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="col-md-12">
                    <button class="btn btn-normal" type="submit">{{__('Submit Your Review')}}</button>
                </div>
            </div>
        </form>
    </div>
