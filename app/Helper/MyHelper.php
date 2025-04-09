<?php


namespace App\Helper;


use Illuminate\Support\Facades\File;
use Carbon\Carbon;
use Intervention\Image\ImageManagerStatic as Image;

class MyHelper
{

    static function notifyByFirebase($title, $body, $tokens, $data = [])        // paramete 5 =>>>> $type
    {

        $registrationIDs = $tokens;

        $fcmMsg = array(
            'body' => $body,
            'title' => $title,
            'sound' => "default",
            'color' => "#203E78"
        );

        $fcmFields = array(
            'registration_ids' => $registrationIDs,
            'priority' => 'high',
            'notification' => $fcmMsg,
            'data' => $data
        );
        $headers = array(
            'Authorization: key=' . env('FIREBASE_API_ACCESS_KEY'),
            'Content-Type: application/json'
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmFields));
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }
    ///
    //////////////////////////////////////////////////////////////////////

    static function generateCode($model)
    {
        if ($model == 'customer') {
            $code = rand('1000', '9999') . rand('1000', '9999') . rand('1000', '9999');

            $customer = Customer::where('referal_code', $code)->first();

            if ($customer) {
                self::generateCode($model);
            } else {
                return $code;
            }
        }
    }

    //////////////////////////////////////////////////////////////////////
    ///
    //////////////////////////////////////////////////////////////////////

    static function generateToken($user)
    {
        $email = str_split($user->email, 3);
        $phone = str_split($user->phone, 1);
        $token = Str::random(5);

        foreach ($email as $value) {
            $token .= $value . Str::random(20);
        }

        $token .= '.' . Str::random(5);

        foreach ($phone as $value) {
            $token .= $value . Str::random(4);
        }

        $token .= '.' . Str::random(20);

        return $token;


    }

    //////////////////////////////////////////////////////////////////////
    ///
    static function generateCouponCode()
    {
        $code = rand('1000', '9999') . rand('1000', '9999') . rand('1000', '9999');

        $record = Cobon::where('code', $code)->first();

        if ($record) {
            self::generateCobonCode();
        } else {
            return $code;
        }
    }

    static function generateInvoiceCode()
    {
        $code = rand('1000', '9999') . rand('1000', '9999') . rand('1000', '9999');

        $record = Invoice::where('code', $code)->first();

        if ($record) {
            self::generateCobonCode();
        } else {
            return $code;
        }
    }

    static function ResetPassword($model, $password)
    {
        $model->password = Hash::make($password);
        $model->save();
        return true;
    }


    static function removeToken($token)
    {
        Token::where('token', $token)->delete();
        return true;
    }

    static function addIdCard($photo, $folder, $model)
    {

        $path = \Storage::disk('public_uploads')->put($folder, $photo);

        $model->id_card = $path;
        $model->save();
    }


    static function is_read($model)
    {
        if ($model->is_read == 0) {
            $model->is_read = 1;
            $model->save();
            return true;
        } else {
            return false;
        }
    }


    static function convertDateTime($dateTime)
    {
        $date = Carbon::parse($dateTime)->format('Y-m-d 00:00:00');

        return $date;
    }


    static function coupon_activation($model, $name = 'is_active')
    {
        if ($model->$name == 1) {
            $model->$name = 0;
            $model->save();

        } else {
            return false;
        }

        return true;
    }

    static function activation($model, $name = 'is_active')
    {
        if ($model->$name == 1) {
            $model->$name = 0;
            $model->save();

        } else {
            $model->$name = 1;
            $model->save();
        }

        return true;
    }


    static function offer($model)
    {
        if ($model->is_offered == 1) {
            $model->is_offered = 0;
            $model->save();

        } else {
            $model->is_offered = 1;
            $model->save();
        }

        return true;
    }


    static function activationView($model, $url, $on_red = 'الغاء التفعيل', $on_blue = 'تفعيل')
    {
        $onclick = 'onclick="myFunction(' . $model->id . ')"';
        if ($model->is_active == 1 && $on_blue != 'قبول') {
            return '<a class="btn btn-danger" href="' . $url . '" id="btn_' . $model->id . '" ' . $onclick . '>
                         ' . $on_red . '
                    </a>';
        } else {
            return ' <a class="btn btn-primary" style="width: 10rem;" href="' . $url . '" id="btn_' . $model->id . '" ' . $onclick . '>
                        ' . $on_blue . '
                    </a>';
        }
    }

    static function isOffer($model, $url)
    {
        if ($model->is_offered == 1) {
            return '<a class="btn btn-danger" href="' . $url . '" >
                         الغاء التفعيل
                    </a>';
        } else {
            return ' <a class="btn btn-primary" style="width: 10rem;" href="' . $url . '">
                        تفعيل
                    </a>';
        }
    }


    static function addPhoto($file, $model, $folder_name)
    {
        $image = $file;
        $destinationPath = public_path() . '/uploads/' . $folder_name . '/';
        $extension = $image->getClientOriginalExtension(); // getting image extension
        $name = time() . '' . rand(11111, 99999) . '.' . $extension; // renaming image
        $image->move($destinationPath, $name); // uploading file to given


        $model->image = 'uploads/' . $folder_name . '/' . $name;
        $model->save();
    }

    static function addPhotos($file, $model, $folder_name, $relation)
    {
        $image = $file;
        $destinationPath = public_path() . '/uploads/' . $folder_name . '/';
        $extension = $image->getClientOriginalExtension(); // getting image extension
        $name = time() . '' . rand(11111, 99999) . '.' . $extension; // renaming image
        $image->move($destinationPath, $name); // uploading file to given

        $model->$relation()->create(['photo' => 'uploads/' . $folder_name . '/' . $name,]);
    }


    static function updatePhotos($file, $model, $folder_name, $relation)
    {
        $image = $file;
        $destinationPath = public_path() . '/uploads/' . $folder_name . '/';
        $extension = $image->getClientOriginalExtension(); // getting image extension
        $name = time() . '' . rand(11111, 99999) . '.' . $extension; // renaming image
        $image->move($destinationPath, $name); // uploading file to given


        $model->$relation()->create(['photo' => 'uploads/' . $folder_name . '/' . $name]);

        //File::delete(public_path() . '/uploads/' . $folder_name . '/' . $name);
    }

    static function updateScreenPhotos($file, $model, $folder_name, $relation)
    {
        $image = $file;
        $destinationPath = public_path() . '/uploads/thumbnails/' . $folder_name . '/';
        $extension = $image->getClientOriginalExtension(); // getting image extension
        $name = 'original' . time() . '' . rand(11111, 99999) . '.' . $extension; // renaming image
        $image->move($destinationPath, $name); // uploading file to given


        $image_400 = '400-' . time() . '' . rand(11111, 99999) . '.' . $extension;

        $resize_image = Image::make($destinationPath . $name);

        $resize_image->resize(400, null, function ($constraint) {
            $constraint->aspectRatio();
        })->save($destinationPath . $image_400, 100);

        $model->$relation()->create(['video_screen' => 'uploads/thumbnails/' . $folder_name . '/' . $image_400,

            'type' => 'video_screen']);

        File::delete(public_path() . '/uploads/thumbnails/' . $folder_name . '/' . $name);
    }


    static function addVideos($file, $model, $folder_name, $relation)
    {
        $video = $file;
        $destinationPath = public_path() . '/uploads/videos/' . $folder_name . '/';
        $extension = $video->getClientOriginalExtension(); // getting image extension
        $name = time() . '' . rand(11111, 99999) . '.' . $extension; // renaming image
        $video->move($destinationPath, $name); // uploading file to given
        $model->$relation()->create(['video_url' => 'uploads/videos/' . $folder_name . '/' . $name,
            'type' => 'video']);
    }

    static function updateVideos($file, $model, $folder_name, $relation)
    {
        $video = $file;
        $destinationPath = public_path() . '/uploads/videos/' . $folder_name . '/';
        $extension = $video->getClientOriginalExtension(); // getting image extension
        $name = time() . '' . rand(11111, 99999) . '.' . $extension; // renaming image
        $video->move($destinationPath, $name); // uploading file to given
        $model->$relation()->create(['video_url' => 'uploads/videos/' . $folder_name . '/' . $name,
            'type' => 'video']);
    }

    static function updatePhoto($file, $model, $folder_name)
    {
        $image = $file;
        $destinationPath = public_path() . '/uploads/' . $folder_name . '/';
        $extension = $image->getClientOriginalExtension(); // getting image extension
        $name = time() . '' . rand(11111, 99999) . '.' . $extension; // renaming image
        $image->move($destinationPath, $name); // uploading file to given

        $model->update(['image' => 'uploads/' . $folder_name . '/' . $name]);
    }

    static function updateImage($file, $fileName , $model, $folder_name)
    {

        $image = $file;
        $destinationPath = public_path() . '/uploads/' . $folder_name . '/';
        $extension = $image->getClientOriginalExtension(); // getting image extension
        $name = time() . '' . rand(11111, 99999) . '.' . $extension; // renaming image
        $image->move($destinationPath, $name); // uploading file to given

        $model->update([$fileName => 'uploads/' . $folder_name . '/' . $name]);

    }


    static function deletePhoto($model, $relation = null)
    {
        $photo = $model->photo;

        File::delete(public_path() . '/' . $photo->name);


        if ($relation == 'photos') {
            $model->photos()->delete();
        } else {

            $model->photo()->delete();
        }

    }

    static function deletePhotoV2($model, $relation)
    {
        $image = $model->$relation;

        File::delete(public_path() . '/' . optional($image)->photo);

        $model->$relation()->delete();

    }

    static function deletePhotos($model, $relation)
    {
        $image = $model->$relation;
        foreach ($image as $photo) {
            File::delete(public_path() . '/' . optional($photo)->photo_url);
        }

        $model->$relation()->delete();

    }

    static function deleteVideos($model, $relation)
    {
        $videos = $model->$relation;
        foreach ($videos as $video) {
            File::delete(public_path() . '/' . optional($video)->video_url);
        }

        $model->$relation()->delete();

    }

    static function word2uni($word)
    {

        $new_word = array();
        $char_type = array();
        $isolated_chars = array('ا', 'د', 'ذ', 'أ', 'آ', 'ر', 'ؤ', 'ء', 'ز', 'و', 'ى', 'ة');

        $all_chars = array
        (
            'ا' => array(

                'middle' => 'ﺎ',

                'isolated' => 'ﺍ'
            ),

            'ؤ' => array(

                'middle' => 'ﺅ',

                'isolated' => 'ﺆ'
            ),
            'ء' => array(
                'middle' => 'ﺀ',
                'isolated' => 'ﺀ'
            ),
            'أ' => array(

                'middle' => 'ﺄ',

                'isolated' => 'ﺃ'
            ),
            'آ' => array(

                'middle' => 'ﺂ',

                'isolated' => 'ﺁ'
            ),
            'ى' => array(

                'middle' => 'ﻰ',

                'isolated' => 'ﻯ'
            ),
            'ب' => array(
                'beginning' => 'ﺑ',
                'middle' => 'ﺒ',
                'end' => 'ﺐ',
                'isolated' => 'ﺏ'
            ),
            'ت' => array(
                'beginning' => 'ﺗ',
                'middle' => 'ﺘ',
                'end' => 'ﺖ',
                'isolated' => 'ﺕ'
            ),
            'ث' => array(
                'beginning' => 'ﺛ',
                'middle' => 'ﺜ',
                'end' => 'ﺚ',
                'isolated' => 'ﺙ'
            ),
            'ج' => array(
                'beginning' => 'ﺟ',
                'middle' => 'ﺠ',
                'end' => 'ﺞ',
                'isolated' => 'ﺝ'
            ),
            'ح' => array(
                'beginning' => 'ﺣ',
                'middle' => 'ﺤ',
                'end' => 'ﺢ',
                'isolated' => 'ﺡ'
            ),
            'خ' => array(
                'beginning' => 'ﺧ',
                'middle' => 'ﺨ',
                'end' => 'ﺦ',
                'isolated' => 'ﺥ'
            ),
            'د' => array(
                'middle' => 'ﺪ',
                'isolated' => 'ﺩ'
            ),
            'ذ' => array(
                'middle' => 'ﺬ',
                'isolated' => 'ﺫ'
            ),
            'ر' => array(
                'middle' => 'ﺮ',
                'isolated' => 'ﺭ'
            ),
            'ز' => array(
                'middle' => 'ﺰ',
                'isolated' => 'ﺯ'
            ),
            'س' => array(
                'beginning' => 'ﺳ',
                'middle' => 'ﺴ',
                'end' => 'ﺲ',
                'isolated' => 'ﺱ'
            ),
            'ش' => array(
                'beginning' => 'ﺷ',
                'middle' => 'ﺸ',
                'end' => 'ﺶ',
                'isolated' => 'ﺵ'
            ),
            'ص' => array(
                'beginning' => 'ﺻ',
                'middle' => 'ﺼ',
                'end' => 'ﺺ',
                'isolated' => 'ﺹ'
            ),
            'ض' => array(
                'beginning' => 'ﺿ',
                'middle' => 'ﻀ',
                'end' => 'ﺾ',
                'isolated' => 'ﺽ'
            ),
            'ط' => array(
                'beginning' => 'ﻃ',
                'middle' => 'ﻄ',
                'end' => 'ﻂ',
                'isolated' => 'ﻁ'
            ),
            'ظ' => array(
                'beginning' => 'ﻇ',
                'middle' => 'ﻈ',
                'end' => 'ﻆ',
                'isolated' => 'ﻅ'
            ),
            'ع' => array(
                'beginning' => 'ﻋ',
                'middle' => 'ﻌ',
                'end' => 'ﻊ',
                'isolated' => 'ﻉ'
            ),
            'غ' => array(
                'beginning' => 'ﻏ',
                'middle' => 'ﻐ',
                'end' => 'ﻎ',
                'isolated' => 'ﻍ'
            ),
            'ف' => array(
                'beginning' => 'ﻓ',
                'middle' => 'ﻔ',
                'end' => 'ﻒ',
                'isolated' => 'ﻑ'
            ),
            'ق' => array(
                'beginning' => 'ﻗ',
                'middle' => 'ﻘ',
                'end' => 'ﻖ',
                'isolated' => 'ﻕ'
            ),
            'ك' => array(
                'beginning' => 'ﻛ',
                'middle' => 'ﻜ',
                'end' => 'ﻚ',
                'isolated' => 'ﻙ'
            ),
            'ل' => array(
                'beginning' => 'ﻟ',
                'middle' => 'ﻠ',
                'end' => 'ﻞ',
                'isolated' => 'ﻝ'
            ),
            'م' => array(
                'beginning' => 'ﻣ',
                'middle' => 'ﻤ',
                'end' => 'ﻢ',
                'isolated' => 'ﻡ'
            ),
            'ن' => array(
                'beginning' => 'ﻧ',
                'middle' => 'ﻨ',
                'end' => 'ﻦ',
                'isolated' => 'ﻥ'
            ),
            'ه' => array(
                'beginning' => 'ﻫ',
                'middle' => 'ﻬ',
                'end' => 'ﻪ',
                'isolated' => 'ﻩ'
            ),
            'و' => array(
                'middle' => 'ﻮ',
                'isolated' => 'ﻭ'
            ),
            'ي' => array(
                'beginning' => 'ﻳ',
                'middle' => 'ﻴ',
                'end' => 'ﻲ',
                'isolated' => 'ﻱ'
            ),
            'ئ' => array(
                'beginning' => 'ﺋ',
                'middle' => 'ﺌ',
                'end' => 'ﺊ',
                'isolated' => 'ﺉ'
            ),
            'ة' => array(
                'middle' => 'ﺔ',
                'isolated' => 'ﺓ'
            )
        );

        if (in_array($word[0] . $word[1], $isolated_chars)) {
            $new_word[] = $all_chars[$word[0] . $word[1]]['isolated'];
            $char_type[] = 'not_normal';
        } else {
            $new_word[] = $all_chars[$word[0] . $word[1]]['beginning'];
            $char_type[] = 'normal';
        }

        if (strlen($word) > 4) {
            if ($char_type[0] == 'not_normal') {
                if (in_array($word[2] . $word[3], $isolated_chars)) {
                    $new_word[] = $all_chars[$word[2] . $word[3]]['isolated'];
                    $char_type[] = 'not_normal';
                } else {

                    $new_word[] = $all_chars[$word[2] . $word[3]]['beginning'];
                    $char_type[] = 'normal';
                }
            } else {
                $new_word[] = $all_chars[$word[2] . $word[3]]['middle'];
                $chars_statue[] = 'middle';

                if (in_array($word[2] . $word[3], $isolated_chars)) {
                    $char_type[] = 'not_normal';
                } else {
                    $char_type[] = 'normal';
                }
            }
            $x = 4;
        } else {
            $x = 2;
        }

        for ($x = 4; $x < (strlen($word) - 4); $x++) {
            if ($char_type[count($char_type) - 1] == 'not_normal' and $x % 2 == 0) {
                if (in_array($word[$x] . $word[$x + 1], $isolated_chars)) {

                    $new_word[] = $all_chars[$word[$x] . $word[$x + 1]]['isolated'];
                    $char_type[] = 'not_normal';
                } else {

                    $new_word[] = $all_chars[$word[$x] . $word[$x + 1]]['beginning'];
                    $char_type[] = 'normal';
                }
            } elseif ($char_type[count($char_type) - 1] == 'normal' and $x % 2 == 0) {

                if (in_array($word[$x] . $word[$x + 1], $isolated_chars)) {

                    $new_word[] = $all_chars[$word[$x] . $word[$x + 1]]['middle'];
                    $char_type[] = 'not_normal';
                } else {

                    $new_word[] = $all_chars[$word[$x] . $word[$x + 1]]['middle'];
                    $char_type[] = 'normal';
                }
            }

        }
        if (strlen($word) > 6) {
            if ($char_type[count($char_type) - 1] == 'not_normal') {
                if (in_array($word[$x] . $word[$x + 1], $isolated_chars)) {

                    $new_word[] = $all_chars[$word[$x] . $word[$x + 1]]['isolated'];
                    $char_type[] = 'not_normal';
                } else {

                    if ($word[strlen($word) - 2] . $word[strlen($word) - 1] == 'ء') {
                        $new_word[] = $all_chars[$word[$x] . $word[$x + 1]]['isolated'];
                        $char_type[] = 'normal';
                    } else {
                        $new_word[] = $all_chars[$word[$x] . $word[$x + 1]]['beginning'];
                        $char_type[] = 'normal';
                    }

                }

                $x += 2;
            } elseif ($char_type[count($char_type) - 1] == 'normal') {

                if (in_array($word[$x] . $word[$x + 1], $isolated_chars)) {

                    $new_word[] = $all_chars[$word[$x] . $word[$x + 1]]['middle'];
                    $char_type[] = 'not_normal';
                } else {

                    $new_word[] = $all_chars[$word[$x] . $word[$x + 1]]['middle'];
                    $char_type[] = 'normal';
                }

                $x += 2;
            }


        }

        if ($char_type[count($char_type) - 1] == 'not_normal') {

            if (in_array($word[$x] . $word[$x + 1], $isolated_chars)) {

                $new_word[] = $all_chars[$word[$x] . $word[$x + 1]]['isolated'];

            } else {
                $new_word[] = $all_chars[$word[$x] . $word[$x + 1]]['isolated'];

            }

        } else {
            if (in_array($word[$x] . $word[$x + 1], $isolated_chars)) {

                $new_word[] = $all_chars[$word[$x] . $word[$x + 1]]['middle'];

            } else {

                $new_word[] = $all_chars[$word[$x] . $word[$x + 1]]['end'];

            }
        }

        return implode('', array_reverse($new_word));
    }


    static function sixMonthsLetter($record)
    {
        Image::configure(['driver' => 'imagick']);
        $img = Image::make(public_path('front/img/courses_letter.jpg'));

        $img->text('قوات أمن المنشآت', 3930, 1290, function ($font) {
            $font->file(public_path('front/fonts/GEDinkum-Bold-1.ttf'));
            $font->size(130);
            $font->color('#000000');
            $font->align('right');
            $font->valign('bottom');
        });

        $text = $record->side;
        $img->text($text, 3960, 1480, function ($font) {
            $font->file(public_path('front/fonts/Frutiger-LT-Arabic-65-Bold.ttf'));
            $font->size(120);
            $font->color('#000000');
            $font->align('right');
            $font->valign('bottom');
        });

        $text2 = $record->name;
        $img->text($text2, 4320, 2620, function ($font) {
            $font->file(public_path('front/fonts/Frutiger-LT-Arabic-65-Bold.ttf'));
            $font->size(105);
            $font->color('#000000');
            $font->align('right');
            $font->valign('bottom');
        });

        $img->text(Carbon::parse($record->created_at)->format('Y-m-d'), 740, 970, function ($font) {
            $font->file(public_path('front/fonts/Ripple-Regular.ttf'));
            $font->size(80);
            $font->color('#000000');
            $font->align('center');
            $font->valign('bottom');
        });


        $img->text($record->civil_registry, 2160, 2620, function ($font) {
            $font->file(public_path('front/fonts/Ripple-Regular.ttf'));
            $font->size(90);
            $font->color('#000000');
            $font->align('center');
            $font->valign('bottom');
        });

        $text3 = $record->diploma->getOriginal('name')['ar'];
        $img->text($text3, 935, 2620, function ($font) {
            $font->file(public_path('front/fonts/tradtes.ttf'));
            $font->size(120);
            $font->color('#000000');
            $font->align('center');
            $font->valign('bottom');
        });

        $text4 = $record->diploma->getOriginal('name')['ar'];
        if (in_array($record->diploma->period, ['year', 'three_months', 'six_months', 'nine_months']) && request('study_type') == 'presence') {
            $type = $text4 . ' (حضوري) ';
        } elseif (in_array($record->diploma->period, ['year', 'three_months', 'six_months', 'nine_months']) && request('study_type') == 'online') {
            $type = $text4 . ' (عن بعد) ';
        } else {
            $type = $text4;
        }
        $img->text($type, 3010, 3170, function ($font) {
            $font->file(public_path('front/fonts/tradtes.ttf'));
            $font->size(100);
            $font->color('#000000');
            $font->align('center');
            $font->valign('bottom');
        });


        $img->text($record->diploma->hours_number, 870, 3170, function ($font) {
            $font->file(public_path('front/fonts/tradtes.ttf'));
            $font->size(95);
            $font->color('#000000');
            $font->align('center');
            $font->valign('bottom');
        });


        $img->text(setting('security_diploma_date') . ' هـ ', 2830, 3360, function ($font) {
            $font->file(public_path('front/fonts/tradtes.ttf'));
            $font->size(110);
            $font->color('#000000');
            $font->align('center');
            $font->valign('bottom');
        });

        $img->text($record?->region?->name, 3670, 4670, function ($font) {
            $font->file(public_path('front/fonts/tradtes.ttf'));
            $font->size(100);
            $font->color('#000000');
            $font->align('right');
            $font->valign('bottom');
        });

        $img->text('علي أن تكون الدراسة في الفترة المسائية', 2500, 4660, function ($font) {
            $font->file(public_path('front/fonts/Frutiger-LT-Arabic-65-Bold.ttf'));
            $font->size(80);
            $font->color('#000000');
            $font->align('center');
            $font->valign('bottom');
        });

        //exec('convert -units PixelsPerInch originalImage -resample 300 outputIamge');
        $img->save(public_path('uploads/letters/' . $record->id . '.jpg'), '100');
        $record->image = 'uploads/letters/' . $record->id . '.jpg';
        $record->save();

        $im = new \Imagick(public_path($record->image));
        $im->setImageFormat('pdf');
        $im->writeImage(public_path() . '/uploads/pdf_letters/' . $record->id . '-' . 'pdf' . '.pdf');
        $filepath = 'uploads/pdf_letters/' . $record->id . '-' . 'pdf' . '.pdf';
        $record->pdf = $filepath;
        $record->save();
    }

    static function yearOrTwoLetter($record)
    {
        Image::configure(['driver' => 'imagick']);
        $img = Image::make(public_path('front/img/diploma_letter.jpg'));

        $img->text('قوات أمن المنشآت', 3930, 1290, function ($font) {
            $font->file(public_path('front/fonts/GEDinkum-Bold-1.ttf'));
            $font->size(130);
            $font->color('#000000');
            $font->align('right');
            $font->valign('bottom');
        });

        $text = $record->side;
        $img->text($text, 3960, 1480, function ($font) {
            $font->file(public_path('front/fonts/Frutiger-LT-Arabic-65-Bold.ttf'));
            $font->size(120);
            $font->color('#000000');
            $font->align('right');
            $font->valign('bottom');
        });

        $text2 = $record->name;
        $img->text($text2, 4320, 2620, function ($font) {
            $font->file(public_path('front/fonts/Frutiger-LT-Arabic-65-Bold.ttf'));
            $font->size(105);
            $font->color('#000000');
            $font->align('right');
            $font->valign('bottom');
        });

        $img->text(Carbon::parse($record->created_at)->format('Y-m-d'), 740, 970, function ($font) {
            $font->file(public_path('front/fonts/Ripple-Regular.ttf'));
            $font->size(80);
            $font->color('#000000');
            $font->align('center');
            $font->valign('bottom');
        });


        $img->text($record->civil_registry, 2160, 2620, function ($font) {
            $font->file(public_path('front/fonts/Ripple-Regular.ttf'));
            $font->size(90);
            $font->color('#000000');
            $font->align('center');
            $font->valign('bottom');
        });

        $text3 = $record->diploma->getOriginal('name')['ar'];
        $img->text($text3, 935, 2620, function ($font) {
            $font->file(public_path('front/fonts/tradtes.ttf'));
            $font->size(105);
            $font->color('#000000');
            $font->align('center');
            $font->valign('bottom');
        });

        $text4 = $record->diploma->getOriginal('name')['ar'];
        if ($record->diploma->period == 'year' && request('study_type') == 'presence') {
            $type = $text4 . ' (حضوري) ';
        } elseif ($record->diploma->period == 'year' && request('study_type') == 'online') {
            $type = $text4 . ' (عن بعد) ';
        } else {
            $type = $text4;
        }

        $img->text($type, 3430, 3170, function ($font) {
            $font->file(public_path('front/fonts/tradtes.ttf'));
            $font->size(113);
            $font->color('#000000');
            $font->align('center');
            $font->valign('bottom');
        });


        $img->text($record->diploma->hours_number, 1880, 3170, function ($font) {
            $font->file(public_path('front/fonts/tradtes.ttf'));
            $font->size(95);
            $font->color('#000000');
            $font->align('center');
            $font->valign('bottom');
        });


        $img->text(setting('security_diploma_date') . ' هـ ', 2900, 3360, function ($font) {
            $font->file(public_path('front/fonts/tradtes.ttf'));
            $font->size(110);
            $font->color('#000000');
            $font->align('center');
            $font->valign('bottom');
        });

        $img->text($record->diploma->period == 'two_years' ? 'أربعة فصول دراسية' : 'فصلين دراسيين', 2250, 3720, function ($font) {
            $font->file(public_path('front/fonts/tradtes.ttf'));
            $font->size(150);
            $font->color('#000000');
            $font->align('center');
            $font->valign('bottom');
        });

        $img->text($record?->region?->name, 3620, 4670, function ($font) {
            $font->file(public_path('front/fonts/tradtes.ttf'));
            $font->size(100);
            $font->color('#000000');
            $font->align('right');
            $font->valign('bottom');
        });

        $img->text('علي أن تكون الدراسة في الفترة المسائية', 2500, 4660, function ($font) {
            $font->file(public_path('front/fonts/Frutiger-LT-Arabic-65-Bold.ttf'));
            $font->size(75);
            $font->color('#000000');
            $font->align('center');
            $font->valign('bottom');
        });

        //exec('convert -units PixelsPerInch originalImage -resample 300 outputIamge');
        $img->save(public_path('uploads/letters/' . $record->id . '.jpg'), '100');
        $record->image = 'uploads/letters/' . $record->id . '.jpg';
        $record->save();

        $im = new \Imagick(public_path($record->image));
        $im->setImageFormat('pdf');
        $im->writeImage(public_path() . '/uploads/pdf_letters/' . $record->id . '-' . 'pdf' . '.pdf');
        $filepath = 'uploads/pdf_letters/' . $record->id . '-' . 'pdf' . '.pdf';
        $record->pdf = $filepath;
        $record->save();
    }

    static function diplomaLetterMadinah($record)
    {
        Image::configure(['driver' => 'imagick']);
        $img = Image::make(public_path('front/img/diploma_letter.jpg'));

        $img->text('قوات أمن المنشآت', 3930, 1290, function ($font) {
            $font->file(public_path('front/fonts/GEDinkum-Bold-1.ttf'));
            $font->size(130);
            $font->color('#000000');
            $font->align('right');
            $font->valign('bottom');
        });


        $img->text('قائد قوات أمن المنشآت بمنطقة المدينة المنورة', 4000, 1480, function ($font) {
            $font->file(public_path('front/fonts/Frutiger-LT-Arabic-65-Bold.ttf'));
            $font->size(97);
            $font->color('#000000');
            $font->align('right');
            $font->valign('bottom');
        });

        $text2 = $record->name;
        $img->text($text2, 4320, 2620, function ($font) {
            $font->file(public_path('front/fonts/Frutiger-LT-Arabic-65-Bold.ttf'));
            $font->size(105);
            $font->color('#000000');
            $font->align('right');
            $font->valign('bottom');
        });

        $img->text(Carbon::parse($record->created_at)->format('Y-m-d'), 740, 970, function ($font) {
            $font->file(public_path('front/fonts/Ripple-Regular.ttf'));
            $font->size(80);
            $font->color('#000000');
            $font->align('center');
            $font->valign('bottom');
        });


        $img->text($record->civil_registry, 2160, 2620, function ($font) {
            $font->file(public_path('front/fonts/Ripple-Regular.ttf'));
            $font->size(90);
            $font->color('#000000');
            $font->align('center');
            $font->valign('bottom');
        });

        $text3 = $record->product?->name;
        $img->text($text3, 935, 2620, function ($font) {
            $font->file(public_path('front/fonts/tradtes.ttf'));
            $font->size(105);
            $font->color('#000000');
            $font->align('center');
            $font->valign('bottom');
        });

        $text4 = $record->product?->name;
//        if ($record->diploma->period == 'year' && request('study_type') == 'presence') {
//            $type = $text4 . ' (حضوري) ';
//        } elseif ($record->diploma->period == 'year' && request('study_type') == 'online') {
//            $type = $text4 . ' (عن بعد) ';
//        } else {
//            $type = $text4;
//        }

        $img->text($text4 . ' ( مسائي ) ', 3430, 3170, function ($font) {
            $font->file(public_path('front/fonts/Frutiger-LT-Arabic-65-Bold.ttf'));
            $font->size(77);
            $font->color('#000000');
            $font->align('center');
            $font->valign('bottom');
        });


        $img->text($record->product?->hours_number, 1880, 3170, function ($font) {
            $font->file(public_path('front/fonts/tradtes.ttf'));
            $font->size(95);
            $font->color('#000000');
            $font->align('center');
            $font->valign('bottom');
        });


        $img->text(setting('security_diploma_date') . ' هـ ', 2900, 3360, function ($font) {
            $font->file(public_path('front/fonts/tradtes.ttf'));
            $font->size(110);
            $font->color('#000000');
            $font->align('center');
            $font->valign('bottom');
        });

        $img->text('أربعة فصول دراسية', 2250, 3720, function ($font) {
            $font->file(public_path('front/fonts/tradtes.ttf'));
            $font->size(150);
            $font->color('#000000');
            $font->align('center');
            $font->valign('bottom');
        });

        $img->text('المدينة المنورة', 3620, 4670, function ($font) {
            $font->file(public_path('front/fonts/tradtes.ttf'));
            $font->size(100);
            $font->color('#000000');
            $font->align('right');
            $font->valign('bottom');
        });

        //exec('convert -units PixelsPerInch originalImage -resample 300 outputIamge');
        $img->save(public_path('uploads/letters/' . $record->id . '.jpg'), '100');
        $record->image = 'uploads/letters/' . $record->id . '.jpg';
        $record->save();

        $im = new \Imagick(public_path($record->image));
        $im->setImageFormat('pdf');
        $im->writeImage(public_path() . '/uploads/pdf_letters/' . $record->id . '-' . 'pdf' . '.pdf');
        $filepath = 'uploads/pdf_letters/' . $record->id . '-' . 'pdf' . '.pdf';
        $record->pdf = $filepath;
        $record->save();
    }

    static function madinahCourseLetter($record)
    {
        Image::configure(['driver' => 'imagick']);
        $img = Image::make(public_path('front/img/dawra_letter.jpg'));

        $img->text('قوات أمن المنشآت', 3930, 1290, function ($font) {
            $font->file(public_path('front/fonts/GEDinkum-Bold-1.ttf'));
            $font->size(130);
            $font->color('#000000');
            $font->align('right');
            $font->valign('bottom');
        });


        $img->text('قائد قوات أمن المنشآت بمنطقة المدينة المنورة', 3990, 1480, function ($font) {
            $font->file(public_path('front/fonts/Frutiger-LT-Arabic-65-Bold.ttf'));
            $font->size(97);
            $font->color('#000000');
            $font->align('right');
            $font->valign('bottom');
        });

        $text2 = $record->name;
        $img->text($text2, 4320, 2620, function ($font) {
            $font->file(public_path('front/fonts/Frutiger-LT-Arabic-65-Bold.ttf'));
            $font->size(105);
            $font->color('#000000');
            $font->align('right');
            $font->valign('bottom');
        });

        $img->text(Carbon::parse($record->created_at)->format('Y-m-d'), 740, 970, function ($font) {
            $font->file(public_path('front/fonts/Ripple-Regular.ttf'));
            $font->size(80);
            $font->color('#000000');
            $font->align('center');
            $font->valign('bottom');
        });


        $img->text($record->civil_registry, 2160, 2620, function ($font) {
            $font->file(public_path('front/fonts/Ripple-Regular.ttf'));
            $font->size(90);
            $font->color('#000000');
            $font->align('center');
            $font->valign('bottom');
        });

        $text3 = $record->product->name;
        $img->text($text3, 935, 2620, function ($font) {
            $font->file(public_path('front/fonts/tradtes.ttf'));
            $font->size(120);
            $font->color('#000000');
            $font->align('center');
            $font->valign('bottom');
        });

        $text4 = $record->product->name;
        $img->text($text4 . ' ' . __($record->product->period) . ' ' . '( مسائي )', 2800, 3170, function ($font) {
            $font->file(public_path('front/fonts/Frutiger-LT-Arabic-65-Bold.ttf'));
            $font->size(100);
            $font->color('#000000');
            $font->align('center');
            $font->valign('bottom');
        });


        $img->text($record->product->hours_number, 730, 3170, function ($font) {
            $font->file(public_path('front/fonts/tradtes.ttf'));
            $font->size(95);
            $font->color('#000000');
            $font->align('center');
            $font->valign('bottom');
        });


        $img->text('1445-12-20' . ' هـ ', 2830, 3360, function ($font) {
            $font->file(public_path('front/fonts/tradtes.ttf'));
            $font->size(110);
            $font->color('#000000');
            $font->align('center');
            $font->valign('bottom');
        });

        $img->text('المدينة المنورة', 3670, 4670, function ($font) {
            $font->file(public_path('front/fonts/tradtes.ttf'));
            $font->size(100);
            $font->color('#000000');
            $font->align('right');
            $font->valign('bottom');
        });

        //exec('convert -units PixelsPerInch originalImage -resample 300 outputIamge');
        $img->save(public_path('uploads/letters/' . $record->id . '.jpg'), '100');
        $record->image = 'uploads/letters/' . $record->id . '.jpg';
        $record->save();

        $im = new \Imagick(public_path($record->image));
        $im->setImageFormat('pdf');
        $im->writeImage(public_path() . '/uploads/pdf_letters/' . $record->id . '-' . 'pdf' . '.pdf');
        $filepath = 'uploads/pdf_letters/' . $record->id . '-' . 'pdf' . '.pdf';
        $record->pdf = $filepath;
        $record->save();
    }

    static function madinahSixMonthsLetter($record)
    {
        Image::configure(['driver' => 'imagick']);
        $img = Image::make(public_path('front/img/madinah_six_months.jpg'));


        $text2 = $record->name;
        $img->text($text2, 4000, 2620, function ($font) {
            $font->file(public_path('front/fonts/tradtes.ttf'));
            $font->size(140);
            $font->color('#000000');
            $font->align('right');
            $font->valign('bottom');
        });

        $img->text(Carbon::parse($record->created_at)->format('Y-m-d'), 760, 970, function ($font) {
            $font->file(public_path('front/fonts/Ripple-Regular.ttf'));
            $font->size(90);
            $font->color('#000000');
            $font->align('center');
            $font->valign('bottom');
        });


        $img->text($record->civil_registry, 2200, 2620, function ($font) {
            $font->file(public_path('front/fonts/Ripple-Regular.ttf'));
            $font->size(95);
            $font->color('#000000');
            $font->align('center');
            $font->valign('bottom');
        });

        $text3 = $record->product->name;
        $img->text($text3, 940, 2620, function ($font) {
            $font->file(public_path('front/fonts/tradtes.ttf'));
            $font->size(110);
            $font->color('#000000');
            $font->align('center');
            $font->valign('bottom');
        });

        $text4 = $record->product->name;
        $img->text($text4, 3500, 3270, function ($font) {
            $font->file(public_path('front/fonts/tradtes.ttf'));
            $font->size(120);
            $font->color('#000000');
            $font->align('center');
            $font->valign('bottom');
        });

        $img->text($record->product->hours_number, 630, 3270, function ($font) {
            $font->file(public_path('front/fonts/tradtes.ttf'));
            $font->size(80);
            $font->color('#000000');
            $font->align('center');
            $font->valign('bottom');
        });

        $img->text(setting('security_diploma_date') . ' هـ ', 2150, 3460, function ($font) {
            $font->file(public_path('front/fonts/tradtes.ttf'));
            $font->size(95);
            $font->color('#000000');
            $font->align('center');
            $font->valign('bottom');
        });

        //exec('convert -units PixelsPerInch originalImage -resample 300 outputIamge');
        $img->save(public_path('uploads/madinah/letters/' . $record->id . '.jpg'), '100');
        $record->image = 'uploads/madinah/letters/' . $record->id . '.jpg';
        $record->save();

        $im = new \Imagick(public_path($record->image));
        $im->setImageFormat('pdf');
        $im->writeImage(public_path() . '/uploads/madinah/pdf_letters/' . $record->id . Carbon::now()->format('Y-m-d') . '-' . 'pdf' . '.pdf');
        $filepath = 'uploads/madinah/pdf_letters/' . $record->id . Carbon::now()->format('Y-m-d') . '-' . 'pdf' . '.pdf';
        $record->pdf = $filepath;
        $record->save();
    }
}
