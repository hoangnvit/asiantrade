<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\User;

class MessageController extends Controller
{
   public function index()
   {

      return view('user.message');
   }
   public function inbox()
   {
      try {
         $user = auth()->user();
         $message = Message::Where('receiver_id', $user->id)
            ->where('display_receiver', 1)->get();

         return $message;
      } catch (\Illuminate\Database\QueryException $ex) {
         return view('errors');
      }
   }

   public function unread()
   {
      try {
         $user = auth()->user();

         $num_unread = Message::Where('receiver_id', $user->id)->where('read_status', 0)->get()->count();
         return $num_unread;
      } catch (\Illuminate\Database\QueryException $ex) {
         return view('errors');
      }
   }

   public function outbox()
   {
      try {
         $user = auth()->user();
         $message = Message::Where('sender_id', $user->id)
            ->where('display_sender', 1)->get();
         return $message;
      } catch (\Illuminate\Database\QueryException $ex) {
         return view('errors');
      }
   }

   public function detail($message_id)
   {

      try {
         $message = Message::find($message_id);
         $sender = User::find($message->sender_id);
         $receiver = User::find($message->receiver_id);
         if ($receiver->id == auth()->user()->id && ($message->read_status == 0)) {

            $message['read_status'] = 1;
            $message->save();
         }

         return [$message, $sender->username, $receiver->username];
      } catch (\Illuminate\Database\QueryException $ex) {
         return view('errors');
      }
   }

   public function un_display($message_id)
   {
      try {
         $message = Message::find($message_id);
         $user = auth()->user();
         if ($message->sender_id == $user->id) {
            $message['display_sender'] = 0;
            $current_box = 1;
         } else {
            $message['display_receiver'] = 0;
            $current_box = 0;
         }

         $message->save();

         return $current_box;
      } catch (\Illuminate\Database\QueryException $ex) {
         return view('errors');
      }
   }

   public function list_users()
   {

      try {
         $user = User::all();
         return $user;
      } catch (\Illuminate\Database\QueryException $ex) {
         return view('errors');
      }
   }

   public function save_message(Request $request)
   {
      try {
         $receiver_id = $request->receiver_id;
         // return $receiver_id;
         $temp = [

            'sender_id' => auth()->user()->id,
            'receiver_id' => $request->receiver_id,
            'message' => $request->message,
            'title' => $request->title
         ];
         $message = Message::create($temp);

         return $message;
      } catch (\Illuminate\Database\QueryException $ex) {
         return view('errors');
      }
   }

   public function total_in_out()
   {
      try {
         $user_id = auth()->user()->id;
         $total_out = Message::where('sender_id', $user_id)->where('display_sender', 1)->get()->count();
         $total_in = Message::where('receiver_id', $user_id)->where('display_receiver', 1)->get()->count();
         return [$total_in, $total_out];
      } catch (\Illuminate\Database\QueryException $ex) {
         return view('errors');
      }
   }
}
