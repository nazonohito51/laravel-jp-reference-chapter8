@extends('layouts.default')
@section('content')
<form method="post" action="{{{ route('post.register') }}}">
    {!! csrf_field() !!}
    <div class="form-group @if($errors->first('name'))has-error @endif">
        <label class="control-label" for="name">名前</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="名前を入力してください" value="{{{ old('name') }}}">
    </div>
    <div class="form-group @if($errors->first('email'))has-error @endif">
        <label class="control-label" for="email">メールアドレス</label>
        <input type="email" class="form-control" id="email" name="email" placeholder="メールアドレスを入力してください" value="{{{ old('email') }}}">
    </div>
    <div class="form-group @if($errors->first('password'))has-error @endif">
        <label class="control-label" for="password">パスワード</label>
        <input type="password" class="form-control" name="password" id="password" placeholder="パスワードを入力してください">
    </div>
    <div class="form-group @if($errors->first('password_confirmation'))has-error @endif">
        <label for="password_confirmation">もう一度入力してください</label>
        <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="もう一度パスワードを入力してください">
    </div>
    <img src="{!! captcha() !!}"/>

    <div class="form-group @if($errors->first('captcha_code'))has-error @endif">
        <label class="control-label" for="captcha_code">画像認証 {{{ $errors->first('captcha_code') }}}</label>
        <input type="text" class="form-control" name="captcha_code" id="captcha_code"
               placeholder="画像に表示されている文字を入力してください"/>
    </div>
    <button type="submit" class="btn btn-success">アカウント作成</button>
</form>
@stop
