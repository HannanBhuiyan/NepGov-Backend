<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;
use App\Models\PollingCategory;
use App\Models\PollingQuestion;
use App\Models\PollingSubCategory;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Facades\Auth;

class PollingSubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function polling_topic_create()
    {
        // return 'ok';
        return view('layouts.backend.polling_sub_cat.polling_sub_cat-create',[
            'polling_category' => PollingCategory::all(),
            'countries' => Country::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'category_id' => 'required',
            'name' => 'required',
            'slug' => 'required'
        ]);

        $cat = new PollingSubCategory();
             
        $cat->category_id = $request->category_id;
        $cat->name = $request->name;
        $cat->slug = $request->slug;
        $cat->status = 'live';
        $cat->need_registration = $request->need_registration == 'on' ? 1 : 0;
        $cat->need_specifi_time = $request->need_specifi_time == 'on' ? 1 : 0;


        if($request->need_specifi_time == 'on'){
            $request->validate([
                'start_date' => 'required|date',
                'end_date' => 'required|date',
                'start_time' => 'required',
                'end_time' => 'required'
            ]);

            $current_time = date("h:i");
            $today_Date =  Carbon::now()->format('m/d/Y');
            $start_date = Carbon::createFromFormat('Y-m-d', $request->start_date)->format('m/d/Y');
            $end_date = Carbon::createFromFormat('Y-m-d', $request->end_date)->format('m/d/Y');

            
            if(($start_date > $end_date)){
                return back()->with('fail', 'End Date must be Greater than Start Date');
            }elseif($start_date == $today_Date){
                if($request->start_time <= $current_time){
                    return back()->with('fail', 'Start time cant be before current time.');
                }else{
                    if($start_date == $end_date){
                       if($request->start_time > $request->end_time){
                            return back()->with('fail', 'End Time must be Greater than Start Time');
                       }else{
                        $cat->start_date = $start_date;
                        $cat->end_date = $end_date;
                        $cat->start_time = $request->start_time;
                        $cat->end_time = $request->end_time;
                        $cat->is_published = $request->is_published ?? 'publish';
                       }
                    }else{
                        $cat->start_date = $start_date;
                        $cat->end_date = $end_date;
                        $cat->start_time = $request->start_time;
                        $cat->end_time = $request->end_time;
                        $cat->is_published = $request->is_published ?? 'publish';
                    }

                }
            }else if($start_date == $end_date){
                if($request->start_time >= $request->end_time){
                    return back()->with('fail', 'End Time must be Greater than Start Time');
                }else{
                 $cat->start_date = $start_date;
                 $cat->end_date = $end_date;
                 $cat->start_time = $request->start_time;
                 $cat->end_time = $request->end_time;
                 $cat->is_published = $request->is_published ?? 'publish';
                }
             }else{
                 $cat->start_date = $start_date;
                 $cat->end_date = $end_date;
                 $cat->start_time = $request->start_time;
                 $cat->end_time = $request->end_time;
                 $cat->is_published = $request->is_published ?? 'publish';
             }   

        }else{
            $cat->is_published = $request->is_published ?? 'publish';
        }
 
        
        if($request->country == null){
            $cat->country = 'global';
        }else{
            $cat->country = json_encode($request->country);
        }
        $cat->save();
        // return back();
        return redirect()->route('polling_category.index')->with('success', 'Sub Category create success');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PollingSubCategory  $pollingSubCategory
     * @return \Illuminate\Http\Response
     */
    public function show(PollingSubCategory $pollingSubCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PollingSubCategory  $pollingSubCategory
     * @return \Illuminate\Http\Response
     */
    public function polling_sub_category_edit($id)
    {
        // return $id;
        // return $single_sub_category =  PollingSubCategory::findOrFail($id);
        return view('layouts.backend.polling_sub_cat.polling_sub_cat-edit',[
            'item' => PollingSubCategory::findOrFail($id),
            'categories' => PollingCategory::all(),
            'countries' => Country::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PollingSubCategory  $pollingSubCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // return $request;
    
        $cat = PollingSubCategory::findOrFail($id);

        $request->validate([
            'name' => 'required'
        ]);

        $cat->name = $request->name;
        $cat->status = 'live';
        $cat->need_specifi_time = $request->need_specifi_time == 'on' ? 1 : 0;    
        
        if($request->home_page_live == 'on'){
            
             $homeLive = PollingSubCategory::where('home_page_live', 1)->first();

            if($homeLive){
                if($homeLive->id == $id){
                    $homeLive->update([
                        'home_page_live' => 1,
                        'need_registration' => 0,
                        'country' => 'global',
                        'is_published' => 'publish',
                    ]);
                }else{
                    $homeLive->update([
                        'home_page_live' => 0,
                        'need_registration' => 0,
                        'country' => 'global',
                        'is_published' => 'publish',
                    ]);
                }
                
                $cat->home_page_live = 1;
                
            }else{
                $cat->home_page_live = 1;
            }
            
        }else{
            $cat->need_registration = $request->need_registration == 'on' ? 1 : 0;
            if(!$request->country){
                $cat->country = 'global';
            }else{
                $cat->country = json_encode($request->country);
            }
        }
        

        if($request->need_specifi_time == 'on'){
            $request->validate([
                'start_date' => 'required|date',
                'end_date' => 'required|date',
                'start_time' => 'required',
                'end_time' => 'required'
            ]);

            $current_time = date("h:i");
            $today_Date =  Carbon::now()->format('m/d/Y');
            $start_date = Carbon::createFromFormat('Y-m-d', $request->start_date)->format('m/d/Y');
            $end_date = Carbon::createFromFormat('Y-m-d', $request->end_date)->format('m/d/Y');

          
            
            if(($start_date > $end_date)){
                return back()->with('fail', 'End Date must be Greater than Start Date');
            }elseif($start_date == $today_Date){
                if($request->start_time <= $current_time){
                    return back()->with('fail', 'Start time cant be before current time.');
                }else{
                    if($start_date == $end_date){
                       if($request->start_time > $request->end_time){
                            return back()->with('fail', 'End Time must be Greater than Start Time');
                       }else{
                        $cat->start_date = $start_date;
                        $cat->end_date = $end_date;
                        $cat->start_time = $request->start_time;
                        $cat->end_time = $request->end_time;
                        $cat->is_published = $request->is_published ?? 'publish';
                       }
                    }else{
                        $cat->start_date = $start_date;
                        $cat->end_date = $end_date;
                        $cat->start_time = $request->start_time;
                        $cat->end_time = $request->end_time;
                        $cat->is_published = $request->is_published ?? 'publish';
                    }

                }
            }else if($start_date == $end_date){
                if($request->start_time > $request->end_time){
                     return back()->with('fail', 'End Time must be Greater than Start Time');
                }else{
                 $cat->start_date = $start_date;
                 $cat->end_date = $end_date;
                 $cat->start_time = $request->start_time;
                 $cat->end_time = $request->end_time;
                 $cat->is_published = $request->is_published ?? 'publish';
                }
             }else{
                 $cat->start_date = $start_date;
                 $cat->end_date = $end_date;
                 $cat->start_time = $request->start_time;
                 $cat->end_time = $request->end_time;
                 $cat->is_published = $request->is_published ?? 'publish';
             }   

        }else{
            $cat->is_published = $request->is_published ?? 'publish';
        }


        $cat->save();

        return redirect()->route('polling_category.index')->with('success', 'Topic Update success');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PollingSubCategory  $pollingSubCategory
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $count =  PollingQuestion::where('sub_category_id', $id)->count();
        if($count > 0){
            return back()->with('fail', 'questions r available in this category, please delete those first');
        }else{
            PollingSubCategory::findOrFail($id)->delete();
            return redirect()->route('polling_category.index')->with('success', 'Topic delete success');
        } 
    }
}
