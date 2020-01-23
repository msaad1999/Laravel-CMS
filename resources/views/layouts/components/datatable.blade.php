<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>

            <tr>
              <th>ID</th>
              <th>Photo</th>
              <th>Name</th>
              <th>Email</th>
              <th>Role</th>
              <th>Status</th>
              <th>Created At</th>
              <th>Updated At</th>
            </tr>

          </thead>
          <tfoot>

            <tr>
              <th>ID</th>
              <th>Photo</th>
              <th>Name</th>
              <th>Email</th>
              <th>Role</th>
              <th>Status</th>
              <th>Created At</th>
              <th>Updated At</th>
            </tr>

          </tfoot>
          <tbody>

            @if($users)
            @foreach($users as $user)
              <tr>
                <td>{{ $user->id }}</td>
                <td>
                  @if ($user->photo)
                    <img src='{{ $user->photo->file }}' width=40 height=40>
                  @else
                    --
                  @endif
                </td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->role->name }}</td>
                <td>{{ $user->is_active ? 'Active' : 'Not Active' }}</td>
                <td>{{ $user->created_at->diffForHumans() }}</td>
                <td>{{ $user->updated_at->diffForHumans() }}</td>
              </tr>
            @endforeach
          @endif

          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

@push('scripts')
<script src='{{ asset('js/components/datatables.js') }}'></script>
@endpush