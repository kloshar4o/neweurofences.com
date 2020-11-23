<?php

namespace App\Http\Controllers;

use App\Models\Lang;
use App\Models\MenuId;
use App\Models\Menu;
use App\Models\GalleryItem;
use App\Models\GalleryItemId;
use App\Models\GoodsPhoto;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Intervention\Image\Facades\Image;

class FileController extends Controller
{
    private $lang_id;
    private $lang;

    public function __construct()
    {
        $this->middleware('auth');
        $this->lang_id = $this->lang()['lang_id'];
        $this->lang = $this->lang()['lang'];
    }

    public function upload() {

        if(Input::file())
        {
            if(!is_null(Input::get('gallery-id'))){
                return $this->uploadGallery();
            }
            else{
                return $this->uploadOneImg();
            }
        }

        return response()->json([
            'status'=>false,
            'messages' => controllerTrans('variables.something_wrong', $this->lang)
        ]);
    }

	public function uploadPdf()
	{
		$url = Input::get('url');

		$pdf = Input::file('pdf');
		$path = 'upfiles/file_pdf/';
		$subject = Input::get('subject');

		$response = '';
		if(Input::hasFile('pdf')){
			if($pdf->getClientOriginalExtension() == 'pdf'){
				if($pdf->getClientSize() < 60000000000){
					$subjects = explode('_',$subject);

					$cur_lang = Lang::where('lang',$subjects[1])->first();

					if (File::exists($path. '' .$subject. '.pdf')){
						File::delete($path. '' .$subject. '.pdf');
						$pdf->move('upfiles/file_pdf/', $subject .'.pdf');

						DB::table('menu')
						  ->whereRaw('menu_id IN(SELECT id FROM menu_id WHERE alias="'.$subjects[0].'")')
						  ->where('lang_id',$cur_lang->id)
						  ->update(['pdf' => $subject.'.pdf']);

						$response = trans('variables.pdf_edited');
					}
					else{
						$pdf->move('upfiles/file_pdf/', $subject .'.pdf');

						DB::table('menu')
						  ->whereRaw('menu_id IN(SELECT id FROM menu_id WHERE alias="'.$subjects[0].'")')
						  ->where('lang_id',$cur_lang->id)
						  ->update(['pdf' => $subject.'.pdf']);

						$response = trans('variables.pdf_saved');
					}
				}
				else $response = trans('variables.pdf_size');
			}
			else $response = trans('variables.pdf_format');
		}
		else $response = trans('variables._wrong_message');

		return redirect($url.'?alias='.$subject.'&n='.$response);
	}

	public function deletePdf()
	{
		$url = Input::get('url');
		$pdf_name = Input::get('file_name');
		$path = '/upfiles/file_pdf/';
		$subject = Input::get('subject');

		$pdf = Menu::where('pdf', $pdf_name)
		           ->first();

		$pdf_id = MenuId::where('alias', $subject)
		                ->first();

		$response = '';

		if($pdf->pdf != ''){
			if($pdf->pdf == $pdf_name){
				if (File::exists($path. '' .$pdf_name. '.pdf')){
					File::delete($path. '' .$pdf_name. '.pdf');

					DB::table('menu')
					  ->where('pdf', $pdf_name)
					  ->where('menu_id',$pdf_id->id)
					  ->update(['pdf' => '']);

					$response = trans('variables.pdf_deleted');
				}
				else{
					DB::table('menu')
					  ->where('pdf', $pdf_name)
					  ->where('menu_id',$pdf_id->id)
					  ->update(['pdf' => '']);

					$response = trans('variables.pdf_deleted');
				}
			}
		}
		else
			$response = trans('variables._wrong_message');


		return redirect($url.'?alias='.$subject.'&n='.$response);
	}

