<form id="formAuthUserSignup" class="userForms">
    <div class="form-group">
        <h1>Signup</h1>

        <div class="form-group">
            <label>Name:</label>
            <input class="form-control" id="formAuthUserSignupName">
        </div>    

        <div class="form-group">
            <label>Email:</label>
            <input class="form-control" id="formAuthUserSignupEmail">
        </div>  

        <div class="form-group">
            <label>Password:</label>
            <input class="form-control" id="formAuthUserSignupPassword" type="password">
        </div> 

        <div class="form-group">
            <label>Password confirmation:</label>
            <input class="form-control" id="formAuthUserSignupPasswordConfirm" type="password">
        </div>   

        <div class="form-group">
            <label>Status:</label>
            <p id="formAuthUserSignupStatus" class="statusForm">Unknown</p>
        </div>   

    </div>
    <button type="button" class="btn btn-primary" onclick="sendAuthUserSignupForm()">Submit</button>
</form>

<form id="formAuthUserLogin" class="userForms">
    <div class="form-group">
        <h1>Login</h1>
        <div class="form-group">
            <label>Email:</label>
            <input class="form-control" id="formAuthUserLoginEmail">
        </div>  

        <div class="form-group">
            <label>Password:</label>
            <input class="form-control" id="formAuthUserLoginPassword" type="password">
        </div> 

        <div class="form-group">
            <label>Status:</label>
            <p id="formAuthUserLoginStatus" class="statusForm">Unknown</p>
        </div> 

    </div>
    <button type="button" class="btn btn-primary" onclick="sendAuthUserLoginForm()">Submit</button>
</form>

<form id="formAuthUserLogout" class="userForms">
    <div class="form-group">
        <h1>Logout</h1>
        <div class="form-group">
            <label>Token:</label>
            <input class="form-control" id="formAuthUserLogoutToken">
        </div>  
        <div class="form-group">
            <label>Status:</label>
            <p id="formAuthUserLogoutStatus" class="statusForm">Unknown</p>
        </div> 
    </div>
    <button type="button" class="btn btn-primary" onclick="sendAuthUserLogoutForm()">Submit</button>
</form>