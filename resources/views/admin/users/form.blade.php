<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
    <label for="name" class="col-md-2 control-label">First Name</label>
    <div class="col-md-10">
        <input class="form-control" name="first_name" type="text" id="first_name" value="{{ old('first_name', optional($user)->first_name) }}" minlength="1" maxlength="255" required="true" placeholder="First Name">
        {!! $errors->first('first_name', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
    <label for="name" class="col-md-2 control-label">Middle Name</label>
    <div class="col-md-10">
        <input class="form-control" name="middle_name" type="text" id="middle_name" value="{{ old('middle_name', optional($user)->middle_name) }}" minlength="1" maxlength="255" required="true" placeholder="Middle Name">
        {!! $errors->first('middle_name', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
    <label for="name" class="col-md-2 control-label">Last Name</label>
    <div class="col-md-10">
        <input class="form-control" name="last_name" type="text" id="last_name" value="{{ old('last_name', optional($user)->last_name) }}" minlength="1" maxlength="255" required="true" placeholder="Last Name">
        {!! $errors->first('last_name', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('gender') ? 'has-error' : '' }}">
    <label for="gender" class="col-md-2 control-label">Gender</label>
    <div class="col-md-10">
        <select class="form-control" name="gender" type="text" id="gender">
          @foreach(['MALE' => 'MALE', 'FEMALE' => 'FEMALE'] as $key => $gender)
            <option value="{{ $key }}" {{ old('gender', optional($user)->gender) == $key ? 'selected':'' }}>
              {{ $gender  }}
            </option>
          @endforeach
        </select>
        {!! $errors->first('gender', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
    <label for="email" class="col-md-2 control-label">{{ trans('users.email') }}</label>
    <div class="col-md-10">
        <input class="form-control" name="email" type="text" id="email" value="{{ old('email', optional($user)->email) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('users.email__placeholder') }}">
        {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('mobile_phone') ? 'has-error' : '' }}">
    <label for="mobile_phone" class="col-md-2 control-label">{{ trans('Phone') }}</label>
    <div class="col-md-10">
        <input class="form-control" name="mobile_phone" type="tel"  id="mobile_phone" value="{{ old('mobile_phone', optional($user)->mobile_phone) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('Phone') }}">
        {!! $errors->first('mobile_phone', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div hidden class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
    <label for="password" class="col-md-2 control-label">Password</label>
    <div class="col-md-10">
        <input class="form-control" name="password" type="tel"  id="password" value="12345678" minlength="1" maxlength="255" required="true" placeholder="{{ trans('Phone') }}">
        {!! $errors->first('password', '<p class="help-block">:message</p>') !!}
    </div>
</div>


<div hidden class="form-group">
  <label for="label" class="col-md-2 control-label">Database(s)</label>
  <div class="col-md-12">

    @php

      $databases = [];
      if ($user){
        $databases = optional($user)->userDatabases;
        $databases = $databases->toArray();
      }

    @endphp

    @if (count($db_connections)>0)
      @foreach($db_connections as $db_connection)

        <input {{ (count(array_keys(array_combine(array_keys($databases), array_column($databases, 'name')),$db_connection)) > 0)? 'checked': ''}} name="db_connections[]" type="checkbox" value="{{ $db_connection }}" checked>
        <label for="{{ $db_connection }}">{{ ucwords(strtolower(str_replace("_"," ",$db_connection))) }}</label><br>

      @endforeach
    @endif

  </div>
</div>

<div class="form-group {{ $errors->has('label') ? 'has-error' : '' }} ml-1 mr-1">
    <label for="label" class="col-md-2 control-label">Role(s)</label>
    <div class="col-md-10">
        @foreach ($roles as $role)

        <input {{ isset($user)? $user->hasRole($role->name)? 'checked': '' :""}} name="roles[]" type="checkbox" value="{{$role->id}}">
        <label for="{{$role->name}}">{{ucfirst($role->name)}}</label><br>

        @endforeach
    </div>
</div>
