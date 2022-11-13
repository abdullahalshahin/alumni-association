<div class="row g-2">
    <div class="mb-3 col-md-6">
        <label for="name">Name</label>
        <input type="text" name="name" value="{{ old('name', $students->name ?? '') }}" class="form-control" id="name" placeholder="Write your name" required>
    </div>

    <div class="mb-3 col-md-4">
        <label for="date_of_birth">Date of Birth</label>
        <div class="input-group">
            <input type="text" name="date_of_birth" value="{{ old('date_of_birth', $students->date_of_birth ?? '') }}" class="form-control date" id="date_of_birth" data-toggle="date-picker" data-single-date-picker="true" required>
            <span class="input-group-text bg-primary border-primary text-white">
                <i class="mdi mdi-calendar-range font-13"></i>
            </span>
        </div>
    </div>
</div>

<div class="row g-2">
    <div class="mb-3 col-md-6">
        <label for="gender">Gender</label>
        <select id="gender" name="gender" class="form-select" required>
            <option selected>Choose</option>
            <option value="1" {{ old('gender') ?? ( 1 == ($students->gender ?? '')) ? 'selected' : '' }}>Male</option>
            <option value="2" {{ old('gender') ?? ( 2 == ($students->gender ?? '')) ? 'selected' : '' }}>Female</option>
            <option value="3" {{ old('gender') ?? ( 3 == ($students->gender ?? '')) ? 'selected' : '' }}>Others</option>
        </select>
    </div>

    <div class="mb-3 col-md-6">
        <label for="contact_number">Contact Number</label>
        <input type="text" name="contact_number" value="{{ old('contact_number', $students->contact_number ?? '') }}" class="form-control" id="contact_number" placeholder="+8801XXXXXXXXX" required>
    </div>
</div>

<div class="row g-2">
    <div class="mb-3 col-md-6">
        <label for="email">Email</label>
        <input type="email" name="email" value="{{ old('email', $students->email ?? '') }}" class="form-control" id="email" placeholder="example@email.com" required>
    </div>

    <div class="mb-3 col-md-6">
        <label for="password">Password</label>
        <div class="input-group input-group-merge">
            <input type="password" name="password" value="{{ old('password', $students->security ?? '') }}" id="password" class="form-control" placeholder="Password" required>
            <div class="input-group-text" data-password="false">
                <span class="password-eye"></span>
            </div>
        </div>
    </div>
</div>

<div class="row g-2">
    <div class="mb-3 col-md-6">
        <label for="department_id">Department</label>
        <select id="department_id" name="department_id" class="form-select" required>
            <option value=""> -- Select Department --</option>
            @foreach ($departments as $department)
                <option value="{{ $department->id }}" {{ (old('department_id') ?? ($students->session->batch->department_id ?? '' )) == $department->id ? 'selected' : '' }}>
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
                <option value="{{ $batch->id }}" {{ (old('batch_id') ?? ($students->session->batch_id ?? '' )) == $batch->id ? 'selected' : '' }}>
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
            <option value=""> -- Select Batch --</option>
            @foreach ($sesiones as $session)
                <option value="{{ $session->id }}" {{ (old('session_id') ?? ($students->session_id ?? '')) == $session->id ? 'selected' : '' }}>
                    {{ $session->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3 col-md-6">
        <label for="earning_credit">Earning Credit</label>
        <input type="text" name="earning_credit" value="{{ old('earning_credit', $students->earning_credit ?? '') }}" class="form-control" id="earning_credit" required>
    </div>
</div>

<div class="row g-2">
    <div class="mb-3 col-md-6">
        <label for="roles">Permission</label>
        <select id="roles" name="roles" class="form-select" required>
            <option selected>Choose</option>
            @foreach ($roles as $role)
                <option value="{{ $role->id }}">{{ $role->name ?? '' }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3 col-md-6">
        <label for="inputState">Status</label>
        <select id="inputState" name="inputState" class="form-select" required>
            <option value="1" {{ old('status') ?? ( 1 == ($students->status ?? '')) ? 'selected' : '' }} selected>Active</option>
            <option value="2" {{ old('status') ?? ( 2 == ($students->status ?? '')) ? 'selected' : '' }}>Inactive</option>
            <option value="3" {{ old('status') ?? ( 3 == ($students->status ?? '')) ? 'selected' : '' }}>Blocked</option>
        </select>
    </div>
</div>

<div class="mb-3">
    <label for="address">Address</label>
    <input type="text" name="address" value="{{ old('address', $students->address ?? '') }}" class="form-control" id="address" placeholder="Village, Upazila, Thana, Division" required>
</div>

<div class="mb-3">
    <label for="image">Image</label>
    <input type="file" name="image" id="image" class="form-control">
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
