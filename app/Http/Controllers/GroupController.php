<?php

namespace App\Http\Controllers;

use App\Helpers\HelperFunctions;
use App\Models\group;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    public function createGroup(Request $request)
    {
        $group = new Group();
        $group->group_name = $request->input('group_name');
        $group->course_id = $request->input('course_id');
        $group->teacher_id = $request->input('teacher_id');
        $group->save();

        return response()->json(['message' => 'Group created successfully', 'group' => $group], 201);
    }

    //----------------------------------------------------------------------------------------------------------

    public function deleteGroup($id)
    {
        HelperFunctions::deleteItem(group::class, $id);

        return response()->json(['message' => 'Group deleted succesfully']);
    }
}
