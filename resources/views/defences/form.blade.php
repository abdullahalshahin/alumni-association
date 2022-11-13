<div class="row g-2">
    <div class="mb-3 col-md-6">
        <label for="student_id">Student</label>
        <select id="student_id" name="student_id" class="form-select" required>
            <option value=""> -- Select Student --</option>
            @foreach ($students as $student)
                <option value="{{ $student->id }}" {{ (old('student_id') ?? ($defences->student_id)) == $student->id ? 'selected' : '' }}>
                    {{ $student->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3 col-md-6">
        <label for="date">Date</label>
        <div class="input-group">
            <input type="text" name="date" value="{{ old('date', $defences->date ?? '') }}" class="form-control date" id="date" data-toggle="date-picker" data-single-date-picker="true" required>
            <span class="input-group-text bg-primary border-primary text-white">
                <i class="mdi mdi-calendar-range font-13"></i>
            </span>
        </div>
    </div>
</div>

<div class="row g-2">
    <div class="mb-3 col-md-6">
        <label for="department_id">Department</label>
        <select id="department_id" name="department_id" class="form-select" required>
            <option value=""> -- Select Department --</option>
            @foreach ($departments as $department)
                <option value="{{ $department->id }}" {{ (old('department_id') ?? ($defences->groups->session->batch->department_id ?? '' )) == $department->id ? 'selected' : '' }}>
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
                <option value="{{ $batch->id }}" {{ (old('batch_id') ?? ($defences->groups->session->batch_id ?? '' )) == $batch->id ? 'selected' : '' }}>
                    {{ $batch->name }}
                </option>
            @endforeach
        </select>
    </div>
</div>

<div class="row g-2">
    <div class="mb-3 col-md-6">
        <label for="session_id">Session</label>
        <select id="session_id" name="session_id" class="form-select" required>
            <option value=""> -- Select Session --</option>
            @foreach ($sesiones as $session)
                <option value="{{ $session->id }}" {{ (old('session_id') ?? ($defences->groups->session_id ?? '')) == $session->id ? 'selected' : '' }}>
                    {{ $session->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3 col-md-6">
        <label for="group_id">Group</label>
        <select id="group_id" name="group_id" class="form-select" required>
            <option value=""> -- Select Group --</option>
            @foreach ($groups as $group)
                <option value="{{ $group->id }}" {{ (old('group_id') ?? ($defences->group_id ?? '')) == $group->id ? 'selected' : '' }}>
                    {{ $group->name }}
                </option>
            @endforeach
        </select>
    </div>
</div>

<div class="row g-2">
    <div class="mb-3 col-md-6">
        <label for="marks">Marks</label>
        <input type="text" name="marks" value="{{ old('marks', $defences->marks ?? '') }}" class="form-control" id="marks">
    </div>
</div>

<div class="mb-2">
    <label for="details">Details</label>
    <textarea name="details" class="form-control" id="details" value="{{ old('details', $defences->details ?? '') }}" rows="3">{{ $appointments->payment_amount ?? '' }}</textarea>
</div>

<div class="row g-2">
    <div class="mb-3 col-md-6">
        <label for="inputState">Status</label>
        <select id="inputState" name="inputState" class="form-select" required>
            <option value="0" {{ old('status') ?? ( 0 == ($defences->status ?? '')) ? 'selected' : '' }} selected>Pending</option>
            <option value="1" {{ old('status') ?? ( 1 == ($defences->status ?? '')) ? 'selected' : '' }}>Verified</option>
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

                        $('#group_id').html('<option value="">-- Select Session --</option>');
                    }
                });
            });

            $('#session_id').on('change', function () {
                var session_id = this.value;

                $("#group_id").html('');

                $.ajax({
                    url: "{{url('api/fetch-groups')}}",
                    type: "POST",
                    data: {
                        session_id: session_id,
                        _token: '{{csrf_token()}}'
                    },
                    dataType: 'json',
                    success: function (res) {
                        $('#group_id').html('<option value="">-- Select Session --</option>');
                        $.each(res.groups, function (key, value) {
                            $("#group_id").append('<option value="' + value.id + '">' + value.name + '</option>');
                        });
                    }
                });
            });
        });
    </script>
</x-slot>
