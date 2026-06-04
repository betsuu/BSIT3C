@extends('layouts.user_template')

@section('content')

<style>
    @import url('https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=DM+Mono:wght@500&display=swap');

    .reminders-wrapper {
        font-family: 'DM Sans', sans-serif;
        padding: 2rem;
    }

    .reminders-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 1.5rem;
    }

    .reminders-header h4 {
        font-size: 1.4rem;
        font-weight: 700;
        color: #0f172a;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        margin: 0;
    }

    .reminders-header h4 i { color: #0dcaf0; }

    .btn-add-reminder {
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

    .btn-add-reminder:hover { opacity: 0.88; color: #fff; text-decoration: none; }

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
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        padding: 1rem 1.25rem;
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
        padding: 0.85rem 1.25rem;
        font-size: 0.875rem;
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

    .task-text { font-weight: 600; color: #0f172a; }

    .location-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.3rem;
        background: #f0fdf4;
        color: #15803d;
        border: 1px solid #bbf7d0;
        padding: 0.2rem 0.6rem;
        border-radius: 999px;
        font-size: 0.75rem;
        font-weight: 500;
    }

    .time-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.3rem;
        background: #fef9c3;
        color: #a16207;
        border: 1px solid #fde68a;
        padding: 0.2rem 0.6rem;
        border-radius: 999px;
        font-size: 0.75rem;
        font-weight: 500;
        font-family: 'DM Mono', monospace;
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

    /* Checkbox */
    .done-check {
        width: 18px;
        height: 18px;
        cursor: pointer;
        accent-color: #0dcaf0;
    }

    /* Done row style */
    tr.is-done td { opacity: 0.45; }
    tr.is-done .task-text { text-decoration: line-through; color: #94a3b8; }

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
    .modal-footer { padding: 0.75rem 1.5rem 1.25rem; border: none; font-family: 'DM Sans', sans-serif; }

    .modal-label {
        font-size: 0.8rem;
        font-weight: 600;
        color: #475569;
        display: flex;
        align-items: center;
        gap: 0.35rem;
        margin-bottom: 0.4rem;
    }

    .modal-label i { color: #0dcaf0; }

    .modal-input {
        width: 100%;
        padding: 0.6rem 0.9rem;
        border: 1.5px solid #e2e8f0;
        border-radius: 9px;
        font-size: 0.875rem;
        color: #0f172a;
        font-family: 'DM Sans', sans-serif;
        transition: border-color 0.15s;
        background: #f8fafc;
        box-sizing: border-box;
    }

    .modal-input::placeholder { color: #94a3b8; }
    .modal-input:focus { outline: none; border-color: #0dcaf0; background: #fff; box-shadow: 0 0 0 3px rgba(13,202,240,0.1); }

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
        width: 100%;
    }

    .btn-modal-save:hover { opacity: 0.88; }

    .btn-modal-cancel {
        background: none;
        color: #64748b;
        border: none;
        padding: 0.65rem 1rem;
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
    }

    .btn-modal-delete:hover { opacity: 0.88; }

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

<div class="reminders-wrapper">

    <div class="reminders-header">
        <h4>
            <i class="bi bi-bell-fill"></i> Reminders
        </h4>
        <button class="btn-add-reminder" data-bs-toggle="modal" data-bs-target="#addModal">
            <i class="bi bi-plus-lg"></i> Add Reminder
        </button>
    </div>

    <div class="card-table">
        <table>
            <thead>
                <tr>
                    <th class="text-center">#</th>
                    <th>Reminder</th>
                    <th>Where</th>
                    <th>Time</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($todos as $todo)
                <tr id="row-{{ $todo->id }}" class="{{ $todo->is_done ? 'is-done' : '' }}">
                    <td class="text-center"><span class="num-pill">{{ $loop->iteration }}</span></td>
                    <td><span class="task-text" id="task-{{ $todo->id }}">{{ $todo->task }}</span></td>
                    <td>
                        <span class="location-badge">
                            <i class="bi bi-geo-alt-fill"></i> {{ $todo->location }}
                        </span>
                    </td>
                    <td>
                        <span class="time-badge">
                            <i class="bi bi-clock-fill"></i> {{ $todo->time }}
                        </span>
                    </td>
                    <td>
                        <div class="action-cell">
                            <button type="button" id="edit-{{ $todo->id }}"
                                class="btn-edit-sm {{ $todo->is_done ? 'disabled' : '' }}"
                                data-bs-toggle="modal"
                                data-bs-target="#editModal{{ $todo->id }}"
                                {{ $todo->is_done ? 'disabled' : '' }}>
                                <i class="bi bi-pencil-fill"></i> Edit
                            </button>
                            <button type="button" class="btn-delete-sm"
                                data-bs-toggle="modal"
                                data-bs-target="#deleteModal{{ $todo->id }}">
                                <i class="bi bi-trash3-fill"></i> Delete
                            </button>
                            <input type="checkbox"
                                class="done-check"
                                data-id="{{ $todo->id }}"
                                @if($todo->is_done) checked @endif
                                onchange="markDone(this)">
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@foreach($todos as $todo)
<div class="modal fade" id="deleteModal{{ $todo->id }}" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-grad-header danger">
                <div>
                    <div class="mh-title"><i class="bi bi-trash3-fill"></i> Delete Reminder</div>
                    <div class="mh-sub">This action is permanent</div>
                </div>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="delete-warn">
                    Are you sure you want to delete <strong>{{ $todo->task }}</strong>? This cannot be undone.
                </div>
            </div>
            <div class="modal-footer d-flex gap-2">
                <a href="/deleteToDo/{{ $todo->id }}" class="btn-modal-delete">
                    <i class="bi bi-trash3-fill"></i> Yes, Delete
                </a>
                <button type="button" class="btn-modal-cancel" data-bs-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
@endforeach


@foreach($todos as $todo)
<div class="modal fade" id="editModal{{ $todo->id }}" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="/updateToDo/{{ $todo->id }}" method="POST">
                @csrf
                <div class="modal-grad-header">
                    <div>
                        <div class="mh-title"><i class="bi bi-pencil-square"></i> Edit Reminder</div>
                        <div class="mh-sub">Update the details below</div>
                    </div>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="modal-label"><i class="bi bi-card-text"></i> Reminder</label>
                        <input type="text" name="task" value="{{ $todo->task }}" class="modal-input" placeholder="e.g. Submit assignment" required>
                    </div>
                    <div class="mb-3">
                        <label class="modal-label"><i class="bi bi-geo-alt-fill"></i> Where</label>
                        <input type="text" name="location" value="{{ $todo->location }}" class="modal-input" placeholder="e.g. School, Home, Office">
                    </div>
                    <div class="mb-1">
                        <label class="modal-label"><i class="bi bi-clock-fill"></i> Time</label>
                        <input type="text" name="time" value="{{ $todo->time }}" class="modal-input" placeholder="e.g. 10:00am">
                    </div>
                </div>
                <div class="modal-footer d-flex gap-2">
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


<div class="modal fade" id="addModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-grad-header">
                <div>
                    <div class="mh-title"><i class="bi bi-bell-fill"></i> Add Reminder</div>
                    <div class="mh-sub">Fill in the details below</div>
                </div>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form action="/todo" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="modal-label"><i class="bi bi-card-text"></i> Reminder</label>
                        <input type="text" name="task" class="modal-input" placeholder="e.g. Submit assignment" required>
                    </div>
                    <div class="mb-3">
                        <label class="modal-label"><i class="bi bi-geo-alt-fill"></i> Where</label>
                        <input type="text" name="location" class="modal-input" placeholder="e.g. School, Home, Office">
                    </div>
                    <div class="mb-3">
                        <label class="modal-label"><i class="bi bi-clock-fill"></i> Time</label>
                        <input type="text" name="time" class="modal-input" placeholder="e.g. 10:00am">
                    </div>
                    <div class="d-flex gap-2 mt-4">
                        <button type="submit" class="btn-modal-save">
                            <i class="bi bi-floppy-fill"></i> Save Reminder
                        </button>
                        <button type="button" class="btn-modal-cancel" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
function markDone(checkbox) {
    const id = checkbox.dataset.id;
    const isDone = checkbox.checked ? 1 : 0;

    fetch(`/todo/${id}/done`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ is_done: isDone })
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            const row = document.getElementById(`row-${id}`);
            const taskText = document.getElementById(`task-${id}`);
            const editBtn = document.getElementById(`edit-${id}`);
            row.classList.toggle('is-done', isDone === 1);
            editBtn.disabled = isDone === 1;
            editBtn.classList.toggle('disabled', isDone === 1);
        }
    })
    .catch(err => console.error(err));
}
</script>

@endsection