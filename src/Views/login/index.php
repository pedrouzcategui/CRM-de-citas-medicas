<style>
 form {
    width: 50%;
    margin: 0px auto;
    div {
        margin-bottom: 10px;
        label {
            display: block;
            margin: 10px 0px;
        }
        input, button {
            width: 100%;
            padding: 5px;
        }
    }
 }
 
</style>

<form action="/login" method="POST">
    <div>
       <h1 class="text-center">Login</h1>
    </div>
    <div>
        <label for="email">Email</label>
        <input type="email" name="email" required/>
    </div>
    <div>
        <label for="password">Password</label>
        <input type="password" name="password" required/>
    </div>
    <div>
        <button>Login</button>
    </div>
</form>