@extends('layout.add')

@section('content')
<div class="uk-container uk-container-small uk-margin-top">
    <h2 class="uk-heading-line"><span>Add Category</span></h2>
    <form action="{{ route('categories.store') }}" method="POST">
        @csrf
        <div class="uk-margin">
            <label for="name" class="uk-form-label">Category Name</label>
            <input type="text" class="uk-input" id="name" name="name" required>
        </div>
        <div class="uk-margin">
            <label for="status" class="uk-form-label">Status</label>
            <select class="uk-select" id="status" name="status" required>
                <option value="1">Active</option>
                <option value="0">Inactive</option>
            </select>
        </div>
        <button type="submit" class="uk-button uk-button-primary">Save</button>
    </form>
</div>
@endsection
