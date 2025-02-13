<!-- resources/views/auth/login.blade.php -->
<form method="POST" action="{{ route('login') }}">
  @csrf

  <div>
      <label for="email">Email</label>
      <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>
      @error('email')
          <span role="alert">{{ $message }}</span>
      @enderror
  </div>

  <div>
      <label for="password">Password</label>
      <input id="password" type="password" name="password" required autocomplete="current-password">
      @error('password')
          <span role="alert">{{ $message }}</span>
      @enderror
  </div>

  <div>
      <button type="submit">Login</button>
  </div>
</form>
