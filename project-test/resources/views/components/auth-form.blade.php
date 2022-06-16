@if(!auth()->check())
  <form method="post" action="/sign-in" class="fh5co-form animate-box" data-animate-effect="fadeIn">
    @csrf
    <h2>Sign In</h2>
    <div class="form-group">
      <label for="email" class="sr-only">Username</label>
      <input type="text" class="form-control" id="email" name="email" placeholder="email" autocomplete="off">
      @error("email")
				<span class="text-danger"> {{ $message }} </span>
			@enderror
    </div>
    <div class="form-group">
      <label for="password" class="sr-only">Password</label>
      <input type="password" class="form-control" id="password" name="password" placeholder="Password" autocomplete="off">
    </div>
    <div class="form-group">
      <p>Not registered? <a href="sign-up">Sign Up</a> | <a href="/forgot-password">Forgot Password?</a></p>
    </div>
    <div class="form-group">
      <input type="submit" value="Sign In" class="btn btn-primary">
    </div>
    @if($errors->any())
			@foreach($errors->all() as $error)
        <ul class="form-group">
          <li class="text-danger">{{ $error }}</li>
        </ul>
			@endforeach
		@endif
  </form>
@else
  <form method="post" action="/sign-out" class="fh5co-form animate-box" data-animate-effect="fadeIn">
    @csrf
    <div class="form-group">
      <a href="/forgot">Forgot Password?</a></p>
    </div>
    <div class="form-group">
      <input type="submit" value="Sign Out" class="btn btn-primary">
    </div>
  </form>
@endif
