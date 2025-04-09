<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Admin\Page;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormSubmitted;
use App\Models\Site\Seo;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Traits\SEOTools as SEOToolsTrait;

class ContactController extends Controller
{
    use SEOToolsTrait;

    function index(): View
    {
        $service = Seo::where('id', 2)->first();
        $this->seo()->setTitle($service->meta_title);
        $this->seo()->setDescription($service->meta_description);
        $this->seo()->opengraph()->setUrl($service->meta_canonical);
        $this->seo()->opengraph()->addProperty('type', $service->meta_property);
        $this->seo()->twitter()->setSite($service->meta_twitter);
        $this->seo()->jsonLd()->setType($service->meta_jsonLd);
        SEOMeta::addKeyword($service->meta_Keyword);
        $contactPage = Page::where('page_type_id', 3)
            ->findOrFail(6);
        return view('front.contact-us', compact('contactPage'));
    }

    public function submit(Request $request)
    {
        try {
            Log::info('Request Data:', $request->all());

            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email',
                'msg_subject' => 'required|string',
                'phone_number' => 'nullable|string',
                'message' => 'required|string',
                '_token' => 'required'
            ]);
            $contact = Contact::create($request->all());
            // Send an email
            Mail::to('recipient@example.com')->send(new ContactFormSubmitted($contact));
            // Process the form data
            return response()->json(['status' => 'success']);
        } catch (\Exception $e) {
            Log::error('Error in submit method:', ['error' => $e->getMessage()]);
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }
}
