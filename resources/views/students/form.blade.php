<div class="row g-2">
    <div class="mb-3 col-md-6">
        <label for="name" class="form-label">Name</label>
        <input type="text" name="name" value="{{ old('name', $users->name ?? '') }}" class="form-control" id="name" placeholder="Write your name" required>
    </div>

    <div class="mb-3 col-md-4">
        <label for="date_of_birth" class="form-label">Date of Birth</label>
        <div class="input-group">
            <input type="text" name="date_of_birth" value="{{ old('date_of_birth', $users->date_of_birth ?? '') }}" class="form-control date" id="date_of_birth" data-toggle="date-picker" data-single-date-picker="true" required>
            <span class="input-group-text bg-primary border-primary text-white">
                <i class="mdi mdi-calendar-range font-13"></i>
            </span>
        </div>
    </div>
</div>

<div class="row g-2">
    <div class="mb-3 col-md-6">
        <label for="username" class="form-label">username</label>
        <div class="input-group flex-nowrap">
            <span class="input-group-text">@</span>
            <input type="text" name="username" value="{{ old('username', $users->username ?? '') }}" id="username" class="form-control" placeholder="username" aria-label="username" aria-describedby="username" required>
        </div>
    </div>

    <div class="mb-3 col-md-6">
        <label for="password" class="form-label">Password</label>
        <div class="input-group input-group-merge">
            <input type="password" name="password" value="{{ old('password', $users->security ?? '') }}" id="password" class="form-control" placeholder="Password" required>
            <div class="input-group-text" data-password="false">
                <span class="password-eye"></span>
            </div>
        </div>
    </div>
</div>

<div class="row g-2">
    <div class="mb-3 col-md-6">
        <label for="phone" class="form-label">Contact Number</label>
        <input type="text" name="phone" value="{{ old('phone', $users->phone ?? '') }}" class="form-control" id="phone" placeholder="+8801XXXXXXXXX" required>
    </div>

    <div class="mb-3 col-md-6">
        <label for="email" class="form-label">Email</label>
        <input type="email" name="email" value="{{ old('email', $users->email ?? '') }}" class="form-control" id="email" placeholder="example@email.com" required>
    </div>
</div>

<div class="row g-2">
    <div class="mb-3 col-md-6">
        <label for="gender" class="form-label">Gender</label>
        <select id="gender" name="gender" class="form-select" required>
            <option selected>Choose</option>
            <option value="1" {{ old('gender') ?? ( 1 == ($users->gender ?? '')) ? 'selected' : '' }}>Male</option>
            <option value="2" {{ old('gender') ?? ( 2 == ($users->gender ?? '')) ? 'selected' : '' }}>Female</option>
            <option value="3" {{ old('gender') ?? ( 3 == ($users->gender ?? '')) ? 'selected' : '' }}>Others</option>
        </select>
    </div>

    <div class="mb-3 col-md-6">
        <label for="position" class="form-label">Position</label>
        <input type="text" name="position" value="{{ old('position', $users->position ?? '') }}" class="form-control" id="position">
    </div>
</div>

<div class="row g-2">
    <div class="mb-3 col-md-6">
        <label for="roles" class="form-label">Permission</label>
        <select id="roles" name="roles" class="form-select" required>
            <option selected>Choose</option>
            @foreach ($roles as $role)
                <option value="{{ $role->id }}">{{ $role->name ?? '' }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3 col-md-6">
        <label for="inputState" class="form-label">Status</label>
        <select id="inputState" name="inputState" class="form-select" required>
            <option value="1" {{ old('status') ?? ( 1 == ($users->status ?? '')) ? 'selected' : '' }} selected>Active</option>
            <option value="2" {{ old('status') ?? ( 2 == ($users->status ?? '')) ? 'selected' : '' }}>Inactive</option>
            <option value="3" {{ old('status') ?? ( 3 == ($users->status ?? '')) ? 'selected' : '' }}>Blocked</option>
        </select>
    </div>
</div>

<div class="mb-3">
    <label for="address" class="form-label">Address</label>
    <input type="text" name="address" value="{{ old('address', $users->address ?? '') }}" class="form-control" id="address" placeholder="Village, Upazila, Thana, Division" required>
</div>

<div class="mb-3">
    <label for="image" class="form-label">Image</label>
    <input type="file" name="image" id="image" class="form-control">
</div>
