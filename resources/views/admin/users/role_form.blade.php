
<div hidden class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
    <label for="name" class="col-md-2 control-label">{{ trans('users.name') }}</label>
    <div class="col-md-10">
        <input class="form-control" name="name" type="text" id="name" value="{{ old('name', optional($user)->name) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('users.name__placeholder') }}">
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div hidden class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
    <label for="email" class="col-md-2 control-label">{{ trans('users.email') }}</label>
    <div class="col-md-10">
        <input class="form-control" name="email" type="text" id="email" value="{{ old('email', optional($user)->email) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('users.email__placeholder') }}">
        {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<!-- Roles Form Input -->

<div class="form-group {{ $errors->has('label') ? 'has-error' : '' }} ml-1 mr-1">
        <label for="label" class="col-md-2 control-label">Roles</label>
        <div class="col-md-10">
            @foreach ($roles as $role)

            <input {{ isset($user)? $user->hasRole($role->name)? 'checked': '' :""}} name="roles[]" type="checkbox" value="{{$role->id}}">
            <label for="{{$role->name}}">{{ucfirst($role->name)}}</label><br>

            @endforeach
        </div>
    </div>
