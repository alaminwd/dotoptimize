<?php

namespace App\Http\Controllers;

use App\Models\CallInformation;
use App\Models\Contact;
use App\Models\ContactContent;
use App\Models\OfficeAddress;
use App\Models\Quote;
use App\Models\Subscribe;
use App\Models\UserMessage;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Image;

class ContactController extends Controller
{
    //quote store
    function quote_store(Request $request){
        if($request->name==''||$request->email==''||$request->desp==''){
          return redirect(url()->previous().'#freequote')->with('error', "Name Field is required!<br>Email Field is required!<br>Message Field is required!");
        }
        else{
            Quote::insert([
              'name'=>$request->name,
              'email'=>$request->email,
              'desp'=>$request->desp,
              'created_at'=>Carbon::now(),
            ]);
            return redirect(url()->previous().'#freequote')->with('success', 'Yur Message has been sent!');
        }
    }

    // Quote list
    function quote_list(){
      $quotes = Quote::latest()->paginate(30);
      return view('admin.notification.quote_list', [
        'quotes'=>$quotes,
      ]);
    }

    // Quote delete
    function Quote_delete($quote_id){
      Quote::find($quote_id)->delete();
      return back();
    }

    // Quote view
    function Quote_view($quote_id){
      Quote::find($quote_id)->update([
        'status'=>1,
      ]);

      $quotes_info = Quote::find($quote_id);
      return view('admin.notification.quote_view', [
        'quotes_info'=>$quotes_info,
      ]);
    }

    // ================= message store

    // message
    function message_store(Request $request){

      if($request->user_name==''||$request->user_email==''||$request->user_phone==''||$request->user_desp==''){
        return redirect(url()->previous().'#request_call')->with('message_error', 'Name field is required!<br> Email field is required!<br>Number field is required!<br>Message field is required!<br>');
      }

      else{
        UserMessage::insert([
          'user_name'=>$request->user_name,
          'user_email'=>$request->user_email,
          'user_phone'=>$request->user_phone,
          'user_desp'=>$request->user_desp,
          'created_at'=>Carbon::now(),
        ]);
        return redirect(url()->previous().'#request_call')->with('messagesuccess', 'Yur Message has been sent!');
      }

    }

    // Message list
    function message_list(){
      $messages = UserMessage::latest()->paginate(30);
      return view('admin.notification.message_list', [
        'messages'=>$messages,
      ]);
    }

    // message delete
     function message_delete($message_id){
      UserMessage::find($message_id)->delete();
      return back();
    }

     // message view
     function message_view($message_id){
      UserMessage::find($message_id)->update([
        'status'=>1,
      ]);

      $message_info = UserMessage::find($message_id);
      return view('admin.notification.message_view', [
        'message_info'=>$message_info,
      ]);
    }

    // ================ contact
    // contact message
    function contact_store(Request $request){
     
      if($request->name==''||$request->email==''||$request->number==''||$request->subject==''||$request->desp==''){
        return redirect(url()->previous().'#contact-section')->with('contact_error', 'Name field is required!<br> Email field is required!<br>Number field is required!<br>Subject field is required!<br>Message field is required!<br>');
      }

     else{
      Contact::insert([
        'name'=>$request->name,
        'email'=>$request->email,
        'number'=>$request->number,
        'subject'=>$request->subject,
        'desp'=>$request->desp,
        'created_at'=>Carbon::now(),
      ]);
      return redirect(url()->previous().'#contact-section')->with('success', 'Yur Message has been sent!');
     }

    }

    // Contact list
    function contact_list(){
      $messages = Contact::latest()->paginate(30);
      return view('admin.notification.contact_list', [
        'messages'=>$messages,
      ]);
    }

    // Contact delete
    function contact_delete($message_id){
      Contact::find($message_id)->delete();
      return back();
    }

    // message view
    function contact_view($message_id){
      Contact::find($message_id)->update([
        'status'=>1,
      ]);

      $message_info = Contact::find($message_id);
      return view('admin.notification.contact_view', [
        'message_info'=>$message_info,
      ]);
    }

    // subscription
    function subscribe(Request $request){
      if($request->sub_email==''){
        return redirect(url()->previous().'#footer_part')->with('sub_email', 'Email field is required');
      }

      else{
       Subscribe::insert([
        'email'=>$request->sub_email,
        'created_at'=>Carbon::now(),
       ]);
       return redirect(url()->previous().'#footer_part')->with('sub_success', 'Subscription successful!');
      }
    }

    // banner subscription
    function subscribe_banner(Request $request){
      if($request->email==''){
        return redirect(url()->previous().'#banner_part')->with('sub_email', 'Email field is required');
      }

      else{
       Subscribe::insert([
        'email'=>$request->email,
        'created_at'=>Carbon::now(),
       ]);
       return redirect(url()->previous().'#banner_part')->with('sub_success', 'Subscription successful!');
      }
    }

    // Subscription List
    function subscribe_list(){
      $subscribes = Subscribe::all();
      return view('admin.notification.subscribe_list', [
        'subscribes'=>$subscribes,
      ]);
    }

    // subscribe delete
    function subscribe_delete($subscribe_id){
      Subscribe::find($subscribe_id)->delete();
      return back();
    }



    // ===contact content =====//
    function contact_content(){
      $office_info = OfficeAddress::all();
      $contents = ContactContent::all();
        return view('admin.contact.contact',[
          'contents'=>$contents,
          'office_info'=>$office_info,
        ]);
    }


    function update_content(Request $request){
      $request->validate([
        'sub_title'=>'required',
        'title'=>'required',
        'desp'=>'required',
      ]);

      ContactContent::find($request->id)->update([
        'sub_title'=>$request->sub_title,
        'title'=>$request->title,
        'desp'=>$request->desp,
      ]);

      return back();
    }


    
    //  add Office Address info 

    function add_address(Request $request){

      $request->validate([
        'title'=>'required',
        'sub_title'=>'required',
        'location'=>'required',
        'phone'=>'required',
        'email'=>'required',
        'image'=>['image', 'mimes:jpeg,png,jpg,gif,svg',],
    ]);


      $image = $request->image;
      $extension = $image->getClientOriginalExtension();
      $file_name = substr($request->sub_title, 0,10).'.'.$extension; 
      Image::make($image)->save(public_path('upload/office_address/').$file_name);


     
        
        OfficeAddress::insert([
          'title'=>$request->title,
          'sub_title'=>$request->sub_title,
          'location'=>$request->location,
          'phone'=>$request->phone,
          'email'=>$request->email,
          'image'=>$file_name,
        ]);

        return back();


    }


    function delete_address($address_id){

      $present_img =OfficeAddress::find($address_id);
      unlink(public_path('upload/office_address/'.$present_img->image));


      OfficeAddress::find($address_id)->delete();

      return back();
    }



    function call_information(){
      $infos = CallInformation::all();
      return view('admin.notification.call_information',[
        'infos'=>$infos,
      ]);
    }


    function update_call_info(Request $request){
        $request->validate([
          'sub_title'=>'required',
          'title'=>'required',
        ]);


        CallInformation::find($request->id)->update([
          'sub_title'=>$request->sub_title,
          'title'=>$request->title,
        ]);

        return back();
    }
}
