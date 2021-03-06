<?php

namespace App\Http\Controllers;

use App\Http\Resources\{QuestionResource,QuestionCategoryResource};
use App\Models\{Category,Question};
use Illuminate\Http\Request;

use function PHPUnit\Framework\isNull;

class QuestionController extends Controller
{
    public function categoryQuestion()
    {
        return response()->json(QuestionCategoryResource::collection(Category::all()), 200);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = $request->query('perPage');
        if($query) {
            return response()->json(QuestionResource::collection(Question::orderBy('title', 'ASC')->paginate($query)), 200);
        } else {
            return response()->json(QuestionResource::collection(Question::orderBy('title', 'ASC')->get()), 200);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $question = Question::find($id);
        return response()->json(new QuestionResource($question), 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Question $question)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
        //
    }
}
