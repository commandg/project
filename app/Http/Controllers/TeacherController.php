<?php

namespace App\Http\Controllers;

use App\Helpers\HelperFunctions;
use App\Models\teacher;
use Illuminate\Http\Request;
use Nette\Schema\Helpers;
use Illuminate\Database\Eloquent\Model;

class TeacherController extends Controller
{
    public function updateTeacherStatus(Request $request, $userId)
    {
        // Find the teacher by user ID
        $teacher = Teacher::where('user_id', $userId)->first();
        if (!$teacher) {
            return response()->json(['message' => 'Teacher not found'], 404);
        }

        // Update the teacher's status
        $teacher->is_teacher = true;
        $teacher->save();

        return response()->json(['message' => 'Teacher status updated successfully'], 200);
    }

    //--------------------------------------------------------------------------------------------------------

    public function deleteTeacher($id)
    {

        HelperFunctions::deleteItem(Teacher::class, $id);
        return response()->json(['message' => 'Teacher deleted succesfully']);

    }
}
