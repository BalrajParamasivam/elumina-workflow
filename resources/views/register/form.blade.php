@include('../include.header')

<div class="container" style="margin-top:5%;margin-bottom:5%">

@if(Auth::user())

<!-- response -->
@if(session('loginresponce'))
<!--login-->
@if(session('loginresponce')=='success')
<div class="alert alert-success col-md-12" role="alert">
  Login Successfully
</div>

@endif

@endif

<!-- response -->
@if(session('response'))




<!--new register-->
@if(session('response')=='added')
<div class="alert alert-success col-md-6" role="alert">
  Register Successfully
</div>

@endif

<!--Update-->
@if(session('response')=='success')
<div class="alert alert-success col-md-6" role="alert">
  {{session('message')}}
</div>

@endif

<!--Failed-->
@if(session('response')=='failed')
<div class="alert alert-danger col-md-6" role="alert">
{{session('message')}}
</div>

@endif

@endif
<!-- response end-->

<!-- error response -->
@if ($errors->any())
    <div class="alert alert-danger col-md-6">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<!-- response  end -->
@if(Auth::user()->hasRole('customer'))
<!-- Form -->
<form action="{{route('register.store')}}" method="POST" id="registerForm" class="mb-4">

{{ csrf_field() }}

  <div class="form-row mb-4">

    <!--first name-->
    <div class="form-group col-md-6">
      <label for="firstname">FirstName</label>
      <input type="text" class="form-control" name="firstname" id="firstname">
    </div>

    <!--last name-->
    <div class="form-group col-md-6">
      <label for="lastname">LastName</label>
      <input type="text" class="form-control" name="lastname" id="lastname">
    </div>

    <!--email-->
    <div class="form-group col-md-6">
      <label for="email">Email</label>
      <input type="email" class="form-control"  name="email" id="email">
    </div>

    <!--dateofbirth-->
    <div class="form-group col-md-6">
      <label for="date_of_birth">Date Of Birth</label>
      <input type="text" class="form-control" name="date_of_birth" readonly id="date_of_birth">
    </div>
    </div>

    <button type="submit" class="btn btn-primary">Register</button>
</form>
@endif
<!-- form end -->

@if(Auth::user()->hasRole('admin'))
<!-- Table -->
<table id="registerTable" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
        <thead>
            <tr>
                <th>First name</th>
                <th>Last name</th>
                <th>Email</th>
                <th>DateOf Birth</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($register as $reg)
            <tr>
                <td>{{ $reg->firstname }}</td>
                <td>{{ $reg->lastname }}</td>
                <td>{{ $reg->email }}</td>
                <td>{{ date('d-m-Y', strtotime($reg->dateofbirth)) }}</td>
                <td>
                <form action="{{ route('register.update', $reg->id) }}"  method="POST" onsubmit="return confirm('You Want to Update?');"  >
                {{ csrf_field() }}
                @method('PUT')

        <div class="row">
        <div class="form-group col-md-3">
            Status
        </div>
                <div class="form-group col-md-6">
                    <select class="form-control" id="status" name="status">
                    <option value="draft"  @if($reg->status=='draft') selected @endif  >Draft</option>
                    <option value="to_review" @if($reg->status=='review') selected @endif >Review</option>
                    <option value="approve" @if($reg->status=='approved') selected @endif >Approved</option>
                    <option value="reject" @if($reg->status=='rejected') selected @endif >rejected</option>
                    </select>
                </div>
                <div class="col-md-3">
                <button type="submit" class="btn btn-primary btn-raised" >Update</button>
                </div>
                </div>
                </form>

                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
<!-- Table End-->
@endif

@else

<!-- response -->
@if(session('loginresponce'))



<!--login-->
@if(session('loginresponce')=='failed')
<div class="alert alert-danger col-md-6" role="alert">
  Login Failed
</div>

@endif



@endif

<!-- Form -->
<form action="{{url('/login')}}" method="POST" id="loginForm" class="mb-4">

{{ csrf_field() }}

  <div class="form-row mb-4">

  <small id="emailHelp" class="form-text text-muted">
      <p>
          admin Role: name:admin ,password : admin
          <br>
          Customer Role: name: customer ,password :customer
      </p>
      </small>

    <!--name-->
    <div class="form-group col-md-6">
      <label for="name">Name</label>
      <input type="text" class="form-control" name="name" id="name" required>


    </div>
     <!--password-->
     <div class="form-group col-md-6">
      <label for="password">Password</label>
      <input type="password" class="form-control" name="password" id="password" required>


    </div>
    </div>
    <button type="submit" class="btn btn-primary">Sign in</button>
</form>
<!-- form end -->


@endif
</div>

@include('../include.footer')


