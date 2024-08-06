@extends('layout.add')

@section('content')
<div class="uk-container uk-margin-top">
    <h1 class="uk-heading-line"><span>Edit User</span></h1>
    <form action="{{ route('users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="uk-margin">
            <label class="uk-form-label" for="name">Name</label>
            <div class="uk-form-controls">
                <input class="uk-input" type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required>
            </div>
        </div>

        <div class="uk-margin">
            <label class="uk-form-label" for="email">Email</label>
            <div class="uk-form-controls">
                <input class="uk-input" type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required>
            </div>
        </div>

        <div class="uk-margin">
            <label class="uk-form-label" for="role">Role</label>
            <div class="uk-form-controls">
                <select class="uk-select" id="role" name="role">
                    <option value="" {{ is_null($user->role) ? 'selected' : '' }}>User</option>
                    <option value="1" {{ $user->role === '1' ? 'selected' : '' }}>Admin</option>
                </select>
            </div>
        </div>

        <button type="submit" class="uk-button uk-button-primary">Update User</button>
    </form>
    <a href="{{ route('users.index') }}" class="uk-button uk-button-default uk-margin-top">Back to Users</a>
</div>
@endsection
