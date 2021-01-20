<link rel="stylesheet" type="text/css" href="http://localhost/sos/public/assets/backend/css/bootstrap.min.css">


<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Roles') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="row">
  <div class="col-md-10">
      <form role="form" class="filter-form form-inline">
          <div class="form-group">
            <input width="200" type="search" value="{{Request::get('search')}}" name="search" placeholder="Search by role title" class="form-control" style="width: 360px;max-width: 100%;">
          </div>
          <button type="submit" class="btn btn-primary">Submit</button>
          <a  href="{{route('role.index')}}" class="btn btn-default">Clear</a>
        </form>
  </div>
</div>

    <div class="td-table">
              <h2>Roles List <span>({{$data['roles']->total()}} Roles)</span></h2>
              <div class="td-table-body">
                <div class="table-responsive">
                  <table>
                    <thead>
                      <tr>
                        <td>Sr.</td>
                        <td>Title</td>
                        <td>Active/Inactive</td>
                        <td>Action</td>
                      </tr>
                    </thead>
                  <tbody>
                      @forelse($data['roles'] as $key => $value)
                      <!--single tr-->
                       <tr>
                        <td>
                          {{++$key}}.
                        </td>
                        <td>
                          <div class="organiser-details">
                            <div class="list-content">
                                <h4>{{$value->name}}</h4>
                                <p>{{$value->role_title}}</p>
                            </div>
                          </div>
                        </td>
                         <td>
                           <select class="form-control" name="status" data-id="{{encrypt($value->id)}}">
                              <option @if($value->is_active === '1') {{'selected'}} @endif value="active">Active</option>
                              <option @if($value->is_active === '0') {{'selected'}} @endif value="inactive">Inactive</option>
                            </select>
                        </td>
                        <td class="action-btn">
                            <div class="btn-group" role="group" aria-label="Basic example">
                            <a href="{{route('role.edit',encrypt($value->id))}}" type="button" class="btn btn-sm btn-primary">{{ _('Edit') }}</a> 
                          {{--  <a href="javascript:void()" type="button" class="btn btn-sm btn-danger btn-delete" data-url="{{route('role.destroy',encrypt($value->id))}}">{{ _('Delete') }}</a> --}}
                             </div>
                        </td>
                      </tr><!--end-->
                      @empty
                       <tr>
                        <td colspan="6">{{ _('Record not found') }}</td>
                       </tr>
                      @endforelse
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12 text-right">
                 {{ $data['roles']->links() }}
              </div>
            </div>
<!-- Modal -->
<div id="deleteModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">

    <!-- Modal content-->
    <form action="" method="POST">@csrf(){{@method_field('POST')}}
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Delete Role</h4>
      </div>
      <div class="modal-body">
        <p>Are you sure to delete this role.</p>
      </div>
      <div class="modal-footer">
      <div class="btn-group"> 
           <input type="submit" name="Delete"  class="btn btn-danger" value="Confirm">
           <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
      </div>
      </div>
    </div>
  </form>
  </div>
</div>

<!-- Modal -->
<div id="statusModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">

    <!-- Modal content-->
    <form action="{{route('role.status')}}" method="POST">@csrf(){{@method_field('POST')}}
  <input type="hidden" name="status" value="">
  <input type="hidden" name="id" value="">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Change Role Status</h4>
      </div>
      <div class="modal-body">
        <p>Are you sure want to update status.</p>
      </div>
      <div class="modal-footer">
      {{--  <div class="btn-group"> --}}
           <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
           <input type="submit" name="Delete"  class="btn btn-danger" value="Confirm">
   {{--     </div> --}}
      </div>
    </div>
  </form>
  </div>
</div>
            </div>
        </div>
    </div>
</x-app-layout>
