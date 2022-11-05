<x-app-layout>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Users List</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Users</h4>
                </div>
            </div>
        </div>

        @if ($message = Session::get('success'))
            <div class="alert alert-success" id="notificationAlert">
                <p>{{ $message }}</p>
            </div>
        @endif

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-2">
                            <div class="col-sm-4">
                                <a href="{{ route('users.create') }}" class="btn btn-danger mb-2"><i class="mdi mdi-plus-circle me-2"></i> Add User</a>
                            </div>
                            <div class="col-sm-8">
                                <div class="text-sm-end">
                                    <button type="button" class="btn btn-success mb-2 me-1"><i class="mdi mdi-cog"></i></button>
                                    <button type="button" class="btn btn-light mb-2 me-1">Import</button>
                                    <button type="button" class="btn btn-light mb-2">Export</button>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-centered table-striped dt-responsive nowrap w-100" id="products-datatable">
                                <thead>
                                    <tr>
                                        <th style="width: 20px;">
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="customCheck1">
                                                <label class="form-check-label" for="customCheck1">&nbsp;</label>
                                            </div>
                                        </th>
                                        <th>SL</th>
                                        <th>Name</th>
                                        <th>Phone Number</th>
                                        <th>username</th>
                                        <th>Email</th>
                                        <th>Date of Birth</th>
                                        <th>Gender</th>
                                        <th>Position</th>
                                        <th>Permissions</th>
                                        <th>Status</th>
                                        <th style="width: 75px;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" id="customCheck2">
                                                    <label class="form-check-label" for="customCheck2">&nbsp;</label>
                                                </div>
                                            </td>
                                            <td>{{ ++$i }}</td>
                                            <td class="table-user">
                                                @if ($user->image)
                                                    <img src="/images/users/{{ $user->image }}" alt="table-user" class="me-2 rounded-circle">
                                                @else
                                                    <img src="{{ asset('images/default/avator.png') }}" alt="table-user" class="me-2 rounded-circle">
                                                @endif
                                                <a href="javascript:void(0);" class="text-body fw-semibold">{{ $user->name ?? '' }}</a>
                                            </td>
                                            <td>{{ $user->phone ?? '' }}</td>
                                            <td>{{ $user->username ?? '' }}</td>
                                            <td>{{ $user->email ?? '' }}</td>
                                            <td>{{ $user->date_of_birth ?? '' }}</td>
                                            <td> {{ ($user->gender == 1) ? 'Male' : (($user->gender == 2) ? 'Female' : (($user->gender == 3) ? 'Others' : '')) }} </td>
                                            <td>{{ $user->position ?? '' }}</td>
                                            <td>
                                                @forelse ($user->roles as $role)
                                                    {{ $role->name }}
                                                @empty
                                                    No Permission
                                                @endforelse
                                            </td>
                                            <td>
                                                @if ($user->status == 1)
                                                    <span class="badge badge-success-lighten">Active</span>
                                                @elseif ($user->status == 2)
                                                    <span class="badge badge-warning-lighten">Inactive</span>
                                                @elseif ($user->status == 3)
                                                    <span class="badge badge-danger-lighten">Blocked</span>
                                                @endif
                                            </td>
        
                                            <td>
                                                <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                                                    <a href="{{ route('users.show', $user->id) }}" class="action-icon" id="view_button"> <i class="mdi mdi-eye"></i></a>
                                                    <a href="{{ route('users.edit', $user->id) }}" class="action-icon" id="edit_button"> <i class="mdi mdi-square-edit-outline"></i></a>

                                                    @csrf
                                                    @method('DELETE')

                                                    <input name="_method" type="hidden" value="DELETE">
                                                    <button type="submit" class="btn action-icon show_confirm" data-toggle="tooltip" title='Delete'><i class="mdi mdi-delete"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- script -->
    <x-slot name="script">
        <script src="{{ asset('assets/js/pages/demo.users.js') }}"></script>

        <script>
            $('#notificationAlert').delay(3000).fadeOut('slow');     
                $(document).ready(function() {
                    $('#DataTable').DataTable();
            });


            // $('.show_confirm').click(function(event) {
            //     var form =  $(this).closest("form");
            //     var name = $(this).data("name");
            //     event.preventDefault();
            //     Swal.fire({
            //         title: 'Are you sure?',
            //         text: "You want to delete this item ?",
            //         icon: 'warning',
            //         showCancelButton: true,
            //         confirmButtonText: 'Yes, delete it!',
            //         cancelButtonText: 'No, cancel!',
            //         reverseButtons: true
            //     })
            //     .then((willDelete) => {
            //         if (willDelete.isConfirmed) {
            //             form.submit();
            //         }
            //     });
            // });
        </script>
    </x-slot>
</x-app-layout>
