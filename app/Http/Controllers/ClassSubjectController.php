<?php

namespace App\Http\Controllers;

use App\Models\ClassModel;
use App\Models\SubjectModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ClassSubjectModel;
class ClassSubjectController extends Controller

{
    public function list(){
        $data['getRecord']=ClassSubjectModel::getRecord();
        $data['header_title']="Subject Assign List";
        return view('admin.assign_subject.list',$data);
    }
    public function add(){
        $data['getClass']=ClassModel::getClass();
        $data['getSubject']=SubjectModel::getSubject();
        $data['header_title']="Subject Assign List";
        return view('admin.assign_subject.add',$data);
    }
    public function insert(Request $request)
    {
        if (!empty($request->subject_id))
        {
            foreach ($request->subject_id as $subject_id)
            {
                $save=new ClassSubjectModel;
                $save->class_id =$request->class_id;
                $save->subject_id=$subject_id;
                $save->status=$request->status;
                $save->created_by=Auth::user()->id;
                $save->save();



            }
            return redirect('admin/assign_subject/list')->with('success',"Subject Sucssesfully Assign");
        }
        else
        {

            return redirect()->back()->with('error','due to aome error pls try again');
        }
    }
    public function edit($id)
    {
        $data['getRecord']=ClassSubjectModel::getSingle($id);
        if (!empty($data['getRecord']))
        {       $data['header_title']="Edit Class";
            return  view('admin.assign_subject.edit',$data);
        }
        else
        {
            abort(404);
        }
    }
    public function update($id,Request $request)
    {
        $save=ClassSubjectModel::getSingle($id);
        $save->name=$request->name;
        $save->status=$request->status;
        $save->save();
        return redirect('admin/assign_subject/list')->with('succes'," Class Successfully Updated ");

    }
    public function delete($id)
    {
        $save=ClassSubjectModel::getSingle($id);
        $save->is_delete =1;
        $save->save();
        return redirect()->back()->with('succes'," Class Successfully Deletet ");
    }

}
