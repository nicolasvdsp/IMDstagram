# Connection with Database
* Make a new file "settings.php" in the settings folder.
* Paste following code in the newly created file:

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

* Whenever a connection is required, use: $conn = Db::getConnection();
* Never commit settings.php (it's already listed in the .gitignore file)



# voor je begint:

! pull voor je aan je code begint

master branch(moet altijd werkende blijven)

develop branch (tussen branch voor mergen met master)

feature/example(feature branch waar je 1 feature op doen) vb. feature/register

klaar met feature branch pull request naar develop en review door teamleden voor merging (zodat er niets kapot gaat van een andere team lid door merge)

