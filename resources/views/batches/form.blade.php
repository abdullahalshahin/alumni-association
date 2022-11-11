<div class="row g-2">
    <div class="mb-3 col-md-6">
        <label for="name">Name</label>
        <input type="text" name="name" value="{{ old('name', $batches->name ?? '') }}" class="form-control" id="name" required>
    </div>

    <div class="mb-3 col-md-6">
        <label for="year">Year</label>
        <input type="text" name="year" value="{{ old('year', $batches->year ?? '') }}" class="form-control" id="year" required>
    </div>
</div>

<div class="row g-2">
    <div class="mb-3 col-md-6">
        <label for="department_id">Department</label>
        <select id="department_id" name="department_id" class="form-select" required>
            <option value=""> -- Select Department --</option>
            @foreach ($departments as $department)
                <option value="{{ $department->id }}" {{ (old('department_id') ?? ($batches->department_id)) == $department->id ? 'selected' : '' }}>
                    {{ $department->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3 col-md-6">
        <label for="inputState">Status</label>
        <select id="inputState" name="inputState" class="form-select" required>
            <option value="0" {{ old('status') ?? ( 0 == ($batches->status ?? '')) ? 'selected' : '' }} selected>Inactive</option>
            <option value="1" {{ old('status') ?? ( 1 == ($batches->status ?? '')) ? 'selected' : '' }}>Active</option>
            <option value="2" {{ old('status') ?? ( 2 == ($batches->status ?? '')) ? 'selected' : '' }}>Closed</option>
        </select>
    </div>
</div>
