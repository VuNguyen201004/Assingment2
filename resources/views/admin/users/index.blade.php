@extends('layout.add')

@section('content')
    <div class="uk-container uk-margin-top">
        <h1 class="uk-heading-line"><span>Users</span></h1>
        <a href="{{ route('users.create') }}" class="uk-button uk-button-primary uk-margin-bottom">Create New User</a>

        <table class="uk-table uk-table-striped uk-table-hover">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @if($user->role === '1')
                                Admin
                            @elseif(is_null($user->role))
                                User
                            @else
                                {{ $user->role }}
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('users.show', $user->id) }}" class="uk-button uk-button-default uk-button-primary">View</a>
                            <a href="{{ route('users.edit', $user->id) }}" class="uk-button uk-button-warning uk-button-warning">Edit</a>
                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="uk-button uk-button-danger uk-button-small">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
