<p>
  <a style="text-decoration:none;" data-toggle="collapse"data-toggle="collapse" href="#dd-{{ isset($title) ? str_slug($title):'permissionHeading' }}" role="button" aria-expanded="false" aria-controls="collapseExample">
    <h3>{{$title}} {!! isset($user) ? '<span class="text-danger">(' . $user->getDirectPermissions()->count() . ')</span>' : '' !!}</h3>
  </a>
</p>
<div class="collapse"  id="dd-{{ isset($title) ? str_slug($title) :  'permissionHeading' }}">
  <div class="card card-body">
   
         <div class="row">
                    @foreach($permissions as $perm)
                        <?php
                            $per_found = null;
    
                            if( isset($role) ) {

                                $per_found = $role->hasPermissionTo($perm->name);
                              
                            }
    
                            if( isset($user)) {
                                $per_found = $user->hasDirectPermission($perm->name);
                            }
                          
                        ?>
  
                        <div class="col-md-3">
                            <div class="checkbox">
                            <div class="form-group">
                                <label class="{{ str_contains($perm->name, 'delete') ? 'text-danger' : '' }}">
                                <input  <?php  echo ($per_found==null)? '':'checked'; ?> name="permissions[]" type="checkbox" value="{{$perm->id}}"> <b>{{$perm->name}}</b> 
                                </label>
                            </div>
                            </div>
                        </div>
                    @endforeach

                </div>

  </div>
</div>