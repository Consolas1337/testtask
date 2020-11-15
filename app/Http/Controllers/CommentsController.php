<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Illuminate\Support\Facades\DB;
use App\Models\Comments;
use Validator;

class CommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comments = Comments::all();
        return response()->json(['data' => $comments], 200);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $error_messages = [
            'name.*'        => 'Поле "Имя" является обязательным',
            'text.*'        => 'Поле "Текст" является обязательным',
        ];

        $validator = Validator::make($request->all(), [
            'name'          => 'required|string',
            'text'          => 'required|string',
        ], $error_messages);

        $errors = $validator->errors()->all();

        foreach ($errors as $field => $value) {
            return response()->json(['message' => $value], 500);
        }

        $name = $request->input("name");
        $text = $request->input("text");
        $parent = $request->input("parent_id");

        $parent = Comments::find($parent);

        if (!isset($parent)) {
            $parent = null;
        }

        Comments::create([
            'user' => $name,
            'text' => $text,
            'parent_id' => $parent["id"],
        ]);

        return response()->json(['message' => "Комментарий успешно создан!"], 200);
    }


    /**
     * Like the specified comment.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function like(Request $request)
    {
        $comment = Comments::findOrFail($request->input("id"));
        if ($comment->increment("likes")) {
            return response()->json(['message' => 'Лайк засчитан!'], 200);
        } else {
            return response()->json(['message' => 'Произошла ошибка'], 500);
        }
    }

    /**
     * Dislike the specified comment.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function dislike(Request $request)
    {
        $comment = Comments::findOrFail($request->input("id"));
        if ($comment->decrement("likes")) {
            return response()->json(['message' => 'Дислайк засчитан!'], 200);
        } else {
            return response()->json(['message' => 'Произошла ошибка'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $comment = Comments::findOrFail($id);
        if ($comment->delete()) {
            return response()->json(['message' => 'Удаление прошло успешно!'], 200);
        } else {
            return response()->json(['message' => 'При удалении произошла ошибка'], 500);
        }
    }
}
