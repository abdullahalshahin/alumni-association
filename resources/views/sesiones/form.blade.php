<div class="row g-2">
    <div class="mb-3 col-md-6">
        <label for="name">Name</label>
        <input type="text" name="name" value="{{ old('name', $sesiones->name ?? '') }}" class="form-control" id="name" required>
    </div>
</div>

<div class="row g-2">
    <div class="mb-3 col-md-6">
        <label for="batch_id">Batch</label>
        <select id="batch_id" name="batch_id" class="form-select" required>
            <option value=""> -- Select Batch --</option>
            @foreach ($batches as $batch)
                <option value="{{ $batch->id }}" {{ (old('batch_id') ?? ($sesiones->batch_id)) == $batch->id ? 'selected' : '' }}>
                    {{ $batch->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3 col-md-6">
        <label for="inputState">Status</label>
        <select id="inputState" name="inputState" class="form-select" required>
            <option value="0" {{ old('status') ?? ( 0 == ($sesiones->status ?? '')) ? 'selected' : '' }} selected>Inactive</option>
            <option value="1" {{ old('status') ?? ( 1 == ($sesiones->status ?? '')) ? 'selected' : '' }}>Active</option>
            <option value="2" {{ old('status') ?? ( 2 == ($sesiones->status ?? '')) ? 'selected' : '' }}>Closed</option>
        </select>
    </div>
</div>
