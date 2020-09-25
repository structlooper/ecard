<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use DB;

class AdminController extends Controller
{
    //
    public function home(){
        return view('admin.index');
    }
    public function login_view(){
        return view('admin.login');
    }
    public function update_password_page(){
        return view('admin.update_password');
    }
    public function update_password(request $request){
        $validator = Validator::make($request->all(),

            [
                'current_password' => 'required' ,
                'new_password' => 'required|min:6',
                'confirm_password' => 'required|min:6'
            ]


        );
        if ($validator->fails()) {
            return back()->with('error',$validator->errors()->first());
        }
        $c_pass = $request->current_password;
        $n_pass = $request->new_password;
        $con_pass = $request->confirm_password;
        if ($n_pass === $con_pass){
          if (Hash::check($c_pass,Auth::user()->password)){
              $bool = DB::table('users')
                  ->where('id',Auth::user()->id)
                  ->update(['password' => Hash::make($n_pass),'updated_at' => Carbon::now()]);
              if ($bool){
                  return back()->with('flash_success','password updated successfully');
              }else{

                  return back()->with('error','Not updated try after some times');
              }
          }else{
              return back()->with('error','Current password is incorrect');
          }
        }else{
            return back()->with('error','New password and Confirm password not matched');
        }
    }
    public function user_list(){
        $user_list = DB::table('tbl_users')
            ->get()->toArray();
        return view('admin.user_list',compact('user_list'));
    }
    public function update_user_password(request $request){
        $validator = Validator::make($request->all(),

            [
                'new_password' => 'required|min:6',
                'user_id' => 'required|exists:tbl_users,user_id'
            ]
        );
        if ($validator->fails()) {
            return back()->with('error',$validator->errors()->first());
        }
        $update_password = DB::table('tbl_users')
            ->where('user_id',$request->user_id)
            ->update(['user_password' => $request->new_password,'updated_at' => Carbon::now()]);
        if ($update_password){
            return back()->with('flash_success','User Password update successfully');
        }else{
            return back()->with('error','Password not updated, try again later');
        }
    }

    /**
     * Card categories management
     * @strcutlooper
     * */
    public function card_categories(){
        $card_categories = DB::table('card_categories')
            ->get()->toArray();
        return view('admin.card_categories',compact('card_categories'));
    }
    public function card_add(request $request){
        if ($request->card_type !== null){
            $insert_Card = DB::table('card_categories')
                ->insert([
                    'card_type' => $request->card_type,
                    'card_description' => $request->card_desc,
                    'created_at' => Carbon::now()
                ]);
            if ($insert_Card) {
                return back()->with('flash_success','Card category saved successfully');

            } else {
                return back()->with('error','Not save, try again later');

            }
        }else{
            return back()->with('error','Please enter card type');
        }
    }
    /**
     * Function for ajax request of card details
     * @strcutlooper
     * */
    public function card_fetch(request $request){
        $card_id = $request->card_id;
        if ($card_id !== null) {
            $card_details = DB::table('card_categories')
                ->where('card_id',$card_id)
                ->first();
            return [
                'status' => true,
                'data' => $card_details,
            ];
        } else {
            return [
                'status' => false,
                'msg' => 'Card id error please refresh the page and try again',
            ];
        }
    }
    public function update_card(request $request){
        if ($request->card_type !== null || $request->card_id){
            $insert_Card = DB::table('card_categories')
                ->where('card_id',$request->card_id)
                ->update([
                    'card_type' => $request->card_type,
                    'card_description' => $request->card_desc,
                    'updated_at' => Carbon::now()
                ]);
            if ($insert_Card) {
                return back()->with('flash_success','Card category updated successfully');

            } else {
                return back()->with('error','Not save, try again later');

            }
        }else{
            return back()->with('error','Please enter card type');
        }
    }
    public function delete_card(request $request){
        if ($request->card_id !== null){
            $delete_Card = DB::table('card_categories')
                ->where('card_id',$request->card_id)
                ->delete();
            if ($delete_Card) {
                return back()->with('flash_success','Card category deleted successfully');

            } else {
                return back()->with('error','Not delete, try again later');

            }
        }else{
            return back()->with('error','Please select correct card category');
        }
    }


