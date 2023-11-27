<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @vite('resources/css/app.css')
</head>
<body>
  
    <header class="bg-white shadow">
      <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold tracking-tight text-gray-900">Class Overview</h1>
      </div>
    </header>
    <main>
        @foreach($students as $student)
<div class="mx-auto max-w-2xl bg-slate-50">
    <div class="p-4 lg:flex lg:items-center lg:justify-between rounded-l shadow-xl">
        <div class="min-w-0 flex-1">
          <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:truncate sm:text-3xl sm:tracking-tight">{{ $student->forename }} {{ $student->surname }}</h2>
          <div class="mt-1 flex flex-col sm:mt-0 sm:flex-row sm:flex-wrap sm:space-x-6">
            <div class="mt-2 flex items-center text-sm text-gray-500">
                MIS ID: {{ $student->mis_id }}
            </div>
          </div>
        </div>
        </div>
      </div>
  </div>
  @endforeach
    </main>
  </div>
  
</body>
</html>