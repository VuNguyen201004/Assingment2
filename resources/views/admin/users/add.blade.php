@extends('layout.add')

@section('content')
<div class="uk-container uk-margin-top">
    <h1 class="uk-heading-line"><span>Add New User</span></h1>
    <form action="{{ route('users.store') }}" method="POST">
        @csrf

        <div class="uk-margin">
            <label class="uk-form-label" for="name">Name</label>
            <div class="uk-form-controls">
                <input class="uk-input" type="text" id="name" name="name" value="{{ old('name') }}" required>
            </div>
        </div>

        <div class="uk-margin">
            <label class="uk-form-label" for="email">Email</label>
            <div class="uk-form-controls">
                <input class="uk-input" type="email" id="email" name="email" value="{{ old('email') }}" required>
            </div>
        </div>

        <div class="uk-margin">
            <label class="uk-form-label" for="password">Password</label>
            <div class="uk-form-controls">
                <input class="uk-input" type="password" id="password" name="password" required>
            </div>
        </div>

        <div class="uk-margin">
            <label class="uk-form-label" for="password_confirmation">Confirm Password</label>
            <div class="uk-form-controls">
                <input class="uk-input" type="password" id="password_confirmation" name="password_confirmation" required>
            </div>
        </div>

        <div class="uk-margin">
            <label class="uk-form-label" for="role">Role</label>
            <div class="uk-form-controls">
                <select class="uk-select" id="role" name="role">
                    <option value="">User</option>
                    <option value="1">Admin</option>
                </select>
            </div>
        </div>

        <button type="submit" class="uk-button uk-button-primary">Add User</button>
    </form>
    <a href="{{ route('users.index') }}" class="uk-button uk-button-default uk-margin-top">Back to Users</a>
</div>
@endsection
