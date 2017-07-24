<form enctype="multipart/form-data" method="post" action="/auth/registration" class="form-signin" id="new_customer">
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" id="email" name="email" required="required">
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" id="password" name="password" required="required">
    </div>
    <div class="form-group">
        <label for="repeatPassword">Repeat password</label>
        <input type="password" class="form-control" id="repeatPassword" name="repeatPassword" required="required">
    </div>

    <button type="submit" class="btn btn-primary" id="submitRegistration">Submit</button>
</form>
<script src="/js/registration.js"></script>
