<?php

namespace App\Http\Controllers\Api\Tourist;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Trip;
use Auth;
use App\Traits\api_return;
use Validator;
use App\Traits\push_notification;
use App\Http\Resources\BookingResource;


class BookingController extends Controller
{
    //
    use api_return;
    use push_notification;


    public function BookedAppointments(){

     $booking=Booking::paginate(10);
     $new = BookingResource::collection($booking);
     return $this->returnPaginationData($new,$booking,"success"); 

    }

//------------------------------------------------------------
    public function store(Request $request){
        
            
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
            $trip=Trip::findOrfail($request->trip_id);

            if(!$trip){ 
                return $this->returnError('404',('this trip not found'));
            }
            else{
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
                
                $title = 'حجز جديد';
                $body = 'تم الحجز عن طريق ' . Auth::user()->name;
                $user_id = $trip->guide->user->id ?? null;
                if($user_id){
                    $this->send_notification( $title , $body , $title , $body  , $user_id);
                }
                
                return $this->returnSuccessMessage('Booking saved Successfully');
            }
    }
    //--------------------------------------------------

        public function update(Request $request, $booking_id){

            $rules = [
                'start_date' => 'required|date_format:d/m/Y',
                'end_date' => 'required|date_format:d/m/Y',
                'companions' => 'required|integer',
            ];
    
            $validator = Validator::make($request->all(), $rules);
    
            if ($validator->fails()) {
                return $this->returnError('401', $validator->errors());
            }

            $booking=BooKing::findOrfail($booking_id);

            if(!$booking)
      
            return $this->returnError('404',('this booking not found'));
            //check if selected date equal old date or new date to check avaliablity of that date
        if(!($booking->start_date==$request->start_date)&&($booking->end_date==$request->end_date)){

            //check if any trip reseved within that date
             $all_Booking=Booking::all();
             foreach($all_Booking as $booking ){
                 if(($request->start_date >= $booking->start_date) && ($request->start_date <= $booking->end_date)){
                      return $this->returnError(205,'Sorry there is a Trip is reseved from '.$booking->start_date .' to '.$booking->end_date .' please choose another date');
            
                     }
                         }
                           }
      $booking->update($request->all());
        
        return $this->returnSuccessMessage('Booking updated Successfully');
        }

    //---------------------------------------------------

    public function delete($booking_id){

      $booking=BooKing::findOrfail($booking_id);

      if(!$booking)

      return $this->returnError('404',('this booking not found'));

      $booking->delete();

      return $this->returnSuccessMessage('Booking deleted Successfully');

    }
    }