<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Portfolio;
//use function MongoDB\BSON\toJSON;


class PortfolioController extends Controller
{
    public function __construct()
    {
        App::setLocale('ru');
    }

    public function index() {
        $elements = Portfolio::all();
        return view('profile.portfolio', compact('elements'));
    }

    public function newElement(Request $request) {

        $validator = Validator::make($request->all(),[
            'image'=>'required|max:2048',
            'image.*'=>'mimes:jpg,jpeg,png'
        ]);

        if($validator->fails())
            return redirect()->back()->withErrors($validator->errors()->first());

        $images = [];

        $portfolio = new Portfolio();

        $portfolio->name = $request->name;
        $portfolio->description = $request->description;
        $portfolio->user_id = auth()->user()->id;
        $portfolio->save();

        foreach ($request->file('image') as $image) {
            $imageName = "/profiles/".auth()->user()->email."/portfolio/element".$portfolio->id.'/img_1_portfolio_'. Str::random().'.'.$image->getClientOriginalExtension();
//            $imageName = 'img_'.$portfolio->id.'_portfolio_'. Str::random().'.'.$image->getClientOriginalExtension();
//            $images->add($imageName);
            $images[] = $imageName;
            $image->move(public_path("/profiles/".auth()->user()->email."/portfolio/element".$portfolio->id), $imageName);
        }

        $portfolio->image = $images;
//        $portfolio->image = $images->toJson();
        $portfolio->save();
//            dd(json_encode($images));

        return redirect()->back()->with('success', 'Ваша работа в портфолио успешно добавлена!');

    }

    public function deleteElement($id) {
        $elem = Portfolio::find($id);

        $elem->delete();
        return redirect()->back()->with('success', Lang::get('messages.delete-portfolio'));
    }
}
