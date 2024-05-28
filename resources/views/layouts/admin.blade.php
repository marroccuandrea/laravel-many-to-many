<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- fontawesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Admin Boolpress</title>
</head>

<body>
    @include('admin.partials.header')
    <div class="main-wrapper d-flex">
        <aside class="bg-dark navbar-dark text-white">
            <nav>
                <ul>
                    <li>
                        <a href="{{ route('admin.tecnologies.index') }}"><i class="fa-solid fa-microchip px-1"></i>
                            Tecnology</a>
                    </li>
                    <li>
                        <a href="{{ route('admin.types.index') }}"><i class="fa-solid fa-font-awesome px-1"></i>
                            Type</a>
                    </li>
                    <li>
                        <a href="{{ route('admin.projects.index') }}"><i class="fa-solid fa-diagram-project px-1 "></i>
                            Projects</a>
                    </li>
                    <li>
                        <a href="{{ route('admin.projects.create') }}"><i class="fa-solid fa-diagram-project px-1 "></i>
                            New Project</a>
                    </li>
                </ul>
            </nav>
        </aside>
        <div class="content p-5">
            @yield('content')
        </div>
    </div>
</body>

</html>