    public function uploadOneImg(){

        $response = [];
        $key = 0;
        $uploadPath = Input::get('uploadPath');
        foreach(Input::file() as $singleFile) {
            foreach ($singleFile as $file) {
                $extension = $file->getClientOriginalExtension();
                $fileName = md5(time()) . rand(11111111, 99999999) . '.' . $extension;
                switch (strtolower($file->getClientOriginalExtension())) {
                    case 'jpg':
                    case 'png':
                    case 'jpeg': {
                        $fileType = 'img';
                        $destinationPath = 'upfiles/' . $uploadPath;
                        break;
                    }
                    default : {
                        return response()->json([
                            'status' => false,
                            'messages' => controllerTrans('variables.invalid_img_format', $this->lang)
                        ]);
                        break;
                    }
                }

                $file->move($destinationPath, $fileName);

                if (!File::exists($destinationPath . '/s')) {
                    File::makeDirectory($destinationPath . '/s');
                }
                if (!File::exists($destinationPath . '/m')) {
                    File::makeDirectory($destinationPath . '/m');
                }

                if ($uploadPath == 'goods') {
                    resizeIMGbyMaxSize($uploadPath, $destinationPath . '/m/', $fileName, 592);
                } else {
                    CreateImageManipulator($uploadPath, $destinationPath . '/m/', $fileName, 365, 530);
                }
                if ($uploadPath == 'size') {
                    resizeIMGbyMaxSize($uploadPath, $destinationPath . '/m/', $fileName, 592);
                } else {
                    CreateImageManipulator($uploadPath, $destinationPath . '/m/', $fileName, 365, 530);
                }

                if ($uploadPath == 'brand') {
                    CreateImageManipulator($uploadPath, $destinationPath . '/s/', $fileName, 148, 41);
                } else {
                    CreateImageManipulator($uploadPath, $destinationPath . '/s/', $fileName, 261, 131);
                }

	            if ($uploadPath == 'color') {
		            CreateImageManipulator($uploadPath, $destinationPath . '/s/', $fileName, 19, 17);
	            }

                if ($uploadPath == 'admin_user') {
                    CreateImageManipulator($uploadPath, $destinationPath . '/s/', $fileName, 52, 42);
                }


//                    Image::make($destinationPath.'/'.$fileName)->resize(200,150)->save($destinationPath.'/s/'.$fileName);
//                    Image::make($destinationPath.'/'.$fileName)->resize(500,450)->save($destinationPath.'/m/'.$fileName);

                $response['fileName'][$key] = $fileName;
                $response['fileType'][$key] = $fileType;
                $response['url'][$key] = asset($destinationPath . '/' . $fileName);
                $key++;
            }
        }
        return response()->json([
            $response,
            'status'=>true
        ]);
    }


    public function destroyOneSingleImg()
    {
        $curr_img = Input::get('curr_img');
        $curr_id = Input::get('curr_id');
        $uploadPath = Input::get('uploadPath');

        if(is_null($curr_img) || is_null($uploadPath))
            return response()->json([
                'status'=>false,
                'messages' => controllerTrans('variables.something_wrong', $this->lang)
            ]);

        if($uploadPath == 'goods')
	        DB::table($uploadPath.'_colors_id')
	          ->where('id', $curr_id)
	          ->update(['img' => '']);
        else
	        DB::table($uploadPath)
	          ->where('id', $curr_id)
	          ->update(['img' => '']);

        $destinationPath = 'upfiles/'.$uploadPath;

        if (File::exists($destinationPath . '/s/' . $curr_img))
            File::delete($destinationPath . '/s/' . $curr_img);

        if (File::exists($destinationPath . '/m/' . $curr_img))
            File::delete($destinationPath . '/m/' . $curr_img);

        if (File::exists($destinationPath . '/' . $curr_img))
            File::delete($destinationPath . '/' . $curr_img);

        return response()->json([
            'status'=>true,
            'messages' => controllerTrans('variables.removed', $this->lang)
        ]);
    }

    public function destroyOneMultipleImg()
    {
        $curr_img = Input::get('curr_img');
        $curr_id = Input::get('curr_id');
        $uploadPath = Input::get('uploadPath');

        if(is_null($uploadPath) || ( is_null($curr_id) && is_null($curr_img)))
            return response()->json([
                'status'=>false,
                'messages' => [controllerTrans('variables.something_wrong', $this->lang)]
            ]);

        DB::table($uploadPath . '_images')
            ->where('id', $curr_id)
            ->delete();

        if(!is_null($curr_img)) {
            $destinationPath = 'upfiles/' . $uploadPath;

            if (File::exists($destinationPath . '/s/' . $curr_img))
                File::delete($destinationPath . '/s/' . $curr_img);

            if (File::exists($destinationPath . '/m/' . $curr_img))
                File::delete($destinationPath . '/m/' . $curr_img);

            if (File::exists($destinationPath . '/' . $curr_img))
                File::delete($destinationPath . '/' . $curr_img);

        }

        return response()->json([
            'status' => true,
            'messages' => [controllerTrans('variables.removed', $this->lang)]
        ]);
    }

    public function activateOneImg()
    {
        $active = Input::get('active');
        $curr_id = Input::get('curr_id');
        $uploadPath = Input::get('uploadPath');

        if(is_null($uploadPath) || is_null($curr_id))
            return response()->json([
                'status'=>false,
                'messages' => [controllerTrans('variables.something_wrong', $this->lang)]
            ]);

        if($active == 1) {
            $active = 0;
            $msg = controllerTrans('variables.element_is_inactive', $this->lang, ['name' => '']);
        }
        else {
            $active = 1;
            $msg = controllerTrans('variables.element_is_active', $this->lang, ['name' => '']);
        }

        DB::table($uploadPath . '_images')
            ->where('id', $curr_id)
            ->update(['active' => $active]);

        return response()->json([
            'status' => true,
            'messages' => [$msg]
        ]);
    }

