<?php

namespace App\Services;
use Illuminate\Http\Request;

trait Uploader{
    public function upload($field, Request $request){
        if ($request->hasFile('logo')) {
            $image = $request->file('logo');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->storeAs('public/images', $imageName);
            return $imageName;
        }
        return null;
    }
}