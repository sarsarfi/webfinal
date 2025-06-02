<h1>فرم ثبت‌نام</h1>

<form method="POST" action="/webfinal/register">
    <div class="mb-3">
        <label for="name" class="form-label">نام</label>
        <input type="text" class="form-control" id="name" name="name" required>
    </div>

    <div class="mb-3">
        <label for="email" class="form-label">ایمیل</label>
        <input type="email" class="form-control" id="email" name="email" required>
    </div>

    <div class="mb-3">
        <label for="password" class="form-label">رمز عبور</label>
        <input type="password" class="form-control" id="password" name="password" required>
    </div>

    <button type="submit" class="btn btn-primary">ثبت‌نام</button>
</form>
