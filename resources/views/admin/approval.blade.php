@extends('layout.admin')

@section('content')
    <div class="card mt-5">
        <div class="card-header">Approval Account</div>
        <div class="card-body">
            <table class="table align-middle mb-0 bg-white">
                <thead class="bg-light">
                  <tr>
                    <th>Name</th>
                    <th>Status</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                    <tr>
                        <td>
                        <div class="d-flex align-items-center">
                            <img
                                src="{{ asset('storage/' . $user->photo) }}"
                                alt=""
                                style="width: 45px; height: 45px"
                                class="rounded-circle"
                                />
                            <div class="ms-3">
                            <p class="fw-bold mb-1">{{ $user->name }}</p>
                            <p class="text-muted mb-0">{{ $user->email }}</p>
                            </div>
                        </div>
                        </td>
                        <td>
                            @if ($user->status == 'approved')
                                <span class="badge badge-success rounded-pill d-inline">Approved</span>
                            @elseif ($user->status == 'pending')
                                <span class="badge badge-warning rounded-pill d-inline">Pending</span>
                            @endif
                        </td>
                        <td>
                            @if ($user->status == 'pending')
                            <form action="{{ route('admin.approve', $user->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('POST')
                                <button type="submit" class="btn btn-success btn-sm btn-rounded">
                                    <i class="fas fa-check"></i> Approve
                                </button>
                            </form>
                            @else
                                <button type="button" class="btn btn-success btn-sm btn-rounded" disabled>
                                    <i class="fas fa-check"></i> Approve
                                </button>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>  
        </div>
    </div>
@endsection