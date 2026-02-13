<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Campus MoU Organization')</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <style>
        :root {
            --primary-blue: #004878;
            --primary-yellow: #f2b11a;
        }
    </style>
</head>

<body class="bg-gray-50 min-h-screen flex flex-col">
    @php
        if (!isset($menus)) {
            $menus = \Modules\Ppid\Entities\Menu::getHierarchical();
        }
    @endphp
    @include('ppid::landing-page.components.navbar')

    <main class="flex-1">
        @yield('content')
    </main>

    @include('ppid::landing-page.components.footer')
</body>

</html>
