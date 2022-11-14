<x-app-layout>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('roles.index') }}">Roles</a></li>
                            <li class="breadcrumb-item active">Role Edit</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Role Edit</h4>
                </div>
            </div>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-2">
                            <form action="{{ route('roles.update', $role->id) }}" method="POST">
                                @csrf
                                @method('PUT')
        
                                <div class="row g-2">
                                    <div class="mb-1 col-md-5">
                                        <label for="name">Role Name</label>
                                        <input type="text" name="name" value="{{ old('name', $role->name ?? '') }}" class="form-control" id="name" placeholder="e.g: Executive" required>
                                    </div>
                                    <div class="mb-1 col-md-7">
                                        <label for="description">Role Description</label>
                                        <input type="text" name="description" value="{{ old('description', $role->description ?? '') }}" class="form-control" id="description">
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="form-group">
                                        <strong>Permission:</strong>
                                        @foreach($permission as $value)
                                            <br>
                                            <input type="checkbox" value="{{ $value->id }}" {{ in_array($value->id, $role_permissions) ? 'checked' : '' }} name="permission[]" data-permission-name="{{$value->name}}">
                                            <span>{{ $value->name }}</span>
                                        @endforeach
                                    </div>
                                </div>
                                
        
                                <div class="modal-footer">
                                    <a href="{{ route('roles.index') }}" class="btn btn-primary">Go Back</a>
                                    <button type="submit" class="btn btn-success">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
