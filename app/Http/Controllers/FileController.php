<?php

namespace App\Http\Controllers;

use App\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{


    public function serve(Request $request){

        $file = File::where('hash', $request->hash)->get()->first();

        $content = Storage::disk($file->disk)->get($file->path.$file->hash);

        return response($content)
            ->header('Content-Type', $file->mimetype)
            ->header('Content-Disposition', 'inline;');
    }

    public function download(Request $request){

        $file = File::where('hash', $request->hash)->get()->first();

        $content = Storage::disk($file->disk)->get($file->path.$file->hash);

        if($file->new_name){
            $file_name = $file->new_name .".". $file->extension;
        }else{
            $file_name = $file->name;
        }

        return response($content)->header('Content-Type', $file->mimetype)
            ->header("Content-Disposition", "attachment;filename=\"".$file_name."\"");
    }

}
