@extends('layout.user')

@section('content')

<div class="container">

    <table>
        @foreach ($files as $file)
            <tr>
                <td>{{ $file->client_name }}</td>
                <td>{{ $file->extension }}</td>
            </tr>
        @endforeach
    </table>
</div>

{{ $files->links() }}

@endsection