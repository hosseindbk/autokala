<?php

namespace App\Http\Controllers\api\v1;

use App\comment;
use App\commentrate;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class CommentController extends Controller
{
    public function comment(Request $request){

        $valiData = $request->validate([
            'commentable_id'    => 'required',
            'commentable_type'  => 'required',
            'parent_id'         => 'required',
            'comment'           => 'required|min:3',
            'name'              => 'required|min:3',
            'phone'             => 'required|min:9',
        ]);

        comment::create($valiData);

        $status     = true;
        $message    = 'success';
        $response   = 'اطلاعات با موفقیت ثبت شد';

        return Response::json(['ok' => $status, 'message' => $message, 'response' => $response]);
    }

    public function commentrate(Request $request){

        $commentData = $request->validate([
            'commentable_id'    => 'required',
            'commentable_type'  => 'required',
            'comment'           => 'required|min:3',
            'phone'             => 'required|min:9',
            'name'              => 'required|min:3',
            'quality'           => 'required|integer|between:0,5',
            'value'             => 'required|integer|between:0,5',
            'innovation'        => 'required|integer|between:0,5',
            'ability'           => 'required|integer|between:0,5',
            'design'            => 'required|integer|between:0,5',
            'comfort'           => 'required|integer|between:0,5',
        ]);

        commentrate::create($commentData);

        $status     = true;
        $message    = 'success';
        $response   = 'اطلاعات با موفقیت ثبت شد';

        return Response::json(['ok' => $status, 'message' => $message, 'response' => $response]);
    }

}
