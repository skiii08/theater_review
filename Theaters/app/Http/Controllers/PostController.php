<?php

 namespace App\Http\Controllers;
 

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\TheaterReview;

class PostController extends Controller
    {
    
    public function index(Post $post)//インポートしたPostをインスタンス化して$postとして使用。
    {
    return $post->get();//$postの中身を戻り値にする。
    }
    /*
    public function theaterTop(TheaterReview $theater_review)
    {
       return $theater_review->get();
    }
    */
    
   public function theaterTop()
    {
       $theater_reviews = TheaterReview::with('theater')->get();
        return view('theaterTop', compact('theater_reviews'));
    }
    /*
    public function index(Theater_review $theater_review)
    {
        
        return $theater_review->get();
    
    //return view('theaterTop.index')->with(['theater_reviews' => $theater_review->get()]); 
    
      
    }
    */
    
    }

