@props(['tagsCsv'])

@php
  $tags = explode(',', $tagsCsv);//split by coma
@endphp

<ul  class="flex">

  @foreach ($tags as $tag)

    <li
    {{ $attributes->merge(['class' => 'flex items-center justify-center bg-black text-white rounded-xl py-1 px-3 mr-2 text-xs']) }}
        {{-- class="" --}}
    >
        <a href="/?tag={{$tag}}">
          <span class="capitalize">{{$tag}}</span>
        </a>
    </li>
    
  @endforeach

</ul>