    public function uploadGallery(){
        $uploadPath = 'gallery';
        foreach(Input::file() as $singleFile){
            foreach($singleFile as $file){
                $extension = $file->getClientOriginalExtension();
                $fileName = md5(time()) . rand(11111111,99999999).'.'.$extension;
                switch(strtolower($file->getClientOriginalExtension())){
                    case 'jpg':
                    case 'png':
                    case 'jpeg':{
                        $destinationPath = 'upfiles/'.$uploadPath;
                        break;
                    }
                    default : {
                        return response()->json([
                            'status'=>false,
                            'messages' => [controllerTrans('variables.invalid_img_format', $this->lang)]
                        ]);
                        break;
                    }
                }

                $file->move($destinationPath, $fileName);

                if(!File::exists($destinationPath.'/s')){
                    File::makeDirectory($destinationPath.'/s');
                }
                if(!File::exists($destinationPath.'/m')){
                    File::makeDirectory($destinationPath.'/m');
                }

                CreateImageManipulator($uploadPath, $destinationPath.'/m/', $fileName, 580, 385, true, false);
                CreateImageManipulator($uploadPath, $destinationPath.'/s/', $fileName, 330, 390, true, false);

                watermark($destinationPath.'/'.$fileName, asset('/admin-assets/img/watermark.png'), $destinationPath.'/'.$fileName);

                $maxPosition = GetMaxPosition('goods_foto');
                $data = [
                    'goods_item_id' => Input::get('gallery-id'),
                    'img' => $fileName,
                    'position' => $maxPosition + 1,
                    'active' => 1
                ];

                GoodsPhoto::create($data);
            }
        }
        return response()->json([
            'status' => true,
            'messages' => ['Save'],
            'redirect' => urlForLanguage($this->lang()['lang'], 'productionsphoto/'.Input::get('gallery-id'))
        ]);
    }

    public function uploadGalleryPhoto(){
        $uploadPath = 'galleryItems';
        foreach(Input::file() as $singleFile){
            foreach($singleFile as $file){

                $extension = $file->getClientOriginalExtension(); // getting image extension
                $fileName = md5(time()) . rand(11111111,99999999).'.'.$extension; // renameing image
                $original_name = $file->getClientOriginalName();

                switch(strtolower($file->getClientOriginalExtension())){
                    case 'jpg':
                    case 'png':
                    case 'jpeg':{
                        $destinationPath = 'upfiles/'.$uploadPath;
                        break;
                    }
                    default : {
                        return response()->json([
                            'status'=>false,
                            'messages' => [controllerTrans('variables.invalid_img_format', $this->lang)]
                        ]);
                        break;
                    }
                }

                $file->move($destinationPath, $fileName);

                if(!File::exists($destinationPath.'/s')){
                    File::makeDirectory($destinationPath.'/s');
                }
                if(!File::exists($destinationPath.'/m')){
                    File::makeDirectory($destinationPath.'/m');
                }

                resizeIMGbyMaxSize($uploadPath, $destinationPath.'/s/', $fileName, 200);
                CreateImageManipulator($uploadPath, $destinationPath.'/m/', $fileName, 500, 500);
                //watermark($destinationPath.'/m/'.$fileName, asset('/admin-assets/img/watermark.png'), $destinationPath.'/m/'.$fileName);
                //watermark($destinationPath.'/'.$fileName, asset('/admin-assets/img/watermark.png'), $destinationPath.'/'.$fileName);


                $maxPosition = GetMaxPosition('gallery_item_id');

                $data = [
                    'gallery_subject_id' => Input::get('gallery-id'),
                    'img' => $fileName,
                    'position' => $maxPosition + 1,
                    'active' => 1,
                    'deleted' => 0,
                    'type' => 'photo',
                    'youtube_id' => '',
                    'youtube_link' => '',
                    'alias' => str_slug(pathinfo($fileName, PATHINFO_FILENAME)),
                    'show_on_main' => 0
                ];

                $gallery_item_id = GalleryItemId::create($data);

                $data = [
                    'gallery_item_id' => $gallery_item_id->id,
                    'lang_id' => $this->lang_id,
                    'name' => pathinfo($original_name, PATHINFO_FILENAME)
                ];

                GalleryItem::create($data);
            }
        }
        return response()->json([
            'status' => true,
            'messages' => ['Save'],
            'redirect' => urlForLanguage($this->lang()['lang'], 'itemsphoto')
        ]);
    }
}