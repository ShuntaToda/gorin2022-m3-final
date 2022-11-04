@include('header', ['title' => 'login'])

<form action="{{ route('login') }}" method="POST">
  @csrf
  <div class="mb-3">
    <label class="form-label">アカウント</label>
    <input type="text" class="form-control" name="acount">
  </div>
  <div class="mb-3">
    <label class="form-label">パスワード</label>
    <input type="password" class="form-control" name="password">
  </div>
  <button type="submit" class="btn btn-primary">送信</button>
</form>

@include('footer')