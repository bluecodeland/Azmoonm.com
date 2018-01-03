برای بازیابی رمز عبور خود اینجا را کلیک کنید: <a href="{{ $link = url('password/reset', $token).'?email='.urlencode($user->getEmailForPasswordReset()) }}"> {{ $link }} </a>
