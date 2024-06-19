<?php

namespace App\Http\Controllers;

use App\Helpers\HelperFunctions;
use App\Models\message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function createMessage(Request $request)
    {
        $message = new Message();
        $message->group_id = $request->input('group_id');
        $message->body = $request->input('body');
        $message->sent_date = now(); // automatically set the sent date to the current date and time
        $message->save();

        return response()->json(['message' => 'Message created successfully', $message], 201);
    }

    //------------------------------------------------------------------------------------------------------------

    public function editMessage(Request $request)
    {
        $message = Message::find($request->input('message_id'));

        if (!$message) {
            return response()->json(['error' => 'Message not found'], 404);
        }

        $message->body = $request->input('body');
        $message->save();

        return response()->json(['message' => 'Message updated successfully', 'essage' => $message], 200);
    }

    //----------------------------------------------------------------------------------------------------------------

    public function deleteMessage($id)
    {
        HelperFunctions::deleteItem(message::class, $id);

        return response()->json(['message' => 'Message deleted succesfully']);
    }
}
