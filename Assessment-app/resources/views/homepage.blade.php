<!DOCTYPE html>
<html>
<head>
    <title>Homepage</title>
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireScripts
    @stack('scripts')
    @stack('styles')
</head>
<body>
    <div>
        @php
            use App\Helpers\PostHelper;
        @endphp

        <h1>Welcome to the homepage of, {{ auth()->user()->name }}!</h1>
        <h2>Recent Posts:</h2>
        <table>
            <thead>
                <tr>
                    <th>User Name</th>
                    <th>Title</th>
                    <th>Body</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts->sortByDesc('created_at') as $post)
                @php
                    $user = App\Models\User::find($post->user_id);
                @endphp
                <tr>
                    <td>{{ PostHelper::getUserName($post->user_id) }}</td>
                    <td>{{ $post->title }}</td>
                    <td>{{ Str::limit($post->body, 100) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        @livewire('create-post')

        @if ($errors->any())
    <div class="error">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if (session()->has('message'))
    <div class="success">
        {{ session('message') }}
    </div>
@endif
    </div>
</body>
</html>
