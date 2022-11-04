@include('header', ['title' => 'items'])

<nav>
  <a href="{{ route('logout') }}" class="btn btn-outline-danger">ログアウト</a>
  <a href="{{ route('items_create') }}" class="btn btn-outline-primary">商品新規登録</a>
  <a href="{{ route('coupons_list') }}" class="btn btn-outline-primary">クーポン一覧</a>
</nav>
<table class="table">
  <thead>
    <tr>
      <th scope="col">id</th>
      <th scope="col">名称</th>
      <th scope="col">税込価格</th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
    @foreach ($items as $item)
    <tr>
      <td>{{ $item->id }}</td>
      <td>{{ $item->name }}</td>
      <td>{{ $item->price }}</td>
      <td class="d-flex">
        <a href="{{ route('items_edit', $item->id) }}" class="mx-2 btn btn-outline-primary">編集</a>
        <form action="{{ route('items_delete', $item->id) }}" onsubmit="return check()">
          <button type="submit" class="btn btn-outline-danger">削除</button>
        </form>
      </td>
    </tr>
      
    @endforeach
  </tbody>
</table>

@include('footer')