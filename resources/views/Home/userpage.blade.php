<!DOCTYPE html>
<html>
   <head>
      <!-- Basic -->
     <!-- Basic -->
     <meta charset="utf-8" />
     <meta http-equiv="X-UA-Compatible" content="IE=edge" />
     <!-- Mobile Metas -->
     <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
     <!-- Site Metas -->
     <meta name="keywords" content="" />
     <meta name="description" content="" />
     <meta name="author" content="" />
     <link rel="shortcut icon" href="{{asset('home/images/favicon.png')}}" type="">
     <title>Famms - Fashion HTML Template</title>
     <!-- bootstrap core css -->
     <link rel="stylesheet" type="text/css" href="{{asset('home/css/bootstrap.css')}}" />
     <!-- font awesome style -->
     <link href="{{asset('home/css/font-awesome.min.css')}}" rel="stylesheet" />
     <!-- Custom styles for this template -->
     <link href="{{asset('home/css/style.css')}}" rel="stylesheet" />
     <!-- responsive style -->
     <link href="{{asset('home/css/responsive.css')}}" rel="stylesheet" />
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
   </head>
   <body>
      @include('sweetalert::alert')
      <div class="hero_area">
         <!-- header section strats -->
         @include('Home.Header')
         <!-- end header section -->
         <!-- slider section -->
         @include('Home.Slider')
         <!-- end slider section -->
      </div>
      <!-- why section -->
      @include('Home.Why')
      <!-- end why section -->
      
      <!-- arrival section -->
      @include('Home.Arrival')
      <!-- end arrival section -->
      
      <!-- product section -->  
     @include('Home.Product')
      <!-- end product section -->
   <!--Comment and Reply system start from here -->
    <div style="text-align: center;padding-bottom:30px">
      <h1 style="font-size:30px;text-align:center;padding-top:20px;padding-bottom:20px">Comments </h1>
 
   <form action="{{url('add_comment')}}" method="POST">
      @csrf
       <textarea style="height: 150px; width:600px;" placeholder="Comment something here" name="comment">
       </textarea>
       <br>
       <input type="submit" class="btn btn-primary" value="comment" name="">
      </form>  
   </div>
   <div style="padding-left:20%">
      <h1 style="font-size: 20px;">All Comments</h1>
      @foreach ($comment as $comment)
          
    
      <div>
         <b>{{$comment->name}}</b>
         <p>{{$comment->comment}}</p>
         <a href="javascript::void(0);" onclick="reply(this)" data-commentId="{{$comment->id}}">Reply</a>
         @foreach($reply as $rep)
         @if ($rep->comment_id == $comment->id)
             
         
         <div style="padding-left: 3%;padding-bottom:10px;">
            <b>{{$rep->name}}</b>
            <p>{{$rep->reply}}</p>
            <a href="javascript::void(0);" onclick="reply(this)" data-commentId="{{$comment->id}}">Reply</a>
         </div>
         @endif
         @endforeach
      </div>
      @endforeach
       <!--reply system here-->
       
      <div style="display: none" class="replyDiv">
         <form action="{{url('add_reply')}}" method="POST">
            @csrf
         <input id="commentId" type="text"  name="commentId"  hidden="">
      <textarea placeholder="write something here" name="reply" style="width: 200px"></textarea>
      <br>
      {{-- <input type="submit" class="btn btn-primary" value="reply" name=""> --}}
       <button type="submit" class="btn btn-warning">reply</button>  
  
      <a href="javascript::void(0);" class="btn" onclick="reply_close(this)" >Close</a>
   </form>
      </div>
   
      <!--reply system end here-->
   </div>

   <!--Comment and Reply system end here -->
      <!-- subscribe section -->
    @include('Home.Subscriber')
      <!-- end subscribe section -->
      <!-- client section -->
     @include('Home.Client')
      <!-- end client section -->
      <!-- footer start -->
      @include('Home.Footer')
      <!-- footer end -->
      <div class="cpy_">
         <p class="mx-auto">© 2021 All Rights Reserved By <a href="https://html.design/">Free Html Templates</a><br>
         
            Distributed By <a href="https://themewagon.com/" target="_blank">ThemeWagon</a>
         
         </p>
      </div>
      <script type="text/javascript">
            function reply(caller)
            {
               document.getElementById("commentId").value =$(caller).attr('data-commentId');
               $('.replyDiv').insertAfter($(caller));
               $('.replyDiv').show();
            }
            function reply_close(caller)
            {
               $('.replyDiv').hide();
               
            }
      </script>
      <script>
         document.addEventListener("DOMContentLoaded", function(event) { 
             var scrollpos = localStorage.getItem('scrollpos');
             if (scrollpos) window.scrollTo(0, scrollpos);
         });
 
         window.onbeforeunload = function(e) {
             localStorage.setItem('scrollpos', window.scrollY);
         };
     </script>
      <!-- jQery -->
      <script src="home/js/jquery-3.4.1.min.js"></script>
      <!-- popper js -->
      <script src="home/js/popper.min.js"></script>
      <!-- bootstrap js -->
      <script src="home/js/bootstrap.js"></script>
      <!-- custom js -->
      <script src="home/js/custom.js"></script>
   </body>
</html>