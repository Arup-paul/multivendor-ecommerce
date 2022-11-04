<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Option;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    public function index(){
        $sliders = Option::where('type', 'slider')->get();
        return view('admin.sliders.index',compact('sliders'));
    }

    public function create(){
        return view('admin.sliders.create');
    }

    public function store(Request $request){
         $request->validate([
             'title' => 'required',
             'banner' => 'required',
         ]);

        Option::create([
            'type' => 'slider',
            'value' => [
                'title' => $request->title,
                'banner' => $request->banner,
                'child_image' => $request->child_image,
                'short_title' => $request->short_title,
                'button_text' => $request->button_text,
                'button_link' => $request->button_link,
            ],
            'status' => $request->status
        ]);

        return response()->json( [ 'message' =>  'New Slider Added successfully'] );

    }

    public function edit($id){
        $slider = Option::findOrFail($id);
        return view('admin.sliders.edit',compact('slider'));
    }

    public function update($id,Request $request){
        $request->validate([
            'title' => 'required',
            'banner' => 'required',
        ]);

        Option::where('id',$id)->update([
            'value' => [
                'title' => $request->title,
                'banner' => $request->banner,
                'child_image' => $request->child_image,
                'short_title' => $request->short_title,
                'button_text' => $request->button_text,
                'button_link' => $request->button_link,
            ],
            'status' => $request->status
        ]);

        return response()->json( [ 'message' =>  'Slider Updated successfully'] );

    }

    public function massDestroy(Request $request)
    {

        if($request->deleteAction == 'delete') {
            if (isset($request->ids)) {
                foreach ($request->ids as $id) {
                    $slider = Option::findOrFail($id);
                    if(file_exists($slider->banner)){
                        unlink($slider->banner);
                    }
                    if(file_exists($slider->child_image)){
                        unlink($slider->child_image);
                    }
                    $slider->delete();
                }
                return response()->json([
                    'message' =>  __('Slider Deleted Successfully'),
                    'redirect' => route('admin.sliders.index')
                ]);
            }else{
                return  response()->json(   __('Please Select Checkbox'),422 );
            }
        }else{
            return  response()->json(   __('Please Select Action'),422 );
        }

    }

}
