<div class="row g-2">
    <div class="mb-3 col-md-6">
        <label for="name">Name</label>
        <input type="text" name="name" value="{{ old('name', $groups->name ?? '') }}" class="form-control" id="name" required>
    </div>

    <div class="mb-3 col-md-6">
        <label for="session_id">Session</label>
        <select id="session_id" name="session_id" class="form-select" required>
            <option value=""> -- Select Batch --</option>
            @foreach ($sesiones as $session)
                <option value="{{ $session->id }}" {{ (old('session_id') ?? ($groups->session_id)) == $session->id ? 'selected' : '' }}>
                    {{ $session->name }}
                </option>
            @endforeach
        </select>
    </div>
</div>

<div class="row g-2">
    <div class="mb-3 col-md-6">
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

    <div class="mb-3 col-md-6">
        <label for="topic_name">Topic Name</label>
        <input type="text" name="topic_name" value="{{ old('topic_name', $groups->topic_name ?? '') }}" class="form-control" id="topic_name" required>
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
