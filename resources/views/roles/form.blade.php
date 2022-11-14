<div class="row g-2">
    <div class="mb-1 col-md-5">
        <label for="name">Role Name</label>
        <input type="text" name="name" value="{{ old('name', $role->name ?? '') }}" class="form-control" id="name" placeholder="e.g: Executive" required>
    </div>
    <div class="mb-1 col-md-7">
        <label for="description">Role Description</label>
        <input type="text" name="description" value="{{ old('description', $role->description ?? '') }}" class="form-control" id="description">
    </div>
</div>

<div class="row">
    <div class="form-group">
        <strong>Permission:</strong>
        @foreach($role_permissions as $value)
            <br>
            <input type="checkbox" value="{{ $value->id }}" name="permission[]" data-permission-name="{{$value->name}}">
            <span>{{ $value->name }}</span>
        @endforeach
    </div>
</div>
