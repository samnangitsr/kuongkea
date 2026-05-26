<!doctype html>
<html>
<head><meta charset="utf-8"><title>Captures</title></head>
<body>
<h2>Recent Captures</h2>
<ul>
@foreach ($caps as $c)
  <li>
    <img src="{{ asset('storage/'.$c->photo) }}" width="160">
    <div>Customer #{{ $c->customer_exchange_id ?? '—' }} | {{ $c->created_at }}</div>
  </li>
@endforeach
</ul>
</body>
</html>
