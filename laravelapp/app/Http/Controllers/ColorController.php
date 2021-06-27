<?php

namespace App\Http\Controllers;

use App\Models\Color;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    public function index()
    {
        $result['data'] = Color::all();
        return view('admin.color', $result);
    }

    public function manage_color($id='')
    {
        if($id>0) {
            $arr = Color::where(['id'=>$id])->first();
            $result['color'] = $arr->color;
            $result['id'] = $arr->id;
        } else {
            $result['color'] = '';
            $result['id'] = 0;
        }
        return view('admin.manage_color', $result);
    }

    public function manage_color_process(Request $request)
    {
        $request->validate([
            'color' => 'required'
        ]);
        
        if($request->post('id') > 0) {
            $model = Color::find($request->post('id'));
            $msg = 'Record update successfully';
        } else {
            $model = new Color();
            $msg = 'Record save successfully';
        }

        $model->color = $request->post('color');
        $model->status = 1;
        $model->save();
        $request->session()->flash('message', $msg);
        return redirect('admin/color');
    }

    public function delete(Request $request, $id='')
    {
        $model = Color::find($id);
        $model->delete();
        $request->session()->flash('message', 'Record deleted successfully');
        return redirect('admin/color');
    }

    public function status(Request $request, $status, $id)
    {
        $model = Color::find($id);
        $model->status = $status;
        $model->save();
        $request->session()->flash('message', 'Status update successfully');
        return redirect('admin/color');
    }

}
