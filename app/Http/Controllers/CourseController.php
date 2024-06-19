<?php

namespace App\Http\Controllers;

use App\Helpers\HelperFunctions;
use App\Models\course;
use App\Http\Requests\StorecourseRequest;
use App\Http\Requests\UpdatecourseRequest;
use Illuminate\Http\Request;

class CourseController extends Controller
{

    public function addCourse(Request $request)
    {
        // Create a new course
        $course = new Course();
        $course->teacher_id = $request->input('teacher_id');
        $course->course_name = $request->input('course_name');
        $course->course_type = $request->input('course_type');

        // Save the course
        $course->save();

        return response()->json(['message' => 'Course added successfully', 'course' => $course], 201);
    }

    //---------------------------------------------------------------------------------------------------------------

    public function editCourse(Request $request, $id)
    {
        // Retrieve the course instance
        $course = Course::find($id);

        // Update the course properties
        $course->course_name = $request->input('course_name');
        $course->course_type = $request->input('course_type');
        // Update any other properties of the course

        // Save the changes
        $course->save();

        return response()->json(['message' => 'Course updated successfully', 'course' => $course], 200);
    }
    //-------------------------------------------------------------------------------------------------------------
    public function viewTeacherCourses($teacherId)
    {
        // Get the courses added by the teacher
        $courses = Course::where('teacher_id', $teacherId)->get();

        // Return the courses as JSON response
        return response()->json(['courses' => $courses], 200);
    }

    //--------------------------------------------------------------------------
    public function deleteCourse($id)
    {
        HelperFunctions::deleteItem(course::class, $id);
        return response()->json(['message' => 'Course deleted succesfully']);
    }
}
