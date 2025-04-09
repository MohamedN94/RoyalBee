<?php

namespace App\Livewire;

use App\Models\Review;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class ReviewForm extends Component
{
//    public $name;
//    public $email;
    public $review_text;
//    public $reviewContent;
    public $rating = 0.5;
    public $product_id;
    public $show = false;


    public function mount($product_id)
    {
        $this->product_id = $product_id;
        $this->show = false;
    }

    public function setRating($value)
    {
        // Make sure the rating is a float value between 0.5 and 5
        $this->rating = $value;
        $this->show = true;
    }

    public function submitReview()
    {
        // Add your validation and logic to save the review
        try {
            // Validate the input
            $this->validate([
//            'name' => 'required|min:3',
//            'email' => 'required|email',
//            'reviewTitle' => 'required|min:3',
                'review_text' => 'required|min:10',
                'rating' => 'required|min:1|max:5',
            ]);

            $this->show = true;
            Review::create([
//             'name' => $this->name,
//             'email' => $this->email,
//             'title' => $this->reviewTitle,
                'user_id' => auth()->check() ? auth()->user()->id : null,
                'product_id' => $this->product_id,
                'review_text' => $this->review_text,
                'rating' => $this->rating,
            ]);

            session()->flash('message', 'Your review has been submitted!');

            // Clear form after submission
            $this->reset(['review_text', 'rating']);
            $this->rating = 0.5;
        } catch (ValidationException $e) {
            // If validation fails, show the tab and display validation errors
            $this->show = true;
            throw $e;
        }
    }


    public function render()
    {
        return view('livewire.review-form');
    }
}
