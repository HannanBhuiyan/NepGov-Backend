<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\PollingReview;
use App\Models\QuestionOption;
use App\Models\PollingCategory;
use App\Models\PollingQuestion;
use App\Models\PollingSubCategory;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Country;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Collection;

class PollingCategoryApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $polling_category = PollingCategory::all();
        return response()->json($polling_category);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = array(
            'category_name' => 'required',
            'slug' => 'required'
        );
        $valiodator = Validator::make($request->all(), $rules);
        if($valiodator->fails()){
            return response()->json($valiodator->errors(),401);
        }else{
            $cat = new PollingCategory();
            $cat->category_name = $request->category_name;
            $cat->slug = $request->slug;
            $cat->status = $request->status;
            $cat->user_id = Auth::id();
            $cat->need_registration = $request->need_registration == 'on' ? 1 : 0;
            if($request->country == null){
                $cat->country = 'global';
            }else{
                $cat->country = json_encode($request->country);
            }
            $cat->save();
            return response()->json(['status'=>200, 'success'=>'Category Create Success']);

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function topic_wise_questions($slug)
    {
        $topic = PollingSubCategory::where('slug', $slug)->first();
        $topic_name = $topic->name;
        $ques = PollingQuestion::where('sub_category_id',$topic->id)->with("poll_options")->get();
        return response()->json(['sub_cat_name' => $topic_name, 'ques'=>$ques]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function home_live_topic()
    {
        $homeLiveTopic = PollingSubCategory::where('home_page_live', 1)->first();

        return response()->json($homeLiveTopic);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
    }

    public function all_topics()
    {

        // polling category auto update
        $curr_time = Carbon::now()->format('H:i');
        $today_Date =  Carbon::now()->format('m/d/Y');
     
     
        $polling_sub_categories = PollingSubCategory::where('need_specifi_time', 1)->get();

        $polling_sub_categories->map(function($item) use ($today_Date,$curr_time){
            
            if($item->start_date <=  $today_Date && $item->end_date >= $today_Date){
                if($item->start_date == $today_Date){
                    if($item->start_time <= $curr_time){
                        $item->is_published = 'publish';
                        $item->save();
                    }
                }elseif($item->end_date ==  $today_Date){
                    if($item->end_time >= $curr_time){
                        $item->is_published = 'pause';
                        $item->save();
                    }
                }
            }
            elseif($item->start_date >  $today_Date) {
                $item->is_published = 'pause';
                $item->save();
            }
            elseif($item->end_date <  $today_Date){
                $item->is_published = 'pause';
                $item->save();
            }
        });

      
 

        // 
        $all_topics = PollingSubCategory::where('is_published' , 'publish')->get();

        // return $all_topics;
 
        $c =$all_topics->map(function($item) use ($today_Date, $curr_time){
                if($item->need_specifi_time == 1){
                    if($today_Date >= $item->start_date  && $today_Date <= $item->end_date){
                        if($item->start_date == $today_Date){
                            if($item->start_time <= $curr_time){
                                return $item;
                            }
                        }elseif($item->end_date ==  $today_Date){
                            if($item->end_time >= $curr_time){
                                return $item;
                            }
                        }
                    }
                }else{
                    return $item;
                }
            });

        // return response()->json(['data'=>$c]);
        return response()->json(['data'=>$all_topics]);


    }


    function all_countries(){
        $countries = Country::all();

        return response()->json($countries);
    }
}
