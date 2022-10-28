{{-- By default holds the classes of tailwind --}}
{{-- If it recieve a prop call class then merge or adding this class to this attribute --}}
<div {{$attributes->merge(['class'=>'bg-gray-50 border border-gray-200 rounded p-6'])}} 
  >
  {{-- the same as @yield --}}
  {{$slot}}

</div>