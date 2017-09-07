<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapse" data-target="collapse" data-toggle="#navbar" aria-expanded="false" aria-controls="true">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="#" class="navbar-brand">S-Avicii</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="active"><a href="/Controller/Auth/About">About us</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container backgroundimg">

    <div class="body_head">
        <h1 align="center">Mon Cheri</h1>
        <h3 align="center">I've gotta carry my cross without you.</h3>
    </div>

    <div class="input-group group_pos">
        <input class="form-control inputsize" type="text" name="username" placeholder="please input your username">
    </div>
    <div class="input-group group_pos">
        <input class="form-control inputsize" type="password" name="token" placeholder="please input your token">
    </div>

    <div class="register_pos">
        <a onclick="popRegisterWin()" href="#">Don't have the Assign? Check!</a>
    </div>

    <div class="btn-toolbar grouppos">
        <div class="btn-group" role="group" aria-label="...">
            <button type="button" class="btn-info login_btn" id="login_btn">Login</button>
        </div>
        <div class="btn-group" role="group" aria-label="...">
            <button type="button" class="btn-info login_btn" id="find_token">Forgot?</button>
        </div>
    </div>
</div>
<script language="JavaScript">
    $(function () {
        $("#login_btn").click(function () {
            Login();
        });

        $("#find_token").click(function () {
            popFindTokenWin();
        })
    })
</script>