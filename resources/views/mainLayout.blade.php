<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('page-title')</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <style>
        body {
            font-family: Calibri, Arial, sans-serif;
            font-size: 1.3rem;
        }

        .auth-labels {
            display: inline-block;
            width: 8em;
        }

        .auth-textbox {
            margin-bottom: .5em;
        }

        .user-info {
            font-size: 0.85rem;
            font-weight: bold;
        }

        .fs-6 {
            font-size: 1rem;
            /* Adjusted font size for consistency */
        }

        .text-end {
            text-align: end;
            /* Ensuring text alignment for right positioning */
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row mt-3"> <!-- Added top margin for spacing -->
            <div class="col text-end">
                <div class="fs-6">
                    @if(Auth::check())
                    {{ Auth::user()->userInfo->user_firstname }} {{ Auth::user()->userInfo->user_lastname }}
                    <span class="user-info">
                        @if(Auth::user()->hasRole('admin'))
                        : Admin User
                        @else
                        : User
                        @endif
                    </span>
                    @include('slugs.logout')
                    @endif
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col">
                @if(!Auth::check())
                @yield('auth-content')
                @else
                @yield('page-content')
                @endif
            </div>
        </div>
    </div>
</body>

</html>