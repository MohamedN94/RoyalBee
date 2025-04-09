<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Admin\Photo;
use App\Models\Attachment;
use App\Models\Image;
use Illuminate\Support\Facades\File;

class PhotoController extends Controller
{


    public function update()
    {
        //
    }

    public function destroy($id)
    {
        $photo = Photo::findOrFail($id);
        if (file_exists($photo->photo))
            unlink($photo->photo);
        $photo->delete();
        return response(['text' => __('تم الحذف بنجاح')]);
    }
}
