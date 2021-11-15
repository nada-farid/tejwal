<?php

namespace App\Http\Controllers\Api\Tourist;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use Auth;
use App\Traits\api_return;
use Validator;

class BookingController extends Controller
{
    //
    use api_return;

    public function BookTrip(Request $request){

            $rules = [
                'start_date' => 'required|date_format:d/m/Y',
                'end_date' => 'required|date_format:d/m/Y',
                'companions' => 'required|integer',
                'trip_id' => 'required|integer',
            ];
    
            $validator = Validator::make($request->all(), $rules);
    
            if ($validator->fails()) {
                return $this->returnError('401', $validator->errors());
            }
            //check if any trip reseved within that date
        $all_Booking=Booking::all();
        foreach($all_Booking as $booking ){
            if(($request->start_date >= $booking->start_date) && ($request->start_date <= $booking->end_date)){

            return $this->returnError(205,'Sorry there is a Trip is reseved from '.$booking->start_date .' to '.$booking->end_date .' please choose another date');
            
            }
        }
        $booking= new Booking();
        $booking->start_date=$request->start_date;
        $booking->end_date=$request->end_date;
        $booking->companions=$request->companions; 
        $booking->user_id=Auth::id();
        $booking->trip_id=$request->trip_id;
        $booking->save();
        
        return $this->returnSuccessMessage('Booking saved Successfully');
        }
    }