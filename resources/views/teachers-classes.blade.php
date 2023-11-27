
<div>
  @foreach($classes as $class)
        <div class="w-full class-card bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700"> 
         <ul>
        <li>ID: {{ $class->id}} </li>
        <li>Name: {{ $class->name}} </li>
        <li>subject: {{ $class->subject}} </li>
        <span class="hidden sm:block">
          <button class="inline-flex items-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
            <a href="/class-overview/{{$class->id}}">View</a>
          </button>
        </span>
        </ul>
        </div>
        @endforeach
</div>
