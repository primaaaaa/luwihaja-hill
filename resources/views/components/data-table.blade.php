@props(['headers' => [], 'rows' => []])

<table class="table table-hover">
  <thead>
    
    
    <tr>
      @foreach ($headers as $header)
      <th class="text-secondary fw-bold" scope="col">{{ $header }}</th>
      @endforeach

    </tr>
  </thead>
  <tbody>

    {{ $slot }}

  </tbody>
</table>