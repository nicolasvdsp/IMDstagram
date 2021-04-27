# Connection with Database
* Make a new file "settings.php" in the settings folder.
* Paste following code in the newly created file:

```
<?php

    const SETTINGS = [
        "db" => [
        
            "host" => "localhost", //localhost
            "db" => "IMDstagram", //name database
            "port" => 8889, //port, you can find this on phpMyAdmin
            "user" => "root", // username, root for development purposes
            "password" => "root" //password, root for development purposes
    ]
];
```

* Whenever a connection is required, use: $conn = Db::getConnection();
* Never commit settings.php (it's already listed in the .gitignore file)



# Before you start:

* Always pull before writing code, so you're always up to date
* Keep the master branch intact: Test and experiment on a branch, only merge to main when it works
* When contributing, follow the commit conventions (discord channal)


# check
Bas
