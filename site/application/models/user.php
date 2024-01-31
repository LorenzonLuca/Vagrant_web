<?php
class User
{
    /**
     * @throws Exception
     */
    public static function getUser($username, $password) {
        $statement = 'SELECT * FROM user WHERE username = :username;';
        $result = DB_CONNECTION->prepare($statement);
        $result->bindParam(':username', $username, PDO::PARAM_STR);
        $result->execute();
        $user = $result->fetch(PDO::FETCH_OBJ);

        if (!$user) {
            throw new Exception();
        }
        if (password_verify($password, $user->password)) {
            unset($user->password);
            return $user;
        } else {
            throw new Exception();
        }
    }

    public static function createUser($username, $password, $admin){
        $statement = 'SELECT * FROM user WHERE username = :username;';
        $result = DB_CONNECTION->prepare($statement);
        $result->bindParam(':username', $username, PDO::PARAM_STR);
        $result->execute();
        $user = $result->fetch(PDO::FETCH_OBJ);

        if (!$user) {
            $password = password_hash($password, PASSWORD_BCRYPT);
            $statement = 'INSERT INTO user (username, password, admin) VALUES (:username, :password, :admin)';
            $result = DB_CONNECTION->prepare($statement);
            $result->bindParam(':username', $username, PDO::PARAM_STR);
            $result->bindParam(":password", $password, PDO::PARAM_STR);
            $result->bindParam(":admin", $admin, PDO::PARAM_BOOL);
            $result->execute();

            return true;
        }else{
            return false;
        }
    }
}