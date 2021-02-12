@extends('layout')
@section('contents')
        <div class="d"> 
            <h2></h2>
        <b>{{ $newsdata -> title}}</b><br><br>
        {{ $newsdata -> text}}<br>
        </div>
        <h2>コメントを書く</h2>
        <form method="post" action="{{ route('comment' , $newsdata -> id) }}" >
        @csrf
            <div class="post"  >
                <dl>
                    <dt>名前：</dt>
                    <dd><input  name="view_name" type="text"></dd>
                    @if ($errors->has('view_name'))
                        <div class="text-danger"> 
                            <!-- 1番最初のバリデーションに引っかかったエラーを表示 -->
                            {{ $errors->first('view_name') }}
                        </div>
                    @endif                    
                    <dt>コメント：</dt>
                    <dd><input type="text" name="message" class="message"></dd>
                    <input type="hidden" name="newsnumber" value=<?php echo $newsdata["id"]?>>
                    <input type="submit" value="送信" name="submit" class="submit"> 
                    @if ($errors->has('message'))
                        <div class="text-danger"> 
                            <!-- 1番最初のバリデーションに引っかかったエラーを表示 -->
                            {{ $errors->first('message') }}
                        </div>
                    @endif                    
                </dl>
            </div>
        </form>
        <hr>
        <section>
<!--ここにメッセージを表示させる-->
        @if (session('err_msg'))
            <p class="error" >
                {{session('err_msg')}}
            </p>
        @endif
            <?php  if (empty($comments )){
                echo "コメントはありません";
            } ?>
        @foreach($comments as $comment)
             <div class="comment" >
                <article>
                    <h2 color="white">{{  $comment -> view_name  }}</h2>
                    <p>{{  $comment -> message  }}</p>
                    <form method="GET" action="{{route('deletecomment')}}" onSubmit="return checkDelete()">
                        <input type="hidden" name="id" value=<?php echo  $comment["id"] ?> >
                        <input type="hidden" name="newsnumber" value=<?php echo  $comment["newsnumber"] ?> >
                        <button type="submit" value="削除"　id="">削除</button>
                    </form>

                </article>
            </div>
        @endforeach 
        </section>  
        <script>
            function checkDelete(){
            if (window.confirm('削除して良いですか')){
                return true;
            }else{
                return false
            }
            }
        </script>
@endsection