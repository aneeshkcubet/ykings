<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="utf-8">
    </head>
    <body>
        <h2>Reset Your Password</h2>

        <div>
            Yo have requested to reset your password on Ykings app.
            Click here to reset your password: {{ url('password/reset/'.$token) }}
        </div>

    </body>
</html>