@extends('layouts.admin')
@section('content')

    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <button class='btn btn-success' id='btn_add' data-bs-target='#form_modal' data-bs-toggle='modal'>Add Program</button>
            
        </div>
    </div>
    <div class="modal" id='form_modal'>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class='modal-title'>Add Program</h2>
                    <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                </div>
                <div class="modal-body">
                    <form action="{{route('admin.programs.store')}}" method='post'>
                        @csrf
                        <div>
                            <label for="" class='form-label'>  Program Name                      
                            </label>
                            <input type="text" name="name" id="" class='form-control'>
                        </div>
                        <div>
                            <label for="" class='form-label'>  Academic Year                      
                            </label>
                            <input type="text" name="academic_year" id="" class='form-control'>
                        </div>
                        <button class='btn btn-success'>Submit</button>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
<div class="card">
    <div class="card-header">
        Program List
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-ExpenseCategory">
                <thead>
                    <tr>
                        
                        <th>
                            ID
                        </th>
                        <th>
                            Program Name
                        </th>
                        <th>
                            Academic Year
                        </th>
                        
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($programs as $program)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$program->name}}</td>
                            <td>{{$program->academic_year}}</td>
                            <td>
                                @can('expense_category_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.programs.show', $program->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('expense_category_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.programs.edit', $program->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('expense_category_delete')
                                    <form action="{{ route('admin.programs.destroy', $program->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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