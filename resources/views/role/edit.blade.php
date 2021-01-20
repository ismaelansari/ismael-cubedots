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
                @foreach ($errors->all() as $error)
        <div>{{ $error }}</div>
    @endforeach

                         <form role="form" action="{{route('role.update',encrypt($data['role']->id))}}" method="post" enctype="multipart/form-data" >
                          @csrf()
                          {{ @method_field('PUT')}}
            <div class="create-tournament">

              <div class="input-fields">

                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Role Title</label>
                      <input type="text" placeholder="Role Title" class="form-control" name="role_title" value="{{old('role_title') ?? $data['role']->name}}"autocomplete="off">
                      @if ($errors->has('role_title'))
                        <span class="text-error" role="alert">
                           <strong>{{ $errors->first('role_title') }}</strong>
                        </span>
                      @endif
                    </div>
                  </div>
                </div>
                <div class="row">
                <div class="col-md-12">
            <div class="form-group">
              <label>Role Desctiption</label>
              <textarea name="description" class="form-control">{{old('description') ?? $data['role']->description}}</textarea>
            </div>
          </div>
          <div class="col-md-12">
            <div class="row">
              <div class="form-group">
                 <div class="col-md-12">
                  <div class="form-group">
                    <h4>Premissions</h4>
                    <label> <input type="checkbox" id="ckbCheckAll" />
                    Check All</label>
                  </div>
                </div>
              @foreach ($data['modules'] as $module)
                <div class="col-md-3">
                  <h4>{{ $module->module_name }}</h4> 
                  <div class="scroll-div">
                    <div class="form-group">
                      @foreach ($module->permissions as $permission)
                      <div class="checkbox">
                        <label>
                          <input type="checkbox" name="permissions[]" value="{{$permission->id}}"
                        @isset ($data['role'])
                            @foreach ($data['role']->permissions as $role_permit)
                              @if ($role_permit->id == $permission->id)
                                checked
                              @endif 
                           @endforeach
                        @endisset
                      >{{$permission->permission_name}}
                        </label>
                      </div>
                      @endforeach
                    </div>
                  </div>
                </div>
              @endforeach
              </div>
            </div>
          </div>

                <div class="button">
                  <button class="btn btn-default">Update</button>
                </div>

              </div>
            </div>
          </form>
@include('common.backButton',['backUrl' => route('role.index')])
@push('css')
@endpush
@push('js')
  <script type="text/javascript">

$('.btn-remove').on('click',function(e){
  id = $(this).attr('data-id');
  $('input[name="id"]').val(id);
    $('#myModal').modal('toggle');
});

$(document).ready(function () {
    $("#ckbCheckAll").click(function () {
        $('input[type="checkbox"]').prop('checked', $(this).prop('checked'));
    });
    
    $('input[type="checkbox"]').change(function(){
        if (!$(this).prop("checked")){
            $("#ckbCheckAll").prop("checked",false);
        }
    });
});


  </script>
@endpush
            </div>
        </div>
    </div>
</x-app-layout>


 