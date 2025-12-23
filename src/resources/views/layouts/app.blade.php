<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title', 'Utility Tool')</title>

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="  crossorigin="anonymous"></script>
  <!-- Optional: FontAwesome (for icons) -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

  <style>
    body { background-color: #f8f9fa; }
    pre {
      background-color: #212529;
      color: #0f0;
      padding: 1rem;
      border-radius: 0.5rem;
      max-height: 400px;
      overflow-y: auto;
      font-size: 0.9rem;
    }
    footer {
      margin-top: 4rem;
      padding-top: 1rem;
      font-size: 0.85rem;
      color: #6c757d;
      border-top: 1px solid #dee2e6;
    }
  </style>

  @stack('styles')
</head>
<body class="py-4">

  <div class="container">
    <header class="mb-4">
      <h1 class="fw-bold">
        @yield('header_title', '🧩 Internal Tool')
      </h1>
      @hasSection('header_subtitle')
        <p class="text-muted">@yield('header_subtitle')</p>
      @endif
    </header>

    @yield('content')

    <footer class="text-center">
      <p class="mb-0">© {{ date('Y') }} — Internal Utilities Dashboard</p>
    </footer>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  @stack('scripts')
</body>
</html>
