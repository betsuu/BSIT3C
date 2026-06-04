@extends('layouts.user_template')

@section('content')

<style>
    @import url('https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=DM+Mono:wght@500&display=swap');

    .users-wrapper {
        font-family: 'DM Sans', sans-serif;
        padding: 2rem;
    }

    .users-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 1.5rem;
    }

    .users-header h4 {
        font-size: 1.4rem;
        font-weight: 700;
        color: #0f172a;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        margin: 0;
    }

    .users-header h4 i { color: #0dcaf0; }

    /* Card Table */
    .card-table {
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 4px 24px rgba(15, 23, 42, 0.08);
        overflow: hidden;
        border: 1px solid #e2e8f0;
    }

    .card-table table {
        width: 100%;
        border-collapse: collapse;
        margin: 0;
    }

    .card-table thead {
        background: linear-gradient(135deg, #0dcaf0 0%, #0d6efd 100%);
    }

    .card-table thead th {
        color: #fff;
        font-size: 0.72rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        padding: 0.6rem 1rem;
        border: none;
        text-align: left;
    }

    .card-table thead th.text-center { text-align: center; }

    .card-table tbody tr {
        border-bottom: 1px solid #f1f5f9;
        transition: background 0.15s ease;
    }

    .card-table tbody tr:last-child { border-bottom: none; }
    .card-table tbody tr:hover { background: #f0fdff; }

    .card-table tbody td {
        padding: 0.45rem 1rem;
        font-size: 0.85rem;
        color: #334155;
        vertical-align: middle;
        border: none;
    }

    .num-pill {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 26px;
        height: 26px;
        background: #e0f2fe;
        color: #0284c7;
        font-size: 0.72rem;
        font-weight: 700;
        border-radius: 50%;
        font-family: 'DM Mono', monospace;
    }

    .name-text { font-weight: 600; color: #0f172a; }

    .user-avatar {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 30px;
        height: 30px;
        border-radius: 50%;
        background: linear-gradient(135deg, #0dcaf0, #0d6efd);
        color: #fff;
        font-size: 0.75rem;
        font-weight: 700;
        font-family: 'DM Sans', sans-serif;
        flex-shrink: 0;
    }

    .user-name-cell {
        display: flex;
        align-items: center;
        gap: 0.6rem;
    }

    .email-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.3rem;
        background: #f0f9ff;
        color: #0369a1;
        border: 1px solid #bae6fd;
        padding: 0.2rem 0.6rem;
        border-radius: 999px;
        font-size: 0.75rem;
        font-weight: 500;
    }

    .action-cell {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .btn-edit-sm {
        background: #eff6ff;
        color: #2563eb;
        border: 1px solid #bfdbfe;
        font-size: 0.75rem;
        font-weight: 600;
        padding: 0.3rem 0.75rem;
        border-radius: 7px;
        cursor: pointer;
        transition: all 0.15s;
        display: inline-flex;
        align-items: center;
        gap: 0.25rem;
        font-family: 'DM Sans', sans-serif;
    }

    .btn-edit-sm:hover { background: #2563eb; color: #fff; border-color: #2563eb; }

    .btn-delete-sm {
        background: #fff1f2;
        color: #e11d48;
        border: 1px solid #fecdd3;
        font-size: 0.75rem;
        font-weight: 600;
        padding: 0.3rem 0.75rem;
        border-radius: 7px;
        cursor: pointer;
        transition: all 0.15s;
        display: inline-flex;
        align-items: center;
        gap: 0.25rem;
        font-family: 'DM Sans', sans-serif;
    }

    .btn-delete-sm:hover { background: #e11d48; color: #fff; border-color: #e11d48; }

    .btn-add-user {
        background: linear-gradient(135deg, #0dcaf0, #0d6efd);
        color: #fff;
        border: none;
        padding: 0.55rem 1.2rem;
        border-radius: 10px;
        font-size: 0.875rem;
        font-weight: 600;
        cursor: pointer;
        font-family: 'DM Sans', sans-serif;
        transition: opacity 0.15s;
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
    }

    .btn-add-user:hover { opacity: 0.88; color: #fff; }

    /* ===== MODALS ===== */
    .modal-content { border: none; border-radius: 16px; overflow: hidden; box-shadow: 0 20px 60px rgba(15,23,42,0.18); }

    .modal-grad-header {
        background: linear-gradient(135deg, #0dcaf0, #0d6efd);
        padding: 1.25rem 1.5rem 1rem;
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
    }

    .modal-grad-header.danger {
        background: linear-gradient(135deg, #e11d48, #be123c);
    }

    .modal-grad-header .mh-title {
        font-size: 1.1rem;
        font-weight: 700;
        color: #fff;
        margin: 0 0 0.15rem;
        display: flex;
        align-items: center;
        gap: 0.4rem;
        font-family: 'DM Sans', sans-serif;
    }

    .modal-grad-header .mh-sub {
        font-size: 0.8rem;
        color: rgba(255,255,255,0.8);
        font-family: 'DM Sans', sans-serif;
    }

    .modal-grad-header .btn-close-white {
        filter: brightness(0) invert(1);
        opacity: 0.8;
    }

    .modal-body { padding: 1.25rem 1.5rem; font-family: 'DM Sans', sans-serif; }

    .modal-label {
        display: block;
        font-size: 0.8rem;
        font-weight: 600;
        color: #475569;
        margin-bottom: 0.4rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }

    .modal-input {
        width: 100%;
        border: 1.5px solid #e2e8f0;
        border-radius: 9px;
        padding: 0.55rem 0.85rem;
        font-size: 0.875rem;
        color: #0f172a;
        font-family: 'DM Sans', sans-serif;
        transition: border-color 0.15s;
        outline: none;
        background: #f8fafc;
    }

    .modal-input:focus { border-color: #0dcaf0; background: #fff; }

    .modal-footer {
        padding: 1rem 1.5rem;
        border-top: 1px solid #f1f5f9;
        display: flex;
        gap: 0.5rem;
    }

    .btn-modal-save {
        flex: 1;
        background: linear-gradient(135deg, #0dcaf0, #0d6efd);
        color: #fff;
        border: none;
        padding: 0.65rem 1rem;
        border-radius: 9px;
        font-size: 0.875rem;
        font-weight: 700;
        cursor: pointer;
        font-family: 'DM Sans', sans-serif;
        transition: opacity 0.15s;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.4rem;
    }

    .btn-modal-save:hover { opacity: 0.88; }

    .btn-modal-cancel {
        background: #f1f5f9;
        color: #64748b;
        border: none;
        padding: 0.65rem 1.1rem;
        border-radius: 9px;
        font-size: 0.875rem;
        font-weight: 600;
        cursor: pointer;
        font-family: 'DM Sans', sans-serif;
        transition: color 0.15s;
    }

    .btn-modal-cancel:hover { color: #0f172a; }

    .btn-modal-delete {
        flex: 1;
        background: linear-gradient(135deg, #e11d48, #be123c);
        color: #fff;
        border: none;
        padding: 0.65rem 1rem;
        border-radius: 9px;
        font-size: 0.875rem;
        font-weight: 700;
        cursor: pointer;
        font-family: 'DM Sans', sans-serif;
        transition: opacity 0.15s;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.4rem;
        text-decoration: none;
    }

    .btn-modal-delete:hover { opacity: 0.88; color: #fff; }

    .delete-warn {
        background: #fff1f2;
        border: 1px solid #fecdd3;
        border-radius: 10px;
        padding: 0.85rem 1rem;
        color: #9f1239;
        font-size: 0.875rem;
        line-height: 1.5;
    }


</style>

<div class="users-wrapper">

    <div class="users-header">
        <h4>
            <i class="bi bi-people-fill"></i> Users
        </h4>
        <button class="btn-add-user" data-bs-toggle="modal" data-bs-target="#addUserModal">
            <i class="bi bi-plus-lg"></i> Add User
        </button>
    </div>

    <div class="card-table">
        <table>
            <colgroup>
                <col style="width: 60px;">
                <col style="width: 200px;">
                <col style="width: 260px;">
                <col>
            </colgroup>
            <thead>
                <tr>
                    <th class="text-center">#</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($user as $users)
                <tr>
                    <td class="text-center"><span class="num-pill">{{ $loop->iteration }}</span></td>
                    <td>
                        <div class="user-name-cell">
                            <div class="user-avatar">{{ strtoupper(substr($users->name, 0, 1)) }}</div>
                            <span class="name-text">{{ $users->name }}</span>
                        </div>
                    </td>
                    <td>
                        <span class="email-badge">
                            <i class="bi bi-envelope-fill"></i> {{ $users->email }}
                        </span>
                    </td>
                    <td>
                        <div class="action-cell" style="justify-content: center;">
                            <button type="button" class="btn-edit-sm"
                                data-bs-toggle="modal"
                                data-bs-target="#editModal{{ $users->id }}">
                                <i class="bi bi-pencil-fill"></i> Edit
                            </button>
                            <button type="button" class="btn-delete-sm"
                                data-bs-toggle="modal"
                                data-bs-target="#deleteModal{{ $users->id }}">
                                <i class="bi bi-trash3-fill"></i> Delete
                            </button>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div style="padding: 0.75rem 1rem; border-top: 1px solid #e2e8f0; background: #f8fafc; text-align: right;">
        <span style="
            background: linear-gradient(135deg, #0dcaf0, #0d6efd);
            color: #fff;
            font-size: 0.78rem;
            font-weight: 700;
            padding: 0.3rem 0.85rem;
            border-radius: 999px;
            font-family: 'DM Mono', monospace;
            letter-spacing: 0.04em;
        ">{{ count($user) }} users</span>
    </div>
</div>

{{-- Delete Modals --}}
@foreach($user as $users)
<div class="modal fade" id="deleteModal{{ $users->id }}" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-grad-header danger">
                <div>
                    <div class="mh-title"><i class="bi bi-trash3-fill"></i> Delete User</div>
                    <div class="mh-sub">This action is permanent</div>
                </div>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="delete-warn">
                    Are you sure you want to delete <strong>{{ $users->name }}</strong>? This cannot be undone.
                </div>
            </div>
            <form action="/deleteUser/{{ $users->id }}" method="POST">
                @csrf
                <div class="modal-footer">
                    <button type="submit" class="btn-modal-delete">
                        <i class="bi bi-trash3-fill"></i> Yes, Delete
                    </button>
                    <button type="button" class="btn-modal-cancel" data-bs-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach

{{-- Edit Modals --}}
@foreach($user as $users)
<div class="modal fade" id="editModal{{ $users->id }}" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="/updateUser/{{ $users->id }}" method="POST">
                @csrf
                <div class="modal-grad-header">
                    <div>
                        <div class="mh-title"><i class="bi bi-pencil-square"></i> Edit User</div>
                        <div class="mh-sub">Update the details below</div>
                    </div>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="modal-label"><i class="bi bi-person-fill"></i> Username</label>
                        <input type="text" name="name" value="{{ $users->name }}" class="modal-input" placeholder="e.g. John Doe" required>
                    </div>
                    <div class="mb-1">
                        <label class="modal-label"><i class="bi bi-envelope-fill"></i> Email</label>
                        <input type="email" name="email" value="{{ $users->email }}" class="modal-input" placeholder="e.g. john@example.com" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn-modal-save">
                        <i class="bi bi-floppy-fill"></i> Save Changes
                    </button>
                    <button type="button" class="btn-modal-cancel" data-bs-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach

@endsection


<div class="modal fade" id="addUserModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="/addUser" method="POST">
                @csrf
                <div class="modal-grad-header">
                    <div>
                        <div class="mh-title"><i class="bi bi-person-plus-fill"></i> Add User</div>
                        <div class="mh-sub">Fill in the details below</div>
                    </div>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    @if($errors->any())
                        <div class="alert alert-danger py-2 mb-3">
                            @foreach($errors->all() as $error)
                                <div style="font-size:0.8rem">{{ $error }}</div>
                            @endforeach
                        </div>
                    @endif
                    <div class="mb-3">
                        <label class="modal-label"><i class="bi bi-person-fill"></i> Username</label>
                        <input type="text" name="name" class="modal-input" placeholder="e.g. John Doe" required>
                    </div>
                    <div class="mb-3">
                        <label class="modal-label"><i class="bi bi-envelope-fill"></i> Email</label>
                        <input type="email" name="email" class="modal-input" placeholder="e.g. john@example.com" required>
                    </div>
                    <div class="mb-1">
                        <label class="modal-label"><i class="bi bi-lock-fill"></i> Password</label>
                        <input type="password" name="password" class="modal-input" placeholder="Min. 8 characters" minlength="8" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn-modal-save">
                        <i class="bi bi-person-plus-fill"></i> Add User
                    </button>
                    <button type="button" class="btn-modal-cancel" data-bs-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>