    <div class="container theme-showcase mask rgba-gradient align-items-center rounded pb-4" role="main">

        <!-- Main jumbotron for a primary marketing message or call to action -->
        <div class="container">
        
            <div class="row mt-15 pt-3 pb-4">

                <div class="col-md-12 pt-1 text-center ">
                    <ul class="nav float-left ">
                        <li><a href="/login/index_signin" style="color: white" data-wow-delay="0.3s"><span class="fa fa-user h1" aria-hidden="true"></span> Sign in</button></a></li>
                    </ul>
                    <ul class="nav float-right ">
                    <br>
                        <li><a href="/login/index_signup" style="color: white" data-wow-delay="0.3s"><span class="fa fa-user-edit h1" aria-hidden="true"></span> Sign up</button></a></li>
                    </ul>
                </div>
            </div>

        <div class="mx-auto col-md-4 col-md-offset-4 text-center">
                <p class="bg-primary"><em><em id='errors'></em></em></p>
                <form id='signup' method="post" action="#">
                    <div class="form-group">
                        <label class="h5" for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                    </div>
                    <div class="form-group">
                        <label class="h5" for="username">User name</label>
                        <input type="text" class="form-control" id="username" name="username" placeholder="User name">
                    </div>
                    <div class="form-group">
                        <label class="h5" for="name">First name</label>
                        <input type="text" class="form-control" id="name" name="name"
                               placeholder="First name">
                    </div>
                    <div class="form-group">
                        <label class="h5" for="lname">Last name</label>
                        <input type="text" class="form-control" id="lname" name="lname" placeholder="Last name">
                    </div>
                    <div class="form-group">
                        <label class="h5" for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password"
                               placeholder="Password">
                    </div>
                    <div class="form-group">
                        <label class="h5" for="password2">Confirm password</label>
                        <input type="password" class="form-control" id="password2" name="password2"
                               placeholder="Confirm password">
                    </div>
                    <button type="submit" class=" btn btn-outline-success" name="submit">Submit</button>
                </form>
        </div>
    </div>