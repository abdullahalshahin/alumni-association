<div class="row g-2">
    <div class="mb-3 col-md-6">
        <label for="name">Name</label>
        <input type="text" name="name" value="{{ old('name', $departments->name ?? '') }}" class="form-control" id="name" required>
    </div>

    <div class="mb-3 col-md-6">
        <label for="code">Code</label>
        <input type="text" name="code" value="{{ old('code', $departments->code ?? '') }}" class="form-control" id="code" required>
    </div>
</div>

<div class="row g-2">
    <div class="mb-3 col-md-6">
        <label for="shift">Shift</label>
        <select id="shift" name="shift" class="form-select" required>
            <option value="1" {{ old('shift') ?? ( 1 == ($departments->shift ?? '')) ? 'selected' : '' }} selected>Day</option>
            <option value="2" {{ old('shift') ?? ( 2 == ($departments->shift ?? '')) ? 'selected' : '' }}>Evening</option>
        </select>
    </div>

    <div class="mb-3 col-md-6">
        <label for="total_credit">Total Credit</label>
        <input type="text" name="total_credit" value="{{ old('total_credit', $departments->total_credit ?? '') }}" class="form-control" id="total_credit" required>
    </div>
</div>

<div class="row g-2">
    <div class="mb-3 col-md-6">
        <label for="inputState">Status</label>
        <select id="inputState" name="inputState" class="form-select" required>
            <option value="0" {{ old('status') ?? ( 0 == ($departments->status ?? '')) ? 'selected' : '' }} selected>Inactive</option>
            <option value="1" {{ old('status') ?? ( 1 == ($departments->status ?? '')) ? 'selected' : '' }}>Active</option>
            <option value="2" {{ old('status') ?? ( 2 == ($departments->status ?? '')) ? 'selected' : '' }}>Closed</option>
        </select>
    </div>
</div>
