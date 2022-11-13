<div class="row g-2">
    <div class="mb-3 col-md-3">
        <label for="name">Name</label>
        <input type="text" name="name" value="{{ old('name', $groups->name ?? '') }}" class="form-control" id="name" required>
    </div>

    <div class="mb-3 col-md-4">
        <label for="teacher_id">Teacher</label>
        <select id="teacher_id" name="teacher_id" class="form-select" required>
            <option value=""> -- Select Batch --</option>
            @foreach ($teachers as $teacher)
                <option value="{{ $teacher->id }}" {{ (old('teacher_id') ?? ($groups->teacher_id)) == $teacher->id ? 'selected' : '' }}>
                    {{ $teacher->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3 col-md-5">
        <label for="topic_name">Topic Name</label>
        <input type="text" name="topic_name" value="{{ old('topic_name', $groups->topic_name ?? '') }}" class="form-control" id="topic_name" required>
    </div>
</div>

<div class="row g-2">
    <div class="mb-3 col-md-4">
        <label for="department_id">Department</label>
        <select id="department_id" name="department_id" class="form-select" required>
            <option value=""> -- Select Department --</option>
            @foreach ($departments as $department)
                <option value="{{ $department->id }}" {{ (old('department_id') ?? ($groups->session->batch->department_id ?? '' )) == $department->id ? 'selected' : '' }}>
                    {{ $department->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3 col-md-4">
        <label for="batch_id">Batch</label>
        <select id="batch_id" name="batch_id" class="form-select" required>
            <option value=""> -- Select Batch --</option>
            @foreach ($batches as $batch)
                <option value="{{ $batch->id }}" {{ (old('batch_id') ?? ($groups->session->batch_id ?? '' )) == $batch->id ? 'selected' : '' }}>
                    {{ $batch->name }}
                </option>
            @endforeach
        </select>
    </div>
    
    <div class="mb-3 col-md-4">
        <label for="session_id">Session</label>
        <select id="session_id" name="session_id" class="form-select" required>
            <option value=""> -- Select Batch --</option>
            @foreach ($sesiones as $session)
                <option value="{{ $session->id }}" {{ (old('session_id') ?? ($groups->session_id ?? '')) == $session->id ? 'selected' : '' }}>
                    {{ $session->name }}
                </option>
            @endforeach
        </select>
    </div>
</div>

<div class="row g-2">
    <div class="mb-3 col-md-6">
        <label for="inputState">Status</label>
        <select id="inputState" name="inputState" class="form-select" required>
            <option value="0" {{ old('status') ?? ( 0 == ($groups->status ?? '')) ? 'selected' : '' }} selected>Incomplete</option>
            <option value="1" {{ old('status') ?? ( 1 == ($groups->status ?? '')) ? 'selected' : '' }}>Complete</option>
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
                        
                        $('#session_id').html('<option value="">-- Select Session --</option>');
                    }
                });
            });

            $('#batch_id').on('change', function () {

                var batch_id = this.value;

                $("#session_id").html('');

                $.ajax({
                    url: "{{url('api/fetch-sessions')}}",
                    type: "POST",
                    data: {
                        batch_id: batch_id,
                        _token: '{{csrf_token()}}'
                    },
                    dataType: 'json',
                    success: function (res) {
                        $('#session_id').html('<option value="">-- Select Session --</option>');
                        $.each(res.sessions, function (key, value) {
                            $("#session_id").append('<option value="' + value.id + '">' + value.name + '</option>');
                        });
                    }
                });
            });
        });
    </script>
</x-slot>
