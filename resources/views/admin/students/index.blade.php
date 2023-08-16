@extends('layouts.admin')
@section('content')

    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route("admin.students.create") }}">
                Add Student
            </a>
        </div>
    </div>

<div class="card">
    <div class="card-header">
        Student List
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-ExpenseCategory">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            ID
                        </th>
                        <th>
                            Student ID
                        </th>
                        <th>
                            Name
                        </th>
                        <th>
                            Email
                        </th>
                        <th>
                            Phone
                        </th>
                        <th>
                            Address
                        </th>
                        <th>
                            Education
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($students as $key => $student)
                        <tr data-entry-id="{{ $student->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $student->id}}
                            </td>
                            <td>
                                {{ $student->student_id}}
                            </td>
                            <td>
                                {{ $student->name}}                           
                            </td>
                            <td>
                                {{ $student->email}}                           
                            </td>
                            <td>
                                {{ $student->phone}}                           
                            </td>
                            <td>
                                {{ $student->address}}                           
                            </td>
                            <td>
                                {{ $student->education}}                           
                            </td>
                            <td>
                                @can('expense_category_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.students.show', $student->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('expense_category_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.students.edit', $student->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('expense_category_delete')
                                    <form action="{{ route('admin.students.destroy', $student->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>
                                @endcan

                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>


    </div>
</div>
@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('expense_category_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.expense-categories.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  $('.datatable-ExpenseCategory:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>
@endsection