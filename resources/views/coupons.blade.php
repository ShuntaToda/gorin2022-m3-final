@include('header', ['title' => 'coupons'])

<nav>
  <a href="{{ route('home') }}" class="btn btn-outline-primary">ホームへ戻る</a>
  <a href="{{ route('coupons_create') }}" class="btn btn-outline-primary">クーポン新規登録</a>
</nav>
<table class="table">
  <thead>
    <tr>
      <th scope="col">id</th>
      <th scope="col">クーポンコード</th>
      <th scope="col">割引価格</th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
    @foreach ($coupons as $coupon)
    <tr>
      <td>{{ $coupon->id }}</td>
      <td>{{ $coupon->coupon_code }}</td>
      <td>{{ $coupon->discount_price }}</td>
      <td class="d-flex">
        <form action="{{ route('coupons_delete', $coupon->id) }}" onsubmit="return check()">
          <button type="submit" class="btn btn-outline-danger">削除</button>
        </form>
      </td>
    </tr>
      
    @endforeach
  </tbody>
</table>

@include('footer')