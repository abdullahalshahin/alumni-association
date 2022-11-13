<div class="row g-2">
    <div class="mb-3 col-md-6">
        <label for="name">Name</label>
        <input type="text" name="name" value="{{ old('name', $sessions->name ?? '') }}" class="form-control" id="name" required>
    </div>
</div>

<div class="row g-2">
    <div class="mb-3 col-md-6">
        <label for="department_id">Department</label>
        <select id="department_id" name="department_id" class="form-select" required>
            <option value=""> -- Select Department --</option>
            @foreach ($departments as $department)
                <option value="{{ $department->id }}" {{ (old('department_id') ?? ($sessions->batch->department_id ?? '' )) == $department->id ? 'selected' : '' }}>
                    {{ $department->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3 col-md-6">
        <label for="batch_id">Batch</label>
        <select id="batch_id" name="batch_id" class="form-select" required>
            <option value=""> -- Select Batch --</option>
            @foreach ($batches as $batch)
                <option value="{{ $batch->id }}" {{ (old('batch_id') ?? ($sessions->batch_id)) == $batch->id ? 'selected' : '' }}>
                    {{ $batch->name }}
                </option>
            @endforeach
        </select>
    </div>
</div>

<div class="row g-2">
    <div class="mb-3 col-md-6">
        <label for="inputState">Status</label>
        <select id="inputState" name="inputState" class="form-select" required>
            <option value="0" {{ old('status') ?? ( 0 == ($sessions->status ?? '')) ? 'selected' : '' }} selected>Inactive</option>
            <option value="1" {{ old('status') ?? ( 1 == ($sessions->status ?? '')) ? 'selected' : '' }}>Active</option>
            <option value="2" {{ old('status') ?? ( 2 == ($sessions->status ?? '')) ? 'selected' : '' }}>Closed</option>
        </select>
    </div>
</div>

<x-slot name="script">
    <script>
        $(document).ready(function () {
            $('#department_id').on('change', function () {
                var department_id = this.value;
                
                $("#batch_id").html('');

                $.ajax({
                    url: "{{url('api/fetch-batches')}}",
                    type: "POST",
                    data: {
                        department_id: department_id,
                        _token: '{{csrf_token()}}'
                    },
                    dataType: 'json',
                    success: function (result) {
                        $('#batch_id').html('<option value="">-- Select Batch --</option>');
                        $.each(result.batches, function (key, value) {
                            $("#batch_id").append('<option value="' + value.id + '">' + value.name + '</option>');
                        });
                    }
                });
            });
        });
    </script>
</x-slot>
