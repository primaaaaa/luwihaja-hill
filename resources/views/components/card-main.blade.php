@props(['title' => ''])

<div class="card shadow border-0 my-4">
    <div class="card-body">
        <h5>{{$title}}</h5>
        {{ $slot }}
    </div>
</div>