    /**
     * Function for the Card Management
     * @strcutlooper
     **/
    public function card_list(){
        $card_details = DB::table('card_managements')
            ->join('card_categories','card_managements.card_category_id','=','card_categories.card_id')
            ->get()->toArray();

        $card_type = DB::table('card_categories')->get()->toArray();
        return view('admin.card_list',compact('card_details','card_type'));
    }

    public function add_card_management(request $request){
        $validator = Validator::make($request->all(),

            [
                'card_type' => 'required|exists:card_categories,card_id',
                'card_price' => 'required|numeric|',
                'card_title' =>'required' ,
                'price_unit' => 'required|in:INR,USD',
                'card_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:4000',
            ]
        );
        if ($validator->fails()) {
            return back()->with('error',$validator->errors()->first());
        }

        $card_type = $request->card_type;
        $image1 = $request->card_image;
        $title = $request->card_title;
        if (is_null($image1)) {$card_image = null;} else {
            $extn =$image1->getClientOriginalExtension();
            $fileName = rand(10,100).rand(10,100) .'.'. str_replace(" ", "-", $extn);
            $image1->move('uploads/card/images/', $fileName);
            $card_image = url('/uploads/card/images/'.$fileName);

        }
        $insertCard = DB::table('card_managements')
            ->insert([
                'card_category_id' => $card_type,
                'card_management_title' => $title,
                'card_management_image' => $card_image,
                'card_management_price' => $request->card_price,
                'card_management_price_unit' => $request->price_unit,
                'created_at' => Carbon::now(),
            ]);
        if ($insertCard) {
            return back()->with('flash_success','Card saved successfully');
        } else {
            return back()->with('error','Whoops! Card not saved');
        }
    }
    /**
     * Ajax function to get card details
     * @strcutlooper
     * */
    public function card_management_fetch(request $request){
        $card_id = $request->card_id;
        if ($card_id !== null) {
            $card_details = DB::table('card_managements')
                ->join('card_categories','card_categories.card_id','=','card_managements.card_category_id')
                ->where('card_managements.card_management_id',$card_id)
                ->first();
            return [
                'status' => true,
                'data' => $card_details,
            ];
        } else {
            return [
                'status' => false,
                'msg' => 'Card id error please refresh the page and try again',
            ];
        }
    }
    public function update_card_management(request $request){
        $validator = Validator::make($request->all(),

            [
                'card_price' => 'required|numeric|',
                'card_title' =>'required' ,
                'price_unit' => 'required|in:INR,USD',
                'card_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:4000',
                'card_management_id' => 'required|exists:card_managements,card_management_id'
            ]
        );
        if ($validator->fails()) {
            return back()->with('error',$validator->errors()->first());
        }

        $card_type = $request->card_type;
        $image1 = $request->card_image;
        $title = $request->card_title;
        if (is_null($image1)) {$card_image = $request->old_img;} else {
            $extn =$image1->getClientOriginalExtension();
            $fileName = rand(10,100).rand(10,100) .'.'. str_replace(" ", "-", $extn);
            $image1->move('uploads/card/images/', $fileName);
            $card_image = url('/uploads/card/images/'.$fileName);

        }
        $insertCard = DB::table('card_managements')
            ->where('card_management_id',$request->card_management_id)
            ->update([
                'card_management_title' => $title,
                'card_management_image' => $card_image,
                'card_management_price' => $request->card_price,
                'card_management_price_unit' => $request->price_unit,
                'updated_at' => Carbon::now(),
            ]);
        if ($insertCard) {
            return back()->with('flash_success','Card updated successfully');
        } else {
            return back()->with('error','Whoops! Card not updated');
        }
    }
    public function delete_card_management(request $request){
        if ($request->card_id !== null){
            $delete_Card = DB::table('card_managements')
                ->where('card_management_id',$request->card_id)
                ->delete();
            if ($delete_Card) {
                return back()->with('flash_success','Card  deleted successfully');

            } else {
                return back()->with('error','Not delete, try again later');

            }
        }else{
            return back()->with('error','Please select correct card');
        }
    }

    /**
     * Order management functions
     * @strcutlooper
     * */
    public function order_management(){
        $orders = DB::table('orders')
            ->join('card_managements','card_managements.card_management_id','=','orders.card_id')
            ->join('tbl_users','tbl_users.user_id','=','orders.user_id')
            ->get();

        return view('admin.orders',compact('orders'));
    }
}
