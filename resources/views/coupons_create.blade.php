@include('header', ['title' => 'coupons create'])

<nav>
  <a href="{{ route('coupons_list') }}" class="btn btn-outline-primary">クーポン一覧へ戻る</a>
</nav>


<form action="{{ route('coupons_create') }}" method="POST">
  @csrf
  <div class="mb-3">
    <label class="form-label">クーポンコード</label>
    <input type="text" class="form-control" name="coupon_code">
  </div>
  <div class="mb-3">
    <label class="form-label">割引価格</label>
    <input type="number" class="form-control" name="discount_price">
  </div>
  <button type="submit" class="btn btn-primary">送信</button>
  
  @isset($message)
    <span class="mx-3">{{ $message }}</span>
  @endisset

</form>

@include('footer')