@include('header', ['title' => 'items edit'])

<nav>
  <a href="{{ route('home') }}" class="btn btn-outline-primary">商品一覧へ戻る</a>
</nav>


<form action="{{ route('items_edit', $item->id) }}" method="POST">
  @csrf
  <div class="mb-3">
    <label class="form-label">商品名</label>
    <input type="text" class="form-control" name="name" value="{{ $item->name }}">
  </div>
  <div class="mb-3">
    <label class="form-label">税込価格</label>
    <input type="number" class="form-control" name="price"  value="{{ $item->price }}">
  </div>
  <button type="submit" class="btn btn-primary">送信</button>
  @isset($message)
    <span class="mx-3">{{ $message }}</span>
  @endisset
</form>

@include('footer')