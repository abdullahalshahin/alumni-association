<div class="row g-2">
    <div class="mb-3 col-md-5">
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

    <div class="mb-3 col-md-3">
        <label for="student_credit">Student Credit</label>
        <input type="text" name="student_credit" value="{{ old('date', $defences->student->earning_credit ?? '') }}" class="form-control" id="student_credit" readonly>
    </div>

    <div class="mb-3 col-md-4">
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
    <div class="mb-3 col-md-4">
        <label for="department">Department</label>
        <input type="text" name="department" value="{{ old('date', $defences->group->session->batch->department->name ?? '') }}" class="form-control" id="department" readonly>
    </div>

    <div class="mb-3 col-md-4">
        <label for="department_credit">Department Credit</label>
        <input type="text" name="department_credit" value="{{ old('date', $defences->group->session->batch->department->total_credit ?? '') }}" class="form-control" id="department_credit" readonly>
    </div>

    <div class="mb-3 col-md-4">
        <label for="batch">Batch</label>
        <input type="text" name="batch" value="{{ old('date', $defences->group->session->batch->name ?? '') }}" class="form-control" id="batch" readonly>
    </div>
</div>

<div class="row g-2">
    <div class="mb-3 col-md-6">
        <label for="session">Session</label>
        <input type="text" name="session" value="{{ old('date', $defences->group->session->name ?? '') }}" class="form-control" id="session" readonly>
    </div>

    <div class="mb-3 col-md-6">
        <label for="group_id">Group</label>
        <select id="group_id" name="group_id" class="form-select" required>
            <option value=""> -- Select Batch --</option>
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
    <textarea name="details" class="form-control" id="details" value="{{ old('details', $defences->details ?? '') }}" rows="6">{{ $defences->details ?? '' }}</textarea>
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
            $('#student_id').on('change', function () {
                var student_id = this.value;

                $.ajax({
                    url: "{{url('api/fetch-student-participant')}}",
                    type: "POST",
                    data: {
                        student_id: student_id,
                        _token: '{{csrf_token()}}'
                    },
                    dataType: 'json',
                    success: function (result) {
                        document.getElementById("student_credit").value = result.student.earning_credit ?? '';
                        document.getElementById("department").value = result.student.session.batch.department.name ?? '';
                        document.getElementById("department_credit").value = result.student.session.batch.department.total_credit ?? '';
                        document.getElementById("batch").value = result.student.session.batch.name ?? '';
                        document.getElementById("session").value = result.student.session.name ?? '';

                        $('#group_id').html('<option value="">-- Select Group --</option>');
                        $.each(result.groups, function (key, value) {
                            $("#group_id").append('<option value="' + value.id + '">' + value.name + '</option>');
                        });
                    }
                });
            });
        });
    </script>
</x-slot>
